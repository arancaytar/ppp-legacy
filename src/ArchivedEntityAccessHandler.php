<?php

/**
 * @file
 * Contains \Drupal\ppp\ForumAccessHandler.
 */

namespace Drupal\ppp;


use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\ppp\Entity\Forum;

/**
 * {@inheritdoc}
 */
class ArchivedEntityAccessHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /**
     * @var ArchivedEntityInterface $entity
     */
    if ($operation == 'view' && $entity->isClassified()) {
      return AccessResult::allowedIfHasPermission($account, Forum::PERMISSION_CLASSIFIED);
    }
    return parent::checkAccess($entity, $operation, $account);
  }
}
