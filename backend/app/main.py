from fastapi import FastAPI
from app.db.database import SessionLocal
from app.api.v1.servidor import router
app.include_router(servidor.router)

app = FastAPI()

@app.get("/")
def read_root():
    # Testa conexão abrindo e fechando a sessão
    db = SessionLocal()
    try:
        db.execute("SELECT 1")
        return {"message": "Conexão com banco de dados OK"}
    except Exception as e:
        return {"error": str(e)}
    finally:
        db.close()
