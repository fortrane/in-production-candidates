from fastapi import APIRouter, HTTPException, BackgroundTasks
from app.modules.video_processing import VideoProcessing
from pydantic import BaseModel
from app.utils.security_utils import verify_secret_token

router = APIRouter()


class OceanRequest(BaseModel):
    fileUrl: str
    identity: str
    secret_key: str

@router.post("/create-ocean")
def metrics_processing(request: OceanRequest, background_tasks: BackgroundTasks):
    verify_secret_token(request.secret_key)
    video_processing_task = VideoProcessing(
        request.identity,
        request.fileUrl
    )
    background_tasks.add_task(video_processing_task.start)
    return {"results": "Video processing initiated"}

