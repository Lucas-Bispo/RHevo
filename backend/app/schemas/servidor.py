from datetime import date
from pydantic import BaseModel, constr

class ServidorBase(BaseModel):
    cpf: constr(min_length=11, max_length=11)
    nome: str
    sexo: str
    data_nascimento: date
    escolaridade: int
    nacionalidade: int
    cod_municipio_nascimento: str | None = None
    data_admissao: date
    categoria_trabalhador: str
    tipo_vinculo: str
    cod_lotacao: str | None = None
    cargo: str | None = None
    funcao: str | None = None
    remuneracao: int | None = None

class ServidorCreate(ServidorBase):
    pass

class ServidorRead(ServidorBase):
    id: int

    class Config:
        from_attributes = True