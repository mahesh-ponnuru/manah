<?php
  class PHP_Email_Form {
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $message;
    public $from_company;
    public $ajax = false;
    public $smtp = array();

    function __construct() {
      $this->errors = [];
    }

    // Add a message to the email
    public function add_message($value, $name, $length = 0) {
      if (empty($value)) {
        $this->errors[] = "The field '$name' is required.";
        return false;
      }

      if ($length && strlen($value) < $length) {
        $this->errors[] = "The field '$name' must be at least $length characters.";
        return false;
      }

      $this->message .= "<strong>$name:</strong> $value<br />";
      return true;
    }

    // Send the email
    public function send() {
      if (count($this->errors) > 0) {
        return json_encode(['error' => implode("<br>", $this->errors)]);
      }

      if ($this->smtp) {
        return $this->send_smtp();
      }

      // Use PHP's built-in mail() function to send the email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
      $headers .= "From: " . $this->from_name . " <" . $this->from_email . ">" . "\r\n";
      $headers .= "Reply-To: " . $this->from_email . "\r\n";
      $headers .= "X-Mailer: PHP/" . phpversion();

      // Send the email
      if (mail($this->to, $this->subject, $this->message, $headers)) {
        return json_encode(['success' => 'Your message has been sent successfully!']);
      } else {
        return json_encode(['error' => 'There was an error sending your message. Please try again later.']);
      }
    }

    // Send the email using SMTP (if enabled)
    private function send_smtp() {
      if (empty($this->smtp['host']) || empty($this->smtp['username']) || empty($this->smtp['password'])) {
        return json_encode(['error' => 'SMTP credentials are missing.']);
      }

      $host = $this->smtp['host'];
      $username = $this->smtp['username'];
      $password = $this->smtp['password'];
      $port = isset($this->smtp['port']) ? $this->smtp['port'] : 587;

      // SMTP connection setup
      $smtp = new PHPMailer(true);
      try {
        $smtp->isSMTP();
        $smtp->Host = $host;
        $smtp->SMTPAuth = true;
        $smtp->Username = $username;
        $smtp->Password = $password;
        $smtp->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $smtp->Port = $port;

        //Recipients
        $smtp->setFrom($this->from_email, $this->from_name);
        $smtp->addAddress($this->to);

        // Content
        $smtp->isHTML(true);
        $smtp->Subject = $this->subject;
        $smtp->Body    = $this->message;

        // Send the email
        $smtp->send();
        return json_encode(['success' => 'Your message has been sent successfully!']);
      } catch (Exception $e) {
        return json_encode(['error' => "Mailer Error: " . $smtp->ErrorInfo]);
      }
    }
  }
?>
