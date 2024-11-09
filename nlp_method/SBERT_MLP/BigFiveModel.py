import torch
import torch.nn as nn
import torch.optim as optim
import numpy as np
from sklearn.metrics import f1_score
from sklearn.metrics import mean_squared_error


class BigFiveModel(nn.Module):
    def __init__(self, embedding_dim=384, hidden_dim=768, output_dim=5, dropout_rate=0.5):
        """
        Инициализация модели BigFiveModel
        embedding_dim (int): Размерность входных векторных представлений
        hidden_dim (int): Размер скрытых слоев
        output_dim (int): Количество классов (Big Five, т.е. 5 характеристик)
        dropout_rate (float): Уровень dropout для регуляризации
        """
        super(BigFiveModel, self).__init__()

        self.fc1 = nn.Linear(embedding_dim, hidden_dim)
        self.fc2 = nn.Linear(hidden_dim, hidden_dim)
        self.fc3 = nn.Linear(hidden_dim, output_dim)
        self.relu = nn.ReLU()
        self.dropout = nn.Dropout(dropout_rate)
        self.layer_norm = nn.LayerNorm(hidden_dim)

    def forward(self, x):
        x = self.fc1(x)
        x = self.relu(x)
        x = self.layer_norm(x)
        x = self.dropout(x)
        x = self.fc2(x)
        x = self.relu(x)
        x = self.fc3(x)
        return x


class BigFiveTrainer:
    def __init__(self, model, learning_rate=0.001, lr_scheduler=None):
        """
        Инициализация тренера
        model (nn.Module): модель для обучения
        learning_rate (float): начальная скорость обучения
        lr_scheduler (torch.optim.lr_scheduler): планировщик для изменения скорости обучения
        """
        self.model = model
        self.criterion = nn.MSELoss()
        self.optimizer = optim.Adam(self.model.parameters(), lr=learning_rate)
        self.lr_scheduler = lr_scheduler or optim.lr_scheduler.StepLR(self.optimizer, step_size=20, gamma=0.1)

    def train(self, train_loader, num_epochs=20, device='cpu'):
        """
        Обучение модели
        train_loader (DataLoader): загрузчик данных для обучения
        num_epochs (int): количество эпох для обучения
        device (str): устройство для вычислений ('cpu' или 'cuda')
        """
        self.model.to(device)
        self.model.train()

        for epoch in range(num_epochs):
            running_loss = 0.0
            for embeddings, targets in train_loader:
                embeddings, targets = embeddings.to(device), targets.to(device)

                self.optimizer.zero_grad()
                outputs = self.model(embeddings)
                loss = self.criterion(outputs, targets)
                loss.backward()
                self.optimizer.step()

                running_loss += loss.item()

            self.lr_scheduler.step()
            print(f"Эпоха [{epoch + 1}/{num_epochs}], Потери: {running_loss / len(train_loader):.4f}")
            print(f"Текущий learning rate: {self.optimizer.param_groups[0]['lr']:.6f}")

    def predict(self, embedding, device='cpu'):
        """
        Предсказание для новых данных
        embedding (Tensor): Вектор представления для предсказания
        device (str): Устройство для вычислений ('cpu' или 'cuda')
        """
        self.model.to(device)
        self.model.eval()

        with torch.no_grad():
            embedding = embedding.to(device)
            output = self.model(embedding)

        return output.cpu().numpy()

    def evaluate_mse(self, val_loader, device='cpu'):
        """
        Оценка модели на валидационном датасете с использованием MSE
        val_loader (DataLoader): загрузчик данных для валидации
        device (str): устройство для вычислений ('cpu' или 'cuda')
        """
        self.model.to(device)
        self.model.eval()

        all_targets = []
        all_preds = []

        with torch.no_grad():
            for embeddings, targets in val_loader:
                preds = self.predict(embeddings, device=device)

                preds = preds.squeeze()
                all_preds.extend(preds.tolist())

                all_targets.extend(targets.cpu().numpy().tolist())

        all_targets = np.array(all_targets)
        all_preds = np.array(all_preds)

        if all_targets.shape != all_preds.shape:
            print(f"Несоответствие размерности: {all_targets.shape} vs {all_preds.shape}")
            return None

        mse = mean_squared_error(all_targets, all_preds)
        print(f"MSE на валидационном датасете: {mse:.4f}")
        return mse

    def evaluate_mf1(self, val_loader, device='cpu'):
        """
        Оценка модели на валидационном датасете с использованием mF1
        val_loader (DataLoader): загрузчик данных для валидации
        device (str): устройство для вычислений ('cpu' или 'cuda')
        """
        self.model.to(device)
        self.model.eval()

        all_targets = []
        all_preds = []

        with torch.no_grad():
            for embeddings, targets in val_loader:
                preds = self.predict(embeddings, device=device)

                # Получаем бинарные метки по порогу 0.5
                preds_binary = [1 if p >= 0.5 else 0 for p in preds.flatten().tolist()]

                targets_binary = [1 if t >= 0.5 else 0 for t in targets.cpu().numpy().tolist()]

                all_preds.extend(preds_binary)
                all_targets.extend(targets_binary)

        all_targets = np.array(all_targets)
        all_preds = np.array(all_preds)

        if all_targets.shape != all_preds.shape:
            print(f"Несоответствие размерности: {all_targets.shape} vs {all_preds.shape}")
            return None

        mf1 = f1_score(all_targets, all_preds)
        print(f"mF1 на валидационном датасете: {mf1:.4f}")
        return mf1

    def save_weights(self, path="big_five_model.pth"):
        """
        Сохранение весов модели
        path (str): Путь для сохранения весов
        """
        torch.save(self.model.state_dict(), path)
        print(f"Модель сохранена в {path}")

    def load_weights(self, path="big_five_model.pth", device='cpu'):
        """
        Загрузка весов модели
        path (str): Путь для загрузки весов
        device (str): Устройство для загрузки ('cpu' или 'cuda')
        """
        self.model.load_state_dict(torch.load(path, map_location=device))
        print(f"Модель загружена из {path}")

