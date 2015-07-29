function confirmBooking() {
  var reservedWords = ['test', 'supervise', 'supervisor', 'superuser', 'user', 'admin', 'supersaas'];
  for (i in reservedWords) {
    if (reservedWords[i] === Drupal.settings.supersaas.username) {
      return confirm(Drupal.settings.supersaas.confirmMessage);
    }
  }
}
