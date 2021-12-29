<?php
/**
 * @file
 * Contains \Drupal\ppp\Entity\Member.
 */

namespace Drupal\ppp\Entity;


use Drupal\Core\Annotation\Translation;
use Drupal\Core\Entity\Annotation\ContentEntityType;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\ppp\MemberInterface;

/**
 * @@ContentEntityType(
 *   id = "ppp_member",
 *   label = @Translation("Member)
 *   base_table = "ppp_user",
 *   entity_keys = {
 *     "id" = "uid",
 *     "label" = "pdn",
 *   },
 * )
 */
class Member extends ContentEntityBase implements MemberInterface {

  public function isClassified() {
    // TODO: Implement isClassified() method.
  }

}
