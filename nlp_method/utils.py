import pickle
from SBERT_MLP.BigFiveModel import BigFiveTrainer, BigFiveModel
from SBERT_MLP.embeddings import TextEmbedder
from SBERT_MLP.process_data import DatasetProcessor
import torch
import numpy as np


def covert_ocean_mbti(ocean_json):
    personality_type = ""
    if ocean_json["extraversion"] >= 50:
        personality_type += "E"
    else:
        personality_type += "I"

    if ocean_json["openness"] >= 50:
        personality_type += "S"
    else:
        personality_type += "N"

    if ocean_json["agreeableness"] >= 50:
        if ocean_json["neuroticism"] >= 50:
            personality_type += "F"
        else:
            personality_type += "F"
    else:
        personality_type += "T"

    if ocean_json["conscientiousness"] >= 50:
        personality_type += "J"
    else:
        personality_type += "P"

    return personality_type


def mix_personality_scores(audio_video_scores: dict, txt_scores: np.ndarray, k_vid_aud: float = 0.5, k_text: float = 0.5) -> dict:
    if np.any(txt_scores < 1):
        txt_scores = (txt_scores * 100).astype(int)

    text_scores_dict = {
        "extraversion": txt_scores[0, 0],
        "neuroticism": txt_scores[0, 1],
        "agreeableness": txt_scores[0, 2],
        "conscientiousness": txt_scores[0, 3],
        "openness": txt_scores[0, 4],
    }

    mixed_scores = {}
    for trait, av_score in audio_video_scores.items():
        text_score = text_scores_dict[trait]
        mixed_score = int(av_score * k_vid_aud + text_score * k_text)
        mixed_scores[trait] = mixed_score

    return mixed_scores


def text_embedding(text: str):
    process = DatasetProcessor(text)
    return process.get_embeddings(TextEmbedder())


def get_txt_score(transcript: str):
    device = torch.device("cuda" if torch.cuda.is_available() else "cpu")

    model = BigFiveModel(embedding_dim=384)
    predictor = BigFiveTrainer(model=model)
    predictor.load_weights("SBERT_MLP/weights/big_five_model_03.pth")
    if isinstance(transcript, str) and transcript.endswith('.pkl'):
        embeddings = text_embedding(transcript)
        predict = {}
        for file, embedding in embeddings.items():
            pred = predictor.predict(embedding=embedding, device=device)
            if file not in predict:
                predict[file] = {}
            predict[file] = pred
        return predict

    else:
        predict = predictor.predict(embedding=text_embedding(transcript), device=device)
        return predict


def save_metrics_to_pkl(predictions, output_file="processed_metrics.pkl"):
    metrics = ["extraversion", "neuroticism", "agreeableness", "conscientiousness", "openness"]

    processed_data = {metric: {} for metric in metrics}

    for video_filename, values in predictions.items():
        for i, metric in enumerate(metrics):
            processed_data[metric][video_filename] = float(values[0][i])

    with open(output_file, "wb") as f:
        pickle.dump(processed_data, f)

