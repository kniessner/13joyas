# Design: Silversmith Landing — Block Pattern Split

**Date:** 2026-05-17  
**Status:** Approved  
**Scope:** WP block theme `joyas-block-theme`

---

## Goal

Split the monolithic `patterns/page-startseite.php` (one giant `wp:html` block) into five separate, standalone, fully editable WP block patterns. Each section must work independently and also be composable into a full front-page pattern. Navigation stays in `header.html` (already uses `wp:navigation`).

---

## What Changes

### Files Modified

| File | Change |
|------|--------|
| `patterns/page-startseite.php` | Rewritten — no `wp:html`. Composes 5 section patterns as native WP blocks. No nav/footer (handled by template parts). |
| `src/scss/components/landing-silversmith.scss` | Remove nav/footer styles, remove global `* {}` reset, move hero decorator divs to `::before`/`::after`. |

### Files Created

| File | Slug | Inserter |
|------|------|----------|
| `patterns/section-hero.php` | `joyas/section-hero` | true |
| `patterns/section-collection.php` | `joyas/section-collection` | true |
| `patterns/section-story.php` | `joyas/section-story` | true |
| `patterns/section-process.php` | `joyas/section-process` | true |
| `patterns/section-studio.php` | `joyas/section-studio` | true |

### Files Unchanged

`header.html`, `footer.html`, `front-page.html`, `parts/contact-cta.html`, `parts/process-steps.html`, all other patterns and templates.

---

## SCSS Changes (`landing-silversmith.scss`)

### Remove

- `.jl-topbar`, `.jl-brandmark`, `.jl-nav` — nav is `header.html`'s responsibility
- `.jl-foot` — footer is `footer.html`'s responsibility
- `.jl-hero-bg`, `.jl-hero-image`, `.jl-hero-grain`, `.jl-img-placeholder` — replaced by pseudo-elements
- `*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box }` — breaks WP block editor rendering inside `.joyas-landing` sections
- Global `a { color: inherit; text-decoration: none }` and `img { display: block; max-width: 100% }` resets — scope these to `.jl-*` elements instead

### Add

- `.jl-hero::before` — combined background gradients (merged from `.jl-hero-bg` + `.jl-hero-image`)
- `.jl-hero::after` — grain overlay (from `.jl-hero-grain`), `z-index: 1`, `pointer-events: none`
- `.jl-scroll-indicator::after` — vertical scroll line drawn below the "Scroll" paragraph via CSS
- `.jl-work-label` — absolute-positioned editable label inside each work frame
- Add `font-family: var(--jl-sans)` and `color` to each section class (`.jl-collection`, `.jl-story`, etc.) since the global reset was the previous carrier

### Keep

All `.jl-collection`, `.jl-story`, `.jl-process`, `.jl-studio`, `.jl-step`, `.jl-section-head`, `.jl-section-pad`, `.jl-work`, `.jl-sign`, `.jl-studio-cta`, and responsive media query styles — unchanged.

### CSS Targeting Notes

- **`.jl-story-img`** — when used on a `wp:image` block, WP renders `<figure class="wp-block-image jl-story-img">`. Update the CSS selector to cover `figure.jl-story-img img { object-fit: cover; width: 100%; height: 100%; }` for real uploaded images. The gradient background + pseudo-elements work on `figure` tags.
- **`.jl-sign .rule`** — the decorative horizontal rule (was a raw `<span class="rule">`) becomes a CSS `::before` on `.jl-sign p`: `content: ""; width: 36px; height: 1px; background: var(--jl-ink-3); display: inline-block; vertical-align: middle; margin-right: 18px;`

---

## Section Pattern Designs

### CSS Scope Convention

Each section pattern wraps itself in:
```
<!-- wp:group {"className":"joyas-landing","style":{"spacing":{"padding":...}},"layout":{"type":"default"}} -->
```
This scopes the `--jl-*` CSS custom property tokens and section styles. Multiple `.joyas-landing` divs on the same page is fine — custom properties re-declare without side effects.

All inner `wp:group` blocks use `"layout":{"type":"default"}` (WP flow layout) unless a flex layout is explicitly needed. The SCSS handles all custom grid/flex positioning via `.jl-*` class names.

---

### `section-hero.php` — Full-Viewport Hero

Block tree:
```
wp:group.joyas-landing               ← CSS scope
  wp:group.jl-hero                   ← 100vh dark container, ::before/::after backgrounds
    wp:group.jl-hero-inner           ← CSS grid: 1fr auto rows, full height
      wp:group.jl-hero-center        ← centered content column
        wp:site-logo.jl-hero-logo    ← dynamic: WP Admin > Site Identity > Logo
        wp:paragraph.jl-eyebrow      ← "Handcrafted in Berlin · est. 2013"
        wp:heading[h1]               ← main headline (editable, includes <em>)
        wp:paragraph.jl-sub          ← subtitle paragraph
      wp:group.jl-hero-footer        ← WP flex layout, space-between
        wp:group                     ← location (wp:paragraph × 2)
        wp:paragraph.jl-scroll-indicator ← "Scroll" + CSS ::after draws the line
        wp:group                     ← edition/season (wp:paragraph × 2)
```

