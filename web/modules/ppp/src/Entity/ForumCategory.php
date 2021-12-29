<?php


namespace Drupal\ppp\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Represent a forum category in the archive.
 *
 * @ConfigEntityType(
 *   id = "ppp_forum_category",
 *   label = @Translation("Forum"),
 *   handlers = {
 *   },
 *   config_prefix = "forum_category",
 *   admin_permission = "administer PPP forums",
 *   entity_keys = {
 *     "id" = "cid",
 *     "label" = "label",
 *   },
 *   links = {
 *   },
 *   config_export = {
 *     "cid",
 *     "label",
 *   }
 * )
 */
class ForumCategory extends ConfigEntityBase {

  /**
   * @var int
   */
  protected $cid;

  /**
   * @var string
   */
  protected $label;

}
