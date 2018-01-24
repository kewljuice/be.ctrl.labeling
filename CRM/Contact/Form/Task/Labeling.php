<?php

/**
 * This class helps to print the labels for contacts.
 */
class CRM_Contact_Form_Task_Labeling extends CRM_Contact_Form_Task {

  /**
   * Build all the data structures needed to build the form.
   */
  public function preProcess() {
    $this->set('contactIds', $this->_contactIds);
    parent::preProcess();
  }

  /**
   * Build the form object.
   */
  public function buildQuickForm() {
    self::buildLabelForm($this);
  }

  /**
   * Common Function to build: 'Mailing Label' Form.
   *
   * @param CRM_Core_Form $form
   */
  public static function buildLabelForm($form) {
    // Set title.
    CRM_Utils_System::setTitle(ts('Labeling: Generate labels'));
    // Add select list for available label.
    $label = CRM_Core_BAO_LabelFormat::getList(TRUE);
    $form->add('select', 'label_name', ts('Select Label'), ['' => ts('- select label -')] + $label, TRUE);
    // Add select list for available messageTemplates.
    $template = CRM_Core_BAO_MessageTemplate::getMessageTemplates(FALSE);
    $form->add('select', 'template', ts('Select Template'), ['' => ts('- select template -')] + $template, TRUE);
    $form->addButtons([
      [
        'type' => 'submit',
        'name' => ts('Generate Labels'),
        'isDefault' => TRUE,
      ],
      [
        'type' => 'cancel',
        'name' => ts('Done'),
      ],
    ]);
  }

  /**
   * Set default values for the 'Mailing Label' Form.
   *
   * @return array
   *   array of default values
   */
  public function setDefaultValues() {
    $defaults = [];
    $format = CRM_Core_BAO_LabelFormat::getDefaultValues();
    $defaults['label_name'] = CRM_Utils_Array::value('name', $format);
    return $defaults;
  }

  /**
   * Process the 'Mailing Label' form after the input has been submitted and
   * validated.
   */
  public function postProcess() {
    $fv = $this->controller->exportValues($this->_name);
    // Fetch content from MessageTemplate API.
    $content = '';
    try {
      $template = civicrm_api3('MessageTemplate', 'getSingle', [
        'sequential' => 1,
        'return' => ['msg_html'],
        'id' => $fv['template'],
      ]);
      if (!$template['is_error']) {
        $content = $template['msg_html'];
      }
    } catch (Exception $e) {
    }
    // Loop all selected contacts.
    $rows = [];
    foreach ($this->_contactIds as $key => $contactID) {
      // Fetch Tokens from content.
      $tokens = CRM_Utils_Token::getTokens($content);
      // Fetch Contact data.
      $params = ['contact_id' => $contactID];
      list($contacts) = CRM_Utils_Token::getTokenDetails($params,
        [],
        FALSE,
        FALSE,
        NULL,
        $tokens,
        'CRM_Labeling_Form_Task_Labels'
      );
      // Replace tokens in content.
      $replaced_content = CRM_Utils_Token::replaceContactTokens($content, $contacts[$contactID], TRUE, $tokens);
      // Add content to selected contacts.
      $rows[$contactID] = $replaced_content;
    }
    // Call function to create labels.
    self::createLabel($rows, $fv['label_name']);
    CRM_Utils_System::civiExit(1);
  }

  /**
   * Create 'Mailing' labels (pdf).
   *
   * @param array $contactRows
   *   Associated array of contact data.
   * @param string $format
   *   Format in which labels needs to be printed.
   * @param string $fileName
   *   The name of the file to save the label in.
   */
  public function createLabel(&$contactRows, &$format, $fileName = 'Labeling_CiviCRM.pdf') {
    $pdf = new CRM_Utils_PDF_Label($format, 'mm');
    $pdf->Open();
    $pdf->AddPage();
    // Loop contacts that need to be printed.
    foreach ($contactRows as $row => $value) {
      $pdf->AddPdfLabel($value);
    }
    $pdf->Output($fileName, 'D');
  }

}