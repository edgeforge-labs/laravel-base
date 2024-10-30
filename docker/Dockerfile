FROM php:8.3-fpm

# Install system dependencies
RUN apt update && apt install -y libpng-dev libonig-dev libxml2-dev zip curl unzip git nginx && apt clean

# setup node
RUN curl -fsSL https://deb.nodesource.com/setup_23.x -o nodesource_setup.sh && bash nodesource_setup.sh && apt install -y nodejs npm && apt clean

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

# Copy the nginx config
COPY default.conf /etc/nginx/sites-available/default
COPY start.sh /start.sh

# Give execute permissions to the start script
RUN chmod +x /start.sh

# set permissions for project
RUN chown -R www-data:www-data /var/www

RUN composer update

CMD ["/start.sh"]
