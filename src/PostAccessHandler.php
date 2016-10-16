<?php
/**
 * @file
 * Contains \Drupal\ppp_legacy\PostAccessHandler.
 */

namespace Drupal\ppp_legacy;


use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\ppp_legacy\Entity\Member;
use Drupal\ppp_legacy\Entity\Topic;

class PostAccessHandler extends ArchivedEntityAccessHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /**
     * @var PostInterface $entity
     */
    // Access to posts also requires view access to their author and their topic.
    return parent::checkAccess($entity, $operation, $account)
      ->andIf(Topic::load($entity->getForumId())->access('view', $account))
      ->andIf(Member::load($entity->getAuthorId())->access('view', $account));
  }
}
