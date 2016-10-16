<?php
/**
 * @file
 * Contains \Drupal\ppp_legacy\ArchivedEntityInterface.
 */

namespace Drupal\ppp_legacy;


use Drupal\Core\Entity\EntityInterface;

/**
 * A common interface for archived antities. All such entities may be marked as
 * classified.
 * @package Drupal\ppp_legacy
 */
interface ArchivedEntityInterface extends EntityInterface {
  /**
   * Whether or not the entity is classified.
   * @return boolean
   */
  public function isClassified();
}
