<?php
/**
 * @file
 * Contains \Drupal\ppp\ArchivedEntityInterface.
 */

namespace Drupal\ppp;


use Drupal\Core\Entity\EntityInterface;

/**
 * A common interface for archived antities. All such entities may be marked as
 * classified.
 * @package Drupal\ppp
 */
interface ArchivedEntityInterface extends EntityInterface {
  /**
   * Whether or not the entity is classified.
   * @return boolean
   */
  public function isClassified();
}
