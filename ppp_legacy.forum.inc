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

  drupal_set_title(_ppp_legacy_title_forum($fid));
  drupal_set_breadcrumb([
    l(t('Home'), '<front>'),
  ]);

  $page = [
    'description' => [
      '#markup' => $forum->description,
    ],
    'pager_top' => [
      '#theme' => 'pager',
    ],
    'topics' => [
      '#theme' => 'table',
      '#sticky' => FALSE,
      '#attributes' => [
        'class' => ['ppp-topics-table'],
      ],
      '#header' => [
        'id' => [
          'data' => t('#'),
          'field' => 'tid',
        ],
        'title' => [
          'data' => t('Topic'),
          'field' => 'title',
        ],
        'author' => [
          'data' => t('Topic Starter'),
          'field' => 'author_pdn',
        ],
        'length' => [
          'data' => t('Posts'),
          'field' => 'length',
        ],
        'ended' => [
          'data' => t('Last post'),
          'field' => 'ended',
          'sort' => 'desc',
        ],
      ],
      '#rows' => [],
    ],
    'pager_bottom' => [
      '#theme' => 'pager',
    ],
  ];
  
  $topics = ppp_legacy_load_topics_pager($fid, $page['topics']['#header'], TOPICS_PER_PAGE);
  foreach ($topics as $topic) {
    if (!_ppp_legacy_access_user($topic->author)) {
      $page['topics']['#rows'][$topic->tid] = [[
        'colspan' => 5,
        'data' => t('<em>This topic has been removed from the archive.</em>'),
      ]];
      continue;
    }
    $query = db_select('ppp_post', 'p');
    $query->join('ppp_user', 'u', 'p.author = u.uid');
    $page['topics']['#rows'][$topic->tid] = [
      'id' => [
        'data' => $topic->tid,
        'class' => ['numeric-field'],
      ],
      'title' => l($topic->title, "topic/$fid/{$topic->tid}"),
      'author' => l($topic->author_pdn, 'member/' . $topic->author),
      'length' => [
        'data' => $topic->length,
        'class' => ['numeric-field'],
      ],
      'ended' => [
        'data' => format_date($topic->ended, 'custom', 'F d, Y <\sp\a\n \c\l\a\s\s="\t\i\m\e">H:i</\sp\a\n>'),
      ],
    ];
  }

  return $page;
}

function _ppp_legacy_title_forum($fid) {
  module_load_include('inc', 'ppp_legacy', 'ppp_legacy.crud');
  $forum = ppp_legacy_load_forum($fid);
  if ($forum) {
    return $forum->name;
  }
}
