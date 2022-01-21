## Siga as seguintes instruções para começar a codificar:

OBS: Esse projeto foi desenvolvidor para rodar em PHP 7>

# Abra o terminal de comando na pasta do projeto e execute:
	composer install
	composer dump-autoload

# Configure o arquivo .env com os dados de sua base de dados:
	DBDRIVER="{DBDRIVER}";
	DBHOST="{DBHOST}";
	DBNAME="{DBNAME}";
	DBUSER="{DBUSER}";
	DBPASS="{DBPASS}";
	DBPORT="{DBPORT}";

# Para testar o código, abra o terminal na pasta principal do arquivo e rode os seguintes comandos:
	vendor\bin\phinx migrate
	vendor\bin\phinx seed:run

## Funcionalidades:

==> Acesso Local

# Para acessar o projeto localmente, basta abrir o terminal na pasta do projeto e digitar o comando:
	composer run-script dev
- Abra seu navegador e acesse:
  127.0.0.1:8080

==> Rotas

# Para registrar uma nova rota:
- Abra o arquivo route-list.php em "routes/route-list.php":
- Registre uma nova rota como mostrado no arquivo;
- Para acessar essa nova rota no navegador localmente, configure a url para:
  localhost/standard-eloquent-project/categorias
  ou
  127.0.0.1:8080/categorias
- Para acessar essa nova rota no navegador remotamente, configure a url para:
  www.domain.com/categorias

==> Migrações

# Para criar uma nova migração, abra o terminal na pasta principal do projeto e rode o comando:
	vendor\bin\phinx create MyFirstMigration
# Para migrar as tabelas para o banco de dados, rode o comando:
	vendor\bin\phinx migrate
# Para dar um rollback, rode o comando:
	vendor\bin\phinx rollback

==> Seeders

# Para criar um novo Seeder, abra o terminal na pasta principal do projeto e rode o comando:
	vendor\bin\phinx seed:create MyFirstSeeder
# Para rodar um Seeder, use o comando:
	vendor\bin\phinx seed:run
# Para rodas um Seeder específico, use o comando:
	vendor\bin\phinx seed:run -s MyFirstSeeder -s MySecondSeeder

# =========================================== #

## Follow the given steps to start coding:

PS: This project was built to run in PHP 7>

# Open terminal at root directory and run:
	composer install
	composer dump-autoload

# Configure the file .env to your database info:
	DBDRIVER="{DBDRIVER}";
	DBHOST="{DBHOST}";
	DBNAME="{DBNAME}";
	DBUSER="{DBUSER}";
	DBPASS="{DBPASS}";
	DBPORT="{DBPORT}";

# To test the project, open the terminal at root directory and run the following codes:
	vendor\bin\phinx migrate
	vendor\bin\phinx seed:run

## Engine

==> Local Access

# You can access the project locally, open the terminal at project's root directory and run:
	composer run-script dev
- Open navigator and browse for:
  127.0.0.1:8080

==> Routes

# To register a new route:
-Open the file route-list.php at "routes/route-list.php":
-Add a new route following the example in the file;
-To reach this page at navigator locally, set url to:
localhost/standard-eloquent-project/categories
or
127.0.0.1:8080/categories
-To reach this page at navigator remotely, set url to:
www.domain.com/categories

==> Migrations

# To create a new migration, open the terminal at root directory and run:
	vendor\bin\phinx create MyFirstMigration
# Execute migrate by running the command:
	vendor\bin\phinx migrate
# Execute rollback by running the command:
	vendor\bin\phinx rollback

==> Seeders

# To create a new seeder, open the terminal at root directory and run:
	vendor\bin\phinx seed:create MyFirstSeeder
# Execute migrate by running the command:
	vendor\bin\phinx seed:run
# Execute a specific migrate by running the command:
	vendor\bin\phinx seed:run -s MyFirstSeeder -s MySecondSeeder
