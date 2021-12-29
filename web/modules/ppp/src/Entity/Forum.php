<?php

/**
 * @file
 * Contains \Drupal\ppp\Entity\Forum.
 */

namespace Drupal\ppp\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\ppp\ForumInterface;

/**
 * Represent a forum in the archive.
 *
 * @ConfigEntityType(
 *   id = "ppp_forum",
 *   label = @Translation("Forum"),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\ppp\Form\ForumAddForm",
 *       "edit" = "Drupal\ppp\Form\ForumEditForm",
 *       "delete" = "Drupal\ppp\Form\ForumDeleteForm",
 *     },
 *     "list_builder" = "Drupal\ppp\ForumListBuilder",
 *     "access" = "Drupal\ppp\ArchivedEntityAccessHandler"
 *   },
 *   config_prefix = "forum",
 *   admin_permission = "administer PPP forums",
 *   entity_keys = {
 *     "id" = "fid",
 *     "label" = "label",
 *     "status" = "status"
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/content/ppp/forums/manage/{ppp_forum}/edit",
 *     "delete-form" = "/admin/config/content/ppp/forums/manage/{ppp_forum}/delete",
 *   },
 *   config_export = {
 *     "fid",
 *     "label",
 *     "description",
 *   }
 * )
 */
class Forum extends ConfigEntityBase implements ForumInterface {
  /**
   * The name of the admin permission.
   * @var string PERMISSION_ADMIN
   */
  const PERMISSION_ADMIN = 'administer PPP forums';

  /**
   * @var int $forum_id
   */
  protected $fid;

  /**
   * The forum's name.
   * @var string $label
   */
  protected $label;

  /**
   * The forum's description
   * @var string $description
   */
  protected $description;

  /**
   * {@inheritdoc}
   */
  public function getDescription(): string {
    return $this->description;
  }

}
