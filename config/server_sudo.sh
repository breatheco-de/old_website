#!/bin/bash

DIR="$1"
DOMAIN="$2"

echo 'ajustando path supervisor nginx'
ln -s $DIR /home/deploy/4geeksacademy.co/wordpress/wp-content/themes/online.4geeksacademy.com



# find $DIR/current/config/nginx/corona-backend.conf -type f -exec sed -i "s@<path>@$DIR@g" {} +
# find $DIR/current/config/nginx/corona-backend.conf -type f -exec sed -i "s@<domain>@$DOMAIN@g" {} +

# echo 'configurando supervisor'
# ln -s $DIR/current/config/supervisor/corona-backend.conf /etc/supervisor/conf.d/
# supervisorctl reread && supervisorctl update && supervisorctl restart all

# echo 'configurando nginx'
# ln -s $DIR/current/config/nginx/corona-backend.conf /etc/nginx/conf.d/
# service nginx restart
