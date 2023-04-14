<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Récupérer les données du formulaire
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $subject = trim($_POST['subject']);
  $message = trim($_POST['message']);

  // Vérifier que tous les champs ont été remplis
  if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    $response = array('success' => false, 'message' => 'Veuillez remplir tous les champs du formulaire.');
    echo json_encode($response);
    exit;
  }

  // Envoyer le message par email
  $to = 'gallojean.emmanuel@gmail.com';
  $subject = 'Nouveau message de '.$name.' : '.$subject;
  $message = 'Nom : '.$name.'<br>Email : '.$email.'<br>Message : '.$message;
  $headers = "From: ".$name." <".$email.">\r\n";
  $headers .= "Reply-To: ".$email."\r\n";
  $headers .= "Content-type: text/html\r\n";

  if (mail($to, $subject, $message, $headers)) {
    $response = array('success' => true, 'message' => 'Votre message a bien été envoyé. Merci !');
    echo json_encode($response);
    exit;
  } else {
    $response = array('success' => false, 'message' => 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer.');
    echo json_encode($response);
    exit;
  }
}
?>
