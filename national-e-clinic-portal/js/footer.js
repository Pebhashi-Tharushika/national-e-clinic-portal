const backToTop = document.getElementById('back-to-top');

window.onscroll = function () {
    updateBorderProgress();
};

function updateBorderProgress() {
    const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrollPercent = (scrollTop / scrollHeight) * 100;

    const scrollThreshold = window.innerHeight * 0.3; // 30% of viewport height

    // Show button after scrolling 30% of viewport height
    backToTop.style.display = scrollTop > scrollThreshold ? "flex" : "none";

    // Apply circular border effect with conic-gradient
    backToTop.style.background = `
        conic-gradient( #56aeff ${scrollPercent}%, #333333 ${scrollPercent}%)
      `;
}

// Scroll to the top when the button is clicked
backToTop.onclick = function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
};

