<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>
<body class="<?php print $body_classes; ?>">
  <div id="wrapper">
    <div id="wrapper-inner">
      <div id="container">
      <div id="header">
        <?php if (!empty($header_top)): ?>
        <div id="header-top">
          <?php print $header_top; ?>
        </div><!-- /header-top -->
        <?php endif; ?>
        <div id="header-wrapper">
          <?php if ($site_name): ?>
          <?php if ($site_slogan):?>
          <div id="site-meta">
          <?php endif; ?>
          <?php if ($is_front) { $title_tag = 'h1'; } else { $title_tag = 'h2'; } ?>
          <<?php print $title_tag;?> id="site-title">
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
          </<?php print $title_tag;?>>
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
        </div><!-- /header wrapper -->
        <?php if (!empty($navigation)): ?>
        <div id="navigation">
          <?php print $navigation; ?>
        </div><!-- /navigation -->
        <?php endif; ?>
      </div> <!-- /header -->
      <div id="content-wrapper">
        <div id="content-wrapper-inner">
          <div id="content-main" class="column">
              <?php if (!empty($content_top)): ?>
              <div id="content-top">
                <?php print $content_top; ?>
              </div><!-- /content-top -->
              <?php endif; ?>
              <div id="content">
                <?php if (!empty($title)): ?>
                <h2 class="title<?php if ($tabs) : print ' with-tabs'; endif;?>"><?php print $title; ?></h2>
                <?php endif; ?>
                <?php if (!empty($tabs)): ?>
                <div class="tabs">
                  <?php print $tabs; ?>
                </div>
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
          </div><!-- /content main -->
          <?php if (!empty($left)): ?>
          <div id="sidebar-first" class="sidebar column">
            <?php print $left; ?>
          </div> <!-- /sidebar-left -->
          <?php endif; ?>
          <?php if (!empty($right)): ?>
          <div id="sidebar-second" class="sidebar column">
            <?php print $right; ?>
          </div> <!-- /sidebar-right -->
          <?php endif; ?>
        </div> <!-- / content wrapper inner -->
      </div> <!-- / content wrapper -->
      <div id="footer">
        <div id="footer-inner">
          <?php if ($footer) : ?>
            <?php print $footer; ?>
          <?php endif; ?>
          <p class="copyright"><?php if ($footer_message) { print $footer_message; } ?></p>
        </div><!-- /#footer-inner -->
      </div> <!-- /#footer -->
    </div> <!-- /container -->
    </div><!-- /wrapper-inner -->
  </div> <!-- /wrapper -->
  <?php if ($closure_region): ?>
    <div id="closure-blocks"><?php print $closure_region; ?></div>
  <?php endif; ?>
  <?php print $closure; ?>
</body>
</html>
