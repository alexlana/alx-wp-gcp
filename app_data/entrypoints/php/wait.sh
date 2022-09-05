php -r '$foo = "bar";'

# echo "Espera 300ms..."
# sleep .3

echo "Starting NGINX..."
/opt/bitnami/scripts/nginx/run.sh







# # Wait until PHP-FPM is up and accepts connections. Fail if not started in 10 secs.
# for run in $(seq 100)
# do
#   if [ "$run" -gt "1" ]; then
#     echo "Retrying..."
#   fi
#   RESPONSE=$(
#     SCRIPT_NAME=/fpm-ping \
#     SCRIPT_FILENAME=/fpm-ping \
#     REQUEST_METHOD=GET \
#     cgi-fcgi -bind -connect 127.0.0.1:8080 || true)
#   case $RESPONSE in
#     *"pong"*)
#       echo "FPM is running and ready."

#       info "Starting NGINX..."
#       /opt/bitnami/scripts/nginx/run.sh

#       # # Run nginx without exiting to keep the container running
#       # nginx -g 'daemon off;'
#       # exit 0
#       ;;
#   esac
#   sleep .1
# done
