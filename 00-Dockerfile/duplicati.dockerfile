FROM lscr.io/linuxserver/duplicati:latest

# Mise à jour des paquets du système
RUN apt-get update && apt-get upgrade -y && apt-get clean && apt autoremove -y

# Exposition du port
EXPOSE 8200

# Définition des volumes
VOLUME /config
VOLUME /backups
VOLUME /source

# Variables d'environnement
ENV PUID=1000
ENV PGID=1000
ENV TZ=Etc/UTC

# Commande de démarrage
CMD ["/init"]
