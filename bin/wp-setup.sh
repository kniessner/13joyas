#!/bin/bash
#
# Joyas WordPress Environment Setup via WP-CLI
# Must be run from the project root.
#
set -e

CLI_SERVICE="cli"
THEME_NAME="joyas-block-theme"
ADMIN_USER="joyas"
ADMIN_EMAIL="admin@joyas.local"
ADMIN_PASS="joyas123"
SITE_TITLE="Joyas"
BASE_URL="http://localhost:8090"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${YELLOW}🚀 Setting up Joyas WordPress environment...${NC}"

# Wait for WordPress to be ready
# We do this by hitting the web container, not running wp-cli
# because wp-cli isn't available in the running web container.
echo -e "${YELLOW}⏳ Waiting for WordPress container...${NC}"
until curl -sf "${BASE_URL}/wp-admin/install.php" > /dev/null 2>&1 || curl -sf "${BASE_URL}/wp-login.php" > /dev/null 2>&1; do
	sleep 2
done

# Install WordPress if not already done
echo -e "${YELLOW}🗄️  Installing WordPress (if needed)...${NC}"
until docker compose -f docker/docker-compose.yml run --rm -e HOME=/tmp "${CLI_SERVICE}" /bin/bash -c \
	"wp --allow-root core is-installed 2>/dev/null || \
	 wp --allow-root core install --url='${BASE_URL}' --title='${SITE_TITLE}' --admin_user='${ADMIN_USER}' --admin_password='${ADMIN_PASS}' --admin_email='${ADMIN_EMAIL}' --skip-email" 2>&1; do
	echo -e "${YELLOW}   Database not ready, retrying in 2s...${NC}"
	sleep 2
done

# Configure WordPress URL
echo -e "${GREEN}✅ WordPress is ready. Configuring...${NC}"
docker compose -f docker/docker-compose.yml run --rm -e HOME=/tmp "${CLI_SERVICE}" /bin/bash -c \
	"wp --allow-root option update home '${BASE_URL}' && \
	wp --allow-root option update siteurl '${BASE_URL}'"

# Create admin user if not exists
echo -e "${YELLOW}👤 Creating admin user...${NC}"
docker compose -f docker/docker-compose.yml run --rm -e HOME=/tmp "${CLI_SERVICE}" /bin/bash -c \
	"wp --allow-root user create '${ADMIN_USER}' '${ADMIN_EMAIL}' --user_pass='${ADMIN_PASS}' --role=administrator 2>/dev/null || echo 'User already exists'"

# Delete default plugins
echo -e "${YELLOW}🗑️  Cleaning default plugins...${NC}"
docker compose -f docker/docker-compose.yml run --rm -e HOME=/tmp "${CLI_SERVICE}" /bin/bash -c \
	"wp --allow-root plugin delete hello akismet" 2>/dev/null || true

# Delete default themes except current
echo -e "${YELLOW}🗑️  Cleaning default themes...${NC}"
docker compose -f docker/docker-compose.yml run --rm -e HOME=/tmp "${CLI_SERVICE}" /bin/bash -c \
	"wp --allow-root theme delete twentytwentyfour twentytwentyfive twentytwentysix" 2>/dev/null || true

# Activate Joyas theme
echo -e "${YELLOW}🎨 Activating Joyas theme...${NC}"
docker compose -f docker/docker-compose.yml run --rm -e HOME=/tmp "${CLI_SERVICE}" /bin/bash -c \
	"wp --allow-root theme activate '${THEME_NAME}'"

# Update permalinks
echo -e "${YELLOW}🔗 Setting permalinks...${NC}"
docker compose -f docker/docker-compose.yml run --rm -e HOME=/tmp "${CLI_SERVICE}" /bin/bash -c \
	"wp --allow-root rewrite structure '/%postname%/' --hard"

# Delete default posts/pages/comments
echo -e "${YELLOW}🗑️  Cleaning default content...${NC}"
docker compose -f docker/docker-compose.yml run --rm -e HOME=/tmp "${CLI_SERVICE}" /bin/bash -c \
	"wp --allow-root post delete \$(wp --allow-root post list --post_type=post --post_status=publish --format=ids) --force 2>/dev/null || true"
docker compose -f docker/docker-compose.yml run --rm -e HOME=/tmp "${CLI_SERVICE}" /bin/bash -c \
	"wp --allow-root post delete \$(wp --allow-root post list --post_type=page --post_status=publish --format=ids) --force 2>/dev/null || true"
docker compose -f docker/docker-compose.yml run --rm -e HOME=/tmp "${CLI_SERVICE}" /bin/bash -c \
	"wp --allow-root comment delete --force --all 2>/dev/null || true"

echo -e "${GREEN}✅ Joyas environment ready!${NC}"
echo -e "${GREEN}   URL: ${BASE_URL}${NC}"
echo -e "${GREEN}   Admin: ${ADMIN_USER} / ${ADMIN_PASS}${NC}"
