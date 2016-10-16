<?php
/**
 * @file
 * Contains \Drupal\ppp\MemberInterface.
 */

namespace Drupal\ppp;


use Drupal\Core\Entity\ContentEntityInterface;

interface MemberInterface extends ContentEntityInterface, ArchivedEntityInterface {
  /**
   * @return integer
   */
  public function getMemberId();

  /**
   * @return string
   */
  public function getMemberName();
}
