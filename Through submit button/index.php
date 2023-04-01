<!--Automatically bind the challenge to a button-->



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
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <!--Add a callback function to handle the token.-->
    <script>
    function onSubmit(token) {
    document.getElementById("contactForm").submit();
    }
    </script>

</head>
<body>
<div class="container">
    <h1>CONTACT FORM</h1>
    <div class="cw-frm">
    <form id="contactForm" method="post" action="">

    <!--status message-->
    <?php if(!empty($statusMsg)){ ?>
        <p class="status-msg <?php echo $status; ?>"><?php echo $statusMsg; ?></p>
    <?php } ?>

    <!-- Form fields -->
    <div class="input-group">
        <input type="text" name="name" value="<?php echo  !empty($postData['name'])?$postData
        ['name']: ''; ?>" placeholder="Your name">
    </div>
    <div class="input-group">	
        <input type="email" name="email" value="<?php echo  !empty($postData['email'])?$postData
        ['email']: ''; ?>" placeholder="Your email">
    </div>
    <div class="input-group">
        <textarea name="message" placeholder="Type message..."><?php echo  !empty($postData['message'])?$postData
        ['message']: ''; ?></textarea>
    </div>

    <input type="hidden" name="submit_frm" value="1">
    
    <!-- Submit button with reCAPTCHA trigger -->
    <!--Add attributes to your html button.-->
    <button class="g-recaptcha" 
        data-sitekey="6LcZ7EwlAAAAAMuXDioiRsVlCISZ1dsWHwKFEODo" 
        data-callback='onSubmit' 
        data-action='submit'>Submit</button>
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