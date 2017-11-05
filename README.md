# INDT - Challenge

Este desafio consiste em desenvolver uma interface em PHP para importação de autores e
livros na Library App:
- Definir layout do arquivo de importação
- Desenvolver interface WEB para envio do arquivo
- Qualquer framework (php, css e js) é permitido
- Publicar o projeto em repositório na nuvem (github, gitlab, etc)
- Instruções de instalação e deploy no arquivo README

## Setup

- Clone this repository to your local system:

    `git clone git@github.com:sawant/basic-backend-interview-test.git mcmakler`

- Go into the directory:

    `cd mcmakler`

- Use Docker Compose to orchestrate the application:

    `docker-compose up -d --build`

- Install/update PHP/Symfony packages:

    `docker exec -it mcmakler_php_1 composer update`

- Start using the application:

    http://localhost:8080
    
## Tasks Demonstration

- **Task 1**: Accessing the root location should fulfill this task:

    http://localhost:8080

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