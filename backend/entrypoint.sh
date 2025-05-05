#!/bin/bash
echo "Aguardando disponibilidade do PostgreSQL..."

# Loop até a porta 5432 do serviço 'db' estar disponível
while ! nc -z db 5432; do
  sleep 1
done

echo "PostgreSQL está disponível. Iniciando o backend..."
exec uvicorn app.main:app --host 0.0.0.0 --port 8000 --reload