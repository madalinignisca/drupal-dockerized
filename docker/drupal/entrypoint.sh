#!/bin/bash

cat <<EOF
Welcome to the 16nsk/drupal container
EOF

# Check if Drupal is installed
cd /app/web
DRUPAL_INSTALLED="$(../vendor/bin/drush status bootstrap | grep -q Successful)"

# If Drupal is not installed, do minimal installation
if [ -z "$DRUPAL_INSTALLED" ]
then
  echo "Drupal is not installed.\n"
  echo "Installing Drupal. This might take a minute.\n"
  ../vendor/bin/drush si minimal -y --notify
  echo "Drupal is now installed. Check the admin password above!\n"
fi

# exec CMD
echo ">> exec docker CMD"
echo "$@"
exec "$@"
