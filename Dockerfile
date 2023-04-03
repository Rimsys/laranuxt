# Set the base image to the official PHP image with FPM
FROM php:8.0.28-fpm

# Install required packages
RUN apt-get update && \
    apt-get install -y \
        nginx \
        libzip-dev \
        zip \
        unzip \
        git

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip

# Set the working directory
WORKDIR /app

# Copy the application files to the container
COPY . /app
RUN chmod -R 755 /app/public/
COPY .env.example .env
RUN chmod -R 777 /app/storage
RUN mkdir -p /app/bootstrap/cache
RUN chmod -R 777 /app/bootstrap/cache



# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --no-interaction --no-plugins --no-scripts --prefer-dist




# Configure Nginx
RUN rm /etc/nginx/sites-enabled/default
COPY nginx.conf /etc/nginx/sites-available/
RUN sed -i 's/root \/var\/www\/html;/root \/app\/public;/g' /etc/nginx/sites-available/nginx.conf
RUN sed -i 's/index index.html index.htm index.nginx-debian.html;/index index.php;/g' /etc/nginx/sites-available/nginx.conf
RUN ln -s /etc/nginx/sites-available/nginx.conf /etc/nginx/sites-enabled/

RUN php artisan key:generate --ansi --no-interaction
# Expose port 3000
EXPOSE 8000
EXPOSE 80

# Start PHP-FPM and Nginx
CMD ["sh", "-c", "service nginx start && php-fpm -F"]
