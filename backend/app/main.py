from fastapi import FastAPI

app = FastAPI()

@app.get("/")
async def root():
     return {"message": "Prefeitura RH Backend - FastAPI ativo!"}