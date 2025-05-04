from pydantic import BaseModel, constr
from typing import Optional

class LotacaoBase(BaseModel):
    tp_insc: int  # 1 = CNPJ, 2 = CPF
    nr_insc: constr(min_length=8, max_length=14)
    ini_valid: constr(min_length=7, max_length=7)
    fim_valid: Optional[constr(min_length=7, max_length=7)] = None

    cod_lotacao: constr(min_length=1, max_length=20)
    fpas: constr(min_length=3, max_length=3)
    cod_categ: Optional[constr(min_length=3, max_length=3)] = None

class LotacaoCreate(LotacaoBase):
    """Schema usado na criação de uma nova lotação tributária"""
    pass

class LotacaoRead(LotacaoBase):
    """Schema retornado pela API com o ID incluído"""
    id: int

    class Config:
        from_attributes = True  # permite conversão automática do modelo SQLAlchemy
