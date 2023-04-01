<?php  
  
// Google reCAPTCHA API keys settings  
$secretKey     = '6LcZ7EwlAAAAAAY4bi-Jka9p4d9660yqJ21CPRPm';  
  
// Email settings  
//email address where the contact form submissions should be sent
$recipientEmail = 'fionawekulo@gmail.com';  
  
// Assign default values 
$postData = $valErr = $statusMsg = ''; 
$status = 'error'; 
 
// If the form is submitted 
if(isset($_POST['submit_frm'])){  
    // Retrieve value from the form input fields 
    //If the form has been submitted, the code retrieves the values from the form input fields, 
    //trims whitespace from the values, and performs validation on each field.
    $postData = $_POST;  
    $name = trim($_POST['name']);  
    $email = trim($_POST['email']);  
    $message = trim($_POST['message']);  
  
    // Validate input fields  
    if(empty($name)){  
        $valErr .= 'Please enter your name.<br/>';  
    }  
    if(empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false){  
        $valErr .= 'Please enter a valid email.<br/>';  
    }  
    if(empty($message)){  
        $valErr .= 'Please enter message.<br/>';  
    }  
  
    // Check whether submitted input data is valid  
    //If there are no validation errors, the code validates the reCAPTCHA response using the 
    //Google reCAPTCHA verification API. If the response is valid, the code sends an email to 
    //the recipient email address with the contact form details.
    if(empty($valErr)){  
        // Validate reCAPTCHA response  
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){  
  
            // Google reCAPTCHA verification API Request  
            $api_url = 'https://www.google.com/recaptcha/api/siteverify';  
            $resq_data = array(  
                'secret' => $secretKey,  
                'response' => $_POST['g-recaptcha-response'],  
                'remoteip' => $_SERVER['REMOTE_ADDR']  
            );  
  
            $curlConfig = array(  
                CURLOPT_URL => $api_url,  
                CURLOPT_POST => true,  
                CURLOPT_RETURNTRANSFER => true,  
                CURLOPT_POSTFIELDS => $resq_data  
            );  
  
            $ch = curl_init();  
            curl_setopt_array($ch, $curlConfig);  
            $response = curl_exec($ch);  
            curl_close($ch);  
  
            // Decode JSON data of API response in array  
            $responseData = json_decode($response);  
  
            // If the reCAPTCHA API response is valid  
            if($responseData->success){ 
                // Send email notification to the site admin  
                $to = $recipientEmail;  
                $subject = 'New Contact Request Submitted';  
                $htmlContent = "  
                    <h4>Contact request details</h4>  
                    <p><b>Name: </b>".$name."</p>  
                    <p><b>Email: </b>".$email."</p>  
                    <p><b>Message: </b>".$message."</p>  
                ";  
                  
                // Always set content-type when sending HTML email  
                $headers = "MIME-Version: 1.0" . "\r\n";  
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
                // Sender info header  
                $headers .= 'From:'.$name.' <'.$email.'>' . "\r\n";  
                  
                // Send email  
                @mail($to, $subject, $htmlContent, $headers);  
                  
                $status = 'success';  
                $statusMsg = 'Thank you! Your contact request has been submitted successfully.';  
                $postData = '';  
            }else{  
                //If the reCAPTCHA response is not valid, the code sets the status message to inform the 
                //user that the verification failed. 
                $statusMsg = 'The reCAPTCHA verification failed, please try again.';  
            }  
        }else{  
            $statusMsg = 'Something went wrong, please try again.';  
        }  
    }else{ 
        //If the form was not submitted or there were validation errors, 
            //the code sets the status message accordingly.
             
        $valErr = !empty($valErr)?'<br/>'.trim($valErr, '<br/>'):'';  
        $statusMsg = 'Please fill all the mandatory fields:'.$valErr;  
    }  
}  
  
?>