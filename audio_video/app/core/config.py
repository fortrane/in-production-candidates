from pydantic_settings import BaseSettings
from dotenv import load_dotenv
import os

# pip install pydantic-settings
load_dotenv()


class Settings(BaseSettings):
    API_SECRET_TOKEN: str = "saft2hfd64gfhgf"
    SERVER_LINK: str = "СЕРВЕР"


settings = Settings()
