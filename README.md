# 13 Joyas — Developer Documentation

A WordPress block theme for a Berlin silversmith atelier. Dark editorial design, performance-first, fully custom landing page.

---

## Quick Start

```bash
# 1. Start Docker (WordPress at http://localhost:8090)
npm run start:dock

# 2. Install dependencies
npm install && composer install

# 3. Build assets
npm run build

# 4. Set up WordPress (theme, pages, menus, content)
npm run setup:all

# 5. Start Vite dev server with HMR
npm run dev
```

---

## Project Structure

```
2026-13-joyas/
├── joyas-block-theme/          ← The WordPress theme (volume-mounted into Docker)
│   ├── functions.php           ← Asset enqueue, performance hooks
│   ├── theme.json              ← Design tokens: colors, spacing, typography
│   ├── style.css               ← Theme header metadata only (no real CSS here)
│   ├── templates/              ← Page templates (block markup)
│   ├── parts/                  ← Reusable template parts (header, footer, etc.)
│   ├── patterns/               ← PHP block patterns (auto-registered)
│   ├── blocks/                 ← Custom Gutenberg blocks
│   ├── assets/images/          ← Theme images (logos, placeholder photos)
│   ├── dist/                   ← Compiled output (Vite build) — do not edit
│   └── src/
│       ├── scss/               ← All SCSS source
│       └── ts/                 ← TypeScript source
├── bin/                        ← WP-CLI automation scripts
├── content/                    ← Page copy source files (German)
├── docker/                     ← Docker Compose stack
└── stories/                    ← Storybook pattern library
```

---

## The Design System

### Silversmith Landing (Current Homepage)

The homepage uses a fully custom, editorial dark landing page designed for the silversmith brand. It is **not** built with standard WordPress blocks — it uses scoped HTML + CSS inside a single `<!-- wp:html -->` block.

**How it works:**

```
WordPress renders front-page.html
  └── post-content (no WP header/footer)
       └── joyas/page-startseite pattern
            └── <!-- wp:html --> with .joyas-landing wrapper
                 ├── .jl-topbar       (fixed nav)
                 ├── .jl-hero         (full-viewport dark hero)
                 ├── .jl-collection   (silver objects grid)
                 ├── .jl-story        (atelier / about section)
                 ├── .jl-process      (4-step process, dark bg)
                 ├── .jl-studio       (address + contact)
                 └── .jl-foot         (footer)
```

**Files involved:**

| File | Role |
|------|------|
| `templates/front-page.html` | Blank template — WordPress auto-uses this for the front page. No WP header/footer. |
| `patterns/page-startseite.php` | The complete landing page HTML. Edit content here. |
| `src/scss/components/landing-silversmith.scss` | All CSS for the landing. `.joyas-landing` scope prevents conflicts. |

### Two Design Systems, Side by Side

The theme has **two parallel design systems** that coexist:

| System | Used for | Tokens | Files |
|--------|----------|--------|-------|
| **WordPress block system** | Inner pages (Leistungen, Galerie, etc.) | `theme.json` + `tokens.scss` | `patterns/page-*.php`, `parts/*.html` |
| **Silversmith landing system** | Homepage only | `--jl-*` CSS custom properties in `.joyas-landing` | `landing-silversmith.scss`, `page-startseite.php` |

The silversmith system uses **oklch color space** for better perceptual uniformity (supported in all modern browsers 2024+).

---

## Where to Change Things

### Change homepage copy / content

Edit `joyas-block-theme/patterns/page-startseite.php`.

Sections are clearly commented:
- `<!-- ─── HERO ─────── -->` — eyebrow text, subtitle
- `<!-- ─── COLLECTION ─ -->` — 5 work cards with title + material + edition
- `<!-- ─── STORY ─────── -->` — atelier story paragraphs, signature
- `<!-- ─── PROCESS ───── -->` — 4 process steps
- `<!-- ─── STUDIO ─────── -->` — address, hours, email
- `<!-- ─── FOOTER ─────── -->` — nav links, copyright

