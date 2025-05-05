from pydantic_settings import BaseSettings

class Settings(BaseSettings):
    DATABASE_URL: str = "postgresql://rhuser:rhpass@db:5432/rhdb"  # Valor padrão para desenvolvimento local

    class Config:
        env_file = ".env"
        env_file_encoding = "utf-8"

settings = Settings()