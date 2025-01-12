
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


// Remove the hash when scrolled above the getting-started section
let isClickedGettingStarted = false;
const gettingStartedSection = document.getElementById('getting-started');

window.addEventListener('scroll', function () {

  const topOffset = gettingStartedSection.getBoundingClientRect().top;
  
  if (isClickedGettingStarted) {
    if (topOffset > 0.8 || -1 * window.innerHeight > topOffset) {
      if (window.location.hash) {
        history.replaceState(null, '', window.location.pathname);

      }
      isClickedGettingStarted = false;
    }
  } else {
    if (-1 * window.innerHeight <= topOffset && topOffset < 0.8) {
      isClickedGettingStarted = true;
    }
  }

});

