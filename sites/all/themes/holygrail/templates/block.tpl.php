<section id="block-<?php print $block->module . '-' . $block->delta; ?>" class="<?php print $block_classes;?>">

  <?php if ($block->subject): ?>
    <h2 class="title"><?php print $block->subject; ?></h2>
  <?php endif; ?>

  <div class="content">
    <?php print $block->content; ?>
  </div>

  <?php print $edit_links; ?>

</section> <!-- /block -->
