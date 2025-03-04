#!/bin/bash
 
apt install sudo -y
sudo apt update && apt upgrade -y
sudo apt install docker.io docker-compose -y

docker build -t nginx_project -f ./00-Dockerfile/nginx.dockerfile .
if [ $? -eq 0 ]; then
    echo "Image Nginx construite avec succès : nginx_project"
else
    echo "Échec de la construction de l'image Nginx"
    exit 1
fi

# Construire l'image PHP
echo "Construction de l'image PHP..."
docker build -t php_project -f ./00-Dockerfile/php.dockerfile .
if [ $? -eq 0 ]; then
    echo "Image PHP construite avec succès : php_project"
else
    echo "Échec de la construction de l'image PHP"
    exit 1
fi

# Construire l'image MYSQL
echo "Construction de l'image MySQL..."
docker build -t mysql_project -f ./00-Dockerfile/mysql.dockerfile .
if [ $? -eq 0 ]; then
    echo "Image mysql construite avec succès : mysql_project"
else
    echo "Échec de la construction de l'image mysql"
    exit 1
fi

# Construire l'image adminer
docker build -t adminer_project -f ./00-Dockerfile/adminer.dockerfile .
if [ $? -eq 0 ]; then
    echo "Image Adminer construite avec succès : adminer_project"
else
    echo "Échec de la construction de l'image Adminer"
    exit 1
fi

echo "Toutes les images ont été construites avec succès."

chmod +x -R /root/02-BDD_Backup/ restart.sh

sudo docker-compose up -d

echo "Vérifier que tous les dockers sont bien démarrés."

docker ps -a