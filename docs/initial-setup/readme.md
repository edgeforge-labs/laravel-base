# Initial Setup

TODO: write an intro here

## install composer

https://getcomposer.org/download/

## Setup laravel project

```bash
composer create-project --prefer-dist laravel/laravel laravel-app
cd laravel-app
```

## Dockerize the Laravel App

In your Laravel project root, create a Dockerfile:

```Dockerfile
# [Offical Docs](https://laravel.com/docs/11.x/deployment)
FROM php:8.3-fpm-alpine

# Install system dependencies
RUN apk update && \
    apk add --no-cache \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    curl \
    unzip \
    git \
    nginx \
    net-tools \
    nodejs npm \
    libsodium-dev \
    icu-dev \
    curl-dev \
    openssl-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libzip-dev \
    netcat-openbsd && \
    rm -rf /var/cache/apk/*

# Install PHP extensions | https://laravel.com/docs/11.x/deployment#server-requirements
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp && \
    docker-php-ext-install pdo_mysql exif pcntl bcmath intl zip gd # ctype curl dom fileinfo filter hash mbstring pdo session tokenizer xml pcre openssl sodium | no need to enable these extensions they come prepacked by php8.3

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

# Copy the nginx config
COPY default.conf /etc/nginx/http.d/default.conf
COPY start.sh /start.sh

# Give execute permissions to the start script
RUN chmod +x /start.sh

# Set permissions for the project
RUN chown -R www-data:www-data /var/www

# Update Composer and install npm packages
RUN composer install --no-dev --optimize-autoloader && composer update && npm install && npm run build

CMD ["/start.sh"]
```

In the above Dockerfile, you would also need an Nginx configuration (default.conf). Here's a basic example:

```ini
server {
    listen 80;

    index index.php index.html;
    root /var/www/public;
    error_log /var/log/nginx/error.log debug;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

add this config to the main laravel dir with the docker file

you will also need to add a script to start the php-fpm process, you can find it with `whereis php-fpm`

```bash
cat <<EOF | sudo tee start.sh
#!/bin/sh

export DB_HOST="mysql"

# Wait for MySQL to be ready
echo "Waiting for MySQL to be available..."

until nc -z "$DB_HOST" 3306; do
  echo "MySQL is unavailable - waiting..."
  sleep 3
done

echo "MySQL is available - continuing with migrations..."

# Run Laravel commands
php artisan key:generate
php artisan migrate --force  # Use --force in production to run migrations non-interactively

# Start PHP-FPM in the background
php-fpm -D

# Start nginx in the foreground
nginx -g "daemon off;"
EOF
```

be sure to make it executable

```bash
chmod +x start.sh
```

This will run php-fpm in the background, followed by nginx in the foreground when the container starts, ensuring that both services are available and running.


## Edit env file

set this in env file, the env file will be ignored by gitignore file created by default, either manually inject or remove ignore. The hostname (DB_HOST) is the name of the MySQL service you'll create in Kubernetes or the name of the docker container in docker compose.

```env
DB_CONNECTION=mysql
DB_HOST=mysql           # Use DNS name or IP, name of container for compose, name of K8s Service in K8s
DB_PORT=3306
DB_DATABASE=laravel-app
DB_USERNAME=root
DB_PASSWORD=password
```


## build and push the image to container registry

**This Part is automated by our [pipeline](./.github/workflows/docker-release.yaml)**

### build

```bash
docker build -t edgeforge-labs/laravel-app .
```

### tag

```bash
docker tag local-image:tagname new-repo:tagname
```

### push

```bash
docker push edgeforge-labs/laravel-app
```

### my examples:

````bash
docker build -t edgeforge-labs/laravel-app .
docker tag edgeforge-labs/laravel-app:latest edgeforge-labs/laravel-app:latest
docker push edgeforge-labs/laravel-app:latest
````


## run php aritsan migrate

for this the db needs to be connected, we added a step for this in the startup script