<?php
/**
 * @file
 * Contains \Drupal\ppp_legacy\Entity\Member.
 */

namespace Drupal\ppp_legacy\Entity;


use Drupal\Core\Entity\ContentEntityBase;
use Drupal\ppp_legacy\MemberInterface;

class Member extends ContentEntityBase implements MemberInterface {
  /**
   * {@inheritdoc}
   */
  public function getMemberId() {
    // TODO: Implement getMemberId() method.
  }

  /**
   * {@inheritdoc}
   */
  public function isClassified() {
    // TODO: Implement isClassified() method.
  }

  /**
   * {@inheritdoc}
   */
  public function getMemberName() {
    // TODO: Implement getMemberName() method.
  }
}
