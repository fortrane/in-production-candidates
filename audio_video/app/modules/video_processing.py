import json
import uuid
import os

import requests
from app.core.config import settings

import app.utils.metrics_start as ms
class VideoProcessing:
    def __init__(self, identity: str, original_video: str):
        self.identity = identity
        self.original_video = original_video

    def start(self):
        video_path = f"temp/{self.identity}.mp4"

        self.download_video(self.original_video,video_path)
        ms.make_metrics(video_path,self.identity)

    def send_data(self,res_data):
        processed_data = {
            "id": self.identity,
            "status": "Completed",
            "metric_score": json.dumps(res_data)
        }

        self.update_api(processed_data)

    def download_video(self,video_url, output_path):
        os.makedirs(os.path.dirname(output_path), exist_ok=True)
        response = requests.get(video_url, stream=True)

        if response.status_code == 200:
            with open(output_path, 'wb') as file:
                for chunk in response.iter_content(chunk_size=8192):
                    file.write(chunk)

        else:
            print(f"{response.status_code}")
    def update_api(self, data):
        response = requests.post(f"{settings.API_LINK}updateVideoData", data={
            "secret-key": settings.API_SECRET_TOKEN,
            **data
        })
        if response.status_code != 200:
            print(f"Failed to update API: {response.text}")
