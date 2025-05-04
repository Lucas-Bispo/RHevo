from datetime import date
from pydantic import BaseModel, constr
from typing import Optional
from app.schemas.lotacao import LotacaoRead  # Importa schema da lotação

class ServidorBase(BaseModel):
    cpf: constr(min_length=11, max_length=11)
    nome: str
    sexo: str
    data_nascimento: date
    escolaridade: int
    nacionalidade: int
    cod_municipio_nascimento: Optional[str] = None
    data_admissao: date
    categoria_trabalhador: str
    tipo_vinculo: str

    lotacao_id: int  # Agora referenciando a tabela de lotação

    cargo: Optional[str] = None
    funcao: Optional[str] = None
    remuneracao: Optional[int] = None

class ServidorCreate(ServidorBase):
    """Schema usado na criação de servidores"""
    pass

class ServidorRead(ServidorBase):
    """Schema retornado pela API incluindo o ID e os dados da lotação"""
    id: int
    lotacao: Optional[LotacaoRead]  # Resposta aninhada da lotação

    class Config:
        from_attributes = True
