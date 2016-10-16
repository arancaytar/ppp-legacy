<?php

/**
 * @file
 * Contains \Drupal\ppp\Entity\ForumInterface.
 */

namespace Drupal\ppp;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

interface ForumInterface extends ConfigEntityInterface, ArchivedEntityInterface  {
  /**
   * @return integer
   */
  public function getForumId();

  /**
   * @return string
   */
  public function getDescription();
}
