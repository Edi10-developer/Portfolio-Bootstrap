<?php
// Email Submit
// Note: filter_var() requires PHP >= 5.2.0
if ( isset($_POST['email']) && isset($_POST['name']) && isset($_POST['subject']) && isset($_POST['message']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
 
  // detect & prevent header injections
  $test = "/(content-type|bcc:|cc:|to:)/i";
  foreach ( $_POST as $key => $val ) {
    if ( preg_match( $test, $val ) ) {
      exit;
    }
  }

$password = "password";
$headers = 'From: ' . $_POST["name"] . '<' . $_POST["email"] . '>' . "\r\n" .
    'Reply-To: ' . $_POST["email"] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  //
 
  $mail_status = mail( "contact@ediselimi.com", $_POST['subject'], $_POST['message'], $headers );
 
  //      ^
  //  Replace with your email 
 

  if ($mail_status) { ?>
    <script language="javascript" type="text/javascript" >
      alert('Thank you for the message. We will contact you shortly.');
      window.location = 'index.html';
    </script>
    <?php
  }
  else { ?>
      <script language="javascript" type="text/javascript">
        alert('Message failed. Please, send an email to ronildabeautycorner@gmail.com');
        window.location = 'index.html';
      </script>
      <?php
}
header("Location: ./index.html");

}
?>