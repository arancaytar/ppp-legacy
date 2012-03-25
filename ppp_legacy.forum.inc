<?php

/**
 * @file
 * Callbacks related to the forum page.
 */
 
define('TOPICS_PER_PAGE', 25);

/**
 * Page callback for the forum.
 */
function _ppp_legacy_page_forum($fid) {
  module_load_include('inc', 'ppp_legacy', 'ppp_legacy.crud');
  $forum = ppp_legacy_load_forum($fid);
  if (!$forum) {
    return MENU_NOT_FOUND;
  }
  $page = array(
    'description' => array(
      '#markup' => $forum->description,
    ),
    'pager_top' => array(
      '#theme' => 'pager',
    ),
    'topics' => array(
      '#theme' => 'table',
      '#attributes' => array(
        'class' => array('ppp-topics-table'),
      ),
      '#header' => array(
        'id' => array(
          'data' => t('#'),
          'field' => 'tid',
        ),
        'title' => array(
          'data' => t('Title'),
          'field' => 'title',
        ),
        'author' => array(
          'data' => t('Author'),
          'field' => 'author_pdn',
        ),
        'length' => array(
          'data' => t('Posts'),
          'field' => 'length',
        ),
        'ended' => array(
          'data' => t('Last post'),
          'field' => 'ended',
          'sort' => 'desc',
        ),
      ),
      '#rows' => array(),
    ),
    'pager_bottom' => array(
      '#theme' => 'pager',
    ),
  );
  
  $topics = ppp_legacy_load_topics_pager($fid, $page['topics']['#header'], TOPICS_PER_PAGE);
  foreach ($topics as $topic) {
    $query = db_select('ppp_post', 'p');
    $query->join('ppp_user', 'u', 'p.author = u.uid');
    $page['topics']['#rows'][$topic->tid] = array(
      'id' => $topic->tid,
      'title' => l($topic->title, "topic/{$topic->tid}"),
      'author' => l($topic->author_pdn, 'user/' . $topic->author),
      'length' => $topic->length,
      'ended' => format_date($topic->ended),
    );
  }

  return $page;
}

function _ppp_legacy_title_forum($fid) {
  module_load_include('inc', 'ppp_legacy', 'ppp_legacy.crud');
  $forum = ppp_legacy_load_forum($fid);
  if ($forum) {
    return $forum->title;
  }
}