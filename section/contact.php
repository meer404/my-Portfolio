<?php
include_once 'admin/config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname   = $_POST['fullname'];
    $email      = $_POST['email'];
    $message    = $_POST['message'];
    $created_at = date("Y-m-d H:i:s");

    $sql = "INSERT INTO contacts (fullname, email, message, created_at) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fullname, $email, $message, $created_at);

    if ($stmt->execute()) {
        $success_message = "✅ Your message has been sent successfully!";
    } else {
        $error_message = "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<article class="contact" data-page="contact">

  <header>
    <h2 class="h2 article-title">Contact</h2>
  </header>

  <section class="mapbox" data-mapbox>
    <figure>
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d64844.70607871934!2d45.33645551105339!3d35.56318096429093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40002c0536d143b1%3A0xf791750d4e215dea!2sSulaymaniyah%2C%20Kurdistan%20Region!5e1!3m2!1sen!2siq!4v1754346259271!5m2!1sen!2siq"
        width="400" height="300" loading="lazy"></iframe>
    </figure>
  </section>

  <section class="contact-form">

    <h3 class="h3 form-title">Contact Form</h3>

    <?php if (!empty($success_message)) { echo "<p style='color:green;'>$success_message</p>"; }?>
    
    <?php if (!empty($success_message)) { echo "<script>alert('✅ Your message has been sent successfully!')</script>"; } ?>
    <?php if (!empty($error_message)) { echo "<p style='color:red;'>$error_message</p>"; } ?>

    <form action="" method="POST" class="form" data-form>

      <div class="input-wrapper">
        <input type="text" name="fullname" class="form-input" placeholder="Full name" required data-form-input>
        <input type="email" name="email" class="form-input" placeholder="Email address" required data-form-input>
      </div>

      <textarea name="message" class="form-input" placeholder="Your Message" required data-form-input></textarea>

      <button class="form-btn" type="submit" data-form-btn>
        <ion-icon name="paper-plane"></ion-icon>
        <span>Send Message</span>
      </button>

    </form>

  </section>

</article>