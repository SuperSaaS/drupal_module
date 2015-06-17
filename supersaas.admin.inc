<?php

/**
 * @file
 * Administration page callbacks for the SuperSaaS module.
 */

/**
 * Displays the SuperSaaS administration page.
 *
 * @return array
 *   A HTML-formatted string with administration page content.
 */
function supersaas_admin() {
  $form['supersaas_account_id'] = array(
    '#type' => 'textfield',
    '#title' => t('SuperSaaS account name'),
    '#default_value' => variable_get('supersaas_account_id', ''),
    '#description' => t("The account name of your SuperSaaS account. If you don't have an account name yet then please create one at supersaas.com."),
    '#required' => TRUE,
  );

  $form['supersaas_password'] = array(
    '#type' => 'password',
    '#title' => t('SuperSaaS password'),
    '#default_value' => variable_get('supersaas_password', ''),
    '#description' => t("The password for the administrator of your SuperSaaS account."),
    '#required' => TRUE,
  );

  $form['supersaas_schedule'] = array(
    '#type' => 'textfield',
    '#title' => t('Schedule name or URL'),
    '#default_value' => variable_get('supersaas_schedule', ''),
    '#description' => t("The name of the schedule or URL to redirect to after login."),
    '#required' => TRUE,
  );

  $form['supersaas_button_label'] = array(
    '#type' => 'textfield',
    '#title' => t('Button Label'),
    '#default_value' => variable_get('supersaas_button_label', t('Book Now!')),
    '#description' => t("The text to be put on the button that is displayed, for example 'Create Appointment'."),
    '#required' => TRUE,
  );

  $form['supersaas_button_image'] = array(
    '#type' => 'textfield',
    '#title' => t('Button Image'),
    '#default_value' => variable_get('supersaas_button_image', ''),
    '#description' => t("Location of an image file to use as the button. Can be left blank."),
    '#required' => FALSE,
  );

  $form['supersaas_domain'] = array(
    '#type' => 'textfield',
    '#title' => t('Custom Domain Name'),
    '#default_value' => variable_get('supersaas_domain', ''),
    '#description' => t("If you created a custom domain name that points to SuperSaaS enter it here. Can be left blank."),
    '#required' => FALSE,
  );

  return system_settings_form($form);
}

/**
 * Form validation handler for supersaas_admin().
 *
 * @see supersaas_admin()
 */
function supersaas_admin_validate($form, &$form_state) {
  if (strstr($form_state['values']['supersaas_domain'], 'http')) {
    form_set_error('supersaas_domain', t('Please enter just the domain, not a URL'));
  }

  if ($form_state['values']['supersaas_button_image'] && !strstr($form_state['values']['supersaas_button_image'], 'http')) {
    form_set_error('supersaas_button_image', t("Please enter the URL including 'http'"));
  }
}
