# AML Challenge
## Autor: Thiago Pereira

Para executar a aplicação, certifique-se de seguir os passos abaixo

- Verificar se o arquivo db.json está na página raíz do projeto;
- Ter instalado nos pacotes globais do npm o json server;
### Instalando JSON Server globalmente
```sh
npm i -g json-server
```
### Executando json server
Certifique-se antes de executar o combando abaixo que você está na mesma pasta do arquivo db.json
```sh
json-server --watch db.json
```
### Executando código PHP
Após executado json-serve inicie a aplicação PHP com o comando abaixo.
### Instalando JSON Server globalmente
```sh
php -S localhost:8000
```

### Acessando aplicação via web
No seu navegador de preferência, após executar os comandos no terminal acesse a url
http://localhost:8000

Espero que tenha conseguido acessar todas as funções do CRUD.



## License
MIT
