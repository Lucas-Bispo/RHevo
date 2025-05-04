from sqlalchemy import Column, Integer, String
from app.db.base import Base

class LotacaoTributaria(Base):
    """
    Representa uma lotação tributária conforme o evento S-1005 do eSocial.
    Cada registro corresponde a uma unidade onde servidores podem estar lotados.
    """

    __tablename__ = "lotacoes_tributarias"

    id = Column(Integer, primary_key=True, index=True)

    tp_insc = Column(Integer, nullable=False, doc="Tipo de inscrição do empregador: 1=CNPJ, 2=CPF")
    nr_insc = Column(String(14), nullable=False, doc="Número da inscrição (CNPJ/CPF)")

    ini_valid = Column(String(7), nullable=False, doc="Início da validade no formato AAAA-MM")
    fim_valid = Column(String(7), nullable=True, doc="Fim da validade no formato AAAA-MM (opcional)")

    cod_lotacao = Column(String(20), nullable=False, unique=True, doc="Código da lotação tributária")
    fpas = Column(String(3), nullable=False, doc="Código FPAS conforme tabela do eSocial")
    cod_categ = Column(String(3), nullable=True, doc="Categoria padrão dos servidores nessa lotação")
