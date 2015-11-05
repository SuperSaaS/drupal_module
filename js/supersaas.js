/**
 * @file
 * Provides JavaScript functions for the SuperSaaS module.
 *
 * Checks if the Drupal username is a reserved word in the SuperSaaS system.
 */

function confirmBooking() {
  'use strict';
  var reservedWords = ['test', 'supervise', 'supervisor', 'superuser', 'user', 'admin', 'supersaas'];
  for (var i in reservedWords) {
    if (reservedWords[i] === Drupal.settings.supersaas.username) {
      return confirm(Drupal.settings.supersaas.confirmMessage);
    }
  }
}
