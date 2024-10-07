<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elitistick Website</title>
    <link rel="stylesheet" href="/styles/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <h1>Neon<span>Game</span>Studio</h1>
        </div>
        <nav class="nav">
            <a href="#games">Games</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h2>Creating the Future of Gaming</h2>
            <p>Join us on an epic journey through immersive worlds.</p>
            <a href="#games" class="cta-button">Explore Our Games</a>
        </div>
        <div class="scroll-indicator">
            <span>Scroll</span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>

    <section id="games" class="games-section">
        <h2>Our Games</h2>
        <div class="game-grid">
            <div class="game-item">
                <div class="game-image">
                    <img src="game1.jpg" alt="Game 1">
                    <div class="overlay">
                        <h3>Game Title 1</h3>
                    </div>
                </div>
                <p>Short description of the game.</p>
            </div>
            <div class="game-item">
                <div class="game-image">
                    <img src="game2.jpg" alt="Game 2">
                    <div class="overlay">
                        <h3>Game Title 2</h3>
                    </div>
                </div>
                <p>Short description of the game.</p>
            </div>
            <!-- Add more games as needed -->
        </div>
    </section>

    <section id="about" class="about-section">
        <div class="about-content">
            <h2>About Us</h2>
            <p>We are a passionate team of game developers dedicated to pushing the boundaries of interactive entertainment.</p>
        </div>
    </section>

    <section id="contact" class="contact-section">
        <h2>Contact Us</h2>
        <form>
            <input type="text" placeholder="Your Name" required>
            <input type="email" placeholder="Your Email" required>
            <textarea placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </section>

    <footer class="footer">
        <div class="social-icons">
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
        <p>&copy; 2024 Neon Game Studio. All Rights Reserved.</p>
    </footer>
    <script src="/scripts/js/anim.js"></script>
</body>
</html>
