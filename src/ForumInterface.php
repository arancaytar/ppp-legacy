<?php

/**
 * @file
 * Contains \Drupal\ppp_legacy\Entity\ForumInterface.
 */

namespace Drupal\ppp_legacy;

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
