from fastapi import APIRouter, HTTPException
from fastapi.responses import FileResponse
import os

router = APIRouter()


@router.get("/video/{video_uuid}")
def get_video(video_uuid: str):

    video_path = f"app/temp/{video_uuid}.mp4"

    if not os.path.exists(video_path):
        raise HTTPException(status_code=404, detail="Video not found")

    return FileResponse(video_path, media_type="video/mp4", filename=f"{video_uuid}.mp4")
