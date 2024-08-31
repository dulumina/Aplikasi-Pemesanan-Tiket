#!/usr/bin/env bash
if [[ ! -f ./index.php ]]; then
  if [[ -f index.nginx-debian.html ]]; then
    mv index.nginx-debian.html index.php
  fi
else
  if [[ -f index.nginx-debian.html ]]; then
    rm index.nginx-debian.html
  fi
fi

#if [[ ! -f /ssl/cert.key ]] && [[ ! -f /ssl/cert.crt ]] && [[ ! -f /ssl/ca.crt ]] && [[ ! -f /ssl/dhparam.pem ]]; then
#  echo "Cannot find all ssl certificates!"
#  exit 1
#  else
#  cat /ssl/cert.key /ssl/ca.crt > /ssl/fullchain.crt
#fi

service nginx start
php-fpm

# if you in google cloud run
## #!/usr/bin/env sh
# set -e
#
# php-fpm -D
# nginx -g 'daemon off;'
