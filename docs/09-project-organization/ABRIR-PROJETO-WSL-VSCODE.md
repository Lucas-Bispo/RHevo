# Abrir o Projeto do WSL no VS Code do Windows

Este guia mostra como abrir no VS Code do Windows o projeto que está dentro do WSL em `/var/www/RHevo`.

## Caminho do projeto

No WSL, o projeto está em:

```bash
/var/www/RHevo
```

No Windows Explorer ou no VS Code do Windows, o mesmo caminho pode ser acessado por:

```text
\\wsl.localhost\Ubuntu-24.04\var\www\RHevo
```

## Abrir pelo terminal WSL

Abra o terminal do WSL e execute:

```bash
code /var/www/RHevo
```

Na primeira execução, o VS Code pode instalar ou atualizar o VS Code Server dentro do WSL. Isso é esperado e pode demorar alguns minutos.

Quando abrir corretamente, o VS Code deve mostrar no canto inferior esquerdo algo parecido com:

```text
WSL: Ubuntu-24.04
```

## Abrir pelo VS Code do Windows

Também é possível abrir manualmente pelo VS Code:

1. Abra o VS Code no Windows.
2. Use `File > Open Folder...`.
3. Cole o caminho:

```text
\\wsl.localhost\Ubuntu-24.04\var\www\RHevo
```

## Se não conseguir salvar arquivos

Se o projeto abrir, mas os arquivos não puderem ser editados ou salvos, provavelmente há um problema de permissão na pasta `/var/www/RHevo`.

Verifique o dono da pasta com:

```bash
ls -la /var/www
```

Se a pasta estiver com dono `nobody:nogroup`, ajuste para o usuário do WSL:

```bash
sudo chown -R predador:predador /var/www/RHevo
```

Depois disso, tente abrir novamente:

```bash
code /var/www/RHevo
```
