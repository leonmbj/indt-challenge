# INDT - Challenge

Este desafio consiste em desenvolver uma interface em PHP para importação de autores e
livros na Library App:
- Definir layout do arquivo de importação
- Desenvolver interface WEB para envio do arquivo
- Qualquer framework (php, css e js) é permitido
- Publicar o projeto em repositório na nuvem (github, gitlab, etc)
- Instruções de instalação e deploy no arquivo README

## Setup

- Instale o PHP, git, composer e suas dependências (e.g. Debian):

    `sudo apt install php7.1 php7.1-bcmath php7.1-bz2 php7.1-cgi php7.1-cli php7.1-common php7.1-curl php7.1-enchant php7.1-gd php7.1-imap php7.1-interbase php7.1-intl php7.1-json php7.1-ldap php7.1-mbstring php7.1-mcrypt php7.1-mysql php7.1-odbc php7.1-pgsql php7.1-pspell php7.1-readline php7.1-recode php7.1-soap php7.1-sqlite3 php7.1-sybase php7.1-tidy php7.1-xml php7.1-xsl php7.1-zip apache2 apache2-dev apache2-utils libapache2-mod-php7.1 git composer curl`

- Clone este repositório no seus sistema:

    `git clone https://github.com/leonmbj/indt-challenge.git`

- Entre no diretório:

    `cd indt-challenge`

- Instale o Laravel:

    `composer global require "laravel/installer"`
    
    Tenha certeza que diretório `$HOME/.composer/vendor/bin`  (ou `$HOME/.config/composer/vendor/bin`) está contido no $PATH para que os executáveis do Laravel fiquem disponíveis (e.g.: no Debian, adidionei a linha `PATH="$HOME/.config/composer/vendor/bin:$PATH"` ao arquivo `~/.profile`).

- Instale as dependências do projeto (backend):

    `composer install`
    
- Instale as dependências do projeto (frontend):
    
    `npm install`
    
- Execute o comanda abaixo para iniciar o servidor web nativo do PHP

    `php artisan serve`

- Inicie o uso da aplicação:

    http://127.0.0.1:8000/
    
## Uso da aplicação

A tarefa consiste em fazer o uploda de um arquivo. A aplicação percorrerá este arquivo e irá extrair os dados e salvá-los na nuvem através da api [https://bibliapp.herokuapp.com/explorer/]

- **1**: Layout do arquivo de importação:

O arquivo de importação deve ter o formato csv, ou seja, colunas separadas por vírgula [,] e linhas separadas por nova linha do arquivo, na sequência `Livro,Autor`.  A extensão deve ser ou .csv ou .txt. Se a primeira linha tiver a informação escrita `Livro,Autor`, ou `Livros,Autores`, esta linha será ignorada. 
  
Abaixo, um exemplo de arquivo:
  
        
    O Código DaVinci,Dan Brown
    
    A Fortaleza,Dan Brown
    
    O Regresso,Michael Punke
    
    Harry Potter e A Criança Amaldiçoada,J. K. Rowling
    
    O Universon Numa Casca de Noz,Stephen Hawking
    
    Só A Gente Sabe O Que Sente,Frederico Elboni
    
    O Imperador De Todos Os Males,Siddhartha Mukherjee
    
    A Morte Em Veneza & Tonio Krueger,Thomas Mann
    
    Ensaio Sobre a Cegueira,José Saramago
    


- **Task 3**: The command to request data of last 3 days from NASA's API:

    docker exec -it mcmakler_php_1 php bin/console app:neo:fetch
    
The alternate way is to enter the container and run the command from there:

    docker exec -it mcmakler_php_1 bash
    
    php bin/console app:neo:fetch
    

This will fetch the data from NASA's API and persist it into our MySQL database.
On success, a message similar to the following will be shown on the console:

    Total NEO objects fetched from NASA: 41.
    
- **Task 4**: Display all potentially hazardous asteroids:

    http://localhost:8080/neo/hazardous

- **Task 5**: Calculate and return the model of the fastest asteroid:

    http://localhost:8080/neo/fastest?hazardous={true|false}

- **Task 6**: Calculate and return a year with the most asteroids

    http://localhost:8080/neo/best-year?hazardous={true|false}

- **Task 7**: Calculate and return a month with the most asteroids

    http://localhost:8080/neo/best-month?hazardous={true|false}
    
## Running Tests

To run the tests:

    docker exec -it mcmakler_php_1 vendor/bin/phpunit

## Original Instructions

### Test tasks:

1. Specify a default controller
  - for route `/`
  - with a proper json return `{"hello":"world!"}`

2. Use the api.nasa.gov
  - the API-KEY is `N7LkblDsc5aen05FJqBQ8wU4qSdmsftwJagVK7UD`
  - documentation: https://api.nasa.gov/neo/?api_key=N7LkblDsc5aen05FJqBQ8wU4qSdmsftwJagVK7UD
  
3. Write a command
  - to request the data from the last 3 days from nasa api
  - response contains count of Near-Earth Objects (NEOs)
  - persist the values in your DB
  - Define the model as follows:
    - date
    - reference (neo_reference_id)
    - name
    - speed (kilometers_per_hour)
    - is hazardous (is_potentially_hazardous_asteroid)

4. Create a route `/neo/hazardous`
  - display all DB entries which contain potentially hazardous asteroids
  - format JSON

5. Create a route `/neo/fastest?hazardous=(true|false)`
  - analyze all data
  - calculate and return the model of the fastest asteroid
  - with a hazardous parameter, where `true` means `is hazardous`
  - default hazardous value is `false`
  - format JSON

6. Create a route `/neo/best-year?hazardous=(true|false)`
  - analyze all data
  - calculate and return a year with most asteroids
  - with a hazardous parameter, where `true` means `is hazardous`
  - default hazardous value is `false`
  - format JSON

7. Create a route `/neo/best-month?hazardous=(true|false)`
  - analyze all data
  - calculate and return a month with most asteroids (not a month in a year)
  - with a hazardous parameter, where `true` means `is hazardous`
  - default hazardous value is `false`
  - format JSON
   
### Additional Instructions

- ☑ Fork this repository
- ☑ Tests are not optional
- ☑ (PHP) Symfony is the expected framework
- After you're done, provide us the link to your repository.
- Leave comments where you were not sure how to properly proceed.
- ☑ Implementations without a README will be automatically rejected.

### Bonus Points

- Clean code!
- Knowledge of application flow.
- Knowledge of modern best practices/coding patterns.
- Componential thinking.
- Knowledge of Docker.
- Usage of MongoDB as persistance storage.