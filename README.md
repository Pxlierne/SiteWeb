# Déploiement Automatique de Mon Site Web avec Docker

### Système d'Exploitation Utilisé

Testé et approuvé avec:
- Debian 12

## Étapes pour Déployer le Site

### 1. Cloner le Dépôt

```bash
git clone https://github.com/Pxlierne/SiteWeb.git && cd SiteWeb
```

### 2. Ajouter les Droits d'Exécution au Script et exécuter le script

```bash
sudo chmod +x 99-dockerfile_create.sh && ./99-dockerfile_create.sh
```