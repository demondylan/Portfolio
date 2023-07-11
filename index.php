<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$success = false;
$error = false;
$errorMessage = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = true;
        $errorMessage = 'Please fill in all the required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $errorMessage = 'Please enter a valid email address.';
    } else {
        try {

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USERNAME'];
            $mail->Password = $_ENV['SMTP_PASSWORD'];
            $mail->SMTPSecure = $_ENV['SMTP_SECURE'];
            $mail->Port = $_ENV['SMTP_PORT'];

   
            $mail->set('X-SES-CONFIGURATION-SET', 'ConfigSet');


            $mail->setFrom($_ENV['SMTP_USERNAME'], 'Dylan Gigante');
            $mail->addAddress('gigantedylan001@gmail.com');


            $mail->isHTML(false);
            $mail->Subject = $subject;
            $mail->Body = $message . "\n\nSender's Email: " . $email;


            $mail->send();


            $success = true;
        } catch (Exception $e) {

            $error = true;
            $errorMessage = 'An error occurred while sending the email. Please try again later.';
        }
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
                <p>A passionate software engineer experienced in creating web applications. Skilled in HTML, CSS,
                    JavaScript, and Python. Committed to delivering high-quality code and exceptional user experiences.
                </p>
                <a href="https://docs.google.com/document/d/1VMIhrsSn4JmnXjPzeoCQ4mDyRYnLG2VKePicssCnT4Y/"
                    target="_blank" class="cta-button">View Resume</a>
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
                    <li>React</li>
                    <li>Java</li>
                    <li>Php</li>
                    <li>Node Js</li>
                    <li>Sequelize Express</li>
                    <li>Mysql</li>
                    <li>Redux</li>
                    <li>Git</li>
                    <!-- Add more skills here -->
                </ul>
            </div>
        </section>

        <section id="projects">
            <div>
                <h2>Projects</h2>
                <div class="project">
                    <img src="https://i.gyazo.com/7aa1063bff01a48a2ad9f257eceb4196.png" alt="Open Table">
                    <div>
                        <h3>Open Table</h3>
                        <p>Clone of Open Table <a href="https://www.opentable.com/" target="_blank">check it out here.</a></p>
                        <ul>
                            <li>Converts address into latitude and longitude coordinates when a new restaurant is added
                            </li>
                            <li>Search through restaurants by name, zip code, city, or food type</li>
                            <li>Tracks distance and sorts from client's location to restaurant's location using
                                Haversine Formula</li>
                        </ul>
                        <a href="https://dilys-open-table-clone.onrender.com" target="_blank" class="project-link">Live
                            Demo</a>
                        <a href="https://github.com/demondylan/OpenTable" target="_blank" class="project-link">GitHub
                            Repo</a>
                    </div>
                </div>
                <div class="project">
                    <img src="https://i.gyazo.com/8b4bf2a9932d2d03b967aa0abf50a466.png" alt="Spotify">
                    <div>
                        <h3>Spotify</h3>
                        <p>Clone of Spotify <a href="https://open.spotify.com/" target="_blank">check it out here.</a></p>
                        <p>Create, listen, add, or delete songs and albums.</p>
                        <ul>
                            <li>Search songs by artist name, song name, or album name</li>
                            <li>Upload your own music if you are a verified artist</li>
                            <li>Used React H5 Audio Player to play music</li>
                        </ul>
                        <a href="https://spotify-clone-n2tb.onrender.com/" class="project-link">Live Demo</a>
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
                <ul class="social-links">
                    <li><a href="https://wellfound.com/u/dylan-gigante" target="_blank">Wellfound</a></li>
                    <li><a href="https://www.linkedin.com/in/dylan-gigante/" target="_blank">LinkedIn</a></li>
                    <li><a href="https://github.com/demondylan" target="_blank">GitHub</a></li>
                </ul>
                <p>Location: Clinton Township, Michigan</p>

                <?php if ($success): ?>
                    <p class="success-message">Your message has been sent successfully.</p>
                <?php elseif ($error): ?>
                    <p class="error-message">
                        <?php echo $errorMessage; ?>
                    </p>
                <?php endif; ?>



                <button class="open-modal cta-button">Send Message</button>

                <!-- Modal -->
                <div id="myModal" class="modal">
                    <div class="modal-content center">
                        <span class="close">&times;</span>
                        <h2>Leave a Message</h2>
                        <p>I would love to hear from you! Please fill out the form below to send me a message.</p>
                        <form action="" method="post">
                            <input type="text" name="name" placeholder="Your Name" required>
                            <input type="email" name="email" placeholder="Your Email" required>
                            <input type="text" name="subject" placeholder="Subject" required>
                            <textarea name="message" placeholder="Your Message" required></textarea>
                            <button type="submit" class="cta-button">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Dylan Gigante. All rights reserved.</p>
    </footer>

    <script>
        var modal = document.getElementById("myModal");
        var btn = document.querySelector(".open-modal");
        var closeBtn = document.querySelector(".close");
        var contactForm = document.getElementById("contactForm");

        btn.onclick = function () {
            modal.style.display = "block";
        }

        closeBtn.onclick = function () {
            modal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        contactForm.addEventListener("submit", function (event) {
            event.preventDefault();


            var isSuccess = true;

            var successMessage = document.querySelector(".success-message");
            var errorMessage = document.querySelector(".error-message");
            if (successMessage) {
                successMessage.remove();
            }
            if (errorMessage) {
                errorMessage.remove();
            }


            var messageContainer = document.createElement("p");
            if (isSuccess) {
                messageContainer.textContent = "Your message has been sent successfully.";
                messageContainer.classList.add("success-message");
            } else {
                messageContainer.textContent = "Sorry, there was an error sending your message. Please try again later.";
                messageContainer.classList.add("error-message");
            }
            document.getElementById("contact").insertBefore(messageContainer, contactForm);
            modal.style.display = "none";
        });
    </script>
</body>

</html>