### Change homepage visual design / layout

Edit `joyas-block-theme/src/scss/components/landing-silversmith.scss`.

The file is organized by section (matching the HTML):
- Lines 1–42: CSS custom properties (color palette, fonts)
- Lines 44–102: `.jl-topbar` — fixed navigation
- Lines 104–270: `.jl-hero` — full-viewport hero, gradients, grain
- Lines 272–310: Section shell (`.jl-section-pad`, `.jl-section-head`)
- Lines 312–428: `.jl-collection` + `.jl-work` grid
- Lines 430–535: `.jl-story` — two-column atelier section
- Lines 537–608: `.jl-process` — dark 4-column step grid
- Lines 610–703: `.jl-studio` — contact section
- Lines 705–733: `.jl-foot` — footer
- Lines 735–810: `@media (max-width: 900px)` — all responsive overrides

After editing SCSS, rebuild: `npm run build`

### Add real photography

All image areas are currently CSS gradient placeholders. To swap in real photos:

**Hero background** — In `page-startseite.php`, replace the `.jl-hero-bg` + `.jl-hero-image` divs with an `<img>` tag, then update the `.jl-hero` CSS to use `background-image` on that container.

```html
<!-- Replace this: -->
<div class="jl-hero-bg"></div>
<div class="jl-hero-image"></div>
<div class="jl-img-placeholder"><span>workshop · silver on anvil · b&w</span></div>

<!-- With this: -->
<img class="jl-hero-photo" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hero-workshop.jpg" alt="Silversmith at work" />
```

Add CSS to `landing-silversmith.scss`:
```scss
.jl-hero-photo {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center 40%;
  filter: brightness(0.45) grayscale(0.3);
}
```

**Work grid placeholders** — each `.jl-work .frame` + `.jl-work .obj` div. Replace the `.obj` div with an `<img>` inside `.frame`:
```html
<div class="frame" data-label="01 · STERLING">
  <img src="..." alt="Halo Cuff" style="width:100%;height:100%;object-fit:cover;" />
</div>
```

**Portrait / atelier image** — `.jl-story-img` div. Same approach — add an `<img>` inside it.

Place all images in `joyas-block-theme/assets/images/`.

### Change the brand colors

**Silversmith landing colors** — Edit the CSS custom properties at the top of `landing-silversmith.scss` (lines 8–19):
```scss
--jl-brass: oklch(0.72 0.07 75);       /* main accent — warmer = higher chroma */
--jl-brass-deep: oklch(0.58 0.075 70); /* darker brass for text accents */
--jl-bone: oklch(0.96 0.004 80);       /* light section background */
--jl-ink: oklch(0.13 0.004 250);       /* near-black text */
```

**WordPress block colors** (used on inner pages) — Edit `theme.json` under `settings.color.palette`. Then update `src/scss/tokens.scss` to match.

### Change typography / fonts

**Silversmith landing fonts** — In `landing-silversmith.scss` lines 18–19:
```scss
--jl-serif: "Marcellus", "Cormorant Garamond", serif; /* headings */
--jl-sans: "Inter Tight", system-ui, sans-serif;      /* body + nav */
```

**WordPress block fonts** — In `theme.json` under `settings.typography.fontFamilies`. Also update `tokens.scss` `$font-heading` / `$font-body`.

**All fonts are loaded from Google Fonts** in `functions.php`. Current load:
```
Marcellus | Inter Tight (300,400,500,600) | Playfair Display (400,700) | Cormorant Garamond (italic)
```
Add or remove families in the `wp_enqueue_style('joyas-google-fonts', ...)` call.

### Change navigation items

**Top nav links** — In `page-startseite.php`, find the `<!-- ─── TOP NAV ─── -->` section:
```php
<nav class="jl-nav">
  <a href="#collection">Collections</a>
  <a href="#story">Custom</a>
  ...
</nav>
```

