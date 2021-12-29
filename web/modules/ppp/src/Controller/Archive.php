<?php

/**
 * @file
 * Contains \Drupal\ppp\Controller\Archive.
 */

namespace Drupal\ppp\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\ppp\ArchivedEntityAccessHandler;

class Archive extends ControllerBase {

  /**
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $forumStorage;

  /**
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $categoryStorage;

  /**
   * @var \Drupal\ppp\ArchivedEntityAccessHandler
   */
  protected $accessHandler;

  /**
   * Archive constructor.
   *
   * @param \Drupal\Core\Entity\EntityStorageInterface $categoryStorage
   * @param \Drupal\Core\Entity\EntityStorageInterface $forumStorage
   */
  public function __construct(EntityStorageInterface $categoryStorage,
    EntityStorageInterface $forumStorage
  ) {
    $this->categoryStorage = $categoryStorage;
    $this->forumStorage = $forumStorage;
  }


  public function content() {
    module_load_include('inc', 'ppp', 'ppp.crud');

    $categories = $this->categoryStorage->loadMultiple();
    $fora = $this->forumStorage->loadMultiple();

    $page['fora'] = [
      '#sticky' => FALSE,
      '#theme' => 'table',
      '#attributes' => [
        'class' => ['ppp-fora-table'],
      ],
      '#header' => [
        $this->t('#'),
        $this->t('Forum'),
        $this->t('Topics'),
        $this->t('Posts'),
        $this->t('Last Post'),
      ],
      '#rows' => [],
    ];

    foreach ($categories as $i => $category) {
      $page['fora']['#rows'][$i] = [
        [
          'colspan' => 5,
          'data'    => $category,
          'class'   => ['bluehead'],
        ],
      ];
    }

    foreach ($fora as $fid => $forum) {
      if (!$forum->access('view') || $forum->getC) {
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
    return $page;
  }
}
