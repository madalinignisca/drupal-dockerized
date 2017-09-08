#!/bin/bash

cat <<EOF
Welcome to the 16nsk/drupal container
EOF

# Run composer install
composer install

# Check if Drupal is installed
cd /app/web
DRUPAL_INSTALLED="$(../vendor/bin/drush status bootstrap | grep -c Successful)"

# If Drupal is not installed, do minimal installation
if [ "$DRUPAL_INSTALLED" -eq "0" ]
then
  echo "Drupal is not installed.\n"
  echo "Installing Drupal. This might take a minute.\n"
  ../vendor/bin/drush si minimal -y
  echo "Drupal is now installed. Check the admin password above!\n"
fi

# exec CMD
echo ">> exec docker CMD"
echo "$@"
exec "$@"
