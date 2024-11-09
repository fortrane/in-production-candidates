import pickle
import torch
from torch.utils.data import TensorDataset


class DatasetProcessor:
    def __init__(self, transcription_file, annotation_file=None):
        self.transcription_file = transcription_file
        self.annotation_file = annotation_file
        self.transcriptions = self.load_transcriptions()
        self.annotations = self.load_annotations() if annotation_file else None
        self.embeddings_dict = None
        self.embeddings_tensor = None
        self.targets_tensor = None

    def load_transcriptions(self):
        if isinstance(self.transcription_file, str) and self.transcription_file.endswith('.pkl'):
            with open(self.transcription_file, 'rb') as f:
                transcriptions = pickle.load(f, encoding='latin1')
            return dict(transcriptions.items())
        else:
            return self.transcription_file

    def load_annotations(self):
        with open(self.annotation_file, 'rb') as f:
            annotations = pickle.load(f, encoding='latin1')

        formatted_annotations = {}
        for trait, data in annotations.items():
            for file_name, value in data.items():
                if file_name not in formatted_annotations:
                    formatted_annotations[file_name] = {}
                formatted_annotations[file_name][trait] = value

        return formatted_annotations

    def get_embeddings(self, embedding_class):
        embeddings = {}
        embedder = embedding_class
        if isinstance(self.transcriptions, dict):
            for file_name, text in self.transcriptions.items():
                embedding = embedder.get_embedding(texts=text)
                embeddings[file_name] = embedding
            return embeddings
        else:
            embedding = embedder.get_embedding(self.transcriptions)
            return embedding

    def get_annotations(self):
        return self.annotations

    def create_dataset(self, embedding_class):
        """
        Создает датасет с парами (embeddings, targets) для обучения модели.

        Параметры:
        - annotations: словарь, содержащий метрики Big Five для каждого видео.
        - embeddings: словарь, содержащий тензоры эмбеддингов для каждого видео.

        Возвращает:
        - embeddings_tensor: тензор с эмбеддингами текста размерности [batch_size, embedding_dim].
        - targets_tensor: тензор с метриками Big Five размерности [batch_size, 5].
        """
        embeddings = self.get_embeddings(embedding_class)
        self.embeddings_dict = embeddings

        common_ids = set(self.annotations.keys()).intersection(embeddings.keys())

        embedding_list = [embeddings[video_id] for video_id in common_ids]
        target_list = [
            [
                self.annotations[video_id]['extraversion'],
                self.annotations[video_id]['neuroticism'],
                self.annotations[video_id]['agreeableness'],
                self.annotations[video_id]['conscientiousness'],
                self.annotations[video_id]['openness']
            ]
            for video_id in common_ids
        ]

        embeddings_tensor = torch.stack(embedding_list)
        targets_tensor = torch.tensor(target_list, dtype=torch.float32)
        self.embeddings_tensor = embeddings_tensor
        self.targets_tensor = targets_tensor
        return TensorDataset(embeddings_tensor, targets_tensor)

    def check_dataset_integrity(self):
        """
        Проверяет целостность датасета, убеждаясь, что эмбеддинги и метрики Big Five правильно совпадают.
        Также выводит соответствующие данные из target_tensor.
        """
        common_ids = set(self.annotations.keys()).intersection(self.embeddings_dict.keys())

        targets_list = self.targets_tensor.tolist()

        for idx, video_id in enumerate(list(common_ids)[:5]):
            embedding = self.embeddings_dict[video_id]
            metrics = self.annotations[video_id]

            print(f"Video ID: {video_id}")
            print(f"Embedding: {embedding}")
            print(f"Metrics: {metrics}")

            target_data = targets_list[idx]
            print(f"Target data (Big Five): {target_data}")
            print('-' * 40)
