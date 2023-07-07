<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['SMTP_USERNAME']; // Your SMTP username
        $mail->Password   = $_ENV['SMTP_PASSWORD']; // Your SMTP password
        $mail->SMTPSecure = $_ENV['SMTP_SECURE'];
        $mail->Port       = $_ENV['SMTP_PORT'];

        // Additional settings
        $mail->set('X-SES-CONFIGURATION-SET', 'ConfigSet');

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('gigantedylan001@gmail.com'); // Set recipient email address

        // Content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        // Send the email
        $mail->send();

        // Redirect back to the portfolio page with a success message
        header('Location: portfolio.php?success=true');
        exit;
    } catch (Exception $e) {
        // Redirect back to the portfolio page with an error message
        header('Location: portfolio.php?success=false');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#about">About</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="about">
            <div>
                <h1>Dylan Gigante</h1>
                <h2>Software Engineer</h2>
                <p>A passionate software engineer experienced in creating web applications. Skilled in HTML, CSS, JavaScript, and Python. Committed to delivering high-quality code and exceptional user experiences.</p>
                <a href="https://docs.google.com/document/d/1VMIhrsSn4JmnXjPzeoCQ4mDyRYnLG2VKePicssCnT4Y/" class="cta-button">View Resume</a>
            </div>
        </section>

        <section id="skills">
            <div>
                <h2>Skills</h2>
                <ul>
                    <li>HTML</li>
                    <li>CSS</li>
                    <li>JavaScript</li>
                    <li>Python</li>
                    <!-- Add more skills here -->
                </ul>
            </div>
        </section>

        <section id="projects">
            <div>
                <h2>Projects</h2>
                <div class="project">
                    <img src="project1.jpg" alt="Project 1">
                    <div>
                        <h3>Open Table</h3>
                        <p>Create, view, add, or delete restaurants and reviews.</p>
                        <ul>
                            <li>Converts address into latitude and longitude coordinates when a new restaurant is added</li>
                            <li>Search through restaurants by name, zip code, city, or food type</li>
                            <li>Tracks distance and sorts from client's location to restaurant's location using Haversine Formula</li>
                        </ul>
                        <a href="https://dilys-open-table-clone.onrender.com" class="project-link">Live Demo</a>
                        <a href="https://github.com/demondylan/OpenTable" class="project-link">GitHub Repo</a>
                    </div>
                </div>
                <div class="project">
                    <img src="project2.jpg" alt="Project 2">
                    <div>
                        <h3>Spotify</h3>
                        <p>Create, listen, add, or delete songs and albums.</p>
                        <ul>
                            <li>Search songs by artist name, song name, or album name</li>
                            <li>Upload your own music if you are a verified artist</li>
                            <li>Used React H5 Audio Player to play music</li>
                        </ul>
                        <a href="#" class="project-link">Live Demo</a>
                        <a href="https://github.com/Celvenia/SpotifyClone" class="project-link">GitHub Repo</a>
                    </div>
                </div>
                <!-- Add more project entries here -->
            </div>
        </section>

<section id="contact">
    <div>
        <h2>Contact</h2>
        <p>Email: gigantedylan001@yahoo.com</p>
        <p>Phone: (586) 295-6887</p>
        <ul>
            <li><a href="https://wellfound.com/u/dylan-gigante">Wellfound</a></li>
            <li><a href="https://www.linkedin.com/in/dylan-gigante/">LinkedIn</a></li>
            <li><a href="https://github.com/demondylan">GitHub</a></li>
        </ul>
        <p>Location: Clinton Township, Michigan</p>

        <form action="send_email.php" method="post">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="text" name="subject" placeholder="Subject" required>
            <textarea name="message" placeholder="Your Message" required></textarea>
            <button type="submit" class="cta-button">Send Message</button>
        </form>

        <?php if ($success): ?>
            <p class="success-message">Your message has been sent successfully.</p>
        <?php elseif ($error): ?>
            <p class="error-message">Sorry, there was an error sending your message. Please try again later.</p>
        <?php endif; ?>
    </div>
</section>
    </main>

    <footer>
        <p>&copy; 2023 Dylan Gigante. All rights reserved.</p>
    </footer>
</body>
</html>