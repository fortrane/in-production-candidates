from fastapi import FastAPI
from schemas.schemas import PersonalityData
import requests
from utils import covert_ocean_mbti, mix_personality_scores, get_txt_score
import uvicorn
import json
import config

app = FastAPI()


@app.post("/continueprocessing")
def metrics_processing(data: PersonalityData):
    personality_scores = {
        "openness": data.openness,
        "conscientiousness": data.conscientiousness,
        "extraversion": data.extraversion,
        "agreeableness": data.agreeableness,
        "neuroticism": data.neuroticism
    }
    identity = data.identity
    text = data.text
    txt_scores = get_txt_score(text)
    print(txt_scores)
    mixed_personality_scores = mix_personality_scores(personality_scores, txt_scores, k_vid_aud=0.5, k_text=0.5)
    personality_type = covert_ocean_mbti(mixed_personality_scores)

    oceanJson = {
            "openness": mixed_personality_scores["openness"],
            "conscientiousness": mixed_personality_scores["conscientiousness"],
            "extraversion": mixed_personality_scores["extraversion"],
            "agreeableness": mixed_personality_scores["agreeableness"],
            "neuroticism": mixed_personality_scores["neuroticism"],
            "personality_type": personality_type
        }

    processed_data = {
        'secretKey': config.SECRET_KEY,
        'identity': str(identity),
        'oceanJson': json.dumps(oceanJson)
    }

    print(processed_data)
    response = requests.post(config.API_URL, data=processed_data)

    response.raise_for_status()
    try:
        response_data = response.json()
        print("Ответ сервера:", response_data)

    except ValueError:
        print("Ответ сервера не является JSON:", response.text)


if __name__ == "__main__":
    uvicorn.run(app, host="0.0.0.0", port=5050)
