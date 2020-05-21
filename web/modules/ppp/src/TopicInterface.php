<?php
/**
 * @file
 * Contains \Drupal\ppp\TopicInterface.
 */

namespace Drupal\ppp;


use Drupal\Core\Entity\ContentEntityInterface;

interface TopicInterface extends ContentEntityInterface, ArchivedEntityInterface {
  /**
   * @return integer
   */
  public function getForumId();

  /**
   * @return integer
   */
  public function getTopicId();

  /**
   * @return integer
   */
  public function getAuthorId();

  /**
   * @return string
   */
  public function getTitle();
}
