FROM python:3.11-slim-bookworm

WORKDIR /app

# Atualiza pacotes do sistema
RUN apt-get update && apt-get upgrade -y && apt-get install -y gcc libpq-dev

COPY requirements.txt .
RUN pip install --no-cache-dir -r requirements.txt

COPY ./app ./app

CMD ["uvicorn", "app.main:app", "--host", "0.0.0.0", "--port", "8000", "--reload"]
