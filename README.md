# DOC Validator - API
 - Projeto em formato de API REST que valida e formata documentos como CPF e CNPJ.
 - Desenvolvida com PHP puro, sendo a unica dependencia o PHPUnit, framework utilizado para fazer os testes unitários do código.
 
## Como executar a aplicação
### O que será necessário
  - Sistema operacional linux (Distros Recomendadas: Debian, Ubuntu ou suas ramificações). Obs: caso utilize Windows você pode usar o linux com WSL: |
  <a href="https://learn.microsoft.com/pt-br/windows/wsl/install"> Como instalar o Linux no Windows com o WSL <a>  
  - Docker Engine
  - Docker Compose
  - De algum client HTTP de sua preferência, pode ser um formulário simples no HTML ou clients como POSTMAN ou INSOMNIA
  
### Passos para executar
  - Após ter clonado pela primeira vez o projeto é necessária adicionar o dominio do projeto nos hosts da sua maquina, se estiver utilizando linux so arquivo se encotra no diretório /etc e o nome do arquivo se chama hosts, basta edita-lo e adicionar a seguinte linha 
  - Após ter clonado o projeto em su máquina é necessário startar os containers e dentro do container habilitar o modulo Rewrite do Apache2, para facilitar isso criei um script que esta localizado na raiz do projeto basta estar na pasta do projeto e executar 
\
\
  `./project-start.sh` 
\
\
 Ele irá baixar as imagens e subir os containers para sua máquina
 
