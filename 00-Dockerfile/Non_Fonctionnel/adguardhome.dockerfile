FROM adguard/adguardhome:latest

# Mise à jour des paquets du système
RUN apk update && apk upgrade && apk add --no-cache bash && rm -rf /var/cache/apk/*

# Exposition des ports nécessaires
EXPOSE 53/tcp 53/udp 80/tcp 443/tcp 853/tcp 3000/tcp

# Définition des volumes
VOLUME ["/opt/adguardhome/work", "/opt/adguardhome/conf"]

# Commande par défaut pour démarrer AdGuard Home
CMD ["/opt/adguardhome/AdGuardHome", "--no-check-update"]
