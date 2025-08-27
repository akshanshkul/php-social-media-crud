function uploadProfilePic() {
  // Create file input dynamically
  const input = document.createElement('input');
  input.type = 'file';
  input.accept = 'image/*';
  input.onchange = function (e) {
    const file = e.target.files;
    if (file) {
      const reader = new FileReader();
      reader.onload = function (event) {
        document.getElementById('profileImage').src = event.target.result;
      };
      reader.readAsDataURL(file);
    }
  };
  input.click();
}
