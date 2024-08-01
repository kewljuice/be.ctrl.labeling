<?php

require_once 'labeling.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function labeling_civicrm_config(&$config) {
  _labeling_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function labeling_civicrm_install() {
  _labeling_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function labeling_civicrm_enable() {
  _labeling_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_searchTasks().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_searchTasks
 */
function labeling_civicrm_searchTasks($objectType, &$tasks) {
  // Enable Task for 'contact' and 'event'.
  if ($objectType == "contact") {
    $tasks[] = [
      'title' => ts('Labeling: Generate labels'),
      'class' => 'CRM_Contact_Form_Task_Labeling',
      'result' => FALSE,
    ];
  }
  if($objectType == 'event') {
    $tasks[] = [
      'title' => ts('Labeling: Generate labels'),
      'class' => 'CRM_Event_Form_Task_Labeling',
      'result' => FALSE,
    ];
  }
}

/**
 * Implements hook_civicrm_searchTasks().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterMailingLabelParams
 */
function labeling_civicrm_alterMailingLabelParams(&$args) {
  // https://issues.civicrm.org/jira/browse/CRM-9025
  // Enable 'html' in mailinglabels.
  $args['ishtml'] = TRUE;
}
