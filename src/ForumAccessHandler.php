<?php

/**
 * @file
 * Contains \Drupal\ppp_legacy\ForumAccessHandler.
 */

namespace Drupal\ppp_legacy;


use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\ppp_legacy\Entity\Forum\Forum;
use Drupal\ppp_legacy\Entity\Forum\ForumInterface;

class ForumAccessHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /**
     * @var ForumInterface $entity
     */
    if ($operation == 'view' && $entity->isClassified()) {
      return AccessResult::allowedIfHasPermission($account, Forum::PERMISSION_CLASSIFIED);
    }
    return parent::checkAccess($entity, $operation, $account);
  }
}
