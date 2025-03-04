#!/bin/bash

# Variables de configuration
DB_USER="root"
DB_PASSWORD="P@ssw0rd"  # Remplacez par votre mot de passe
DB_NAME="edcorp_db"  # Nom de la base de données à sauvegarder
BACKUP_DIR="."  # Répertoire partagé avec l'hôte pour les sauvegardes
DATE=$(date +"%Y%m%d%H%M")

# Exécuter la sauvegarde
docker exec srv_mysql /usr/bin/mysqldump -u $DB_USER --password=$DB_PASSWORD $DB_NAME > "$BACKUP_DIR/$DB_NAME-$DATE.sql"

# Vérifier si la sauvegarde a réussi
if [ $? -eq 0 ]; then
    echo "Sauvegarde réussie : $BACKUP_DIR/$DB_NAME-$DATE.sql"
else
    echo "Erreur lors de la sauvegarde."
fi
