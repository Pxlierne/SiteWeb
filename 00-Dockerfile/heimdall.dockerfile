FROM linuxserver/heimdall:latest

# Mise à jour des paquets du système
RUN apk update && apk upgrade && apk add --no-cache bash && rm -rf /var/cache/apk/*

# Exposition des ports
EXPOSE 80 443

# Définition du volume pour la configuration
VOLUME /config

# Variables d'environnement
ENV PUID=1000
ENV PGID=1000
ENV TZ=Etc/UTC

# Commande de démarrage
CMD ["/init"]
