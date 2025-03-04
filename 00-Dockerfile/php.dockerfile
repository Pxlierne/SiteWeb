FROM php:fpm

RUN apt-get update && apt-get upgrade -y && apt autoremove -y
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Vous pouvez ajouter d'autres extensions PHP si nécessaire
# RUN docker-php-ext-install <nom_de_l_extension>
WORKDIR /var/www/html
EXPOSE 80

CMD ["php-fpm"]
