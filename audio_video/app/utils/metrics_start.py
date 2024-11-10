import asyncio
import requests
from app.core.config import settings
from app.utils.transcribing_module.ts import audio_to_text
import app.utils.neural_audio_video.audio_video as av
from app.core.config import settings



def make_metrics(video_path,identity):
    text_video=audio_to_text(video_path)['only_t']
    predict=av.predict_personality_from_video(video_path)
    print(text_video)
    print(predict)
    result={
        "openness": int(predict['Openness']*100),
        "conscientiousness": int(predict['Conscientiousness'] * 100),
        "agreeableness": int(predict['Agreeableness'] * 100),
        "extraversion": int(predict['Extraversion'] * 100),
        "neuroticism": int(predict['Neuroticism'] * 100),
        "identity": int(identity),
        "text":text_video
    }
    send_post_request(predict, identity, text_video, f"{settings.SERVER_LINK}continueprocessing")
    print(result)

def send_post_request(predict, identity, text_video, url):
    result = {
        "openness": int(predict['Openness'] * 100),
        "conscientiousness": int(predict['Conscientiousness'] * 100),
        "agreeableness": int(predict['Agreeableness'] * 100),
        "extraversion": int(predict['Extraversion'] * 100),
        "neuroticism": int(predict['Neuroticism'] * 100),
        "identity": identity,
        "text": text_video
    }

    try:
        print("RESULT",url,result)
        response = requests.post(url, json=result)
        if response.status_code == 200:
            print("Request was successful.")
            return response.json()
        else:
            print(f"Request failed with status code {response.status_code}")
            return None

    except requests.exceptions.RequestException as e:
        print(f"An error occurred: {e}")
        return None


def update_api( data):
    response = requests.post(f"{settings.API_LINK}updateVideoData", data={
        "secret-key": settings.API_SECRET_TOKEN,
        **data
    })
    if response.status_code != 200:
        print(f"Failed to update API: {response.text}")

def covert_ocean_mbti(ocean_json):
    personality_type=""
    if ocean_json["extraversion"]>=0.5:
        personality_type+="E"
    else:
        personality_type += "I"

    if ocean_json["openness"]>=0.5:
        personality_type+="N"
    else:
        personality_type += "S"

    if ocean_json["agreeableness"]>=0.5:
        if ocean_json["neuroticism"]>=0.5:
            personality_type+="F"
        else:
            personality_type += "F"
    else:
        personality_type += "T"

    if ocean_json["conscientiousness"]>=0.5:
        personality_type+="J"
    else:
        personality_type += "P"