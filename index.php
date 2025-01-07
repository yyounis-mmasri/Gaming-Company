<?php
// Start session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href=./Styles/index.css>
    <script src="javascript/index.js"></script>
</head>
<body>
<div class="user-greeting">
    <?php if (isset($_SESSION['user_name'])): ?>
        <p style="font-size: 24px; font-weight: bold;">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
    <?php else: ?>
        <p><a href="login.html">Log in</a></p>
    <?php endif; ?>
    <p><a class="logout" href="php/logout.php" style=" ;"><i class="fa-solid fa-right-from-bracket"></i> Sign out</a></p>
</div>

<header>
     <div class="container">
         <img src="images/header_pic.png" alt="header logo">
         <p>Games</p>
     </div>

    <nav>
        <a href="index.html" class="selected_page hovering">Home</a>
        <a href="" class="hovering">Games</a>
        <a href="careers.html" class="hovering">Careers</a>
        <a href="about.html" class="hovering">About</a>
        <a href="#contact" class="hovering">Contact</a>
    </nav>

</header>



<main>
    <section class="welcome">


        <div class="title">
            <h1>By Gamers, <span class="highlight">For Gamers</span></h1>
            <p>Creating the Very Best in Mobile Gaming</p>
        </div>

        <div class="main-background-image">
        <img class="welcome-pic1" src="images/welcome_pic1.png" alt="welcome picture">
        <img class="welcome-pic2" src="images/welcome_pic2.png" alt="welcome picture">
        <div class="game1">
            <a href="#game1"><img src="images/game3.png" alt="first game"></a>
            <div class="column">
                <h4>Jump On</h4>
                <p>Strategy</p>
            </div>
        </div>
        <div class="game2">
            <a href="#game2"><img src="images/game1.png" alt="third game"></a>
            <div class="column">
                <h4>Feed the Cat</h4>
                <p>casual</p>
            </div>
        </div>
        <div class="game3">
            <a href="#game3"><img src="images/game2.png" alt="second game"></a>
            <div class="column">
                <h4>Ripple Delete</h4>
                <p>Adventure</p>
            </div>
        </div>

         </div>




    </section>
    <section class="portfolio">
        <img class="additional-pic" src="images/portfolio_pic.png" alt="portfolio picture">
        <div class="title">
            <h2><span class="highlight">Explore</span> Our Games</h2>
            <p>I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font.</p>
        </div>


        <div class="games">
        <div class="game1-sec game-sec" id="game1">
            <div class="game-container">
                 <div class="row1">
                     <img src="images/game3.png" alt="first game">
                <div class="column">
                    <h4>Jump On </h4>
                    <p>Adventure</p>
                </div>
                 </div>

                <div class="row2"><p>I'm a paragraph. Click here to add your own text and edit me. I’m a great place for you to tell a story and let your users know a little more about you.</p></div>
                <div class="row3">
                    <a href=""><img src="images/app-store.png" alt="app store"></a>
                    <a href=""><img src="images/google-play.png" alt="google play"></a>
                </div>

            </div>

            <img class="game-phone" src="images/game1-phone.png" alt="first game on phone">

        </div>
        <div class="game2-sec game-sec" id="game2">

            <div class="game-container">
                <div class="row1">
                   <img src="images/game1.png" alt="second game">
                    <div class="column">
                        <h4>Feed the Cat</h4>
                        <p>Casual</p>
                    </div>
                </div>

                <div class="row2"><p>I'm a paragraph. Click here to add your own text and edit me. I’m a great place for you to tell a story and let your users know a little more about you.</p></div>
                <div class="row3">
                    <a href=""><img src="images/app-store.png" alt="app store"></a>
                    <a href=""><img src="images/google-play.png" alt="google play"></a>
                </div>

            </div>

            <img class="game-phone" src="images/game2-phone.png" alt="second game on phone">


        </div>
        <div class="game3-sec game-sec" id="game3">

            <div class="game-container">
                <div class="row1">
                    <img src="images/game2.png" alt="third game">
                    <div class="column">
                        <h4>Ripple Delete</h4>
                        <p>Strategy</p>
                    </div>
                </div>

                <div class="row2"><p>I'm a paragraph. Click here to add your own text and edit me. I’m a great place for you to tell a story and let your users know a little more about you.</p></div>
                <div class="row3">
                    <a href=""><img src="images/app-store.png" alt="app store"></a>
                    <a href=""><img src="images/google-play.png" alt="google play"></a>
                </div>

            </div>

            <img class="game-phone" src="images/game3-phone.png" alt="third game on phone">



        </div>
        </div>






    </section>
    <section class="promotional">
        <p>Come Work at Games!<p>
        <h2>Great People Make <span class="highlight">Great Games.</span></h2>
        <br>
        <h2>Explore our Available Opportunities</h2>
        <a href="careers.html" class="hovering">See Openings</a>
        <img src="images/promotional_pic2.png" alt="promotional picture">

    </section>
    <section class="contact" id="contact">
        <p>About Games Games</p>
        <h2>Creating Interactive Mobile </h2>
        <h2>Games Played Across the Globe</h2>
        <a href="" class="hovering">Learn More</a>
        <img src="images/about_pic2.png" alt="about picture">
    </section>
    <section class="contacting-form">
        <h3>Get in Touch</h3>
        <p>contact us here and feel free to send us your feedback</p>
        <form action="php/contact.php" method="post">
            <div class="col1">
                <input type="text" id="Fname" name="first_name" placeholder="First Name *" required>
                <input type="text" id="Lname" name="last_name" placeholder="Last Name *" required>
            </div>

            <div class="col2">
                <input type="Email" name="email" placeholder="Email *" required>
                <input type="text"  name="subject" id="subject" placeholder="subject *" required>
            </div>
            <textarea required name="message" id="" cols="10" rows="8" placeholder="Message"></textarea>
            <input type="submit" id="submit" value="Submit">
        </form>
    </section>