Admin-editable: logo (Site Identity), eyebrow text, headline, subtitle, location coords, edition label. Background is CSS-only.

---

### `section-collection.php` — Selected Works Grid

Block tree:
```
wp:group.joyas-landing
  wp:group.jl-collection.jl-section-pad
    wp:group.jl-section-head
      wp:paragraph.jl-section-num    ← "Selected Works · 01"
      wp:heading[h2].jl-section-title ← editable section title with <em>
    wp:group.jl-work-grid
      wp:group.jl-work.large         ← 7/12 col
        wp:group.frame
          wp:image                   ← admin uploads artwork photo (placeholder: gold-bracelet.jpg)
          wp:paragraph.jl-work-label ← "01 · STERLING" (editable)
        wp:group.caption
          wp:heading[h3]             ← piece name
          wp:paragraph.meta          ← "<strong>Material</strong> · edition info"
      wp:group.jl-work.small         ← 5/12 col (same structure)
      wp:group.jl-work.third × 3    ← 4/12 col each (same structure)
```

Images: uses existing theme placeholder images (`gold-bracelet.jpg`, `ring-closeup.jpg`, `jewelry-display.jpg`, `craftsman-hands.jpg`, `silver-texture.jpg`). Admin replaces with real product photos.

Note: The `.obj` CSS sphere placeholder is removed. Empty frames show the gradient background from `.frame` CSS.

---

### `section-story.php` — The Atelier

Block tree:
```
wp:group.joyas-landing
  wp:group.jl-story.jl-section-pad
    wp:group.jl-story-grid           ← CSS grid: 5fr 6fr
      wp:image.jl-story-img          ← portrait/studio photo (placeholder gradient via CSS)
      wp:group.jl-story-body
        wp:paragraph.eyebrow-dark    ← "The Atelier · 02"
        wp:heading[h2]               ← headline
        wp:paragraph × 2             ← body paragraphs
        wp:group.jl-sign
          wp:paragraph               ← "— Inés Carrera, Silversmith"
```

The `.jl-story-img` CSS gradient background acts as placeholder until admin uploads a real image.

---

### `section-process.php` — The Making

Block tree:
```
wp:group.joyas-landing
  wp:group.jl-process.jl-section-pad
    wp:group.jl-section-head
      wp:paragraph.jl-section-num
      wp:heading[h2].jl-section-title
    wp:group.jl-process-row          ← CSS grid: 4 equal columns
      wp:group.jl-step × 4
        wp:paragraph.num             ← "01 · Draw"
        wp:paragraph.glyph           ← "I" (roman numeral, styled as circle)
        wp:heading[h4]               ← step title
        wp:paragraph                 ← step description
```

---

### `section-studio.php` — Studio & Contact

Block tree:
```
wp:group.joyas-landing
  wp:group.jl-studio
    wp:group.jl-studio-inner
      wp:heading[h2]                 ← "Visit the bench." (large display type)
      wp:group.jl-studio-cols        ← CSS grid: 2 columns
        wp:group.addr
          wp:heading[h5]             ← "Studio"
          wp:paragraph               ← address + hours
        wp:group
          wp:heading[h5]             ← "Hours & Notes"
          wp:paragraph               ← notes text
    wp:group.jl-studio-cta          ← flex space-between
      wp:paragraph.label             ← "Write the studio"
      wp:paragraph.jl-email-link    ← email as <a href="mailto:...">
      wp:paragraph.label             ← phone number
```

---

### Updated `page-startseite.php` — Full Page Composition

Rewritten to sequence all 5 sections. Each section is its own `wp:group.joyas-landing` block. No nav. No footer. The front-page template (`front-page.html`) already adds `header` and `footer` template parts around the page content.

Pattern metadata: `Title`, `Slug: joyas/page-startseite`, `Categories: pages, joyas`, `Inserter: no`.

---

## What Admin Can Edit (Site Editor)

| Element | Where |
|---------|-------|
| Navigation links | Site Editor > Navigation (header template part) |
| Site logo | WP Admin > Appearance > Site Identity |
| Hero headline, eyebrow, subtitle | Block editor (page content) |
| Hero meta (location, edition, season) | Block editor |
| Section titles and body text | Block editor |
| Artwork images (collection grid) | Block editor > Image blocks |
| Story/atelier portrait image | Block editor > Image block |
| Process step titles and descriptions | Block editor |
| Studio address and contact info | Block editor |
| Email address | Block editor (paragraph link) |
| Footer content | Site Editor > footer template part |

---

## Out of Scope

- Adding Gutenberg block controls (font size pickers, color pickers, etc.) to custom-styled elements — the design uses specific brand colors from `theme.json`
- Converting the hero to a `wp:cover` block — keeping CSS gradient approach preserves the exact visual
- Responsive mobile menu — header template part scope
- Contact form — future enhancement
