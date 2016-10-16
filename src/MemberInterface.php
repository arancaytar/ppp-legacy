<?php
/**
 * @file
 * Contains \Drupal\ppp_legacy\MemberInterface.
 */

namespace Drupal\ppp_legacy;


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
