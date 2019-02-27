<?php

namespace Drupal\supersaas;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Configure supersaas settings for this site.
 */
class SupersaasSettingsForm extends ConfigFormBase {

  /**
   * Constructs a \Drupal\supersaas\SupersaasSettingsForm object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The factory for configuration objects.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    parent::__construct($config_factory);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'supersaas_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'supersaas.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config('supersaas.settings');

    $form['account_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('SuperSaaS Account Name'),
      '#default_value' => $config->get('account_id', ''),
      '#description' => $this->t("The account name of your SuperSaaS account. If you don't have an account name yet then please create one at supersaas.com."),
      '#required' => TRUE,
    );

    $form['password'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('SuperSaaS API Key'),
      '#default_value' => $config->get('password', ''),
      '#description' => $this->t('The API key that you generated from your SuperSaaS account.'),
      '#required' => TRUE,
    );

    $form['schedule'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Schedule Name'),
      '#default_value' => $config->get('schedule', ''),
      '#description' => $this->t('The name of the schedule or URL to redirect to after login.'),
      '#required' => FALSE,
    );

    $form['button_label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Button Label'),
      '#default_value' => $config->get('button_label', $this->t('Book Now!')),
      '#description' => $this->t("The text to be put on the button that is displayed, for example 'Create Appointment'."),
      '#required' => FALSE,
    );

    $form['button_image'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Button Image'),
      '#default_value' => $config->get('button_image', ''),
      '#description' => $this->t('Location of an image file to use as the button. Can be left blank.'),
      '#required' => FALSE,
    );

    $form['domain'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Custom Domain Name'),
      '#default_value' => $config->get('domain', ''),
      '#description' => $this->t('If you created a custom domain name that points to SuperSaaS enter it here. Can be left blank.'),
      '#required' => FALSE,
    );

    $form['https'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Enable HTTPS'),
      '#default_value' => $config->get('https'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('supersaas.settings')
      ->set('account_id', $form_state->getValue('account_id'))
      ->set('password', $form_state->getValue('password'))
      ->set('schedule', $form_state->getValue('schedule'))
      ->set('button_label', $form_state->getValue('button_label'))
      ->set('button_image', $form_state->getValue('button_image'))
      ->set('domain', $form_state->getValue('domain'))
      ->set('https', $form_state->getValue('https'))
      ->save();
  }

}
