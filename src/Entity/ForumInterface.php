<?php

/**
 * @file
 * Contains \Drupal\ppp_legacy\Entity\Forum.
 */

namespace Drupal\ppp_legacy\Entity\Forum;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

interface ForumInterface extends ConfigEntityInterface  {
  /**
   * @return integer
   */
  public function getForumId();

  /**
   * @return string
   */
  public function getDescription();

  /**
   * @return boolean
   */
  public function isClassified();
}