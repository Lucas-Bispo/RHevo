from fastapi import FastAPI
from app.db.database import get_db

app = FastAPI(title="Sistema de RH para Prefeituras")

@app.get("/")
def root():
    return {"message": "Sistema de RH iniciado com sucesso!"}
