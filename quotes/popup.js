if (!localStorage.getItem('alertShown')) {
    alert(
      'This site is not translated to Polish yet\n' +
      'Ta strona nie została jeszcze przetłumaczona na Polski'
    );
    localStorage.setItem('alertShown', 'true');
}