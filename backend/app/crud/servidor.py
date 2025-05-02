from sqlalchemy.orm import Session
from app.db.models.servidor import Servidor
from app.schemas.servidor import ServidorCreate

def criar_servidor(db: Session, servidor: ServidorCreate):
    db_servidor = Servidor(**servidor.dict())
    db.add(db_servidor)
    db.commit()
    db.refresh(db_servidor)
    return db_servidor

def listar_servidores(db: Session, skip: int = 0, limit: int = 10):
    return db.query(Servidor).offset(skip).limit(limit).all()

def buscar_servidor_por_id(db: Session, servidor_id: int):
    return db.query(Servidor).filter(Servidor.id == servidor_id).first()
