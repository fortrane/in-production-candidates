import os

os.environ['CUDA_VISIBLE_DEVICES'] = '-1'
os.environ['TF_FORCE_GPU_ALLOW_GROWTH'] = 'true'

import tensorflow as tf

tf.config.set_visible_devices([], 'GPU')

from tensorflow.keras.models import Model
from tensorflow.keras.layers import Input, Conv2D, MaxPooling2D, Dense, Flatten, concatenate
from tensorflow.keras.layers import BatchNormalization, TimeDistributed, Lambda, LSTM, Concatenate
from keras.applications import vgg16
import numpy as np
import ffmpeg as ff
import librosa
import cv2
import random
import time

def create_model():
    with tf.device('/CPU:0'):
        audio_input = Input(shape=(24, 1319, 1))
        audio_model = Conv2D(32, kernel_size=(3, 3), activation='relu')(audio_input)
        audio_model = BatchNormalization()(audio_model)
        audio_model = MaxPooling2D(pool_size=(2, 2))(audio_model)
        audio_model = Conv2D(32, kernel_size=(3, 3), activation='relu')(audio_model)
        audio_model = BatchNormalization()(audio_model)
        audio_model = MaxPooling2D(pool_size=(2, 2))(audio_model)
        audio_model = Flatten()(audio_model)
        audio_model = Dense(128, activation='relu')(audio_model)
        audio_subnetwork = Model(inputs=audio_input, outputs=audio_model)

        visual_model = Input(shape=(6, 128, 128, 3))

        cnn = vgg16.VGG16(weights="imagenet", include_top=False, pooling='max')
        cnn.trainable = False

        encoded_frame = TimeDistributed(Lambda(lambda x: cnn(x)))(visual_model)
        encoded_vid = LSTM(64)(encoded_frame)

        visual_subnetwork = Model(inputs=visual_model, outputs=encoded_vid)

        combined = Concatenate()([audio_subnetwork.output, visual_subnetwork.output])
        final1 = Dense(256, activation='relu')(combined)
        final2 = Dense(5, activation='linear')(final1)

        combined_network = Model(inputs=[audio_input, visual_model], outputs=final2)

        return combined_network


def predict_personality_from_video(video_path: str, weights_path='C:/Users/Admin/Desktop/hrmatching/app/utils/neural_audio_video/model_weights.h5'):

    model = create_model()

    model.load_weights(weights_path)
    video=f"C:/Users/Admin/Desktop/hrmatching/{video_path}"
    print("video_path",video)
    b = time.time()
    extracted_audio_raw, sr = extract_audio_from_video(file_path=video)
    preprocessed_audio = preprocess_audio_series(raw_data=extracted_audio_raw, sr=sr)

    sampled_frames = extract_N_video_frames(video_path, number_of_samples=6)
    resized_frames = [resize_image(image=frame, new_size=(248, 140)) for frame in sampled_frames]
    cropped_frames = [crop_image_window(image=frame, training=False) / 255.0 for frame in resized_frames]
    preprocessed_video = np.stack(cropped_frames)

    audio_input = preprocessed_audio.reshape(1, *preprocessed_audio.shape)
    video_input = preprocessed_video.reshape(1, *preprocessed_video.shape)
    print("end init",time.time())

    prediction = model.predict([audio_input, video_input])


    personality_traits = ['Neuroticism', 'Extraversion', 'Agreeableness', 'Conscientiousness', 'Openness']
    results = {trait: float(pred) for trait, pred in zip(personality_traits, prediction[0])}
    print("res",time.time()-b)
    return results


def extract_audio_from_video(file_path: str) -> np.ndarray:
    inputfile = ff.input(file_path)
    out = inputfile.output('-', format='f32le', acodec='pcm_f32le', ac=1, ar='44100')
    raw = out.run(capture_stdout=True)
    del inputfile, out
    sr = 44100
    return np.frombuffer(raw[0], np.float32), sr


def preprocess_audio_series(raw_data: np.ndarray, sr: int) -> np.ndarray:
    N, M = 24, 1319

    mfcc_data = librosa.feature.mfcc(y=raw_data, sr=sr, n_mfcc=N)

    mfcc_data_standardized = (mfcc_data - np.mean(mfcc_data)) / np.std(mfcc_data)

    number_of_columns_to_fill = M - mfcc_data_standardized.shape[1]
    padding = np.zeros((N, number_of_columns_to_fill))

    padded_data = np.hstack((padding, mfcc_data_standardized))

    return padded_data.reshape(N, M, 1)


