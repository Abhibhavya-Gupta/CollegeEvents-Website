<?php
require_once 'includes/functions.php';

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    redirect('index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CollegeEvents.com </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/Homepage.css">
        <link rel="stylesheet" href="assets/css/header.css">
        <link rel="stylesheet" href="assets/css/button-sections.css">
        <link rel="stylesheet" href="assets/css/table-of-contents.css">
        <link rel="stylesheet" href="assets/css/modal.css">
    </head>
    <body>
        <div class="background-image">
            <img class="background-image" src="assets/images/image1.jpg">
        </div>

        <header class="header">
            <div class="left-section">
                <div id="navigation">
                    <div id="menu">
                        <div id="bar1" class="bar"></div>
                        <div id="bar2" class="bar"></div>
                        <div id="bar3" class="bar"></div>
                    </div>
                    <ul class="nav" id="nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="pages/profile.html" target="_blank">Profile</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="pages/settings.html" target="_blank">Settings</a></li>
                        <li><a href="#">Contact</a></li>
                        <?php if (isLoggedIn()): ?>
                            <li><a href="?logout=1" class="logout-link">Logout</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="middle-section">
                <p class="Homepage-title">
                    <img class="skit-logo-image" src="assets/images/skit-logo.png">
                    CollegeEvents.com
                </p>
                <?php if (isLoggedIn()): ?>
                    <div class="welcome-container">
                        <?php
                            $hour = date('H');
                            $userName = e($_SESSION['user_name']);
                            
                            if ($hour < 12) {
                                $greeting = "Good Morning";
                            } elseif ($hour < 18) {
                                $greeting = "Good Afternoon";
                            } else {
                                $greeting = "Good Evening";
                            }
                            
                            $motivations = [
                                "Ready to explore amazing events?",
                                "Let's discover something awesome today!",
                                "Your next adventure awaits!",
                                "Time to find your perfect event!",
                                "Excited to see what's new?"
                            ];
                            $motivation = $motivations[array_rand($motivations)];
                        ?>
                        <p class="welcome-greeting"><?php echo $greeting; ?>, <?php echo $userName; ?>!</p>
                        <p class="welcome-subtitle"><?php echo $motivation; ?></p>
                    </div>
                <?php else: ?>
                    <p class="title-about">
                        Your journey of participating in Hackathons, Club activities and many more, Starts here.
                    </p>
                    <button class="get-started-button" id="get-started-button">
                        Get Started
                    </button>
                <?php endif; ?>
            </div>
            <div class="right-section">
                <div class="profile">
                    <a href="profile.php" target="_blank"><img class="avatar" src="./assets/images/mypic.jpg"></a>
                    <span class="tooltip"><?php echo isset($_SESSION['user_name']) ? e($_SESSION['user_name']) : 'User'; ?></span>
                </div>
            </div>
        </header>

        <?php if (!isLoggedIn()): ?>
        <div class="form-section" id="form-section">
            <div class="form-container">
                <button id="close-form" class="close-form">&times;</button>
                <h3>Start Your Journey Now by Creating an Account</h3>
                <p>Create a new account to access exclusive features and join our community of innovators, Or Login to Continue Your Journey:</p>
                <div class="form-buttons">
                    <a href="auth/register.php" class="form-button signup">Create new Account</a>
                    <a href="auth/login.php" class="form-button login">Login</a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <p class="whats-next-text">
            So, What's next?
        </p>
        <div class="buttons-section">
            <button class="hackathon-button">Hackathons</button>
            <button class="sports-button">Sports</button>
            <button class="club-events-button">Club Events</button>
            <button class="workshops-button">Workshops</button>
        </div>

        <div class="table-of-contents">
            <div class="main-section" id="hackathons-section">
                <div class="header-section">
                    <img class="image" src="assets/images/hackathon-image.jpg">
                    <p class="text">Hackathons</p>
                    <div class="Event">
                        <a href="https://www.sphinx.org.in/" target="_blank">
                            <img src="assets/images/mnit-hackathon-image.png" alt="Hack1" class="mnit-image">
                            <div class="event-about">
                                <h2>Sphinx - Techno-Fest</h2>
                                <h3>Location : MNIT Jaipur </h3>
                                <h3>Fees : <span class="event-price">Rs.250</span></h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="main-section" id="sports-section">
                <div class="header-section">
                    <img class="image" src="assets/images/sports-image.jpg">
                    <p class="text">Sports</p>
                </div>
                <div class="Event">
                    <a href="https://pravah.skit.ac.in/skit-pravah-2026-AAVEG" target="_blank">
                        <img src="assets/images/sports-event1.jpg" alt="sports1" class="sports-image">
                        <div class="event-about">
                            <h2>Pravah - Aaveg</h2>
                            <h3>Location : SKIT Jaipur </h3>
                            <h3>Fees : <span class="event-price">Free</span></h3>
                        </div>
                    </a>
                </div>
            </div>

            <div class="main-section" id="club-events-section">
                <div class="header-section">
                    <img class="image" src="assets/images/club-events.avif">
                    <p class="text">Club Events</p>
                    <div class="Event">
                        <a href="https://gd-club-ivory.vercel.app/index.html" target="_blank">
                            <img src="assets/images/google-image.webp" alt="club1" class="google-image">
                            <div class="event-about">
                                <h2>Google Student Ambassador Club</h2>
                                <h3>Location : 6FL8, SKIT Jaipur</h3>
                                <h3>Fees : <span class="event-price">Free</span></h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="main-section" id="workshops-section">
                <div class="header-section">
                    <img class="image" src="assets/images/workshop-image.jpg">
                    <p class="text">Workshops</p>
                    <div class="Event">
                        <a href="https://www.skit.ac.in/student-corner/students-s-life.html?layout=view&id=1525" target="_blank">
                            <img src="assets/images/math-image.png" alt="workshop1" class="math-image">
                            <div class="event-about">
                                <h2>Mathematics Workshop</h2>
                                <h3>Location : ME Block, SKIT Jaipur</h3>
                                <h3>Fees : <span class="event-price">Free</span></h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <footer><h4>-Thank You for using this Website! :)</h4></footer>

        <script>
            // Get Started button functionality
            const getStartedBtn = document.getElementById('get-started-button');
            const formSection = document.getElementById('form-section');
            const closeFormBtn = document.getElementById('close-form');

            if (getStartedBtn) {
                getStartedBtn.addEventListener('click', function() {
                    formSection.classList.add('show');
                });
            }

            if (closeFormBtn) {
                closeFormBtn.addEventListener('click', function() {
                    formSection.classList.remove('show');
                });
            }

            // Close modal when clicking outside the form
            if (formSection) {
                formSection.addEventListener('click', function(e) {
                    if (e.target === formSection) {
                        formSection.classList.remove('show');
                    }
                });
            }
        </script>
        <script src="./assets/scripts/interactive.js"></script>
    </body>
</html>
