#!/bin/bash

cat <<EOF
Welcome to the 16nsk/drupal container
EOF

# Check if Drupal is installed
cd /app/web
DRUPAL_INSTALLED="$(../vendor/bin/drush status bootstrap | grep -q Successful)"

# If Drupal is not installed, do minimal installation
if [ $DRUPAL_INSTALLED -eq 0 ]
then
  echo "Drupal is not installed. Got: $DRUPAL_INSTALLED"
fi
