if (!localStorage.getItem('alertShown')) {
    alert(
      'Quotes are not translated\n' +
      'Cytaty nie są tłumaczone.'
    );
    localStorage.setItem('alertShown', 'true');
}
