## Instalando o sistema livros

Acesse o diretório onde ficará o projeto e o primeiro passo clonar o repositório do backend com o comando: 

    git clone https://github.com/duduccarneiro/livros-api.git

No mesmo diretório execute o comando para clonar o repositório do front end

    git clone https://github.com/duduccarneiro/livros-front-end.git

Entre no diretório

    cd livros-api/
    
Execute o comando para o docker instalar as dependências do laravel:

    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

Copie o arquivo .env.example para .env com o comando:
    
    cp .env.example .env

Edite esse arquivo .env e preencha DB_DATABASE, DB_USERNAME,DB_PASSWORD de sua preferencia

Para iniciar o container do backend:

    sudo ./vendor/bin/sail up

Entre no terminal do container com o comando: 

    docker exec -it livros-api-laravel.test-1 bash

Execute dentro do container o comando abaixo para gerar a chave sa aplicação

    php artisan key:generate

Execute dentro do container o comando abaixo para gerar o banco de dados

    php artisan migrate

Entrar no diretório do front end ainda dentro do container

    cd ../livros-front-end/

Execute o comando para instalar as dependências do front end

    npm install

Iniciar o front end com o comando:

    npx quasar dev

Agora a aplicação pode ser acessada em http://localhost:9000
