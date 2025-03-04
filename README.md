# Mon Site Web déployer automatiquement avec Docker

### Système d"exploitation utilisé

Système d'exploitation testé et approuver avec mes scripts:
- Debian 12

## Etape pour déployer mon site

### 1. cloner mon dépôt

```bash
git clone https://github.com/Pxlierne/SiteWeb.git
```


### 2. Mettre les droits d'exécution au fichier `99-dockerfile_create.sh`


    ```bash
    sudo chmod +x 99-dockerfile_create.sh
    ```

### 3. Executer le script 99-dockerfile_create.sh

```bash
./99-dockerfile_create.sh
```