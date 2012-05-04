<?php
?>
<?php if (!$field_empty) : ?>
<div class="field-type-<?php print $field_type_css ?> field-<?php print $field_name_css ?>">
  <?php if ($label_display == 'above') : ?>
    <?php print t($label) ?>:&nbsp;
  <?php endif;?>
    <?php $count = 1;
    foreach ($items as $delta => $item) :
      if (!$item['empty']) : ?>
        <div class="<?php print ($count % 2 ? 'odd' : 'even') ?>">
          <?php if ($label_display == 'inline') { ?>
            <div class="inline<?php print($delta ? '' : '-first')?>">
              <?php print t($label) ?>:&nbsp;</div>
          <?php } ?>
          <?php print $item['view'] ?>
        </div>
      <?php $count++;
      endif;
    endforeach;?>
</div>
<?php endif; ?>
