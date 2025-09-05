<?php
require './vendor/autoload.php';

use App\core\Helper;
use App\core\Session;
Session::init();
if(!Session::get('loggedIn')) {
    header("Location: login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="assets/css/home.css">
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <span class="network-title">Social Network</span>
            <div class="profile-card">
                <img src="profile.jpg" alt="John Doe">
                <h3>John Doe</h3>
                <p>john@doe.com</p>
                <div class="tag intermediate">Intermediate</div>
                <a class="share-link" href="#">Share Profile</a>
            </div>
        </aside>

        <main class="feed">
            <!-- Add Post Section -->
            <section class="add-post-card">
                <textarea placeholder="What's on your mind?"></textarea>
                <div class="image-preview">
                    <img src="vacancy.jpg" alt="Vacancy">
                    <span class="remove-image">&#10005;</span>
                </div>
                <button class="post-btn">Post</button>
                <button class="add-img-btn">Add Image</button>
            </section>

            <!-- Post Cards -->
            <section class="post-card">
                <div class="post-header">
                    <span>Innovation, teamwork, and growth—it's what we stand for! Discover what makes us unique.</span>
                    <span class="remove-post">&#10005;</span>
                </div>
                <time>Posted on: 20 Nov 2024</time>
                <img src="teamwork.jpg" alt="Teamwork">
                <div class="post-actions">
                    <button class="like-btn">Like 25</button>
                    <button class="dislike-btn">Dislike 10</button>
                </div>
            </section>

            <section class="post-card">
                <div class="post-header">
                    <span>Building a better tomorrow, together. Be part of our journey!</span>
                    <span class="remove-post">&#10005;</span>
                </div>
                <time>Posted on: 19 Nov 2024</time>
                <img src="success.jpg" alt="Success">
                <div class="post-actions">
                    <button class="like-btn">Like 25</button>
                    <button class="dislike-btn">Dislike 10</button>
                </div>
            </section>
        </main>
    </div>

</body>

</html>