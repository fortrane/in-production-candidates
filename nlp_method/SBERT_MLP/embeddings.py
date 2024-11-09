from sentence_transformers import SentenceTransformer
import torch


class TextEmbedder:
    def __init__(self, model_name="all-MiniLM-L6-v2", use_gpu=True):
        self.device = torch.device("cuda" if use_gpu and torch.cuda.is_available() else "cpu")
        self.model = SentenceTransformer(model_name)
        self.model.to(self.device)

    def get_embedding(self, texts):
        """
        Получение эмбеддингов для одного или нескольких текстов.

        :param texts: Список строк (или одна строка) для обработки.
        :return: Тензор с эмбеддингами размером [num_texts, embedding_dim].
        """
        if isinstance(texts, str):
            texts = [texts]

        embeddings = self.model.encode(texts, convert_to_tensor=True)  # device не указываем
        return embeddings.to(self.device)

