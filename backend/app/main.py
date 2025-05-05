from fastapi import FastAPI
from app.api.v1 import servidor, lotacao

# 🔁 Garante a criação das tabelas do banco
from app.db.database import engine
from app.db import base
# ⏱️ Faz a importação dos modelos apenas quando necessário
base.import_models()
base.Base.metadata.create_all(bind=engine)

app = FastAPI(
    title="RHEVO - Sistema de RH para Prefeituras",
    version="0.1.0",
)

@app.get("/")
def read_root():
    return {"message": "API RHEVO ativa"}

# Importa as rotas da API
app.include_router(servidor.router)
app.include_router(lotacao.router)
