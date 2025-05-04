from fastapi import FastAPI
from app.api.v1 import servidor, lotacao  # importa o roteador

app = FastAPI(
    title="RHEVO - Sistema de RH para Prefeituras",
    version="0.1.0",
)

# Rota de teste
@app.get("/")
def read_root():
    return {"message": "API RHEVO ativa!"}

# ✅ Importa as rotas do módulo Servidor (S-2200)
app.include_router(servidor.router)
app.include_router(lotacao.router)