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
  let isClickedGettingStarted = false;
  const gettingStartedSection = document.getElementById('getting-started');

  window.addEventListener('scroll', function () {

    if (gettingStartedSection) {
      const topOffset = gettingStartedSection.getBoundingClientRect().top;
      if (isClickedGettingStarted && topOffset) {
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
    }



  });


  // dynamic percentage increment 
  const percentageElements = document.querySelectorAll('.percentage');
  if (percentageElements.length === 0) {
    return;
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !entry.target.hasAnimated) {
        entry.target.hasAnimated = true; // Flag to prevent re-animation
        incrementPercentage(entry.target);
      }
    });
  }, { threshold: 0.5 });

  percentageElements.forEach(element => observer.observe(element));


  function incrementPercentage(element) {
    let count = 0;
    const duration = 2000; // total time duration
    const incrementTime = duration / 100;

    const interval = setInterval(() => {
      if (count < 100) {
        count++;
        element.textContent = count;
      } else {
        clearInterval(interval);
      }
    }, incrementTime);
  }

});





