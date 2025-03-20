const maxFileSize = 5 * 1024 * 1024; // 5MB

const uploadError = document.getElementById('upload-error');
const uploadPool = document.getElementById('upload-pool');



document.addEventListener('DOMContentLoaded', function () {
    const uploadInput = document.getElementById('attachments');
    if (uploadInput) {
        uploadInput.addEventListener('change', handleFileUpload);
    }
});

function handleFileUpload(event) {
    const files = event.target.files;

    for (const file of files) {
        if (file.size > maxFileSize) {
            uploadError.style.display = 'block';
            uploadError.innerHTML = `File size must be less than 5MB. Selected file: ${file.name}`;
            return;
        } else {
            uploadError.style.display = 'none';
            displayUploadedFile(file);
        }
    }
}

function displayUploadedFile(file) {
    const listItem = document.createElement('li');
    listItem.classList.add('upload-item');

    const fileLink = document.createElement('a');
    fileLink.href = URL.createObjectURL(file);
    fileLink.target = '_blank';
    fileLink.textContent = file.name;

    const removeButton = document.createElement('span');
    removeButton.classList.add('upload-remove');
    removeButton.innerHTML = `<i class="fa-regular fa-xmark"></i>`;
    removeButton.addEventListener('click', () => removeFile(listItem));

    listItem.appendChild(fileLink);
    listItem.appendChild(removeButton);

    uploadPool.appendChild(listItem);
}

function removeFile(listItem) {
    uploadPool.removeChild(listItem);
}
