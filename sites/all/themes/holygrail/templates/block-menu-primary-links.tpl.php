<?php
// Since we know this is the primary nav, probably no need to add normal block classes.
// However you can always add back block_classes as seen in the block.tpl.php file
?>
<nav id="block-<?php print $block->module . '-' . $block->delta; ?>">
  <?php if ($block->subject): ?>
    <h3 class="title"><?php print $block->subject; ?></h3>
  <?php endif; ?>
    <?php print $block->content; ?>
  <?php print $edit_links; ?>
</nav>
