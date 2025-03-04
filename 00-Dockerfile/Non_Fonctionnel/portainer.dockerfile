FROM portainer/portainer-ce:latest

EXPOSE 9000 9443

VOLUME /data

CMD ["/portainer"]
