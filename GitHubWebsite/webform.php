
	
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyatt Griffin</title>
	 <script src="https://www.google.com/recaptcha/api.js"></script>
    <link rel="stylesheet" href="webform.css" media="all">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
    <script src="main.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body >
	<div class="w3-top">
            <div class="w3-bar w3-black w3-card w3-left-align w3-large">
              <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red"
                href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
              <a href="link here" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
              <a href="link here" target='_blank'
                class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">link 2</a>
              <a target='_blank' href="link here"
                class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 3</a>
              <a href="link here" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-white">Link 4</a>
            </div>
	 <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="/webform.php" class="w3-bar-item w3-button w3-padding-large">Contact me</a>
	  <a href="/index.html"  target='_blank' class="w3-bar-item w3-button w3-padding-large">Link 1</a>
    <a href="link here"  target='_blank' class="w3-bar-item w3-button w3-padding-large">Link 2</a>
    <a href="your linke here" target='_blank' class="w3-bar-item w3-button w3-padding-large">link 3</a>
	  <a href="/webform.php" class="w3-bar-item w3-button w3-padding-large">link 4</a>
  </div>
</div>
	<?php
// Checks if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => 'your secret captcha key here',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        echo '<p>Please go back and make sure you check the security CAPTCHA box.</p><br>';
    } else {
        // If CAPTCHA is successfully completed...
		
    $message_sent = false;
    if(isset($_POST['email']) && $_POST['email'] != ''){
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
             //submit the form
			$userName = $_POST['name'];
			$userEmail = $_POST['email'];
			$MessageSubject = $_POST['subject'];
			$message = $_POST['message'];

			$to = "your email";
			$body = "";

			$body .= "From: ".$userName. "\r\n";
			$body .= "Email: ".$userEmail. "\r\n";
			$body .= "Subject: ".$MessageSubject. "\r\n";
			$body .= "Message: ".$message. "\r\n";

			mail($to, $MessageSubject, $body);

			$message_sent = true;
        }
       

    }


        // Paste mail function or whatever else you want to happen here!
        echo '<br><h1>Submission Successful</h1><br>';
    }
} else { ?>
    
<!-- FORM GOES HERE -->
 <?php
    if($message_sent):
        ?> <h1> Thank you, I will reach out to you soon!</h1>
        <?php 
        else:
        ?>
        
    <div class="container">

        <form id='bodyContact' action="webform.php" method="POST" class="form">
			<h1 id='cfh'> Contact Form </h1>
            <div class="form-group">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" tabindex="1" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="your@email.com" tabindex="2" required>
            </div>
            <div class="form-group">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" tabindex="3" required>
            </div>
            <div class="form-group">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" rows="5" cols="50" id="message" name="message" placeholder="Enter Message..." tabindex="4"></textarea>
            </div>
            <div> <form action="?" method="POST">
      <div class="g-recaptcha" data-sitekey="your captcha public key"></div>
      <br/>
      <input type="submit" value="Submit">
    </form>

            </div>
        </form>
    </div>
    <?php
    endif;
    ?>

<?php } ?>
   
</body>

</html>
