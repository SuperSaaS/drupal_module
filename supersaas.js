/**
 * @file
 * Provides JavaScript functions for the SuperSaaS module.
 *
 * Checks if the Drupal username is a reserved word in the SuperSaaS system.
 */

(function (Drupal) {

  'use strict';

  Drupal.behaviors.supersaasSubmit = {
    attach: function (context, settings) {
      var reservedWords = ['test', 'supervise', 'supervisor', 'superuser', 'user', 'admin', 'supersaas'];
      var submit = context.querySelector('.supersaas-login-form input[name=submit]') ||
        context.querySelector('.supersaas-login-form input[type=submit]');

      if (!submit) {
        return;
      }

      submit.onclick = function() {
        for (var i in reservedWords) {
          if (reservedWords[i] === settings.username) {
            return window.confirm(settings.confirmMessage);
          }
        }
      }
    }
  }
})(window.Drupal);
