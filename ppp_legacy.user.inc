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
  $page['profile'] = array(
    '#theme' => 'table',
    '#attributes' => array(
      'class' => array('ppp-user-profile'),
    ),
    '#header' => array(t('Field'), t('Value')),
    '#rows' => array(
      array(t('Displayed name'), $user->pdn),
      array(t('Member number'), $user->uid),
      array(t('Title'), $user->title),
      array(t('Postcount'), $user->posts),
      array(t('Homepage'), l($user->homepage, $user->homepage)),
      array(t('Registered'), format_date($user->joined, 'custom', 'l, F j Y H:i')),
    ),
  );
  
  $page['mid']['#markup'] = '<hr /><h3 id="posts">Recent posts</h3>';
  
  $page['pager_top'] = array('#theme' => 'pager');
  
  $page['posts'] = array(
    '#theme' => 'table',
    '#sticky' => FALSE,
    '#header' => array(t('Author'), t('Recent posts')),
    '#rows' => array(),
    '#attributes' => array('class' => array('topic-table')),
  );
  
  $page['pager_bottom'] = array('#theme' => 'pager');

  foreach ($posts as $post) {
    $topic = ppp_legacy_load_topic($post->fid, $post->tid);
    $page['posts']['#rows'][] = array(
      array(
        'colspan' => 2,
        'data' => l($topic->title, 'topic/' . $post->fid . '/' . $post->tid),
        'class' => array('bluehead'),
      ),
    );
    $page['posts']['#rows'][] = array(
      'sidebar' => array(
        'data' => theme('ppp_post_sidebar', array(
          'user' => $user,
        )),
        'valign' => 'top',
      ),
      'body' => theme('ppp_post_body', array(
        'post' => $post,
        'user' => $user,
      )),
    );
  }
  return $page;
}

function _ppp_legacy_title_user($uid) {
  module_load_include('inc', 'ppp_legacy', 'ppp_legacy.crud');
  $user = ppp_legacy_load_user($uid);
  if ($user) {
    return t('Profile for !user', array('!user' => $user->pdn));
  }
}
