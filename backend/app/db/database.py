from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker
from app.core.config import settings

# Criar o engine usando a URL definida nas configurações
engine = create_engine(settings.DATABASE_URL)

# Criar a fábrica de sessões (permite iniciar e finalizar transações)
SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=engine)

"""
Função utilitária que pode ser usada como dependência no FastAPI
para obter uma sessão com o banco de dados.
"""
def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()
