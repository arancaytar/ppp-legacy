<?php
/**
 * @file
 * Contains \Drupal\ppp\PostInterface.
 */

namespace Drupal\ppp;


use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\TypedData\Type\DateTimeInterface;

interface PostInterface extends ContentEntityInterface, ArchivedEntityInterface {
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
  public function getPostId();

  /**
   * @return integer
   */
  public function getAuthorId();

  /**
   * @return DateTimeInterface
   */
  public function getCreated();

  /**
   * @return string
   */
  public function getContent();
}
