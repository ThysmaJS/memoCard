# Utilisez l'image officielle PHP avec Apache, version 8.2
FROM php:8.2-apache

# Installez les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
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

# Installez les dépendances PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Donnez les permissions nécessaires
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

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
