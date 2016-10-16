<?php

/**
 * @file
 * Contains \Drupal\ppp_legacy\Entity\Forum.
 */

namespace Drupal\ppp_legacy\Entity\Forum;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Represent a forum in the archive.
 *
 * @ConfigEntityType(
 *   id = "ppp_forum",
 *   label = @Translation("Forum"),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\ppp_legacy\Form\ForumAddForm",
 *       "edit" = "Drupal\ppp_legacy\Form\ForumEditForm",
 *       "delete" = "Drupal\ppp_legacy\Form\ForumDeleteForm",
 *     },
 *     "list_builder" = "Drupal\ppp_legacy\ForumListBuilder",
 *     "access" = "Drupal\ppp_legacy\ForumAccessHandler"
 *   },
 *   config_prefix = "forum",
 *   admin_permission = "administer PPP forums",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "status" = "status"
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/content/ppp/forums/manage/{ppp_forum}/edit",
 *     "delete-form" = "/admin/config/content/ppp/forums/manage/{ppp_forum}/delete",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "description",
 *     "forum_id",
 *   }
 * )
 */
class Forum extends ConfigEntityBase implements ForumInterface {
  /**
   * The forum's original numeric identifier on Spiderweb.
   * This is not the internal identifier.
   * @var integer $forum_id
   */
  protected $forum_id;

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
   * Whether or not the forum is classified. Classified fora can only be
   * accessed by users with the "access classified content" permission.
   * @var boolean $classified
   */
  protected $classified;

  /**
   * {@inheritdoc}
   */
  public function getForumId() {
    return $this->forum_id;
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription(): string {
    return $this->description;
  }

  /**
   * {@inheritdoc}
   */
  public function isClassified() {
    return $this->classified;
  }
}