</main>



<footer>

    <div class="container">
        <img src="images/header_pic.png" alt="header logo">
        <p>Games</p>
    </div>
     <div>
         <p class="para">Creating the Very Best in Mobile Gaming</p>
     </div>

    <div class="line"></div>

    <div class="main-menu">
        <div class="menu-contact">
            <h5>Contact</h5>
            <div class="list">
               <p>info@mysite.com</p>
               <p> Tel: 123-456-7890</p>
               <p>500 Terry Francine St.</p>
              <p>San Francisco, CA 94158</p>
            </div>

        </div>
        <div class="menu-subscribe">

            <h5>Subscribe for News and Updates</h5>
            <input type="email" name="email" placeholder="Enter your email here">
            <input type="submit" value="Subscribe" name="submit" class="submit-email">
        </div>
        <div class="menu-menu">
            <h5>Menu</h5>
            <div class="list">
                <a href=""><p>Games</p></a>
                <a href="careers.html"><p>Careers</p></a>
                <a href="about.html"><p>About</p></a>
                <a href="#contact"><p>Contact</p></a>
                <a href="accessibility.html"><p>Accessibility</p></a>
                <a href="terms.html"><p>Terms & Conditions</p></a>
                <a href="privacy_policy.html"><p>Privacy Policy</p></a>
                <a href="shipping_policy.html"><p>Shipping Policy</p></a>
                <a href="refund_policy.html"><p>Refund Policy</p></a>
            </div>

        </div>
        <div class="menu-social">
            <h5>Social</h5>
            <div class="list">
                <a href="https://discord.com/" target="_blank"><i class="fa-brands fa-discord"></i></a>
                <a href="https://www.twitch.tv/" target="_blank"><i class="fa-brands fa-twitch"></i></a>
                <a href="https://www.facebook.com/" target="_blank"> <i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.youtube.com/" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                <a href="https://x.com/" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
            </div>


        </div>


    </div>











</footer>

</body>
</html>