from pydantic import BaseSettings

class Settings(BaseSettings):
    # Define a configuração da URL do banco de dados
    DATABASE_URL: str = "postgresql://rhuser:rhpass@db:5432/rhdb"

    class Config:
        # Especifica o arquivo de ambiente que será utilizado
        env_file = ".env"

# Cria uma instância da classe Settings, carregando as configurações
settings = Settings()

