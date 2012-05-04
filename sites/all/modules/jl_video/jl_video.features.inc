<?php

/**
 * Implementation of hook_node_info().
 */
function jl_video_node_info() {
  $items = array(
    'video' => array(
      'name' => t('Video Gallery'),
      'module' => 'features',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('gallery'),
      'has_body' => '1',
      'body_label' => t('Body'),
      'min_word_count' => '0',
      'help' => '',
    ),
  );
  return $items;
}

/**
 * Implementation of hook_views_api().
 */
function jl_video_views_api() {
  return array(
    'api' => '2',
  );
}
