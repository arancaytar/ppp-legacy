<?php
/**
 * @file
 * Contains \Drupal\ppp\Entity\Topic.
 */

namespace Drupal\ppp\Entity;


use Drupal\Core\Entity\ContentEntityBase;
use Drupal\ppp\TopicInterface;

/**
 * Defines the node entity class.
 *
 * @ContentEntityType(
 *   id = "ppp_topic",
 *   label = @Translation("Topic"),
 *   handlers = {
 *     "access" = "Drupal\node\TopicAccessHandler",
 *     "views_data" = "Drupal\node\NodeViewsData",
 *     "form" = {
 *       "default" = "Drupal\node\NodeForm",
 *       "delete" = "Drupal\node\Form\NodeDeleteForm",
 *       "edit" = "Drupal\node\NodeForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\node\Entity\NodeRouteProvider",
 *     },
 *     "list_builder" = "Drupal\node\NodeListBuilder",
 *     "translation" = "Drupal\node\NodeTranslationHandler"
 *   },
 *   base_table = "node",
 *   data_table = "node_field_data",
 *   revision_table = "node_revision",
 *   revision_data_table = "node_field_revision",
 *   translatable = TRUE,
 *   list_cache_contexts = { "user.node_grants:view" },
 *   entity_keys = {
 *     "id" = "nid",
 *     "revision" = "vid",
 *     "bundle" = "type",
 *     "label" = "title",
 *     "langcode" = "langcode",
 *     "uuid" = "uuid",
 *     "status" = "status",
 *     "uid" = "uid",
 *   },
 *   bundle_entity_type = "node_type",
 *   field_ui_base_route = "entity.node_type.edit_form",
 *   common_reference_target = TRUE,
 *   permission_granularity = "bundle",
 *   links = {
 *     "canonical" = "/node/{node}",
 *     "delete-form" = "/node/{node}/delete",
 *     "edit-form" = "/node/{node}/edit",
 *     "version-history" = "/node/{node}/revisions",
 *     "revision" = "/node/{node}/revisions/{node_revision}/view",
 *   }
 * )
 */
class Topic extends ContentEntityBase implements TopicInterface {

  /**
   * {@inheritdoc}
   */
  public function getForumId() {
    return $this->forum_id->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getTopicId() {
    return $this->topic_id->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getAuthorId() {
    return $this->author_id->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return $this->title->value;
  }

  /**
   * {@inheritdoc}
   */
  public function isClassified() {
    return $this->classified->value;
  }
}
