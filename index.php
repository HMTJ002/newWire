<?php
session_start();
include "app\utils\database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Website - NewsWire</title>
    <link rel="stylesheet" href="app\static\css\home_styles.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="app\static\images\logo.png"  alt="News Wire Logo">
            <div>
                <h1>NEWS WIRE</h1>
                <p>BEYOND HEADLINES</p>
            </div>
        </div>
    
        <nav class="navbar">
            <a href="index.html">Home</a>
            <?php
            if(!isset($_SESSION['user'])){
                echo "<a href='app\user\login.html'>Login</a>";
            }
            else{
                echo "<a href='logout.php'>Logout</a>";
            }
                
            ?>
            <a href="about_us.html">About Us</a>
            <a href="contact_us.html">Contact Us</a>
        </nav>
    </header>

    <section class="contact-image">
        <img src="app\static\images\home_bg.jpg" alt="Contact Us Image">
    </section>
    <section class="home">
    <h2>Welcome to NewsWire</h2>
    <p>Stay informed with real-time updates, breaking stories, and in-depth coverage on the latest happenings.<br> Your trusted source for news, events, and everything trending.</p>
    </section>

    <section class="main">
        <section class="news-category" id="local-news">
            <h3> Local News </h3>
            
            <div class="news-container">
                <?php
                $result = $conn->query("SELECT news.*, 
                (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'thumbs_up') AS thumbs_up,
                (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'angry') AS angry,
                (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'laughing') AS laughing,
                (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'sad') AS sad,
                (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'heart') AS heart
            FROM news WHERE category='local news'");

                while ($row = $result->fetch_assoc()) {
                echo "<div class='news-card'>
                        <img src='app\static\images\uploads/{$row['image']}' alt='News Image 1'>
                        <h4>{$row['title']}</h4>
                        <p class='news-summary'>{$row['summury']}</p>
                        <p class='full-news' id='news-{$row['id']}'>{$row['content']}</p>
                        <button class='see-more' onclick='toggleNews({$row['id']})'>See More</button>
                        <div class='reactions'>
                            <button class='reaction' onclick=react({$row['id']},'thumbs_up')>👍({$row['thumbs_up']})</button>
                            <button class='reaction' onclick=react({$row['id']},'angry')>😡({$row['angry']})</button>
                            <button class='reaction' onclick=react({$row['id']},'laughing')>😂({$row['laughing']})</button>
                            <button class='reaction' onclick=react({$row['id']},'sad')>😢({$row['sad']})</button>
                            <button class='reaction' onclick=react({$row['id']},'heart')>❤️({$row['heart']})</button>
                        </div>
                    </div>";
                }
                ?>
            </div>
        </section>
        

        <section class="news-category" id="international-news">
            <h3>International News</h3>

            <div class="news-container">
            <?php
              $result = $conn->query("SELECT news.*, 
              (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'thumbs_up') AS thumbs_up,
              (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'angry') AS angry,
              (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'laughing') AS laughing,
              (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'sad') AS sad,
              (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'heart') AS heart
          FROM news WHERE category='local news'");
                while ($row = $result->fetch_assoc()) {
                echo "<div class='news-card'>
                        <img src='app\static\images\uploads/{$row['image']}' alt='News Image 1'>
                        <h4>{$row['title']}</h4>
                        <p class='news-summary'>{$row['summury']}</p>
                        <p class='full-news' id='news-{$row['id']}'>{$row['content']}</p>
                        <button class='see-more' onclick='toggleNews({$row['id']})'>See More</button>
                        <div class='reactions'>
                            <button class='reaction' onclick=react({$row['id']},'thumbs_up')>👍({$row['thumbs_up']})</button>
                            <button class='reaction' onclick=react({$row['id']},'angry')>😡({$row['angry']})</button>
                            <button class='reaction' onclick=react({$row['id']},'laughing')>😂({$row['laughing']})</button>
                            <button class='reaction' onclick=react({$row['id']},'sad')>😢({$row['sad']})</button>
                            <button class='reaction' onclick=react({$row['id']},'heart')>❤️({$row['heart']})</button>
                        </div>
                    </div>";
                }
                ?>
            </div>
        </section>
        
        <section class="news-category" id="sports-news">
            <h3>Sports News</h3>

            <div class="news-container">
            <?php
                $result = $conn->query("SELECT news.*, 
                   (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'thumbs_up') AS thumbs_up,
                   (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'angry') AS angry,
                   (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'laughing') AS laughing,
                   (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'sad') AS sad,
                   (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'heart') AS heart
                FROM news WHERE category='Sports'");

                while ($row = $result->fetch_assoc()) {
                echo "<div class='news-card'>
                        <img src='app\static\images\uploads/{$row['image']}' alt='News Image 1'>
                        <h4>{$row['title']}</h4>
                        <p class='news-summary'>{$row['summury']}</p>
                        <p class='full-news' id='news-{$row['id']}'>{$row['content']}</p>
                        <button class='see-more' onclick='toggleNews({$row['id']})'>See More</button>
                        <div class='reactions'>
                            <button class='reaction' onclick=react({$row['id']},'thumbs_up')>👍({$row['thumbs_up']})</button>
                            <button class='reaction' onclick=react({$row['id']},'angry')>😡({$row['angry']})</button>
                            <button class='reaction' onclick=react({$row['id']},'laughing')>😂({$row['laughing']})</button>
                            <button class='reaction' onclick=react({$row['id']},'sad')>😢({$row['sad']})</button>
                            <button class='reaction' onclick=react({$row['id']},'heart')>❤️({$row['heart']})</button>
                        </div>
                    </div>";
                }
                ?>
            </div>
        </section>

        <section class="news-category" id="weather">
            <h3>Weather</h3>

            <div class="news-container">
            <?php
                $result = $conn->query("SELECT news.*, 
                  (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'thumbs_up') AS thumbs_up,
                  (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'angry') AS angry,
                  (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'laughing') AS laughing,
                  (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'sad') AS sad,
                  (SELECT COUNT(*) FROM reactions WHERE news_id = news.id AND reaction_type = 'heart') AS heart
                FROM news WHERE category='Weather'");

                while ($row = $result->fetch_assoc()) {
                echo "<div class='news-card'>
                        <img src='app\static\images\uploads/{$row['image']}' alt='News Image 1'>
                        <h4>{$row['title']}</h4>
                        <p class='news-summary'>{$row['summury']}</p>
                        <p class='full-news' id='news-{$row['id']}'>{$row['content']}</p>
                        <button class='see-more' onclick='toggleNews({$row['id']})'>See More</button>
                        <div class='reactions'>
                            <button class='reaction' onclick=react({$row['id']},'thumbs_up')>👍({$row['thumbs_up']})</button>
                            <button class='reaction' onclick=react({$row['id']},'angry')>😡({$row['angry']})</button>
                            <button class='reaction' onclick=react({$row['id']},'laughing')>😂({$row['laughing']})</button>
                            <button class='reaction' onclick=react({$row['id']},'sad')>😢({$row['sad']})</button>
                            <button class='reaction' onclick=react({$row['id']},'heart')>❤️({$row['heart']})</button>
                    </div>";
                }
                ?>
            </div>
        </section>

       
    </section>


    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Contact Us</h3>
                <ul>
                    <li><strong>Address:</strong> 123 News St, New York, NY 10001</li>
                    <li><strong>Email:</strong> support@newswire.com</li>
                    <li><strong>Phone:</strong> (123) 456-7890</li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="/categories">News Categories</a></li>
                    <li><a href="/latest">Latest News</a></li>
                    <li><a href="/trending">Trending</a></li>
                    <li><a href="/contact">Contact</a></li>
                    <li><a href="/privacy-policy">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Follow Us</h3>
                <ul class="social-links">
                    <li><a href="https://www.facebook.com/NewsWire" target="_blank">Facebook</a></li><br><br>
                    <li><a href="https://www.instagram.com/NewsWire" target="_blank">Instagram</a></li><br><br>
                    <li><a href="https://twitter.com/NewsWire" target="_blank">Twitter</a></li><br><br>
                    <li><a href="https://www.linkedin.com/company/NewsWire" target="_blank">LinkedIn</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Newsletter</h3>
                <p>Stay updated with the latest news and updates!</p>
                <form action="#" method="post" onsubmit="return validateNewsletter()">
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 NewsWire. All rights reserved.</p>
        </div>
    </footer>
    

</body>

<script src="app\static\js\newswire.js"></script>

</html>
