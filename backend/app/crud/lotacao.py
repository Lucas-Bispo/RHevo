from sqlalchemy.orm import Session
from app.db.models.lotacao import LotacaoTributaria
from app.schemas.lotacao import LotacaoCreate

def criar_lotacao(db: Session, lotacao: LotacaoCreate):
    """
    Cria uma nova lotação tributária no banco de dados.
    """
    db_lotacao = LotacaoTributaria(**lotacao.dict())
    db.add(db_lotacao)
    db.commit()
    db.refresh(db_lotacao)
    return db_lotacao

def listar_lotacoes(db: Session, skip: int = 0, limit: int = 10):
    """
    Lista todas as lotações cadastradas com paginação.
    """
    return db.query(LotacaoTributaria).offset(skip).limit(limit).all()

def buscar_lotacao_por_id(db: Session, lotacao_id: int):
    """
    Busca uma lotação pelo seu ID.
    """
    return db.query(LotacaoTributaria).filter(LotacaoTributaria.id == lotacao_id).first()
