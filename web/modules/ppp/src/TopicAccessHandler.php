<?php
/**
 * @file
 * Contains \Drupal\ppp\TopicAccessHandler.
 */

namespace Drupal\ppp;


use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\ppp\Entity\Forum;
use Drupal\ppp\Entity\Member;

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
