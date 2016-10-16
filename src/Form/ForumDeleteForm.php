<?php
/**
 * Created by PhpStorm.
 * User: christoph
 * Date: 16.10.16
 * Time: 03:04
 */

namespace Drupal\ppp_pegacy\Form;


use Drupal\Core\Entity\EntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;

class ForumDeleteForm extends EntityConfirmFormBase {
  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete the forum %forum?', array('%forum' => $this->entity->label()));
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('ppp.admin.forums');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->t('The forum will be deleted. Topics in the forum are unaffected, but will not be displayed.');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->entity->delete()->save();
    drupal_set_message($this->t('Deleted forum %forum.', array('%forum' => $this->entity->label())));

    $form_state->setRedirectUrl($this->getCancelUrl());
  }
}
