FROM nginx:1.12.1
MAINTAINER Madalin Ignisca <madalin.ignisca@gmail.com>

ENV LANG C.UTF-8

EXPOSE 443

RUN apt-get update; apt-get install -y openssl; \
  rm -rf /etc/nginx/conf.d/*; \
  mkdir -p /etc/nginx/external; \
  sed -i 's/access_log.*/access_log \/dev\/stdout;/g' /etc/nginx/nginx.conf; \
  sed -i 's/error_log.*/error_log \/dev\/stdout info;/g' /etc/nginx/nginx.conf; \
  sed -i 's/^pid/daemon off;\npid/g' /etc/nginx/nginx.conf

ADD basic.conf /etc/nginx/conf.d/00-basic.conf
ADD ssl.conf /etc/nginx/conf.d/01-ssl.conf
ADD app.conf /etc/nginx/conf.d/99-app.conf

ADD entrypoint.sh /opt/entrypoint.sh
RUN chmod a+x /opt/entrypoint.sh

ENTRYPOINT ["/opt/entrypoint.sh"]
CMD ["nginx"]
