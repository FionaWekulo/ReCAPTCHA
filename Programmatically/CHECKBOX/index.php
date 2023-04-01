<!--Programmatically invoke the challenge-->



<?php 
//form submission script
include_once './submit.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrating google recaptcha  v3</title>

    <!--style sheet link-->
    <link rel="stylesheet" href="style.css"/>

    <!-- google recaptcha javascript API library-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    
</head>
<body>
<div class="container">
    <h1>CONTACT FORM</h1>
    <div class="cw-frm">
    <form id="contactForm" method="post" action="">


    <!-- Status message -->
    <?php if(!empty($statusMsg)){ ?>
    <div class="status-msg <?php echo $status; ?>"><?php echo $statusMsg; ?></div>
    <?php } ?>


    <!-- Form fields -->
    <div class="input-group">
    <label for="subject">Full name</label>

        <input type="text" name="name" value="<?php echo  !empty($postData['name'])?$postData
        ['name']: ''; ?>" placeholder="Your name">
    </div>
    <div class="input-group">
    <label for="subject">Email address</label>
	
        <input type="email" name="email" value="<?php echo  !empty($postData['email'])?$postData
        ['email']: ''; ?>" placeholder="Your email">
    </div>
    <div class="input-group">
        <label for="subject">Subject</label>
        <input type="text" name="subject" placeholder="Enter subject" value="<?php echo !empty($postData['subject'])?$postData['subject']:''; ?>" required="">
    </div>
    <div class="input-group">
    <label for="subject">Message</label>

        <textarea name="message" placeholder="Type message..."><?php echo  !empty($postData['message'])?$postData
        ['message']: ''; ?></textarea>
    </div>
    <div class="form-input">
        <!-- Google reCAPTCHA box -->
        <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
    </div>
    <input type="submit" name="submit" class="btn" value="Submit">
</form>
<div class="footer">
    <p>
        &copy; 2023 fionawekulo . All rights reserved | Design by
        <a href="http://github.com/FionaWekulo" target="_blank">FionaWekulo</a>
    </p>
</div>
</div>
</div>
</body>
</html>