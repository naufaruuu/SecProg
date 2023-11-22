FROM ubuntu:22.04

# Disable interactive installation
ENV DEBIAN_FRONTEND=noninteractive

# Installing apache2, php
RUN apt-get update \
    && apt-get install -y apache2 php8.1 php8.1-mysql \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Expose port 80 for web server (if your application uses it)
EXPOSE 80
