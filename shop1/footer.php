<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Footer Cute Style</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: rgb(247, 246, 244);
    }

    .footer {
      background-color: #7db8f0ff;
      color: #5a2a49;
      padding: 40px 0 20px;
      font-size: 14px;
      border-top-left-radius: 20px;
      border-top-right-radius: 20px;
      box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
    }

    .footer-container {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      max-width: 1000px;
      margin: auto;
    }

    .footer-section {
      flex: 1;
      margin: 15px;
      min-width: 250px;
    }

    .logo-section .logo {
      font-family: 'Brush Script MT', cursive;
      font-size: 36px;
      color: #e91e63;
    }

    .contact-info {
      font-family: 'Brush Script MT', cursive;
      font-size: 18px;
      margin-top: 10px;
      color: #b03a6f;
    }

    .site-map h3 {
      font-family: 'Comic Sans MS', cursive;
      color: #d63384;
      font-size: 18px;
      margin-bottom: 10px;
    }

    .site-map ul {
      list-style-type: none;
      padding: 0;
    }

    .site-map ul li a {
      color: #5a2a49;
      text-decoration: none;
      display: block;
      margin: 5px 0;
      transition: color 0.3s ease;
    }

    .site-map ul li a:hover {
      color: #e91e63;
      text-decoration: underline;
    }

    .subscribe input[type="email"] {
      padding: 10px;
      width: 80%;
      border-radius: 10px;
      border: 1px solid #ffc0cb;
      margin-bottom: 10px;
      font-family: inherit;
    }

    .subscribe button {
      background-color: #ff99cc;
      border: none;
      padding: 10px 20px;
      color: white;
      cursor: pointer;
      border-radius: 10px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .subscribe button:hover {
      background-color: #e86ba6;
    }

    .social-icons {
      margin-top: 15px;
    }

    .social-icons a img {
      width: 28px;
      height: 28px;
      margin-right: 10px;
      transition: transform 0.3s ease;
    }

    .social-icons a img:hover {
      transform: scale(1.1) rotate(5deg);
    }

    a {
      color: #5a2a49;
    }

    a:hover {
      text-decoration: underline;
    }

    .copyright {
      text-align: center;
      font-size: 13px;
      color: #8e4a67;
      margin-top: 30px;
    }

    @media (max-width: 600px) {
      .footer-container {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .footer-section {
        margin-bottom: 20px;
      }

      .subscribe input[type="email"] {
        width: 100%;
      }
    }

    .social-icons a img {
  width: 30px;
  height: 30px;
  margin-right: 10px;
  border-radius: 8px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.social-icons a img:hover {
  transform: scale(1.1);
  box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

  </style>
</head>
<body>

<!-- footer.php -->
<div class="footer">
  <div class="footer-container">
    <div class="footer-section logo-section">
      <h2 class="logo">🌸 My Logo</h2>
      <p class="contact-info">Contact Information</p>
      <a href="#">Privacy Policy</a>
    </div>

    <div class="footer-section site-map">
      <h3>📌 SITE MAP</h3>
      <ul>
        <li><a href="#">My Business</a></li>
        <li><a href="#">My Products</a></li>
        <li><a href="#">My Services</a></li>
        <li><a href="#">Gallery</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Support</a></li>
      </ul>
    </div>

    <div class="footer-section subscribe">
      <input type="email" placeholder="Your email for cute updates 💌">
      <button>Subscribe 💖</button>
      <div class="social-icons">
  <a href="https://facebook.com" target="_blank">
    <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" />
  </a>
  <a href="https://twitter.com" target="_blank">
    <img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter" />
  </a>
  <a href="mailto:example@example.com">
    <img src="https://cdn-icons-png.flaticon.com/512/561/561127.png" alt="Email" />
  </a>
  <a href="https://youtube.com" target="_blank">
    <img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" alt="YouTube" />
  </a>
  <a href="https://www.instagram.com" target="_blank">
    <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" />
  </a>
</div>

    </div>
  </div>

  <div class="copyright">
    &copy; <?php echo date("Y"); ?>cheng cute 🌸🐼
  </div>
</div>

</body>
</html>
