<?php

/**
 * @file
 * Callbacks related to the user page.
 */
 
/**
 * Page callback for the user profile
 */
function _ppp_legacy_page_user($uid) {
  module_load_include('inc', 'ppp_legacy', 'ppp_legacy.crud');
  $user = ppp_legacy_load_user($uid);
  if (!$user) {
    return MENU_NOT_FOUND;
  }
 
  drupal_set_title(_ppp_legacy_title_user($uid));
  $posts = ppp_legacy_load_posts_user($uid);
  $page['profile'] = [
    '#theme' => 'table',
    '#attributes' => [
      'class' => ['ppp-user-profile'],
    ],
    '#header' => [t('Field'), t('Value')],
    '#rows' => [
      [t('Displayed name'), $user->pdn],
      [t('Member number'), $user->uid],
      [t('Title'), $user->title],
      [t('Postcount'), $user->posts],
      [t('Homepage'), l($user->homepage, $user->homepage)],
      [t('Registered'), format_date($user->joined, 'custom', 'l, F j Y H:i')],
    ],
  ];
  
  $page['mid']['#markup'] = '<hr /><h3 id="posts">Recent posts</h3>';
  
  $page['pager_top'] = ['#theme' => 'pager'];
  
  $page['posts'] = [
    '#theme' => 'table',
    '#sticky' => FALSE,
    '#header' => [t('Author'), t('Recent posts')],
    '#rows' => [],
    '#attributes' => ['class' => ['topic-table']],
  ];
  
  $page['pager_bottom'] = ['#theme' => 'pager'];

  foreach ($posts as $post) {
    if (!_ppp_legacy_access($post->fid)) {
      continue;
    }
    $topic = ppp_legacy_load_topic($post->fid, $post->tid);
    if (!_ppp_legacy_access_user($topic->author)) {
      $page['posts']['#rows'][] = [
        'sidebar' => [],
        'body' => t('<em>This post has been removed from the archive.</em>'),
      ];
      continue;
    }
    $forum = ppp_legacy_load_forum($post->fid);
    $link = 'topic/' . $post->fid . '/' . $post->tid;
    if ($post->pid >= 25) {
      $link .= '/p' . (1 + floor($post->pid / 25));
    }
    $page['posts']['#rows'][] = [
      [
        'colspan' => 2,
        'data' => t('!topic in !forum', ['!topic' => l($topic->title, $link, ['fragment' => $post->pid]), '!forum' => l($forum->name, 'forum/' . $post->fid)]),
        'class' => ['bluehead'],
      ],
    ];
    $page['posts']['#rows'][] = [
      'sidebar' => [
        'data' => theme('ppp_post_sidebar', [
          'user' => $user,
        ]),
      ],
      'body' => theme('ppp_post_body', [
        'post' => $post,
        'user' => $user,
        'in_topic' => FALSE,
      ]),
    ];
  }
  return $page;
}

function _ppp_legacy_title_user($uid) {
  module_load_include('inc', 'ppp_legacy', 'ppp_legacy.crud');
  $user = ppp_legacy_load_user($uid);
  if ($user) {
    return t('Profile for !user', ['!user' => $user->pdn]);
  }
}
