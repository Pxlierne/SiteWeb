FROM mysql:latest
ENV MYSQL_ROOT_PASSWORD=P@ssw0rd
ENV MYSQL_DATABASE=pxlierne_db

COPY ./.conf/init.sql /docker-entrypoint-initdb.d/

EXPOSE 3306
