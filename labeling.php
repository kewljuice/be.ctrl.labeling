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
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function labeling_civicrm_xmlMenu(&$files) {
  _labeling_civix_civicrm_xmlMenu($files);
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
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function labeling_civicrm_postInstall() {
  _labeling_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function labeling_civicrm_uninstall() {
  _labeling_civix_civicrm_uninstall();
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
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function labeling_civicrm_disable() {
  _labeling_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function labeling_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _labeling_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function labeling_civicrm_managed(&$entities) {
  _labeling_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function labeling_civicrm_caseTypes(&$caseTypes) {
  _labeling_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function labeling_civicrm_angularModules(&$angularModules) {
  _labeling_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function labeling_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _labeling_civix_civicrm_alterSettingsFolders($metaDataFolders);
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