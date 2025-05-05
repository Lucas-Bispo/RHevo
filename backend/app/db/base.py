from sqlalchemy.orm import DeclarativeBase

class Base(DeclarativeBase):
    pass

# 🔁 Função que importa os modelos quando necessário (evita importações circulares)
def import_models():
    import app.db.models.servidor
    import app.db.models.lotacao
