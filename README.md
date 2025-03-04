# Documentation du Projet Docker

Ce projet utilise Docker Compose pour orchestrer plusieurs services. Le fichier `docker-compose.yml` décrit les services, leurs configurations et les volumes associés.

## Services

### 1. Nginx Proxy Manager
- **Nom du conteneur** : `srv_nginx-proxy-manager`
- **Image** : `jc21/nginx-proxy-manager:latest`
- **Ports** :
  - 80:80
  - 443:443
  - 81:81
- **Volumes** :
  - `./.conf/npm/data:/data`
  - `./.conf/npm/letsencrypt:/etc/letsencrypt`
- **Environnement** :
  - `DB_SQLITE_FILE: "/data/database.sqlite"`

### 2. Pound
- **Nom du conteneur** : `srv_pound`
- **Image** : `pascaldevink/pound:latest`
- **Port** : 8080
- **Volumes** :
  - `./.conf/pound.cfg:/etc/pound/pound.cfg`
- **Dépendances** :
  - `srv_nginx-1`
  - `srv_nginx-2`

### 3. Nginx (Instance 1)
- **Nom du conteneur** : `srv_nginx-1`
- **Image** : `nginx_project:latest`
- **Port** : 80
- **Volumes** :
  - `./01-SiteWeb:/var/www/html`
  - `./.conf/default.conf:/etc/nginx/conf.d/default.conf`
- **Dépendances** :
  - `srv_php`

### 4. Nginx (Instance 2)
- **Nom du conteneur** : `srv_nginx-2`
- **Image** : `nginx_project:latest`
- **Port** : 80
- **Volumes** :
  - `./01-SiteWeb:/var/www/html`
  - `./.conf/default.conf:/etc/nginx/conf.d/default.conf`
- **Dépendances** :
  - `srv_php`

### 5. PHP
- **Nom du conteneur** : `srv_php`
- **Image** : `php_project:latest`
- **Volumes** :
  - `./01-SiteWeb:/var/www/html`

### 6. Adminer
- **Nom du conteneur** : `srv_adminer`
- **Image** : `adminer_project:latest`
- **Port** : 8080
- **Dépendance** :
  - `srv_mysql`

### 7. MySQL
- **Nom du conteneur** : `srv_mysql`
- **Image** : `mysql_project:latest`
- **Port** : 3306
- **Environnement** :
  - `MYSQL_ROOT_PASSWORD: P@ssw0rd`
  - `MYSQL_DATABASE: pxlierne_db`
- **Volumes** :
  - `mysql_data:/var/lib/mysql`
  - `./02-BDD_Backup:/backup`
  - `./.conf/init.sql:/docker-entrypoint-initdb.d/init.sql`

### 8. AdGuard Home
- **Nom du conteneur** : `srv_adguard`
- **Image** : `adguard/adguardhome:latest`
- **Ports** :
  - "53:53/tcp"
  - "53:53/udp"
- **Volumes** :
  - `./.conf/adguard/work:/opt/adguardhome/work`
  - `./.conf/adguard/conf:/opt/adguardhome/conf`

### 9. Crafty
- **Nom du conteneur** : `srv_crafty`
- **Image** : `registry.gitlab.com/crafty-controller/crafty-4:latest`
- **Ports** : 
    - port par défaut à configurer (8000,8443)
  
### 10. Watchtower
- **Nom du conteneur** : `srv_watchtower`
- **Image** : `containrrr/watchtower:latest`
- **Environnement** :
    - Vérifie les mises à jour tous les jours (24 heures)
  
### 11. Heimdall
- **Nom du conteneur** : `srv_heimdall`
  
### 12. Duplicati
- **Nom du conteneur** : `srv_duplicati`

### 13. Portainer
- **Nom du conteneur** : `srv_portainer`
  
### 14. qBittorrent
- **Nom du conteneur** : `qbittorrent`
  
### 15. Prowlarr
- **Nom du conteneur** : `srv_prowlarr`

### 16. OpenSpeedTest
- **Nom du conteneur** : `openspeedtest`

## Volumes

Les volumes suivants sont créés pour persister les données :

