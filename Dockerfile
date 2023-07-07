FROM php:7.4-apache

# Install PHP extensions required by PHPMailer
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev

RUN docker-php-ext-install zip

# Enable Apache modules
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy your project files to the working directory
COPY . /var/www/html

# Start the Apache server
CMD ["apache2-foreground"]