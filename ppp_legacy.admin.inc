<?php

/**
 * @file
 * Callbacks related to the admin page.
 */
 
/**
 * Page callback for the admin page.
 */
function _ppp_legacy_admin($form, &$form_state) {
  module_load_include('inc', 'ppp_legacy', 'ppp_legacy.crud');
  $fora = db_query('SELECT fid, name FROM {ppp_forum} ORDER BY category, position');
  while ($forum = $fora->fetch()) {
    $options[$forum->fid] = $forum->name;
  }
  $form['ppp_legacy_classified_fora'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Classified fora'),
    '#description' => t('Access to these fora is granted only by special permission.'),
    '#options' => $options,
    '#default_value' => variable_get('ppp_legacy_classified_fora', array()),
  );

  $options = array();
  foreach (filter_formats() as $id => $format) {
    $options[$id] = $format->name;
  }
  $form['ppp_legacy_post_format'] = array(
    '#type' => 'select',
    '#title' => t('Text format'),
    '#description' => t('The format all posts will be rendered in.'),
    '#options' => $options,
    '#default_value' => variable_get('ppp_legacy_post_format', 'xbbcode'),
  );
  return system_settings_form($form);
}

