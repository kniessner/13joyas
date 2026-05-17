#!/bin/bash
#
# Joyas Content Setup via WP-CLI
# Creates pages, menus, and content structure.
# Must be run after wp-setup.sh.
#
set -e

CLI_SERVICE="cli"
THEME_NAME="joyas-block-theme"

WP="docker compose -f docker/docker-compose.yml run --rm -e HOME=/tmp ${CLI_SERVICE} wp --allow-root"

echo "📝 Setting up Joyas content structure..."

# -- Helper to run WP-CLI commands within the cli service --
run_wp() {
	docker compose -f docker/docker-compose.yml run --rm -e HOME=/tmp "${CLI_SERVICE}" wp --allow-root "$@"
}

# Delete all existing pages to allow idempotent re-runs
echo "  🗑️  Removing existing pages..."
docker compose -f docker/docker-compose.yml run --rm -e HOME=/tmp "${CLI_SERVICE}" /bin/bash -c \
	"IDS=\$(wp --allow-root post list --post_type=page --format=ids 2>/dev/null); [ -n \"\$IDS\" ] && wp --allow-root post delete \$IDS --force || true"

# Create pages and capture IDs directly via --porcelain
echo "  📄 Creating pages..."
startseite_id=$(run_wp post create --post_type=page --post_title='Startseite'     --post_status=publish --post_name='startseite'     --post_content='' --porcelain)
leistungen_id=$(run_wp post create --post_type=page --post_title='Leistungen'     --post_status=publish --post_name='leistungen'     --post_content='' --porcelain)
massanfertigung_id=$(run_wp post create --post_type=page --post_title='Maßanfertigung' --post_status=publish --post_name='massanfertigung' --post_content='' --porcelain)
werkstatt_id=$(run_wp post create --post_type=page --post_title='Werkstatt'      --post_status=publish --post_name='werkstatt'      --post_content='' --porcelain)
galerie_id=$(run_wp post create --post_type=page --post_title='Galerie'       --post_status=publish --post_name='galerie'       --post_content='' --porcelain)
referenzen_id=$(run_wp post create --post_type=page --post_title='Referenzen'    --post_status=publish --post_name='referenzen'    --post_content='' --porcelain)
kontakt_id=$(run_wp post create --post_type=page --post_title='Kontakt'       --post_status=publish --post_name='kontakt'       --post_content='' --porcelain)
impressum_id=$(run_wp post create --post_type=page --post_title='Impressum'     --post_status=publish --post_name='impressum'     --post_content='' --porcelain)
datenschutz_id=$(run_wp post create --post_type=page --post_title='Datenschutz'   --post_status=publish --post_name='datenschutz'   --post_content='' --porcelain)

# Set homepage
echo "  🏠 Setting homepage..."
run_wp option update show_on_front 'page'
run_wp option update page_on_front  "${startseite_id}"
run_wp option update page_for_posts '0'

# Set custom templates for full-width pages
echo "  📐 Setting page templates..."
run_wp post meta update "${startseite_id}" _wp_page_template 'page-full-width.php'
run_wp post meta update "${galerie_id}"    _wp_page_template 'page-full-width.php'

# Create primary navigation menu (delete first to allow idempotent re-runs)
echo "  🧭 Creating navigation menu..."
run_wp menu delete 'Primary Navigation' >/dev/null 2>&1 || true
run_wp menu create 'Primary Navigation'

# Add menu items with correct order
echo "  🔗 Adding menu items..."
run_wp menu item add-post 'Primary Navigation' "${leistungen_id}"     --title='Leistungen'
run_wp menu item add-post 'Primary Navigation' "${massanfertigung_id}" --title='Maßanfertigung'
run_wp menu item add-post 'Primary Navigation' "${galerie_id}"       --title='Galerie'
run_wp menu item add-post 'Primary Navigation' "${referenzen_id}"    --title='Referenzen'
run_wp menu item add-post 'Primary Navigation' "${kontakt_id}"       --title='Kontakt'

# Insert pattern content
echo "  🎨 Inserting pattern content into pages..."
docker compose -f docker/docker-compose.yml run --rm -e HOME=/tmp "${CLI_SERVICE}" /bin/bash -c \
	"cd /var/www/html/wp-content/themes/${THEME_NAME} && wp --allow-root eval-file /project/bin/wp-insert-patterns.php"

echo "✅ Content structure complete!"
echo "   Visit: http://localhost:8090/wp-admin to customize."
