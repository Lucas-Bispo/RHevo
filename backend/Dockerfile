FROM python:3.11-slim

WORKDIR /app

# Atualiza pacotes do sistema e instala dependências
RUN apt-get update && apt-get upgrade -y && apt-get install -y gcc libpq-dev netcat-openbsd

COPY requirements.txt .
RUN pip install --no-cache-dir -r requirements.txt

COPY ./app ./app
COPY entrypoint.sh ./entrypoint.sh  

RUN chmod +x /app/entrypoint.sh  

CMD ["uvicorn", "app.main:app", "--host", "0.0.0.0", "--port", "8000", "--reload"]