function editProfile() {
    // Show the modal
    document.getElementById('editModal').style.display = 'flex';

    // Pre-fill the form with current values
    document.getElementById('editName').value = document.getElementById('name').innerText;
    document.getElementById('editEmail').value = document.getElementById('email').innerText;
    document.getElementById('editAlamat').value = document.getElementById('alamat').innerText;
    document.getElementById('editNoTelepon').value = document.getElementById('noTelepon').innerText;
}

function closeModal() {
    // Hide the modal
    document.getElementById('editModal').style.display = 'none';
}

function saveProfile(event) {
    event.preventDefault();

    // Get the new values from the form
    const newName = document.getElementById('editName').value;
    const newEmail = document.getElementById('editEmail').value;
    const newAlamat = document.getElementById('editAlamat').value;
    const newNoTelepon = document.getElementById('editNoTelepon').value;

    // Set the new values in the profile
    document.getElementById('name').innerText = newName;
    document.getElementById('email').innerText = newEmail;
    document.getElementById('alamat').innerText = newAlamat;
    document.getElementById('noTelepon').innerText = newNoTelepon;

    // Handle profile picture change (if needed)
    const fileInput = document.getElementById('editProfilePicture');
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profilePicture').src = e.target.result;
        }
        reader.readAsDataURL(fileInput.files[0]);
    }

    // Close the modal
    closeModal();
}
