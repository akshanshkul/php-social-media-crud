<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/css/signup.css" />
</head>

<body>
    <style>
        input[type="file"] {
            display: none;
        }
    </style>
    <div class="register-card">
        <h2>Join Social Network</h2>
        <form method="POST" enctype="multipart/form-data" action="insert">
            <div class="profile-pic">
                <img id="profileImage" src="default-profile.png" alt="Profile Picture" />
                <button type="button" onclick="uploadProfilePic()">Upload Profile Pic</button>
            </div>


            <input type="text" placeholder="Full Name" name="name" required />
            <input type="date" placeholder="Date of Birth" name="dob" required />
            <input type="email" placeholder="Email Address" name="email" required />

            <div class="password-row">
                <input type="password" placeholder="Password" name="password" required />
                <small id="passwordHelp" style="color: red; display: none;">
                    Password must include A-Z, a-z, 0-9, and special characters !@#$%^&*
                </small>
                <input type="password" placeholder="Re - Password" name="confirm_password" required />
            </div>

            <input type="file" name="profile_pic" accept="image/*" />
            <small>Use A-Z, a-z, 0-9, !@#$%^&* in password</small>
            <button type="submit" name="signup">Sign Up</button>
        </form>
    </div>

    <script src="assets/js/signup.js"></script>
</body>

</html>