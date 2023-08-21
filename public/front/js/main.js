const listItems = document.querySelectorAll('.list-item');

listItems.forEach((item) => {
  item.addEventListener('click', () => {
    const sublist = item.querySelector('.sublist');
    if (sublist.classList.contains('show')) {
      sublist.classList.remove('show');
    } else {
      sublist.classList.add('show');
    }
  });

  const subitems = item.querySelectorAll('.subitem');

  subitems.forEach((subitem) => {
    subitem.addEventListener('click', () => {
      const sublist2 = subitem.querySelector('.sublist2');
      if (sublist2.classList.contains('show')) {
        sublist2.classList.remove('show');
      } else {
        sublist2.classList.add('show');
      }
    });
  });
});