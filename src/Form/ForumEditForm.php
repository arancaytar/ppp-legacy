<?php
namespace Drupal\ppp_pegacy\Form;


class ForumEditForm extends ForumBaseForm {

  /**
   * @return string
   */
  protected function getSuccessMessage() {
    return $this->t('The forum %forum was updated.', [
      '%forum' => $this->entity->label(),
    ]);
  }
}
