# INDT - Challenge

Este desafio consiste em desenvolver uma interface em PHP para importação de autores e
livros na Library App:
- Definir layout do arquivo de importação
- Desenvolver interface WEB para envio do arquivo
- Qualquer framework (php, css e js) é permitido
- Publicar o projeto em repositório na nuvem (github, gitlab, etc)
- Instruções de instalação e deploy no arquivo README

## Setup

- Para instalar o PHP, git, composer e suas dependências (e.g. Debian) execute este comando no terminal:

      sudo apt -y install php7.1 php7.1-bcmath php7.1-bz2 php7.1-cgi php7.1-cli php7.1-common php7.1-curl php7.1-enchant php7.1-gd php7.1-imap php7.1-interbase php7.1-intl php7.1-json php7.1-ldap php7.1-mbstring php7.1-mcrypt php7.1-mysql php7.1-odbc php7.1-pgsql php7.1-pspell php7.1-readline php7.1-recode php7.1-soap php7.1-sqlite3 php7.1-sybase php7.1-tidy php7.1-xml php7.1-xsl php7.1-zip apache2 apache2-dev apache2-utils libapache2-mod-php7.1 git composer curl

- Clone este repositório no seus sistema:

      git clone https://github.com/leonmbj/indt-challenge.git

- Entre no diretório:

      cd indt-challenge

- Instale o Laravel:

      composer global require "laravel/installer"
    
    Tenha certeza que diretório `$HOME/.composer/vendor/bin`  (ou `$HOME/.config/composer/vendor/bin`) está contido no $PATH para que os executáveis do Laravel fiquem disponíveis (e.g.: no Debian, adidionei a linha `PATH="$HOME/.config/composer/vendor/bin:$PATH"` ao arquivo `~/.profile`). Mais informações em: https://laravel.com/docs/5.5/installation

- Instale as dependências do projeto (backend):

      composer install
    
- Instale as dependências do projeto (frontend):
    
      npm install
    
- Execute o comanda abaixo para iniciar o servidor web nativo do PHP

      php artisan serve

- Inicie o uso da aplicação:

      http://127.0.0.1:8000/
    
## Uso da aplicação

A tarefa consiste em fazer o uploda de um arquivo. A aplicação percorrerá este arquivo e irá extrair os dados e salvá-los na nuvem através da api [https://bibliapp.herokuapp.com/explorer/]

- **1**: Layout do arquivo de importação:

O arquivo de importação deve ter o formato csv, ou seja, colunas separadas por vírgula [,] e linhas separadas por nova linha do arquivo, na sequência `Livro,Autor`.  A extensão deste arquivo deve ser ou .csv ou .txt. Se a primeira linha tiver a informação escrita `Livro,Autor`, ou `Livros,Autores`, esta linha será ignorada. 
  
Abaixo, um exemplo de conteúdo de arquivo (o nome deste arquivo pode ser **arquivo.txt**, por exemplo):
  
        
    O Código DaVinci,Dan Brown
    A Fortaleza,Dan Brown
    O Regresso,Michael Punke
    Harry Potter e A Criança Amaldiçoada,J. K. Rowling
    O Universon Numa Casca de Noz,Stephen Hawking
    Só A Gente Sabe O Que Sente,Frederico Elboni
    O Imperador De Todos Os Males,Siddhartha Mukherjee
    A Morte Em Veneza & Tonio Krueger,Thomas Mann
    Ensaio Sobre a Cegueira,José Saramago
    


- **2**: Fazer o upload:

Ao abrir a raiz web do projeto [em http://127.0.0.1:8000/] teremos a tela de upload do arquivo de importação. Esta tela também mostrará os livros e seus autores que já foram importados. Clique no botão **Selecionar Arquivo**, então selecione o arquivo correto de acordo com a formatação explicada anteriormente.

Depois de selecionado o arquivo, clique no botão **Upload** para enviar o arquivo.

- **3**: Resultado esperado:

O sistema fará o processamento do arquivo e então retornará à mesma tela, com uma mensagem de sucesso na parte superior.

Também aparecerá abaixo a lista de livros e seus autores.

Caso se tente importar autores ou livros que já tenham sido importados anteriormente, estes serão ignorados. Não haverá repetição de registros.

    
## Executar testes

Para executar testes unitários, execute o comando no terminal, na raiz do projeto:

    vendor/phpunit/phpunit/phpunit
