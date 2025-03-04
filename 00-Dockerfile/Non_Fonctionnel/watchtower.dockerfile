FROM containrrr/watchtower:latest

# Exposition du port nécessaire (optionnel, selon vos besoins)
EXPOSE 8080

# Définition du volume pour accéder au socket Docker
VOLUME /var/run/docker.sock

# Définition des variables d'environnement
ENV WATCHTOWER_CLEANUP=true
ENV WATCHTOWER_SCHEDULE="0 0 4 * * *"

# Commande par défaut pour démarrer Watchtower
CMD ["watchtower", "--interval", "86400"]
