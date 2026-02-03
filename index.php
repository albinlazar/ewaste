<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoCycle | Responsible E-Waste Disposal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">EcoCycle</div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#impact">Our Impact</a></li>
                <li><a href="#process">How It Works</a></li>
                <li><a href="login.php" class="btn-login">Login / Register</a></li>
            </ul>
        </nav>
    </header>

    <section id="home" class="hero">
        <div class="hero-content">
            <h1>Turn Your <span class="highlight">E-Waste</span> Into <span class="highlight">Rewards</span></h1>
            <p>Join the movement to clean our planet. Dispose of old electronics responsibly and get paid for it.</p>
            <div class="cta-buttons">
                <a href="register.php" class="btn primary">Start Recycling</a>
                <a href="#process" class="btn secondary">Learn More</a>
            </div>
            <p style="margin-top: 1.5rem; font-size: 0.9rem; opacity: 0.8;">
                Are you an Administrator? <a href="login.php" style="color: var(--accnet-color); text-decoration: underline;">Login Here</a>
            </p>
        </div>
        <div class="hero-image">
            <!-- Placeholder for a nice vector or 3D image -->
            <div class="floating-item laptop">💻</div>
            <div class="floating-item phone">📱</div>
            <div class="floating-item battery">🔋</div>
        </div>
    </section>

    <section id="impact" class="impact-section">
        <h2>Why It Matters</h2>
        <div class="cards-container">
            <div class="card">
                <div class="icon">🌍</div>
                <h3>Save the Earth</h3>
                <p>Prevent toxic chemicals from entering the soil and water.</p>
            </div>
            <div class="card">
                <div class="icon">💰</div>
                <h3>Earn Money</h3>
                <p>Get Rs. 50 for every kilogram of e-waste you recycle.</p>
            </div>
            <div class="card">
                <div class="icon">♻️</div>
                <h3>Resource Recovery</h3>
                <p>Recover valuable materials like gold, silver, and copper.</p>
            </div>
        </div>
    </section>

    <section id="process" class="process-section">
        <h2>How It Works</h2>
        <div class="steps">
            <div class="step">
                <span class="step-number">1</span>
                <h3>Register</h3>
                <p>Create an account in seconds.</p>
            </div>
            <div class="step">
                <span class="step-number">2</span>
                <h3>Schedule</h3>
                <p>List your items and pick a date.</p>
            </div>
            <div class="step">
                <span class="step-number">3</span>
                <h3>Pickup</h3>
                <p>We collect from your doorstep.</p>
            </div>
            <div class="step">
                <span class="step-number">4</span>
                <h3>Earn</h3>
                <p>Get paid instantly after verification.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2026 EcoCycle E-Waste Management. All rights reserved.</p>
        <p style="font-size: 0.8rem; margin-top: 10px;"><a href="login.php" style="color: #bbb; text-decoration: none;">Admin Login</a></p>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>
