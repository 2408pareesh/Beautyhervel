<?php
// ---------- DB & PHPMailer config ----------
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // PHPMailer via Composer

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'beautyherbal';

$smtpUser = 'whiledragonsweb@gmail.com';
$smtpAppPassword = "nniwwthjbdpgpzye";

// ---------- Connect to DB ----------
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($mysqli->connect_errno) {
    die("DB connect failed: " . $mysqli->connect_error);
}

// ---------- Handle POST order ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname      = trim($_POST['firstname'] ?? '');
    $lastname       = trim($_POST['lastname'] ?? '');
    $email          = trim($_POST['email'] ?? '');
    $phone          = trim($_POST['phone'] ?? '');
    $gender         = trim($_POST['gender'] ?? '');
    $message        = trim($_POST['message'] ?? '');
    $productArr     = $_POST['product'] ?? [];
    $product        = is_array($productArr) ? implode(', ', $productArr) : trim($productArr);
    $product_image  = trim($_POST['product_image'] ?? '');
    $orderDate      = trim($_POST['order_date'] ?? '');

    if (!$firstname || !$email || !$product) {
        die("⚠️ Required fields missing");
    }

    if (!$orderDate) {
        date_default_timezone_set("Asia/Kolkata");
        $orderDate = date("Y-m-d H:i:s");
    }

    // ---------- Insert into DB with debug ----------
    $stmt = $mysqli->prepare("
        INSERT INTO orders 
        (firstname, lastname, email, phone, gender, message, product, product_image, order_date) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }

    if (!$stmt->bind_param(
        'sssssssss',
        $firstname,
        $lastname,
        $email,
        $phone,
        $gender,
        $message,
        $product,
        $product_image,
        $orderDate
    )) {
        die("Bind failed: " . $stmt->error);
    }

    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    $stmt->close();

    // ---------- Send email ----------
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUser;
        $mail->Password   = $smtpAppPassword;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom($smtpUser, 'Beauty Herbal');
        $mail->addAddress("pareepareeshan997@gmail.com", "Pareepareeshan");

        $mail->isHTML(true);
        $mail->Subject = "New order from $firstname $lastname";

        $body  = "<h2>📌 New Order Details</h2>";
        $body .= "<b>First Name:</b> $firstname<br>";
        $body .= "<b>Last Name:</b> $lastname<br>";
        $body .= "<b>Email:</b> $email<br>";
        $body .= "<b>Phone:</b> $phone<br>";
        $body .= "<b>Gender:</b> $gender<br>";
        $body .= "<b>Message:</b> $message<br>";
        $body .= "<b>Product:</b> $product<br>";
        $body .= "<b>Product Image:</b> $product_image<br>";
        $body .= "<b>📅 Order Date:</b> $orderDate<br>";

        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);

        $mail->send();

        echo "✅ Order placed successfully & email sent!";
    } catch (Exception $e) {
        echo "⚠️ Mail sending failed, but order saved. Error: {$mail->ErrorInfo}";
    }

    exit;
}
$mysqli->close();
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
    <link rel="stylesheet" href="css/link_dimmer.css">
    <link rel="stylesheet" href="css/button_dimmer.css">
    <link rel="stylesheet" href="style.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="2345 .png">
    <link rel="stylesheet" href="style.css">

    <!-- SweetAlert for popup messages -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            <div class="slide-buttons2">
              <a href="buynow.html" class="btn active">BUY NOW <i class="fa-solid fa-cart-shopping"></i></a>
              </a>
        </div>
        </ul>
    </header>

    <!-- NAV LOADER BAR -->
    <div class="progress-container">
        <div class="progress-bar" id="myBar"></div>
    </div>

    <!-- Background video -->
    <video class="video-background" autoplay muted loop>
        <source src="./clip/herbal2.mp4" type="video/mp4">
    </video>

    <!-- Hero Section -->
    <section class="buy-hero">
        <div class="bg-image"></div>
    </section>

    <!-- Contact Section -->
    <section class="container contact-content" id="contact-content">
        <!-- Office Information -->
        <div class="office-info">
            <img src="./2345 .png" style="width: 100%;" alt="logo">
            <img src="./2345 - 1.png" style="width: 100%; margin-top: -315px;" class="downer" alt="logo">
        </div>

        <!-- Contact Form -->
        <div class="contact-form animate">
            <h3><span class="custom1">Welcome to</span> <span class="custom2">Beauty Herbal</span></h3>
            <p style="color: #c8e6c9; margin-bottom: 20px;">For all enquiries, please contact us and one of our
                delightful team will be happy to help.</p>



  
    <form id="contactForm" method="post">
      <input type="hidden" id="orderDate" name="order_date">
      <input type="hidden" id="productImage" name="product_image">

      <div class="mb-3"><input type="text" name="firstname" class="form-control" placeholder="First Name" required></div>
      <div class="mb-3"><input type="text" name="lastname" class="form-control" placeholder="Last Name" required></div>
      <div class="mb-3"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
      <div class="mb-3"><input type="tel" name="phone" class="form-control" placeholder="Phone"></div>
      <div class="mb-3">
        <select name="gender" class="form-control" required>
          <option value="">Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
      </div>
      <div class="mb-3"><textarea name="message" class="form-control" placeholder="Message"></textarea></div>

      <!-- Product Selection -->
      <div class="gallery">
        <label class="photo-card"> <input type="checkbox" name="product[]" value="Herbal hair oil[small]" hidden onchange="updateSelected(this, './img/product1.png')" checked> <img src="./img/pform/pform1.png" alt="Herbal hair oil[small]" style="width:100px;"> <div class="caption">Herbal Hair Oil[small]</div> </label> <label class="photo-card"> <input type="checkbox" name="product[]" value="Herbal hair oil[large]" hidden onchange="updateSelected(this, './img/product2.png')" checked> <img src="./img/pform/pform2.png" alt="Herbal hair oil[large]" style="width:100px;"> <div class="caption">Herbal Hair Oil[large]</div> </label>
        <label class="photo-card"> <input type="checkbox" name="product[]" value="daily harbal powder" hidden onchange="updateSelected(this, './img/product3.jpg')" checked> <img src="./img/pform/pform3.jpg" alt="daily harbal powder" style="width:100px;"> <div class="caption">Daily Herbal powder</div> </label> <label class="photo-card"> <input type="checkbox" name="product[]" value="Weekly herbal product" hidden onchange="updateSelected(this, './img/product4.png')" checked> <img src="./img/pform/pform4.png" alt="Weekly herbal product" style="width:100px;"> <div class="caption">Weekly Herbal product</div> </label>
      </div>

     <button type="submit" class="submit-btn" id="submit-btn" onclick="playSubmitSound()"> <i class="fas fa-paper-plane"></i> Submit Message </button>

     <!-- Social icons below submit button -->
     <div class="form-social-icons" style="margin-top:20px; display:flex; gap:20px; justify-content:center;">
       <a href="https://wa.me/" target="_blank" title="WhatsApp"><img src="https://img.icons8.com/3d-fluency/48/whatsapp.png" alt="whatsapp" width="40" height="40"></a>
       <a href="https://www.tiktok.com/" target="_blank" title="TikTok"><img src="https://img.icons8.com/color-glass/48/tiktok.png" alt="tiktok" width="40" height="40"></a>
       <a href="https://www.facebook.com/" target="_blank" title="Facebook"><img src="https://img.icons8.com/fluency/48/facebook-new.png" alt="facebook" width="40" height="40"></a>
     </div>
     </form>
   </div>
 </section>

  <script>
    // set order date
    document.getElementById('orderDate').value = new Date().toISOString().slice(0,19).replace('T',' ');

    // handle product selection
    function updateSelected(checkbox, imgPath) {
      document.getElementById('productImage').value = imgPath;
      checkbox.parentElement.classList.toggle('selected', checkbox.checked);
    }

    // handle form submit with AJAX
    document.getElementById('contactForm').addEventListener('submit', function(e){
      e.preventDefault();
      let formData = new FormData(this);
      fetch("", {method:"POST", body:formData})
        .then(res=>res.text())
       
  Swal.fire({
    title: "Response",
    html: data,
    icon: "success",
    confirmButtonText: "OK"
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "index.html"; // redirect home
    }
  });
})

        .catch(err=>{
          Swal.fire("Error", err, "error");
        });
  </script>


        <img src="./New folder/Untitled-1.png" class="image-adjust" width="100%" height="100%">


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
          <p>Embrace the freedom of natural beauty. At Herbal Beauty, we believe true wellness begins with nature's touch. Our carefully crafted herbal products are designed to nourish, restore, and uplift to help you glow with confidence inside and out.</p>
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

  <script src="script.js"></script>
  <script src="js/form_submit.js"></script>
  <script src="js/menu.js"></script>
  <script src="js/scroller.js"></script>
  <script src="js/period.js"></script>
  <script src="js/appear_section.js"></script>
  <script src="js/product_select.js"></script>


     <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contactForm');
            
            // Set current date in the hidden field
            document.getElementById('orderDate').value = new Date().toISOString().slice(0, 19).replace('T', ' ');
        });
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show loading state
                const submitBtn = document.getElementById('submit-btn');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                submitBtn.disabled = true;
                
                // Prepare form data
                const formData = new FormData(form);
            });
                
               

        // Function to update selected product image
        function updateSelected(radio, imagePath) {
            document.getElementById('productImage').value = imagePath;
            
            // Remove selected class from all options
            document.querySelectorAll('.photo-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Add selected class to the chosen option
            radio.parentElement.classList.add('selected');
        }
    </script>

        <script>
    function playSubmitSound() {
        var audio = new Audio("./sound/Ticking_Placeholder.mp3");
        audio.play();
    }
    </script>  
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submit-btn');

    // Set current date in the hidden field
    document.getElementById('orderDate').value = new Date().toISOString().slice(0, 19).replace('T', ' ');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Show loading state
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        submitBtn.disabled = true;

        const formData = new FormData(form);

        fetch("", { method: "POST", body: formData })
        .then(res => res.text())
        .then(data => {
            // Show success popup on the same page
            Swal.fire({
                title: "Order Placed!",
                html: data, // server response
                icon: "success",
                confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "product.html#products"; // redirect after OK
                }
            });

            // Reset button
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        })
        .catch(err => {
            Swal.fire({
                title: "Error",
                text: "Something went wrong! Please try again.",
                icon: "error",
                confirmButtonText: "OK"
            });
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });
});
</script>  




</body>

