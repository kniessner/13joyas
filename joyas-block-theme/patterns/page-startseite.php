<?php
/**
 * Title: Startseite — Silversmith Landing
 * Slug: joyas/page-startseite
 * Categories: pages, joyas
 * Description: Complete silversmith landing page for 13 Joyas. Use with the Front Page template.
 * Inserter: no
 */
?>

<!-- wp:html -->
<div class="joyas-landing">

<!-- ─── TOP NAV ─────────────────────────────── -->
<div class="jl-topbar">
  <div class="jl-brandmark">
    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo_13joyas.png" alt="13 Joyas" />
  </div>
  <nav class="jl-nav">
    <a href="#collection">Collections</a>
    <a href="#story">Custom</a>
    <a href="#collection">Gallery</a>
    <a href="#studio">Shop</a>
    <a href="#collection">One of a Kind</a>
    <a href="#studio">Contact</a>
  </nav>
</div>

<!-- ─── HERO ────────────────────────────────── -->
<section class="jl-hero">
  <div class="jl-hero-bg"></div>
  <div class="jl-hero-image"></div>
  <div class="jl-img-placeholder"><span>workshop · silver on anvil · b&w</span></div>
  <div class="jl-hero-grain"></div>

  <div class="jl-hero-inner">
    <div class="jl-hero-center">
      <img class="jl-hero-logo" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo_13joyas.png" alt="13 Joyas" />
      <div class="jl-eyebrow">Handcrafted in Berlin · est. 2013</div>
      <p class="jl-sub">A small atelier working sterling and reclaimed silver into objects meant to be kept. Drawn, raised and finished under one roof in Berlin-Neukölln.</p>
    </div>

    <div class="jl-hero-footer">
      <div class="meta">
        <span>Berlin, Germany</span>
        <b>52°N 13°E</b>
      </div>
      <div class="scroll">
        <span>Scroll</span>
        <div class="jl-scroll-line"></div>
      </div>
      <div class="right">
        <div>Edition №14</div>
        <div>Spring · MMXXVI</div>
      </div>
    </div>
  </div>
</section>

<!-- ─── COLLECTION ───────────────────────────── -->
<section id="collection" class="jl-collection jl-section-pad">
  <div class="jl-section-head">
    <div class="jl-section-num">Selected Works <span class="dot">·</span> 01</div>
    <h2 class="jl-section-title">Thirteen quiet objects — <em>rings, cuffs and vessels</em>, each made to order, none made twice.</h2>
  </div>

  <div class="jl-work-grid">
    <div class="jl-work large">
      <div class="frame" data-label="01 · STERLING">
        <div class="obj"></div>
      </div>
      <div class="caption">
        <h3>Halo Cuff, Brushed</h3>
        <div class="meta"><b>Sterling 925</b> · No. 014 / 30</div>
      </div>
    </div>
    <div class="jl-work small">
      <div class="frame" data-label="02 · OXIDISED">
        <div class="obj"></div>
      </div>
      <div class="caption">
        <h3>Tide Signet</h3>
        <div class="meta"><b>Oxidised silver</b> · Made to order</div>
      </div>
    </div>

    <div class="jl-work third">
      <div class="frame" data-label="03 · ROUGH">
        <div class="obj"></div>
      </div>
      <div class="caption">
        <h3>Stone Vessel</h3>
        <div class="meta"><b>Raised silver</b> · Single piece</div>
      </div>
    </div>
    <div class="jl-work third">
      <div class="frame" data-label="04 · FINE">
        <div class="obj"></div>
      </div>
      <div class="caption">
        <h3>Thread Band</h3>
        <div class="meta"><b>Fine silver 999</b> · Pair</div>
      </div>
    </div>
    <div class="jl-work third">
      <div class="frame" data-label="05 · MIXED">
        <div class="obj"></div>
      </div>
      <div class="caption">
        <h3>Anchor Pendant</h3>
        <div class="meta"><b>Silver + brass</b> · Limited</div>
      </div>
    </div>
  </div>
</section>

