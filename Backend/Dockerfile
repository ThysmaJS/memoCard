# Utilisez l'image officielle PHP avec Apache, version 8.2
FROM php:8.2-apache

# Installez les extensions PHP nécessaires et git
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql

# Activez le module de réécriture d'URL d'Apache
RUN a2enmod rewrite

# Installez Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiez les fichiers de l'application (sans écraser les volumes)
WORKDIR /var/www/html
COPY . /var/www/html

# Autoriser Composer à s'exécuter en tant que super utilisateur et augmenter le timeout
RUN COMPOSER_ALLOW_SUPERUSER=1 composer config --global process-timeout 2000
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-interaction --prefer-dist --optimize-autoloader

# Donnez les permissions nécessaires
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Vider le cache Laravel
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Configuration Apache
RUN echo "<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n\
\n\
DocumentRoot /var/www/html/public" > /etc/apache2/sites-available/000-default.conf

# Exposez le port 80
EXPOSE 80

# Lancez Apache
CMD ["apache2-foreground"]
