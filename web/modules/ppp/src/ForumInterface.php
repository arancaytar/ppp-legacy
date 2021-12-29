<?php

namespace Drupal\ppp;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

interface ForumInterface extends ConfigEntityInterface {

  /**
   * @return string
   */
  public function getDescription();
}
