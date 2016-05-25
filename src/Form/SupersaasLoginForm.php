<?php

namespace Drupal\supersaas\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a user login form.
 */
class SupersaasLoginForm extends FormBase {

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $user;

  /**
   * Constructs a new UserLoginForm.
   *
   * @param \Drupal\Core\Render\RendererInterface $renderer
   *   The renderer.
   * @param \Drupal\Core\Session\AccountInterface $user
   *   The current user.
   */
  public function __construct(RendererInterface $renderer, AccountInterface $user) {
    $this->renderer = $renderer;
    $this->user = $user;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('renderer'),
      $container->get('current_user')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'supersaas_login_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('supersaas.settings');
    $account = str_replace(' ', '_', $config->get('account_id'));

    $protocol = 'http' . ($config->get('https') ? 's' : '') . '://';
    $domain = $config->get('domain') === '' ? 'supersaas.com' : $config->get('domain');
    $form['#action'] = $protocol . $domain . '/api/users';
    $form['#method'] = 'post';

    $form['account'] = array(
      '#type' => 'hidden',
      '#value' => $account,
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'hidden',
      '#value' => $this->user->id() . 'fk',
      '#required' => TRUE,
    );

    $form['user[name]'] = array(
      '#type' => 'hidden',
      '#value' => $this->user->getAccountName(),
      '#required' => TRUE,
    );

    $form['user[email]'] = array(
      '#type' => 'hidden',
      '#value' => $this->user->getEmail(),
      '#required' => TRUE,
    );

    $form['checksum'] = array(
      '#type' => 'hidden',
      '#value' => \md5($account . $config->get('password') . $this->user->getAccountName()),
    );

    $form['after'] = array(
      '#type' => 'hidden',
      '#value' => htmlspecialchars(str_replace(' ', '_', $config->get('schedule'))),
    );

    // Submit image.
    $image = $config->get('button_image');
    $label = htmlspecialchars($config->get('button_label'));
    if (!empty($image)) {
      $form['actions']['submit'] = array(
        '#type' => 'image_button',
        '#name' => 'submit',
        '#src' => $image,
        '#alt' => $label,
      );
    }
    else {
      $form['actions']['submit'] = array(
        '#type' => 'submit',
        '#value' => $label,
      );
    }

    // Javascript pre-submit validation.
    $form['#attached']['library'] = ['supersaas/supersaas'];
    $form['#attached']['drupalSettings'] = array(
      'username' => $this->user->getAccountName(),
      'confirmMessage' => $this->t('Your username is a supersaas reserved word. You might not be able to login. Do you want to continue?'),
    );

    $this->renderer->addCacheableDependency($form, $config);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Not needed, because it submit to a different domain.
  }

}
