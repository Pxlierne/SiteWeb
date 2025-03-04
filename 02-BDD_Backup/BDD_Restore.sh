#!/bin/bash

# Variables de configuration
DB_USER="root"
DB_PASSWORD="P@ssw0rd"  # Remplacez par votre mot de passe
DB_NAME="edcorp_db"  # Nom de la base de données à restaurer
BACKUP_FILE="edcorp_db-202412182106.sql"  # Chemin vers le fichier de sauvegarde

# Vérifiez si le fichier existe avant d'essayer de restaurer
if [ ! -f "$BACKUP_FILE" ]; then
    echo "Le fichier de sauvegarde $BACKUP_FILE n'existe pas."
    exit 1
fi

# Exécuter la restauration
docker exec -i srv_mysql /usr/bin/mysql -u $DB_USER --password=$DB_PASSWORD $DB_NAME < "$BACKUP_FILE"

# Vérifier si la restauration a réussi
if [ $? -eq 0 ]; then
    echo "Restauration réussie depuis : $BACKUP_FILE"
else
    echo "Erreur lors de la restauration."
fi
