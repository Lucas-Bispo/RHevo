from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from app.schemas.lotacao import LotacaoCreate, LotacaoRead
from app.crud import lotacao as crud_lotacao
from app.db.database import get_db

router = APIRouter(
    prefix="/lotacoes",
    tags=["lotacoes tributárias"]
)

@router.post("/", response_model=LotacaoRead)
def criar_lotacao(lotacao: LotacaoCreate, db: Session = Depends(get_db)):
    """
    Cria uma nova lotação tributária.
    """
    return crud_lotacao.criar_lotacao(db, lotacao)

@router.get("/", response_model=list[LotacaoRead])
def listar_lotacoes(db: Session = Depends(get_db)):
    """
    Retorna a lista de lotações cadastradas.
    """
    return crud_lotacao.listar_lotacoes(db)

@router.get("/{lotacao_id}", response_model=LotacaoRead)
def obter_lotacao(lotacao_id: int, db: Session = Depends(get_db)):
    """
    Retorna os dados de uma lotação específica pelo ID.
    """
    lotacao = crud_lotacao.buscar_lotacao_por_id(db, lotacao_id)
    if not lotacao:
        raise HTTPException(status_code=404, detail="Lotação não encontrada")
    return lotacao