**Footer nav links** — In `parts/footer.html` (for WordPress inner pages) or the `<!-- ─── FOOTER ─── -->` section in `page-startseite.php`.

### Edit inner pages (Leistungen, Galerie, etc.)

These use standard WordPress block patterns. Edit the PHP files in `patterns/`:

| Page | File |
|------|------|
| Startseite (Homepage) | `patterns/page-startseite.php` |
| Leistungen | `patterns/page-leistungen.php` |
| Maßanfertigung | `patterns/page-massanfertigung.php` |
| Werkstatt | `patterns/page-werkstatt.php` |
| Galerie | `patterns/page-galerie.php` |
| Kontakt | `patterns/page-kontakt.php` |

These are standard WordPress block markup — you can also edit them directly in the WordPress Site Editor.

---

## SCSS Architecture

```
src/scss/
├── tokens.scss                  ← SCSS variables, mirrors theme.json values
├── main.scss                    ← Entry: imports all partials
├── editor.scss                  ← Editor-only styles
├── base/
│   ├── global.scss              ← Smooth scroll, alignfull fix
│   └── typography.scss          ← WP block typography overrides
├── components/
│   ├── buttons.scss             ← Button styles
│   ├── cards.scss               ← Card hover, shadows
│   ├── navigation.scss          ← Mobile menu
│   ├── process-steps.scss       ← 4-step divider
│   └── landing-silversmith.scss ← Complete homepage landing styles
└── utilities/
    └── a11y.scss                ← Reduced motion, focus helpers
```

### Token import rule

Every SCSS partial must import tokens using a **relative path**:
- Files in `base/` or `components/` or `utilities/`: `@use "../tokens" as *;`
- Files at the root `src/scss/` level: `@use "tokens" as *;`

This replaced the previous broken `additionalData` approach in vite.config.ts.

### Adding a new SCSS component

1. Create `src/scss/components/my-component.scss`
2. Add `@use "../tokens" as *;` at the top
3. Add `@use "components/my-component";` to `main.scss`
4. Run `npm run build`

---

## Templates (Page Templates)

Templates control the outer wrapper of each page (header, main, footer).

| Template | Used for | Has WP header/footer? |
|----------|----------|-----------------------|
| `front-page.html` | **Homepage** — auto-selected by WordPress | **No** — landing handles its own nav/footer |
| `page-landing.html` | Custom landing pages | No |
| `page.html` | Default pages | Yes |
| `page-full-width.html` | Full-width pages | Yes |
| `index.html` | Blog archive | Yes |
| `singular.html` | Single posts | Yes |
| `404.html` | 404 page | Yes |

**Why `front-page.html` has no WP header:**
The homepage uses its own fixed `jl-topbar` navigation that blends over the content with `mix-blend-mode: difference`. The standard WP header would conflict.

**To assign a template to a page in WordPress:**
Go to Pages → Edit → Template (right sidebar) → select the template.

---

## functions.php Architecture

`functions.php` uses a **static-cached manifest helper** to avoid reading disk on every hook:

```php
function joyas_vite_manifest(): ?array {
    static $manifest = null;
    // Reads dist/manifest.json once, caches in static var for the request
    ...
}
```

**Manifest keys** (must match Vite entry points in `vite.config.ts`):
- `src/ts/main.ts` → frontend JS + CSS
- `src/ts/editor.ts` → editor JS + CSS

**Critical:** If you rename entry files in `vite.config.ts`, update the manifest keys in `functions.php` too.

---

## Build System (Vite)

```bash
npm run build    # Production build → dist/
npm run dev      # Dev server with HMR (http://localhost:3000)
```

### Output
```
dist/
├── manifest.json               ← Maps source entries to hashed output files
└── assets/
    ├── main-[hash].css         ← Frontend CSS (all SCSS compiled)
    ├── main-[hash].js          ← Frontend JS
    ├── editor-[hash].css       ← Editor CSS
    └── editor-[hash].js        ← Editor JS
```

