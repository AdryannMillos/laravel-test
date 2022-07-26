# Decrição

Olá, o backend dessa aplicação está feito em `Laravel` e o front em `Vue`. O banco de dados utilizado foi o `Mysql`.
Com essa aplicação o usuário consegue criar uma conta, logar, criar, editar e marcar como feito seus itens em uma lista de tarefas. 
O usuário administrados consegue ver os itens de todos os usuários.

# Instruções
- Após baixar os arquivos, abra a pasta.

- Na raiz do projeto terão duas pastas, backend e frontend, com os comandos:

cd backend; composer install; 

- Você entrará na pasta do backend e baixará todas as dependências, nessa mesma pasta você encontrará um arquivo chamado 
.env.exemple, copie-o e renomeie a copia para apenas .env, edite-a de acordo com o banco de dados que irá utilizar na aplicação


- Com o comando:

 php artisan mirgate

- Cria-se as tabelas de usuário e de tarefas no banco de dados

- Com o comando:

 php artisan db:seed

- Cria-se um usuário admin na tabela users

- Com o comando:

php artisan serve

- O servidor deve iniciar

- Abra um novo terminal, sem fechar o do backend e utilize os comando :

cd frontend; npm install; npm run serve;

- assim, entrando na pasta do frontend, baixando as dependencias e iniciando-o no link mostrado no terminal. Abra o seu navegador e acesse o link.

**Frontend**

A pagina inicial acessada pelo navegador é a de login/criar usuário, onde você pode optar por criar um usuário, ou logar com um já existente.

Após logar, o usuário é redirecionado para a página my-todo.

Nessa página, o usuário adm consegue ver e filtrar as tarefas dos outros usuários, além de poder ver o e-mail de quem criou a tarefa.

Como usuário não adm, é possível criar uma tarefa, com descrição e data de entrega, é possível vizualizar as tarefas criadas por esse usuário,
editar-las e marcar como finalizadas, tarefas finalizadas não podem ser editadas.

**Backend**:

O backend está dividido em dois módulos, Users, onde tem-se todos os arquivos referentes ao usuário e Taks, onde tem-se todos os arquivos referentes as tarefas.

A única rota que não está utilizando o middlaware de autenticação é a rota para criar usuário, assim todas as outras rotas presisão da jwt token gerada pelo login.

- Os comandos:

./vendor/bin/phpunit Modules/Users/Tests
./vendor/bin/phpunit Modules/Tasks/Tests

Rodam os testes unitários e os de feature dos modulos de usuário e de tarefas respectivamente
