<?php

/**
 * @file
 * Callbacks related to the topic page.
 */

define('POSTS_PER_PAGE', 25);

/**
 * Page callback for the topic.
 */
function _ppp_legacy_page_topic($fid, $tid, $page = 1) {
  module_load_include('inc', 'ppp_legacy', 'ppp_legacy.crud');
  $topic = ppp_legacy_load_topic($fid, $tid);
  if (!$topic) {
    return MENU_NOT_FOUND;
  }
  $page = preg_match('/^p(\d+)$/', $page, $_) ? $_[1] : 0;  
  $posts = ppp_legacy_load_posts_pager($fid, $tid, $page * POSTS_PER_PAGE, POSTS_PER_PAGE);
  $pager = _ppp_legacy_topic_pager($fid, $tid, ceil($topic->length / POSTS_PER_PAGE), $page);
  
  $page = array(
    'pager_top' => $pager,
    'topic' => array(
      '#theme' => 'table',
      '#sticky' => FALSE,
      '#header' => array(t('Author'), t('Content')),
      '#rows' => array(),
      '#attributes' => array('class' => array('topic-table')),
    ),
    'pager_bottom' => $pager,
  );

  foreach ($posts as $pid => $post) {
    $page['topic']['#rows'][$pid] = array(
      'sidebar' => array(
        'data' => theme('ppp_post_sidebar', array(
          'user' => ppp_legacy_load_user($post->author),
        )),
        'valign' => 'top',
      ),
      'body' => theme('ppp_post_body', array(
        'post' => $post,
        'user' => ppp_legacy_load_user($post->author),
      )),
    );
  }
  return $page;
}

function _ppp_legacy_title_topic($fid, $tid) {
  module_load_include('inc', 'ppp_legacy', 'ppp_legacy.crud');
  $topic = ppp_legacy_load_topic($fid, $tid);
  if ($topic) {
    return $topic->title;
  }
}

function _ppp_legacy_topic_pager($fid, $tid, $pages, $page) {
  for ($i = 1; $i <= $pages; $i++) {
    $pager["page_$i"] = $i == $page ? "<strong>$i</strong>" : l($i, "$fid/$tid/p$i");
  }
  return $pager;
}
