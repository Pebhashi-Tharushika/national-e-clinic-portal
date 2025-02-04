document.addEventListener("DOMContentLoaded", function () {
    let dateInput = document.querySelector('input[type="date"]');

    dateInput.addEventListener("input", function () {
        if (dateInput.value) {
            dateInput.classList.add("date-selected");
        } else {
            dateInput.classList.remove("date-selected");
        }
    });
});
