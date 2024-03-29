<?php
/**
 * //Adds clearfix to these menus. Yeah, we could do that in the CSS, but what the hey..
 */
function holygrail_menu_local_tasks() {
  $output = '';

  if (menu_primary_local_tasks()) {
    $output .= '<ul class="tabs primary clearfix">' . menu_primary_local_tasks() . '</ul>';
  }
  if (menu_secondary_local_tasks()) {
    $output .= '<ul class="tabs secondary clearfix">' . menu_secondary_local_tasks() . '</ul>';
  }
  return $output;
}

/**
 * // Makes sure we don't get classes like: 'etouffée'
 */
function holygrail_id_safe($string) {
  // Replace with dashes anything that isn't A-Z, numbers, dashes, or underscores.
  $string = strtr(drupal_strtolower($string), array(' ' => '-', '_' => '-', '[' => '-', ']' => ''));
  $string = strtolower(preg_replace('/[^a-zA-Z0-9-]+/', '-', $string));
  // If the first character is not a-z, add 'id' in front.
  if (!ctype_lower($string{0})) { // Don't use ctype_alpha since it is locale aware.
    $string = 'id' . $string;
  }
  return $string;
}


/**
 * // Adds classes to the body tag.
 */
function holygrail_preprocess_page(&$vars, $hook) {

  $body_classes = array($vars['body_classes']);

  //Replace left and right with first and second
  $original = array('left','right');
  $new = array('first','second');
  $body_classes = str_replace($original,$new,$body_classes);
  if (!$vars['is_front']) {
    // Add unique classes for each page/site section
    // (This comes from Zen.)
    $path = drupal_get_path_alias($_GET['q']);
    list($section, ) = explode('/', $path, 2);
    $body_classes[] = holygrail_id_safe('page-' . $path);
    $body_classes[] = holygrail_id_safe('section-' . $section);
    if (arg(0) == 'node') {
      if (arg(1) == 'add') {
        if ($section == 'node') {
          array_pop($body_classes); // Remove 'section-node'
        }
        $body_classes[] = 'section-node-add'; // Add 'section-node-add'
      }
      elseif (is_numeric(arg(1)) && (arg(2) == 'edit' || arg(2) == 'delete')) {
        if ($section == 'node') {
          array_pop($body_classes); // Remove 'section-node'
        }
        $body_classes[] = 'section-node-' . arg(2); // Add 'section-node-edit' or 'section-node-delete'
      }
    }
  }
  if (module_exists('taxonomy') && $vars['node']->nid) {
    foreach (taxonomy_node_get_terms($vars['node']) as $term) {
      $body_classes[] = 'category-' . str_replace(' ', '-', holygrail_id_safe($term->name));
    }
  }

  //Adds header region awareness to body classes
  $regions = array (
    'secondary' => $vars['header_secondary'],
    'tertiary' => $vars['header_tertiary'],
  );

  $non_empty_regions = array_filter($regions, "__headers_are_empty");
  $header_classes = 'header-main-';
  if (count($non_empty_regions)) {
    $header_classes .= implode('-', array_keys($non_empty_regions));
   }
  else {
    $header_classes .= 'only';
  }

  $body_classes[] = $header_classes;

  $vars['body_classes'] = implode(' ', $body_classes);
}

/**
 * Allows node and block preprocess functions to be inherited by subthemes
 * Borrowed from Zen
 */
function holygrail_theme(&$existing, $type, $theme, $path) {
  // Allows 'stackable' preprocess functions, base theme + vsite themes
  holygrail_theme_get_default_settings($theme);

  // Keep track of all the themes, holygrail and child themes.
  static $all_themes = array();

  // Add a "process" phase to come after the "preprocess" functions.
  if (!in_array($theme,$all_themes)) {
    $all_themes[] = $theme;

    foreach (array_keys($existing) as $hook) {
      // Normally, preprocess functions are added to the registry after
      // HOOK_theme() returns, but if we add them first, they won't be re-added.
      if (function_exists($theme . '_preprocess')) {
        $existing[$hook]['preprocess functions'][] = $theme . '_preprocess';
      }
      if (function_exists($theme . '_preprocess_' . $hook)) {
        $existing[$hook]['preprocess functions'][] = $theme . '_preprocess_' . $hook;
      }

      // Add the theme process functions.
      if (function_exists($theme . '_process')) {
        $existing[$hook]['preprocess functions'][] = $theme . '_process';
      }
      if (function_exists($theme . '_process_' . $hook)) {
        $existing[$hook]['preprocess functions'][] = $theme . '_process_' . $hook;
      }
    }
  }

  // Else return nothing.
  return array();
}

/**
 * For header region classes
 */
function __headers_are_empty($s){
  return $s ? TRUE : FALSE;
}


/**
 * Return the theme settings' default values from the .info and save them into the database.
 *
 * @param $theme
 *   The name of theme.
 * Borrowed from Zen
 */
function holygrail_theme_get_default_settings($theme) {
  $themes = list_themes();

  // Get the default values from the .info file.
  $defaults = !empty($themes[$theme]->info['settings']) ? $themes[$theme]->info['settings'] : array();

  if (!empty($defaults)) {
    // Merge the defaults with the theme settings saved in the database.
    $settings = array_merge($defaults, variable_get('theme_'. $theme .'_settings', array()));
    // Save the settings back to the database.
    variable_set('theme_'. $theme .'_settings', $settings);
    // If the active theme has been loaded, force refresh of Drupal internals.
    if (!empty($GLOBALS['theme_key'])) {
      theme_get_setting('', TRUE);
    }
  }

  // Return the default settings.
  return $defaults;
}

/**
 * // Adds useful classes to nodes.
 */
function holygrail_preprocess_node(&$vars, $hook) {
  $node_classes = array($vars['node_classes']);
  $node_classes[] = 'node';
  $node_classes[] = ' node-type-' . $vars['type'];
  if ($vars['sticky']) {
    $node_classes[] = ' sticky';
  }
  if (!$vars['status']) {
    $node_classes[] = ' unpublished';
    $vars['unpublished'] = TRUE;
  }
  else {
    $vars['unpublished'] = FALSE;
  }
  if ($vars['uid'] && $vars['uid'] == $GLOBALS['user']->uid) {
   $node_classes[] = ' my-content';
  }
  if ($vars['teaser']) {
    $node_classes[] = ' node-teaser';
  }
  if (isset($vars['preview'])) {
    $node_classes[] = ' node-preview';
  }
  $vars['node_classes'] = implode($node_classes);
}

/**
 * // Adds useful classes to blocks.
 */
function holygrail_preprocess_block(&$vars, $hook) {
  $block_classes = array($vars['block_classes']);
  $block_classes[] = 'block';
  //$block_classes[] = ' block-' . $block->module;
  $block_classes[] = ' region-' . $vars['block_zebra'];
  $block_classes[] = ' ' . $vars['zebra'];
  $block_classes[] = ' region-count-' . $vars['block_id'];
  $block_classes[] = ' count-' . $vars['id'];
  $vars['block_classes'] = implode($block_classes);
}


/**
 * Generates links for node teasers for easy edit/delete
 */
function holygrail_node_submitted($node){
  return t('@datetime',
   array(
    //'!username' => theme('username', $node),
     '@datetime' => format_date($node->created),
  ));
}