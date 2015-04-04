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
  
  $categories = [1 => "Spiderweb's General Boards", 2 => "Spiderweb's Game Boards"];
  $fora[1] = ppp_legacy_load_fora(1);
  $fora[2] = ppp_legacy_load_fora(2);

  $page['fora'] = [
    '#sticky' => FALSE,
    '#theme' => 'table',
    '#attributes' => [
      'class' => ['ppp-fora-table'],
    ],
    '#header' => [
	    t('#'),
	    t('Forum'),
	    t('Topics'),
	    t('Posts'),
	    t('Last Post'),
	  ],
	  '#rows' => [],
  ];

  foreach ($categories as $i => $category) {
    $page['fora']['#rows'][] = [
      [
        'colspan' => 5,
        'data' => $category,
        'class' => ['bluehead'],
      ],
    ];
    foreach ($fora[$i] as $fid => $forum) {
      if (!_ppp_legacy_access($fid)) {
        continue;
      }
      $page['fora']['#rows'][] = [
        [
          'data' => $fid,
          'class' => ['numeric-field'],
        ],
        l($forum->name, "forum/$fid", ['attributes' => ['class' => 'ppp-forum-link']]) . '<p class="ppp-forum-desc">' . $forum->description . '</p>',
        [
          'data' => $forum->topics,
          'class' => ['numeric-field'],
        ],
        [
          'data' => $forum->posts,
          'class' => ['numeric-field'],
        ],
        $forum->lastpost_topic ? (t('In !topic, by !author, !date', [
          '!topic' => l($forum->lastpost_topic_title, "topic/$fid/" . $forum->lastpost_topic),
          '!author' => l($forum->lastpost_author_pdn, 'member/' . $forum->lastpost_author),
          '!date' => format_date($forum->lastpost_date, 'custom', 'F d, Y <\sp\a\n \c\l\a\s\s="\t\i\m\e">H:i</\sp\a\n>'),
        ])) : '',
      ];
    }
  }
  return $page;
}
