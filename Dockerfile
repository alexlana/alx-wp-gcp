FROM bitnami/wordpress-nginx:6.0.2



USER root

# ImageMagick e GhostScript para gerar previews de PDFs
RUN apt-get update && \
	apt-get --purge remove imagemagick && \
	apt-get install ghostscript -y && \
	apt-get install libgs-dev -y && \
	apt-get install build-essential -y && \
	apt-get install php-dev -y && \
	apt-get install libmagickwand-dev libmagickcore-dev -y && \
	apt-get install php-imagick -y && \
	apt-get install libjpeg-dev libpng-dev libtiff-dev libgif-dev -y

## verificar se faz diferença usar no container
# RUN apt-get install policycoreutils selinux-utils selinux-basics -y && \
# 	selinux-activate && \
# 	selinux-config-enforcing

# criar arquivo para usar como na env var de persistencia do wp, o arquivo mesmo é inútil
RUN touch /opt/bitnami/wordpress/wp-content/evitarpersistencia

# copiar arquivos para a imagem
# copia em staging e producao, volume em dev
COPY ./app_data/languages /opt/bitnami/wordpress/wp-content/languages
COPY ./app_data/mu-plugins /opt/bitnami/wordpress/wp-content/mu-plugins
COPY ./app_data/plugins /opt/bitnami/wordpress/wp-content/plugins
COPY ./app_data/themes /opt/bitnami/wordpress/wp-content/themes

# isso, ao invés de usar as env vars, reduz pela metade o build
# COPY ./app_data/config/wp-config.staging.php /opt/bitnami/wordpress/wp-config.php

# COPY ./app_data/config/libwordpress.sh /opt/bitnami/scripts/libwordpress.sh
# RUN chmod 777 /opt/bitnami/scripts/libwordpress.sh

COPY ./app_data/config/extra.conf /opt/bitnami/nginx/conf/bitnami/extra.conf
RUN chmod 777 /opt/bitnami/nginx/conf/bitnami/extra.conf

# COPY ./app_data/entrypoints/nginx-php-fpm/run.sh /opt/bitnami/scripts/nginx-php-fpm/run.sh
# RUN chmod 777 /opt/bitnami/scripts/nginx-php-fpm/run.sh

# COPY ./app_data/entrypoints/php/wait.sh /opt/bitnami/scripts/php/wait.sh
# RUN chmod 777 /opt/bitnami/scripts/php/wait.sh




# certificado https
# ARG CERTBOT_EMAIL=alexlana@gmail.com
# ARG DOMAIN_LIST=fc.tmp.br
# 
# RUN apt-get update
# RUN apt-get install -y cron
# RUN apt-get install -y certbot
# RUN apt-get install -y python3-certbot-nginx
# RUN apt-get install -y bash
# RUN apt-get install -y wget
# RUN certbot certonly --standalone --agree-tos -m "${CERTBOT_EMAIL}" -n -d ${DOMAIN_LIST}
# RUN rm -rf /var/lib/apt/lists/*
# RUN echo "PATH=$PATH" > /etc/cron.d/certbot-renew 
# RUN echo "@monthly certbot renew --nginx >> /var/log/cron.log 2>&1" >>/etc/cron.d/certbot-renew
# RUN crontab /etc/cron.d/certbot-renew
# VOLUME /etc/letsencrypt


USER 1001


# em um teste rápido pareceu mais rápido o wp em um volume na GCP
VOLUME /opt/bitnami/wordpress



EXPOSE 8080
EXPOSE 8443


