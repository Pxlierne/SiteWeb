FROM pascaldevink/pound:latest

# Ne pas mettre a jour, mais je met la commande comme même
#RUN apt-get update && apt-get upgrade -y

# Copier la configuration de Pound
COPY ./.conf/pound.cfg /etc/pound/pound.cfg

# Exposer le port 8080 (port par défaut de Pound)
EXPOSE 8080

# Commande pour démarrer Pound
CMD ["pound", "-f", "/etc/pound/pound.cfg"]
