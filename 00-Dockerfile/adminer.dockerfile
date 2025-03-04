FROM adminer:latest

# Installation d'extensions PHP supplémentaires si nécessaire
# RUN docker-php-ext-install pdo pdo_mysql

# Définition des variables d'environnement
ENV ADMINER_DEFAULT_SERVER mysql
ENV ADMINER_DESIGN pepa-linha

# Exposition du port 8080
EXPOSE 8080

# Commande par défaut pour démarrer Adminer
CMD ["php", "-S", "[::]:8080", "-t", "/var/www/html"]