### Entry points (vite.config.ts)
```ts
input: {
  main:   'src/ts/main.ts',    // Frontend
  editor: 'src/ts/editor.ts',  // Block editor
}
```

### Path aliases
```ts
'@styles'  → src/scss/
'@scripts' → src/ts/
```

Use in TypeScript: `import '@styles/tokens.scss'`

---

## Design Tokens

### Silversmith Landing (oklch palette)

Used only in `.joyas-landing` / `landing-silversmith.scss`:

| Token | Value | Usage |
|-------|-------|-------|
| `--jl-ink` | `oklch(0.13 0.004 250)` | Primary text, darkest |
| `--jl-pewter` | `oklch(0.55 0.006 250)` | Secondary text, labels |
| `--jl-silver` | `oklch(0.78 0.005 250)` | Muted text, hero copy |
| `--jl-bone` | `oklch(0.96 0.004 80)` | Light section backgrounds |
| `--jl-paper` | `oklch(0.93 0.005 80)` | Slightly warmer background |
| `--jl-brass` | `oklch(0.72 0.07 75)` | Accent — decorators, dots |
| `--jl-brass-deep` | `oklch(0.58 0.075 70)` | Accent — text, underlines |
| `--jl-serif` | Marcellus + Cormorant | Display headings |
| `--jl-sans` | Inter Tight | Body + nav text |

### WordPress Block System (hex palette)

Used in `theme.json`, `tokens.scss`, and all inner page patterns:

| Slug | Hex | SCSS var | Usage |
|------|-----|----------|-------|
| `obsidian` | `#0A0A0A` | `$color-obsidian` | Primary dark |
| `charcoal` | `#1C1C1C` | `$color-charcoal` | Dark sections |
| `gold` | `#C9A96E` | `$color-gold` | CTAs, accent |
| `linen` | `#F5F2EB` | `$color-linen` | Light backgrounds |
| `ash` | `#4A4A4A` | `$color-ash` | Muted text |
| `sand` | `#E8E4DB` | `$color-sand` | Borders |
| `silver` | `#C0C0C0` | — | Highlight |

**Important:** `theme.json` is the **source of truth** for block colors. `tokens.scss` must be kept in sync manually.

### Typography

| Font | Used in | Loaded via |
|------|---------|------------|
| Marcellus | Landing headings (`--jl-serif`) | Google Fonts |
| Inter Tight | Landing body + nav (`--jl-sans`) | Google Fonts |
| Playfair Display | Block theme headings | Google Fonts |
| Cormorant Garamond | Block theme accent/quotes | Google Fonts |
| Inter | Block theme body (fallback only) | System font (not loaded) |

---

## Docker Stack

```bash
npm run start:dock   # Start
npm run stop:dock    # Stop
```

| Service | URL | Credentials |
|---------|-----|-------------|
| WordPress | http://localhost:8090 | `admin` / `admin` (set by setup script) |
| phpMyAdmin | http://localhost:8091 | `joyas` / `joyaspass` |
| Mailpit (email) | http://localhost:8025 | — |

**Volume mounts** (live-reloads on save):
- `joyas-block-theme/` → `/var/www/html/wp-content/themes/joyas-block-theme`

**After running `npm run build`**, the compiled assets in `dist/` are immediately live in WordPress (no server restart needed).

---

## WP-CLI Setup Scripts

```bash
npm run setup:wp       # Theme activate, admin user, permalinks
npm run setup:content  # Create pages, set front page, build nav, inject patterns
npm run setup:all      # Both of the above
```

If the database needs a reset:
```bash
bash bin/wp-reset.sh && npm run setup:all
```

**What `setup:content` does:**
1. Creates pages: Startseite, Leistungen, Maßanfertigung, Werkstatt, Galerie, Kontakt
2. Sets Startseite as the static front page (WordPress Settings → Reading)
3. Creates the main navigation menu
4. Inserts block patterns into each page via `bin/wp-insert-patterns.php`

---

## Adding a New Page

