<?php

/**
 * @file
 * Callbacks related to the main page.
 */

/**
 * Page callback for the main overview.
 */
function _ppp_legacy_page_main() {
  module_load_include('inc', 'ppp_legacy', 'ppp_legacy.crud');
  
  $categories = array(1 => "Spiderweb's General Boards", 2 => "Spiderweb's Game Boards");
  $fora[1] = ppp_legacy_load_fora(1);
  $fora[2] = ppp_legacy_load_fora(2);

  $page['fora'] = array(
    '#sticky' => FALSE,
    '#theme' => 'table',
    '#attributes' => array(
      'class' => array('ppp-fora-table'),
    ),
    '#header' => array(
	    t('#'),
	    t('Forum'),
	    t('Topics'),
	    t('Posts'),
	    t('Last Post'),
	  ),
	  '#rows' => array(),
  );

  foreach ($categories as $i => $category) {
    $page['fora']['#rows'][] = array(
      array(
        'colspan' => 5,
        'data' => $category,
        'class' => array('bluehead'),
      ),
    );
    foreach ($fora[$i] as $fid => $forum) {
      $page['fora']['#rows'][] = array(
        array(
          'data' => $fid,
          'class' => array('numeric-field'),
        ),
        l($forum->name, "forum/$fid", array('attributes' => array('class' => 'ppp-forum-link'))) . '<p class="ppp-forum-desc">' . $forum->description . '</p>',
        array(
          'data' => $forum->topics,
          'class' => array('numeric-field'),
        ),
        array(
          'data' => $forum->posts,
          'class' => array('numeric-field'),
        ),
        $forum->lastpost_topic ? (t('In !topic, by !author, !date', array(
          '!topic' => l($forum->lastpost_topic_title, "topic/$fid/" . $forum->lastpost_topic),
          '!author' => l($forum->lastpost_author_pdn, 'member/' . $forum->lastpost_author),
          '!date' => format_date($forum->lastpost_date, 'custom', 'F d, Y <\sp\a\n \c\l\a\s\s="\t\i\m\e">H:i</\sp\a\n>'),
        ))) : '',
      );
    }
  }
  return $page;
}
