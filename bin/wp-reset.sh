#!/bin/bash
#
# Joyas Quick Reset
# Clears database and rebuilds from scratch.
#

CLI_SERVICE="cli"
docker compose -f docker/docker-compose.yml run --rm -e HOME=/tmp "${CLI_SERVICE}" /bin/bash -c \
	"wp --allow-root db reset --yes" 2>/dev/null || echo "Could not reset database"

echo "🔄 Re-run wp-setup.sh and wp-content-setup.sh to rebuild."
