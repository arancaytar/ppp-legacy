<?php
/**
 * @file
 * Contains \Drupal\ppp_legacy\TopicAccessHandler.
 */

namespace Drupal\ppp_legacy;


use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\ppp_legacy\Entity\Forum;
use Drupal\ppp_legacy\Entity\Member;

/**
 * {@inheritdoc}
 */
class TopicAccessHandler extends ArchivedEntityAccessHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /**
     * @var TopicInterface $entity
     */
    // Access to topics also requires view access to their author and their forum.
    return parent::checkAccess($entity, $operation, $account)
      ->andIf(Forum::load($entity->getForumId())->access('view', $account))
      ->andIf(Member::load($entity->getAuthorId())->access('view', $account));
  }
}
