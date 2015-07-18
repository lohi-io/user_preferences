<?php

/**
 * @file
 * user_preferences.api.php
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Define user preferences.
 *
 * This hook allows modules to define preferences which will go near the user.
 *
 * @return
 *   An array of preferences, note that indexes will be merged, so pick
 *   sensible machine names (root indexes) for your preferences! The array
 *   can have the following key/value pairs.
 *   - title: (required) Label for the preference.
 *   - serialize: (optional) Whether or not this preference will be stored as
 *     an array and needs to be serialised for storage in the database.
 *   - default_value: (optional) This value will be used when the user has yet
 *     to set the preference and is also passed to the form item if in use.
 *   - form_ids: (optional) An array of form IDs of forms which should have
 *     this preference added to.
 *   - form_item: (optional) If adding this preference to a form, the form item
 *     as per the standard Drupal Form API. The default value will be passed in
 *     automatically. http://preview.tinyurl.com/n7d9arj
 */
function hook_user_preferences() {
  return array(
    'enabled_notifications' => array(
      'title' => t('Enabled notifications'),
      // This should be "serialised" grumble grumble.
      'serialize' => TRUE,
      // Unserialised value plz.
      'default_value' => array('email'),
      'form_ids' => array('user_profile_form'),
      // The form_item will pass whatever on to the form specified in the
      // previous index.
      'form_item' => array(
        '#title' => t('Enabled notifications'),
        '#type' => 'checkboxes',
        '#required' => TRUE,
        // Default value will be passed in by the user_preferences module.
        '#options' => array(
          'email' => t('Email'),
          'sms' => t('SMS'),
          'twitter' => t('Twitter'),
        ),
        '#weight' => 1,
        '#access' => user_access('alter own comstack_notification settings'),
      ),
    ),
  );
}

/**
 * @} End of "addtogroup hooks".
 */
