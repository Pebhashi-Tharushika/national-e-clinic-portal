document.addEventListener('DOMContentLoaded', function () {

  // accordition of why choose section
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

  // Remove the hash when scrolled above the getting-started section
  const gettingStartedSection = document.getElementById('getting-started');
  if(gettingStartedSection)
    window.addEventListener('scroll', handleScrollToGettingStarted(gettingStartedSection));

});



let isClickedGettingStarted = false;


function handleScrollToGettingStarted(gettingStartedSection) {

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

};

