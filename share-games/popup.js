if (!localStorage.getItem('alertShown')) {
    alert(
      'CSS will be changed soon.\n' +
      'CSS zostanie zmieniony wkrótce.'
    );
    localStorage.setItem('alertShown', 'true');
}