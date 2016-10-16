<?php
namespace Drupal\ppp_pegacy\Form;


class ForumAddForm extends ForumBaseForm {

  /**
   * @return string
   */
  protected function getSuccessMessage() {
    return $this->t('The forum %forum was created.', [
      '%forum' => $this->entity->label(),
    ]);
  }
}
