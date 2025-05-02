from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from app.schemas.servidor import ServidorCreate, ServidorRead
from app.crud import servidor as crud_servidor
from app.db.database import get_db

router = APIRouter(prefix="/servidores", tags=["servidores"])

@router.post("/", response_model=ServidorRead)
def criar_servidor(servidor: ServidorCreate, db: Session = Depends(get_db)):
    return crud_servidor.criar_servidor(db, servidor)

@router.get("/", response_model=list[ServidorRead])
def listar(db: Session = Depends(get_db)):
    return crud_servidor.listar_servidores(db)

@router.get("/{servidor_id}", response_model=ServidorRead)
def obter(servidor_id: int, db: Session = Depends(get_db)):
    servidor = crud_servidor.buscar_servidor_por_id(db, servidor_id)
    if not servidor:
        raise HTTPException(status_code=404, detail="Servidor não encontrado")
    return servidor
