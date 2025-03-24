function toggleAnswer(clickedQuestion) {
    const answer = clickedQuestion.nextElementSibling;
    const plusIcon = clickedQuestion.querySelector('.expand');
    const minusIcon = clickedQuestion.querySelector('.collapse');

    // Check if the clicked question is already expanded
    const isExpanded = answer.style.display === 'block';

    // Close all FAQs
    document.querySelectorAll('.faq-answer').forEach(ans => ans.style.display = 'none');
    document.querySelectorAll('.expand').forEach(icon => icon.style.display = 'block');
    document.querySelectorAll('.collapse').forEach(icon => icon.style.display = 'none');

    // Toggle the clicked FAQ only if it was not already expanded
    if (!isExpanded) {
        answer.style.display = 'block';
        plusIcon.style.display = 'none';
        minusIcon.style.display = 'block';
    }
}