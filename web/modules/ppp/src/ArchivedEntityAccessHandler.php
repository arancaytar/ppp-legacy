<?php

/**
 * @file
 * Contains \Drupal\ppp\ForumAccessHandler.
 */

namespace Drupal\ppp;


use Drupal\Core\Access\AccessResult;
use Drupal\Core\Config\Config;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityHandlerInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ArchivedEntityAccessHandler
 *
 * @package Drupal\ppp
 */
class ArchivedEntityAccessHandler extends EntityAccessControlHandler implements EntityHandlerInterface {

  /**
   * The name of the admin permission.
   * @var string PERMISSION_CLASSIFIED
   */
  const PERMISSION_CLASSIFIED = 'access classified PPP content';

  /**
   * @var \Drupal\Core\Config\Config
   */
  protected $settings;

  /**
   * ArchivedEntityAccessHandler constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   * @param \Drupal\Core\Config\Config $settings
   */
  public function __construct(EntityTypeInterface $entity_type, Config $settings) {
    parent::__construct($entity_type);
    $this->settings = $settings;
  }

  /**
   * {@inheritdoc}
   */
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
    return new static(
      $entity_type,
      $container->get('config.factory')->get('ppp.settings')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    if ($operation === 'view' && $this->isClassifiedEntity($entity)) {
      return AccessResult::allowedIfHasPermission($account, static::PERMISSION_CLASSIFIED);
    }
    return parent::checkAccess($entity, $operation, $account);
  }

  protected function isClassifiedEntity(EntityInterface $entity) {
    if ($entity instanceof ForumInterface) {
      $keys = ["forums.{$entity->id()}"];
    }
    elseif ($entity instanceof TopicInterface) {
      $keys = [
        "forums.{$entity->getForumId()}",
        "members.{$entity->getAuthorId()}",
        "topics.{$entity->getForumId()}.{$entity->id()}",
      ];
    }
    elseif ($entity instanceof MemberInterface) {
      $key = ["members.{$entity->id()}"];
    }
    elseif ($entity instanceof PostInterface) {
      $keys = [
        "forums.{$entity->getForumId()}",
        "topics.{$entity->getTopicId()}",
        "members.{$entity->getAuthorId()}",
        "posts.{$entity->getForumId()}.{$entity->getTopicId()}",
      ];
    }
  }

}
