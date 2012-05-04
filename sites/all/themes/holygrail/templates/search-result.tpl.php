<?php
?>

<dt>
  <a href="<?php print $url; ?>"><?php print $title; ?></a>
</dt>
<dd class="meta">
  <?php
    if($web_site){
      print $web_site . ', ';
      }
    print $info_split['type'] . ' - ' . $info_split['date'];
    ?>
</dd>
<dd class="snippet">
  <?php if ($snippet) : ?>
    <p class="search-snippet"><?php print $snippet; ?></p>
  <?php endif; ?>
</dd>