def get_number_of_frames(file_path: str) -> int:
    probe = ff.probe(file_path)
    video_streams = [stream for stream in probe["streams"] if stream["codec_type"] == "video"]
    return int(video_streams[0]['nb_frames'])


def extract_N_video_frames(file_path: str, number_of_samples: int = 6) -> list:
    nb_frames = get_number_of_frames(file_path)
    video_frames = []
    random_indexes = random.sample(range(0, nb_frames), number_of_samples)

    cap = cv2.VideoCapture(file_path)
    for ind in random_indexes:
        cap.set(1, ind)
        res, frame = cap.read()
        video_frames.append(cv2.cvtColor(frame, cv2.COLOR_BGR2RGB))
    cap.release()
    return video_frames


def resize_image(image: np.ndarray, new_size: tuple) -> np.ndarray:
    return cv2.resize(image, new_size, interpolation=cv2.INTER_AREA)


def crop_image_window(image: np.ndarray, training: bool = False) -> np.ndarray:
    height, width, _ = image.shape
    if training:
        MAX_N = height - 128
        MAX_M = width - 128
        rand_N_index, rand_M_index = random.randint(0, MAX_N), random.randint(0, MAX_M)
        return image[rand_N_index:(rand_N_index + 128), rand_M_index:(rand_M_index + 128), :]
    else:
        N_index = (height - 128) // 2
        M_index = (width - 128) // 2
        return image[N_index:(N_index + 128), M_index:(M_index + 128), :]


def predict_personality_from_videodataset_batch(videodateset_path: str,
                                                weights_path='C:/Users/Admin/Desktop/hrmatching/app/utils/neural_audio_video/model_weights.h5'):
    model = create_model()
    model.load_weights(weights_path)

    all_results = {}

    video_folder_path = f"C:/Users/Admin/Desktop/hrmatching/temp"

    if not os.path.isdir(video_folder_path):
        print(f"Error: {video_folder_path} is not a valid directory.")
        return None

    # Списки для аудио и видео данных
    audio_inputs = []
    video_inputs = []
    video_filenames = []

    # Сбор всех данных
    for video_file in os.listdir(video_folder_path):
        video_path = os.path.join(video_folder_path, video_file)

        if not video_path.lower().endswith(('.mp4', '.avi', '.mov', '.mkv')):  # Проверка на видео файлы
            continue

        print(f"Processing video: {video_file}")

        # Извлечение и предобработка аудио
        extracted_audio_raw, sr = extract_audio_from_video(file_path=video_path)
        preprocessed_audio = preprocess_audio_series(raw_data=extracted_audio_raw, sr=sr)
        audio_inputs.append(preprocessed_audio)

        # Извлечение и предобработка видео кадров
        sampled_frames = extract_N_video_frames(video_path, number_of_samples=6)
        resized_frames = [resize_image(image=frame, new_size=(248, 140)) for frame in sampled_frames]
        cropped_frames = [crop_image_window(image=frame, training=False) / 255.0 for frame in resized_frames]
        preprocessed_video = np.stack(cropped_frames)
        video_inputs.append(preprocessed_video)

        # Сохраняем имя видео
        video_filenames.append(video_file)

    # Преобразуем списки в numpy массивы для пакетной обработки
    audio_inputs = np.array(audio_inputs)
    video_inputs = np.array(video_inputs)

    # Предсказания для всех видео в одном батче
    predictions = model.predict([audio_inputs, video_inputs])

    # Обработка результатов для каждого видео
    personality_traits = ['Neuroticism', 'Extraversion', 'Agreeableness', 'Conscientiousness', 'Openness']
    for idx, video_file in enumerate(video_filenames):
        results = {trait: float(pred) for trait, pred in zip(personality_traits, predictions[idx])}
        all_results[video_file] = results

    return all_results
#fas=time.time()
#print(predict_personality_from_videodataset_batch('temp'))
#print(time.time()-fas)
"""
if __name__ == "__main__":
    import time
    print("start",time.time())
    a=time.time()
    predictions = predict_personality_from_video('C:/Users/kirill/Desktop/data/0axZSeaUbfs.002.mp4', 'model_weights.h5')
    print(predictions)
    print(time.time()-a)"""