1. **Create the pattern file:** `patterns/page-meinseite.php`
   ```php
   <?php
   /**
    * Title: Mein Seite
    * Slug: joyas/page-meinseite
    * Categories: pages, joyas
    * Inserter: true
    */
   ?>
   <!-- wp:group ... -->
   ...
   <!-- /wp:group -->
   ```

2. **Create a page in WordPress:** Pages → Add New → set template → insert pattern

3. **Or automate it** in `bin/wp-content-setup.sh`:
   ```bash
   wp post create --post_type=page --post_title="Mein Seite" --post_status=publish ...
   ```

---

## Adding a New Custom Block

Custom blocks auto-discover from `blocks/*/block.json`.

```bash
# Scaffold a new block
mkdir blocks/my-block
# Create block.json, render.php (for dynamic), index.ts (for interactive)
```

**Rule:** Always use **dynamic blocks** (`render.php`) — avoids "invalid content" errors when iterating markup.

---

## Code Quality

```bash
npm run lint:php      # PHPCS: WordPress coding standards
npm run fix:php       # Auto-fix PHPCS violations
npm run analyze:php   # PHPStan level 6 static analysis
npm run lint:css      # Stylelint SCSS linting
npm run fix:css       # Auto-fix Stylelint
npm run lint:ts       # TypeScript strict type check
npm run format        # Prettier all files
```

**Git hooks** (Husky + lint-staged run automatically on commit):
- SCSS → Stylelint auto-fix
- JS/TS/JSON/MD/YAML → Prettier format

---

## Common Tasks Cheat Sheet

| What to change | Where |
|----------------|-------|
| Homepage text/copy | `patterns/page-startseite.php` |
| Homepage visual design | `src/scss/components/landing-silversmith.scss` |
| Homepage nav links | `patterns/page-startseite.php` → `.jl-nav` section |
| Add real hero photo | `patterns/page-startseite.php` + `landing-silversmith.scss` |
| Add a work card to the grid | `patterns/page-startseite.php` → `<!-- COLLECTION -->` section |
| Change brand accent color (landing) | `landing-silversmith.scss` line 17: `--jl-brass` |
| Change gold color (inner pages) | `theme.json` palette → `gold` + `tokens.scss` `$color-gold` |
| Add a new Google Font | `functions.php` Google Fonts URL + `theme.json` fontFamilies |
| Add a new SCSS component | `src/scss/components/` + `@use` in `main.scss` |
| Add a new page | `patterns/page-*.php` → create in WP → insert pattern |
| Change address/contact info | `patterns/page-startseite.php` → `<!-- STUDIO -->` section |
| Change footer links | `patterns/page-startseite.php` → `<!-- FOOTER -->` section |
| Change process steps | `patterns/page-startseite.php` → `<!-- PROCESS -->` section |
| Edit inner pages | `patterns/page-leistungen.php` etc. |
| Database reset | `bash bin/wp-reset.sh && npm run setup:all` |

---

## Known Decisions & Trade-offs

**Why is the homepage a single HTML block instead of WordPress blocks?**
The silversmith design requires complex CSS (oklch colors, CSS grid, mix-blend-mode, grain texture, radial gradients) that cannot be expressed through standard block markup without significant quality loss. The scoped `.joyas-landing` wrapper keeps all custom CSS contained and conflict-free.

**Why does `front-page.html` have no WP header?**
The landing page has its own `position: fixed` navigation with `mix-blend-mode: difference` that creates the visual effect shown in the design. Including the standard WP header would create a duplicate nav and break the effect.

**Why oklch colors instead of hex?**
oklch provides perceptually uniform color space — darkening a color with oklch gives more predictable results than adjusting hex brightness. It's supported in all major browsers since 2023.

**Why are there two separate color systems?**
The inner pages (Leistungen, Galerie, etc.) were built with the standard WP block system and can be edited in the WordPress admin. The homepage design requires custom CSS variables and scoping. Merging them would complicate both. The two systems are isolated and don't conflict.
