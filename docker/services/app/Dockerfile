FROM superrosko/php:7.4.13-fpm
MAINTAINER Dmitriy Bespalov <dbespalov.rosko@gmail.com>

# Install dependencies
RUN apt-get update && apt-get install -y \
    dnsutils

# Set working directory
WORKDIR /var/www

# Add user for application
RUN groupadd -g 1000 www-user
RUN useradd -u 1000 -ms /bin/bash -g www-user www-user

# Copy existing application directory permissions
COPY --chown=www-user:www-user . /var/www

# Change current user to www-user
USER www-user
