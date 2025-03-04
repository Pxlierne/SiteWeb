FROM nginx:latest

RUN apt-get update && apt-get upgrade -y && apt autoremove -y

# Vous pouvez décommenter ces lignes si vous avez besoin de copier des fichiers spécifiques
#COPY nginx.conf /etc/nginx/nginx.conf
#COPY ./src /usr/share/nginx/html
WORKDIR /var/www/html
EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
