function uploadProfilePic() {
  const input = document.createElement('input');
  input.type = 'file';
  input.accept = 'image/*';

  input.onchange = e => {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = event => {
        document.getElementById('profileImage').src = event.target.result;
      };
      reader.readAsDataURL(file);

      // Also update the actual hidden file input for form submission
      const fileInput = document.querySelector('input[name="profile_pic"]');
      if (fileInput) {
        // Create a DataTransfer to set the file programmatically (Note: limited browser support)
        const dt = new DataTransfer();
        dt.items.add(file);
        fileInput.files = dt.files;
      }
    }
  };

  input.click();
}

document.addEventListener('DOMContentLoaded', () => {
  const password = document.querySelector('input[type="password"]:first-of-type');
  const confirmPassword = document.querySelector('input[type="password"]:last-of-type');
  const signUpButton = document.querySelector('button[name="signup"]');

  signUpButton.disabled = true;

  function validatePasswords() {
    if (password.value && confirmPassword.value && password.value === confirmPassword.value) {
      signUpButton.disabled = false;
      signUpButton.style.cursor = 'pointer';
      signUpButton.style.opacity = '1';
    } else {
      signUpButton.disabled = true;
      signUpButton.style.cursor = 'not-allowed';
      signUpButton.style.opacity = '0.5';
    }
  }

  // Listen for input event on both fields for instant checking on every key press
  password.addEventListener('input', validatePasswords);
  confirmPassword.addEventListener('input', validatePasswords);
});



document.getElementById('password').addEventListener('input', function() {
  const pwd = this.value;
  const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).+$/;
  const helpText = document.getElementById('passwordHelp');

  if (!pattern.test(pwd)) {
    helpText.style.display = 'block';  // Show error if invalid
  } else {
    helpText.style.display = 'none';   // Hide error when valid
  }
});
