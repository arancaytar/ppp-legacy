<?php
/**
 * @file
 * Contains \Drupal\ppp_legacy\TopicInterface.
 */

namespace Drupal\ppp_legacy;


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