<!-- ─── STORY / ATELIER ──────────────────────── -->
<section id="story" class="jl-story jl-section-pad">
  <div class="jl-story-grid">
    <div class="jl-story-img"></div>
    <div class="jl-story-body">
      <div class="eyebrow-dark">The Atelier <span style="color: oklch(0.58 0.075 70); margin: 0 2px;">·</span> 02</div>
      <h2>An hour at the bench is an hour <em>well kept.</em></h2>
      <p>13 Joyas was founded in 2013 by silversmith Inés Carrera, who trained in Madrid and Pforzheim before opening a one-bench studio in Berlin-Neukölln. The work is small in scale and slow in pace — sterling, fine silver and the occasional reclaimed pour, raised from sheet or forged from rod.</p>
      <p>The number thirteen sets the rhythm: thirteen editions per year, thirteen pieces in each. Nothing leaves the studio without a hallmark and a hand-written card.</p>
      <div class="jl-sign">
        <span class="rule"></span>
        <span>Inés Carrera, Silversmith</span>
      </div>
    </div>
  </div>
</section>

<!-- ─── PROCESS ──────────────────────────────── -->
<section id="process" class="jl-process jl-section-pad">
  <div class="jl-section-head">
    <div class="jl-section-num">The Making <span class="dot">·</span> 03</div>
    <h2 class="jl-section-title">Four passes between <em>sketch and stamp.</em></h2>
  </div>

  <div class="jl-process-row">
    <div class="jl-step">
      <div class="num">01 · Draw</div>
      <div class="glyph">I</div>
      <h4>Sketch &amp; intent</h4>
      <p>A first conversation, a sheet of vellum and graphite. Form is set before metal is touched.</p>
    </div>
    <div class="jl-step">
      <div class="num">02 · Raise</div>
      <div class="glyph">II</div>
      <h4>Anneal &amp; raise</h4>
      <p>Sterling is cut, annealed and raised over stake. The mark of the hammer is left where it belongs.</p>
    </div>
    <div class="jl-step">
      <div class="num">03 · Finish</div>
      <div class="glyph">III</div>
      <h4>File &amp; polish</h4>
      <p>Surfaces are read by hand under a single north-facing window — brushed, satin or mirror.</p>
    </div>
    <div class="jl-step">
      <div class="num">04 · Hallmark</div>
      <div class="glyph">IV</div>
      <h4>Stamp &amp; record</h4>
      <p>Each piece receives the 925 hallmark, an edition number out of thirteen, and a card written in the maker's hand.</p>
    </div>
  </div>
</section>

<!-- ─── STUDIO / CONTACT ─────────────────────── -->
<section id="studio" class="jl-studio">
  <div class="jl-studio-inner">
    <h2>Visit the <em>bench.</em></h2>
    <div class="jl-studio-cols">
      <div class="addr">
        <h5>Studio</h5>
        <b>Weserstraße 13</b>
        12047 Berlin-Neukölln<br/>
        Germany<br/><br/>
        By appointment, Tues – Fri.
      </div>
      <div>
        <h5>Hours &amp; Notes</h5>
        Open studio first Saturday of every month, 11–16h.<br/><br/>
        New editions are released the 13th of each month — sign up to be notified.
      </div>
    </div>
  </div>
  <div class="jl-studio-cta">
    <span class="label">Write the studio</span>
    <a class="email" href="mailto:hola@13joyas.de">hola@13joyas.de</a>
    <span class="label">+49 30 13 13 0013</span>
  </div>
</section>

<!-- ─── FOOTER ───────────────────────────────── -->
<footer class="jl-foot">
  <div class="mark">
    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo_13joyas.png" alt="13 Joyas" style="height: 26px; filter: brightness(0) invert(1); display:block;" />
  </div>
  <div>© MMXXVI · 13 Joyas · Handcrafted in Berlin</div>
  <div class="social">
    <a href="#">Instagram</a>
    <a href="#">Journal</a>
    <a href="#">Shop</a>
  </div>
</footer>

</div>
<!-- /wp:html -->
