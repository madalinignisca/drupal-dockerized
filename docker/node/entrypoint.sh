#!/bin/bash

cat <<EOF
Welcome to the 16nsk/node container
EOF

cd /app

# Run node modules install
yarn install

# exec CMD
echo ">> exec docker CMD"
echo "$@"
exec "$@"
