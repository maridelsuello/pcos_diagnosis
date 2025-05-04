<?php
include 'session.php';
include 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCOS Health Tracker</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <header>
        <h1>Ovarian Response Analyzer</h1>
        <nav>
           <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="add_info.php">Enter Your Information</a></li>
                <li><a href="learn.php">Learn More</a></li>
                <li><a href="features.php">Track Your Health</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>

        </nav>
    </header>

    <main>
        <section id="intro">
           <h2>What is the Ovarian Response Analyzer?</h2>
            <p>The Ovarian Response Analyzer is a helpful tool that estimates how a woman's ovaries may react to fertility treatments such as In Vitro Fertilization (IVF). It evaluates important health information—such as age, Body Mass Index (BMI), testosterone hormone levels, Antral Follicle Count (AFC), and menstrual cycle patterns—to provide a clearer picture of fertility status and assist doctors in creating a personalized treatment plan.</p>
            <a href="features.php" class="button">Check Your Ovarian Response</a>
                  
        </section>

        <section id="features">
            <h2>Features</h2>
            <ul>
                <li><strong>Ovarian Response Prediction:</strong> Find out how your body may respond to fertility treatments based on your personal health data.</li>
                <li><strong>Track Key Health Indicators:</strong> Monitor important factors like age, hormone levels, and menstrual cycle to stay informed.</li>
            </ul>

        </section>

        <section id="testimonials">
            <h2>User Reviews</h2>
            <blockquote>"The quiz helped me understand my symptoms better, and the app is easy to use!"</blockquote>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 PCOS Health Tracker. All Rights Reserved.</p>
    </footer>
</body>
</html>
