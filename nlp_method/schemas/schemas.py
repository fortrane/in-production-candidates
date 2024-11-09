from pydantic import BaseModel


class PersonalityData(BaseModel):
    openness: int
    conscientiousness: int
    extraversion: int
    agreeableness: int
    neuroticism: int
    identity: str
    text: str


class PersonalityScores(BaseModel):
    openness: int
    conscientiousness: int
    extraversion: int
    agreeableness: int
    neuroticism: int
    personality_type: str


class ProcessedPersonalityData(BaseModel):
    personality_scores: PersonalityScores
    identity: str
    secretKey: str
