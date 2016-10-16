<?php
/**
 * Created by PhpStorm.
 * User: christoph
 * Date: 16.10.16
 * Time: 00:42
 */

namespace Drupal\ppp_pegacy\Form;


use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\Query\QueryFactoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\ppp_legacy\Entity\Forum;
use Drupal\ppp_legacy\ForumInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class ForumBaseForm extends EntityForm {
  /**
   * @var \Drupal\Core\Entity\Query\QueryFactoryInterface
   */
  private $queryFactory;

  /**
   * @return string
   */
  protected abstract function getSuccessMessage();

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    /**
     * @var ForumInterface $forum
     */
    $forum = $this->entity;

    $forum['label'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Label'),
      '#default_value' => $forum->label(),
      '#required'      => TRUE,
    ];

    $forum['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $forum->id(),
      '#machine_name' => [
        'exists' => [$this, 'exists'],
        'source' => ['label'],
      ],
      '#disabled' => !$forum->isNew(),
    ];

    $forum['forum_id'] = [
      '#title' => $this->t('Forum number'),
      '#description' => $this->t('This is the original numeric identifier of the forum on Spiderweb.'),
      '#required' => TRUE,
    ];

    $forum['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
    ];

    $forum['classified'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Mark as classified, restricting access to authorized users.'),
    ];

    return parent::form($form, $form_state);
  }

  /**
   * Determine if an ID already exists.
   * @param string $id
   * @return boolean
   */
  public function exists($id) {
    return (bool) $this->queryFactory
      ->get('ppp_forum')
      ->condition('id', $id)
      ->execute();
  }

  /**
   * Determine if a forum ID already exists, and returns the internal ID.
   * @param integer $forum_id
   * @return string|NULL
   */
  public function existsForumId($forum_id) {
    return $this->queryFactory
      ->get('ppp_forum')
      ->condition('forum_id', $forum_id)
      ->execute();
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
    $forum_id = $form_state->getValue('forum_id');
    if ($id = $this->existsForumId($forum_id)) {
      $forum = Forum::load($id);
      $form_state->setErrorByName('forum_id', $this->t('The forum number %forum_id is already in use by %forum.', [
        '%forum_id' => $forum_id,
        '%forum' => $forum,
      ]));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $form_state->setRedirect('ppp.admin.forums');
  }

  /**
   * ForumBaseForm constructor.
   * @param \Drupal\Core\Entity\Query\QueryFactoryInterface $queryFactory
   */
  public function __construct(QueryFactoryInterface $queryFactory) {
    $this->queryFactory = $queryFactory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.query')
    );
  }
}
