from sqlalchemy import Column, Integer, String, Date, ForeignKey
from sqlalchemy.orm import relationship
from app.db.base import Base

class Servidor(Base):
    __tablename__ = "servidores"

    id = Column(Integer, primary_key=True, index=True)
    cpf = Column(String(11), unique=True, nullable=False)
    nome = Column(String(100), nullable=False)
    sexo = Column(String(1), nullable=False)
    data_nascimento = Column(Date, nullable=False)
    escolaridade = Column(Integer, nullable=False)
    nacionalidade = Column(Integer, nullable=False)
    cod_municipio_nascimento = Column(String(7), nullable=True)

    data_admissao = Column(Date, nullable=False)
    categoria_trabalhador = Column(String(3), nullable=False)
    tipo_vinculo = Column(String(2), nullable=False)

    # ✅ Relacionamento com Lotação Tributária (S-1005)
    lotacao_id = Column(Integer, ForeignKey("lotacoes_tributarias.id"), nullable=False)
    lotacao = relationship("LotacaoTributaria", backref="servidores")

    cargo = Column(String(60), nullable=True)
    funcao = Column(String(60), nullable=True)
    remuneracao = Column(Integer, nullable=True)
