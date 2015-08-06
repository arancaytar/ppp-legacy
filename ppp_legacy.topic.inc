<?php

/**
 * @file
 * Callbacks related to the topic page.
 */

define('POSTS_PER_PAGE', 25);

/**
 * Page callback for the topic.
 */
function _ppp_legacy_page_topic($fid, $tid, $page = 'p1') {
  module_load_include('inc', 'ppp_legacy', 'ppp_legacy.crud');
  $forum = ppp_legacy_load_forum($fid);
  $topic = ppp_legacy_load_topic($fid, $tid);
  if (!$topic) {
    return MENU_NOT_FOUND;
  }

  drupal_set_title(_ppp_legacy_title_topic($fid, $tid));
  drupal_set_breadcrumb([
    l(t('Home'), '<front>'),
    l($forum->name, "forum/$fid"),
  ]);

  $page = preg_match('/^p(\d+)$/', $page, $_) ? $_[1] - 1 : 0;
  $posts = ppp_legacy_load_posts_pager($fid, $tid, $page * POSTS_PER_PAGE, POSTS_PER_PAGE);
  $pager = _ppp_legacy_topic_pager($fid, $tid, ceil($topic->length / POSTS_PER_PAGE), $page);

  // Topic starter covers the whole topic.
  if (!_ppp_legacy_access_user($topic->author)) {
    return MENU_ACCESS_DENIED;
  }

  $page = [
    'pager_top' => $pager,
    'topic' => [
      '#theme' => 'table',
      '#sticky' => FALSE,
      '#header' => [t('Author'), t('Topic: @title', ['@title' => $topic->title])],
      '#rows' => [],
      '#attributes' => ['class' => ['topic-table']],
    ],
    'pager_bottom' => $pager,
  ];

  foreach ($posts as $pid => $post) {
    if (!_ppp_legacy_access_user($post->author)) {
      $page['topic']['#rows'][$pid] = [
       'sidebar' => [],
       'body' => t('<em>This post has been removed from the archive.</em>'),
      ];
      continue;
    }
    $page['topic']['#rows'][$pid] = [
      'sidebar' => [
        'data' => theme('ppp_post_sidebar', [
          'user' => ppp_legacy_load_user($post->author),
        ]),
      ],
      'body' => theme('ppp_post_body', [
        'post' => $post,
        'user' => ppp_legacy_load_user($post->author),
        'in_topic' => TRUE,
      ]),
    ];
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
  if ($pages > 1) {
    $pager = [
      '#prefix' => '<h2 class="element-invisible">Pages</h2><div class="item-list"><ul class="pager">',
      '#suffix' => '</ul></div>',
    ];
    for ($i = 1; $i <= $pages; $i++) {
      if ($i == $page + 1) {
        $pager["page_$i"]['#markup'] = '<li class="pager-current">' . $i . '</li>';
      }
      else {
        $pager["page_$i"]['#markup'] = '<li class="pager-item">' . l($i, "topic/$fid/$tid/p$i") . '</li>';
      }
    }
    return $pager;
  }
}
