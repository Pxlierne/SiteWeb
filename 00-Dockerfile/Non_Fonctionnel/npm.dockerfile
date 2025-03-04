FROM jc21/nginx-proxy-manager:latest

# Expose necessary ports
EXPOSE 80
EXPOSE 81
EXPOSE 443

# Set environment variables
ENV NODE_ENV=production

# Start Nginx Proxy Manager
CMD ["npm", "start"]
