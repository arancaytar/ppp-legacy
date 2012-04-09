<?php

/**
 * @file
 * Loading functions (archive is read-only)
 */

/**
 * Load one forum object.
 */
function ppp_legacy_load_forum($fid) {
  $data = &drupal_static(__FUNCTION__);
  if (!isset($data[$fid])) {
    $data[$fid] = db_query('SELECT name, description FROM {ppp_forum} WHERE fid = :fid', array(':fid' => $fid))->fetch();
  }
  return $data[$fid];
}

function ppp_legacy_load_fora($category) {
  $query = db_query('SELECT fid, name, description, topics, posts, lastpost_author, lastpost_author_pdn, lastpost_icon, lastpost_topic, lastpost_topic_title, lastpost_date FROM {ppp_forum} WHERE category = :category ORDER BY position', array(':category' => $category));
  while ($forum = $query->fetch()) {
    $fora[$forum->fid] = $forum;
  }
  return $fora;
}


// create table legacy_ppp_forum select forum_id as fid,name,description,topics,posts,category,position from ppp_forums;
// create table legacy_ppp_topic select a.forum_id as fid, a.topic_id as tid, a.title, a.author, c.displayed_name as author_pdn, a.length, a.lastpost as ended from ppp_topics a join mera b on a.forum_id=b.forum_id and a.topic_id = b.topic_id and a.archived=b.era join ppp_members c on a.author=c.id;
// create table legacy_ppp_post select forum_id as fid, topic_id as tid, post_id as pid, author, c.displayed_name as author_pdn, post_date, content, icon, edit_date, edit_name from ppp_posts a natural join pera b join ppp_members c on a.author=c.id;
/**
 * Load a page of topics.
 */
function ppp_legacy_load_topics_pager($fid, $header, $limit) {
  $query = db_select('ppp_topic')->extend('PagerDefault')->extend('TableSort');
  $query->condition('fid', $fid);
  $query->limit($limit);
  $query->fields('ppp_topic', array('tid', 'title', 'author', 'author_pdn', 'length', 'ended'));
  $query->orderByHeader($header);
  $result = $query->execute();
  $topics = array();
  while ($row = $result->fetch()) {
    $topics[$row->tid] = $row;
  }
  return $topics;
}

function ppp_legacy_load_topic($fid, $tid) {
  $data = &drupal_static(__FUNCTION__);
  if (!isset($data["$fid-$tid"])) {
    $data["$fid-$tid"] = db_query('SELECT tid, title, author, author_pdn, length, ended FROM {ppp_topic} WHERE fid = :fid AND tid = :tid', array(':fid' => $fid, ':tid' => $tid))->fetch();
  }
  return $data["$fid-$tid"];
}

function ppp_legacy_load_posts_pager($fid, $tid, $start, $limit) {
  $query = db_select('ppp_post')->fields('ppp_post', array('pid', 'author', 'author_pdn', 'post_date', 'body', 'icon', 'edit_date', 'edit_name'));
  $query->condition('fid', $fid);
  $query->condition('tid', $tid);
  $query->orderBy('pid', 'asc');
  $query->range($start, $limit);
  $result = $query->execute();
  $posts = array();
  while ($row = $result->fetch()) {
    $row->body = html_entity_decode($row->body, ENT_COMPAT, "UTF-8");
    $posts[$row->pid] = $row;
  }
  return $posts;
}

function ppp_legacy_load_posts_user($uid) {
  $query = db_select('ppp_post')->extend('PagerDefault');
  $query->fields('ppp_post', array('fid', 'tid', 'pid', 'author', 'author_pdn', 'post_date', 'body', 'icon', 'edit_date', 'edit_name'));
  $query->condition('author', $uid);
  $query->orderBy('post_date', 'DESC');
  $query->limit(25);
  $result = $query->execute();
  $posts = array();
  while ($row = $result->fetch()) {
    $row->body = html_entity_decode($row->body, ENT_COMPAT, "UTF-8");
    $posts[] = $row;
  }
  return $posts;
}


function ppp_legacy_load_user($uid) {
  $data = &drupal_static(__FUNCTION__);
  $data[0] = (object) array('uid' => 0, 'pdn' => '-', 'title' => '', 'homepage' => '', 'joined' => 0, 'posts' => 0);
  if (!isset($data[$uid])) {
    $data[$uid] = db_query('SELECT uid, pdn, title, posts, homepage, joined FROM {ppp_user} WHERE uid = :uid', array(':uid' => $uid))->fetch();
  }
  return $data[$uid] ? $data[$uid] : $data[0];
}
