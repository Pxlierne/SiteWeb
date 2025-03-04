FROM registry.gitlab.com/crafty-controller/crafty-4:latest

# Mise à jour des paquets du système
RUN apt-get update && apt-get upgrade -y && apt-get clean && apt autoremove -y

# Définition des variables d'environnement
ENV TZ=Etc/UTC
ENV LOG4J_FORMAT_MSG_NO_LOOKUPS=true

# Exposition des ports nécessaires
EXPOSE 8000 8443 8123 19132/udp 25500-25600

# Définition des volumes
VOLUME ["/crafty/backups", "/crafty/logs", "/crafty/servers", "/crafty/app/config", "/crafty/import"]

# Définition du répertoire de travail
WORKDIR /crafty

# Commande par défaut pour démarrer Crafty
CMD ["python3", "main.py"]
