
// accordition of why choose section
document.addEventListener('DOMContentLoaded', function () {
  const accordionItems = document.querySelectorAll('.accordion-item');
  if (accordionItems.length > 0) {
    accordionItems[0].classList.add('expanded');
  }

  accordionItems.forEach(item => {
    item.addEventListener('mouseenter', () => {
      accordionItems.forEach(i => i.classList.remove('expanded'));
      item.classList.add('expanded');
    });
  });
});



