<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">
<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>
<body class="<?php print $body_classes; ?>">
  <div id="page">
    <div id="page-wrapper">
      <?php if (!empty($header_top)): ?>
      <div id="header-top">
        <div class="wrap clearfix">
          <?php print $header_top; ?>
        </div>
      </div><!-- /header-top -->
      <?php endif; ?>
      <header>
        <div class="wrap clearfix">
          <div class="hg-container">
            <div id="header-main" class="column hg-main">
              <?php if ($site_name || $logo): ?>
              <?php if ($site_slogan):?>
              <div id="site-meta" class="clearfix <?php if($logo) { print ' with-logo'; } ?>">
              <?php endif; ?>
              <?php if ($logo): ?>
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
              <?php endif; ?>
              <?php if ($site_name): ?>
              <?php if ($is_front) { $title_tag = 'h1'; } else { $title_tag = 'h2'; } ?>
              <<?php print $title_tag;?> id="site-title"<?php if ($site_slogan) { print ' class="with-slogan"';}?>>
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
              </<?php print $title_tag;?>>
              <?php endif; ?>
              <?php endif; ?>
              <?php if ($site_slogan): ?>
              <?php if ($is_front) { $slogan_tag = 'h2'; } else { $slogan_tag = 'h3'; } ?><<?php print $slogan_tag;?> id="slogan">
                <span><?php print $site_slogan; ?></span>
              </<?php print $title_tag;?>>
              <?php if ($site_slogan):?>
              </div>
              <?php endif; ?>
              <?php endif; ?>
              <?php if (!empty($header)) : ?>
                <?php print $header;?>
              <?php endif; ?>
              <?php print $header_main; ?>
            </div><!-- /header-main -->
            <?php if (!empty($header_secondary)): ?>
            <div id="header-secondary" class="column hg-secondary">
              <?php print $header_secondary; ?>
            </div><!-- /header-secondary -->
            <?php endif; ?>
            <?php if (!empty($header_tertiary)): ?>
            <div id="header-tertiary" class="column hg-tertiary">
              <?php print $header_tertiary; ?>
            </div><!-- /header-tertiary -->
            <?php endif; ?>
          </div><!-- /hg-container -->
        </div><!-- /wrap -->
      </header>
      <?php if (!empty($primary_links)) : ?>
      <nav id="primary-navigation">
        <div class="wrap clearfix">
          <?php print theme(array('links__system_main_menu', 'links'), $primary_links,
              array(
                'id' => 'main-menu',
                'class' => 'float-left links clearfix',
              ),
              array(
                'text' => '', // to add a label to this menu add
                'level' => '', // determine the heading (h3, h2, etc.)
              ));
            ?>
        </div><!--/wrap-->
      </nav><!-- /navbar -->
      <?php endif; ?>
      <div id="content-area">
        <div class="wrap clearfix">
          <div class="hg-container">
          <div id="content-main" class="column hg-main">
            <?php if (!empty($content_top)): ?>
            <div id="content-top">
              <?php print $content_top; ?>
            </div><!-- /content-top -->
            <?php endif; ?>
            <div id="content">
            <?php print $context_links;?>
            <?php if (!empty($title)): ?>
              <h1 class="title<?php if ($tabs) : print ' with-tabs'; endif;?>"><?php print $title; ?></h1>
             <?php endif; ?>
             <?php if (!empty($tabs)): ?>
              <div class="tabs"><?php print $tabs; ?></div>
              <?php endif; ?>
              <?php print $help; ?>
              <?php print $messages; ?>
              <?php print $content; ?>
            </div> <!-- /content -->
            <?php if (!empty($content_bottom)): ?>
              <div id="content-bottom">
                <?php print $content_bottom; ?>
              </div><!--/content-bottom-->
            <?php endif; ?>
            </div><!-- /main content -->
          <?php if (!empty($left)): ?>
          <div id="content-secondary" class="sidebar column hg-secondary">
            <?php print $left; ?>
          </div> <!-- /secondary content -->
          <?php endif; ?>
          <?php if (!empty($right)): ?>
          <div  id="content-tertiary" class="sidebar column hg-tertiary">
            <?php print $right; ?>
          </div> <!-- /tertiary content -->
          <?php endif; ?>
        </div> <!-- / hg-container -->
        </div><!--/wrap-->
      </div> <!-- / content area -->
      <footer>
        <div class="wrap clearfix">
          <?php if ($footer) : ?>
            <?php print $footer; ?>
          <?php endif; ?>
        </div><!-- /wrap -->
      </footer>
    </div><!-- /page-wrapper -->
  </div> <!-- /page -->
  <?php if ($closure_region): ?>
  <div id="closure-blocks"><?php print $closure_region; ?></div>
  <?php endif; ?>
  <?php print $closure; ?>
</body>
</html>