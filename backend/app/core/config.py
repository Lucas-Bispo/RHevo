from pydantic import BaseSettings  # Importa a classe BaseSettings da biblioteca Pydantic para facilitar a configuração baseada em variáveis de ambiente.

class Settings(BaseSettings):  # Define uma classe Settings que herda de BaseSettings.
    DB_HOST: str = "db"  # Define o nome do host do banco de dados com valor padrão "db".
    DB_PORT: int = 5432  # Define a porta do banco de dados com valor padrão 5432.
    DB_USER: str = "postgres"  # Define o usuário do banco de dados com valor padrão "postgres".
    DB_PASSWORD: str = "postgres"  # Define a senha do banco de dados com valor padrão "postgres".
    DB_NAME: str = "rhevo"  # Define o nome do banco de dados com valor padrão "rhevo".

    @property
    def DATABASE_URL(self):  # Define uma propriedade para gerar a URL de conexão com o banco de dados.
        return f"postgresql://{self.DB_USER}:{self.DB_PASSWORD}@{self.DB_HOST}:{self.DB_PORT}/{self.DB_NAME}"

    class Config:  # Define configurações adicionais para a classe Settings.
        env_file = ".env"  # Especifica que as variáveis de ambiente devem ser carregadas de um arquivo .env.

settings = Settings()  # Cria uma instância da classe Settings para ser usada na aplicação.

