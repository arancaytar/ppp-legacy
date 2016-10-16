<?php
/**
 * @file
 * Contains \Drupal\ppp\Entity\Member.
 */

namespace Drupal\ppp\Entity;


use Drupal\Core\Entity\ContentEntityBase;
use Drupal\ppp\MemberInterface;

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
