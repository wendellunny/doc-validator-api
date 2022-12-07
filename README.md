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
 
 - Após será necessário adicionar o host no seu arquivo hosts de sua máquina
 \
   - <b>Localização do arquivo no ubuntu/debian:<b/> /etc/hosts
     - Linhas a serem adicionadas: 
     \
     `127.0.0.1      doc-validator.test` 

   - Localização do arquivo no windows: C:\Windows\System32\drivers\etc
     - Linhas a serem adicionadas: 
     \
     `127.0.0.1      doc-validator.test`
     \
     `::1      doc-validator.test`

 
 ### Endpoints
 
 Com o projeto devidamente configurado e iniciado podemos começar a usa-lo
 
 Como configuramos nosso host para ser no url `http://doc-validator.test`, todos endpoints irão partir dele 
 
 - `/cpf/formatter` Endpoint que faz a formatação de um CPF
   - Método: POST
   - Campos a serem enviados:
     - cpf - string 
       - (Enviar o cpf sem pontos e traços)
       
 - `/cpf/validator` Endpoint que faz a validação de um CPF
   - Método: POST
   - Campos a serem enviados:
     - cpf - string 
       - (Enviar o cpf sem pontos e traços)
       
  - `/cnpj/formatter` Endpoint que faz a formatação de um CNPJ
    - Método: POST
    - Campos a serem enviados:
      - cnpj - string 
        - (Enviar o cnpj sem pontos e traços)
       
 - `/cnpj/validator` Endpoint que faz a validação de um CNPJ
    - Método: POST
    - Campos a serem enviados:
      - cnpj - string 
        - (Enviar o cnpj sem pontos e traços)
 
