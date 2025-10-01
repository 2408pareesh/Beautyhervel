<?php
// contact.php (mail handling)

// Enable error reporting for debugging (remove on production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // make sure PHPMailer is installed via Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name && $email && $message) {
        try {
            $mail = new PHPMailer(true);

            // SMTP Settings (Gmail example)
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'whiledragonsweb@gmail.com'; // your Gmail
            $mail->Password   = 'nniwwthjbdpgpzye';         // your Gmail password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Email headers
            $mail->setFrom($email, $name);
            $mail->addAddress('pareepareeshan997@gmail.com', 'Beauty Herbal'); // receive email here
            $mail->addReplyTo($email, $name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = "New Contact Form Message from $name";
            $mail->Body    = "
                <h2>Contact Form Submission</h2>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Phone:</strong> {$phone}</p>
                <p><strong>Message:</strong><br>{$message}</p>
            ";

            $mail->send();

            echo "<script>
                alert('✅ Thank you $name, your message has been sent successfully!');
                window.location.href = 'contact.php';
            </script>";

        } catch (Exception $e) {
            echo "<script>
                alert('❌ Sorry, your message could not be sent. Error: {$mail->ErrorInfo}');
                window.location.href = 'contact.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('⚠️ Please fill in all required fields.');
            window.location.href = 'contact.php';
        </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Beauty Herbal</title>
  <!-- Google Fonts-->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/appear_section.css">
  <link rel="stylesheet" href="css/button_dimmer.css">
  <link rel="stylesheet" href="style.css">
  <!-- Favicon -->
  <link rel="shortcut icon" href="2345 .png">
</head>

<body>


  <!-- Top Contact Bar -->
  <div class="top-bar">
    <div class="container">
      <span style="font-family:'Mulish', sans-serif;"><i class="fas fa-map-marker-alt"></i> New Town Western King Street, 5th Avenue, New York</span>
      <span style="font-family:'Mulish', sans-serif;"><i class="fas fa-phone"></i> 1800-2355-2356</span>
    </div>
  </div>

  <!-- Navbar -->
  <header class="navbar">
    <div style="display: flex; align-items: center; gap: 10px;">
      <img src="img/main.png" width="250px">
    </div>

    <div class="menu-toggle" id="mobile-menu">
        <i class="fas fa-bars"></i>
    </div>
    <ul class="nav-links">
   <li><a href="./index.html" onclick="sessionStorage.setItem('preloaderShown', 'true')">Home</a></li>
      <li><a href="./product.html">Products</a></li>
      <li><a href="./about.html">About</a></li>
      <li><a href="./contact.php" class="active">Contact</a></li>
      <div class="slide-buttons2">
              <a href="buynow.php" class="btn">BUY NOW <i class="fa-solid fa-cart-shopping"></i></a>
              </a>
        </div>
    </ul>
  </header>

    <!-- NAV LOADER BAR -->
    <div class="progress-container">
        <div class="progress-bar" id="myBar"></div>
    </div>

  <!-- Hero Section -->
  <section class="hero">
    <div class="breadcrumb">
      <a href="#">Home</a>
      <span>/</span>
      <a href="#" style="color:#b49d41;">Contact</a>
    </div>
    <h1>Contact <span class="custom2">us</span></h1>
  </section>

  <!-- Contact Section -->
  <section class="contact-section">
    <div class="container contact-content">
      <section class="contact-intro">
        <div class="container" style="margin-bottom: 86px;">
          <h2><span class="custom1">We Are Here </span><span class="custom2"> For You!</span></h2>
          <p>If your query is relating to finding our more information about CBD products then please feel free to visit
            the following resources:</p>
        </div>
      </section>

      <div class="divider"></div>

      <!-- Contact Content -->
      <!-- Office Information -->
      <div class="office-info animate">
        <h3><span class="custom1">Head </span><span class="custom2">Office</span></h3>
        <ul class="office-details">
          <li>
            <i class="fas fa-map-marker-alt"></i>
            <strong> New Town Western King Street, 8th Avenue, New York</strong>
          </li>
          <li>
            <i class="fas fa-phone"></i>
            <strong> 1800-2356-2356</strong>
          </li>
          <li>
            <i class="fas fa-envelope"></i>
            <strong> usarname@domainname.com</strong>
          </li>
        </ul>
        <div class="office-hours">
          <p><strong>Mon-Fri:</strong> 9am - 5pm</p>
          <p><strong>Sat-Sun:</strong> Closed</p>
        </div>
      </div>

      <!-- Contact Form -->
     <div class="row justify-content-center">
      <!--div class="col-md-6"-->
        <div class="contact-form">
          <h3><span class="custom1">Root message </span><span class="custom2">us</span></h3>
          <form action="" method="post">
            <div class="form-group">
              <label for="name">Your Name*</label>
              <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
              <label for="email">Email Address*</label>
              <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
              <label for="phone">Phone No</label>
              <input type="tel" id="phone" name="phone">
            </div>

            <div class="form-group">
              <label for="message">Type Your Message*</label>
              <textarea id="message" name="message" required></textarea>
            </div>

            <button type="submit" class="submit-btn">
              <i class="fas fa-paper-plane"></i> Submit Message
            </button>
          </form>
        </div>
      </div>
    </div>
    </div>
  </section>

    <section class="map-section">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.356248414696!2d80.11281027421633!3d9.706073778487936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3afe5470a2b6cb2f%3A0x19173b154e1e3b8d!2sManipay!5e0!3m2!1sen!2slk!4v1701234567890!5m2!1sen!2slk"
            width="100%"
            height="450"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </section>

            <!-- Email Subscription -->
         <div class="section-bg1"></div>
                    <div class="space-extra-top">
                        <div id="contactUs" class="email-subscription">
                            <img src="img/order_footer1.png" alt="Email Header Image"
                                class="email-subscription__image" width="100%">
                            <div class="row justify-content-center">
                                    <img src="2345 .png" style="margin-top:-43px; width:40px;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h2 class="email-subscription__title text-center" style="margin-top: 15px;">Embrace the freedom of natural beauty!
                                        <span class="vs-primary">Herbal Beauty, we believe true wellness begins with nature’s</span> </br>
                                        touch.
                                    </h2>
                                    <div class="footer-social footer-social-footer mb-40 wow animate__fadeInUp"
                                        data-wow-delay="0.35s" style="margin-left: 83px;">
                                        <a href="https://www.facebook.com/profile.php?v.k.pareeshan"><img width="49" height="49" src="https://img.icons8.com/lollipop/49/facebook-new.png" alt="facebook-new"/></a>
                                        <a href="https://www.tiktok.com/@mhdsalim618"><img width="49" height="49" src="https://img.icons8.com/color-glass/49/tiktok.png" alt="tiktok"/></a>
                                        <a href="https://www.instagram.com/mhdsalim618/"><img width="49" height="49" src="https://img.icons8.com/fluency/48/instagram-new.png" alt="instagram-new"/></a>
                                        <a href="https://whatsapp.com/channel/0029VbB6UK8002TDfRHPVl2n"><img width="49" height="49" src="https://img.icons8.com/3d-fluency/94/whatsapp.png" alt="whatsapp"/></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Email Subscription End -->

        <!-- Footer Start -->
        <footer class="vs-footer ">

            <div class="vs-footer__copyright">
                <div class="container wow animate__fadeInUp" data-wow-delay="1.1s">
                    Copyright © 2025 Beauty Herbal. Developed at WEBbuilders
                </div>
            </div>
        </footer>
        <!-- Footer End -->

  <!-- Footer -->
    <div class="footer-container">
      <div class="footer-content">
        <!-- Brand Information Section -->
        <div class="footer-section brand-info">
          <img src="img/main.png" width="250px" height="75px" class="footer-logo">
          <p>Embrace the freedom of natural beauty. At Herbal Beauty, we believe true wellness begins with nature’s touch. Our carefully crafted herbal products are designed to nourish, restore, and uplift to help you glow with confidence inside and out.</p>
          <div class="footer-social-icons">
            <a href="#"><img width="35" height="35" src="https://img.icons8.com/fluency/35/facebook-new.png" alt="facebook-new"/></a>
            <a href="#"><img width="35" height="35" src="https://img.icons8.com/fluency/35/instagram-new.png" alt="instagram-new"/></a>
            <a href="#"><img width="35" height="35" src="https://img.icons8.com/fluency/35/whatsapp.png" alt="whatsapp"/></a>
            <a href="#"><img width="35" height="35" src="https://img.icons8.com/fluency/35/linkedin.png" alt="linkedin"/></a>
          </div>
        </div>

        <!-- Useful Links Section -->
        <div class="footer-section link-info">
          <h3 class="footer-heading"><span class="custom1">Useful</span> <span class="custom2">Links</span></h3>
          <div class="links-columns">
            <ul class="links-list">
              <li><a href="./index.html">Home</a></li>
              <li><a href="./product.html">Products</a></li>
              <li><a href="./about.html">About</a></li>
              <li><a href="./contact.php">Contact</a></li>
              <li><a href="./buynow.php">Shop</a></li>
            </ul>
          </div>
        </div>

        <!-- Contact Information Section -->
        <div class="footer-section contact-info">
          <h3 class="footer-heading"><span class="custom1">Contact</span> <span class="custom2">Information</span></h3>
          <p>
            <i class="fas fa-map-marker-alt"></i>
            New Town Western King Street,<br>
            5th Avenue, New York
          </p>
          <p>
            <i class="fas fa-phone"></i>
            1800-2355-2356
          </p>
          <p>
            <i class="fas fa-envelope"></i>
            usernames@domain.com
          </p>
        </div>

      </div>

      <div class="footer-bottom">
        <p class="copyright">Copyright © 2025 <strong>Beauty Herbal</strong>. Developed at WEBbuilders.lk</p>
      </div>
    </div>
  </div>

  <!-- The circular button -->
  <button class="circle-btn" id="scrollTopBtn"><i class="fa-solid fa-angle-up" style="color: #1a3c2d;"></i></button>

  <script src="js/form_submit.js"></script>
  <script src="js/menu.js"></script>
  <script src="js/scroller.js"></script>
  <script src="js/appear_section.js"></script>
  <script src="script.js"></script>

  <script>
        // netlify/functions/send-sms/send-sms.js

    const twilio = require('twilio');

    exports.handler = async function(event, context) {
        // Only allow POST requests
        if (event.httpMethod !== 'POST') {
            return {
                statusCode: 405,
                body: 'Method Not Allowed'
            };
        }
        
        try {
            const { message, to } = JSON.parse(event.body);
            
            // Initialize Twilio client with environment variables
            const client = twilio(
                process.env.TWILIO_ACCOUNT_SID,
                process.env.TWILIO_AUTH_TOKEN
            );
            
            // Send SMS
            const result = await client.messages.create({
                body: message,
                from: process.env.TWILIO_PHONE_NUMBER, // Your Twilio phone number
                to: to
            });
            
            return {
                statusCode: 200,
                body: JSON.stringify({ success: true, sid: result.sid })
            };
        } catch (error) {
            console.error('Error sending SMS:', error);
            return {
                statusCode: 500,
                body: JSON.stringify({ error: 'Failed to send SMS' })
            };
        }
    };
  </script>
  

</body>

</html>