<?php
session_start(); // Démarre la session pour utiliser les messages flash

// --- Paramètres de la base de données (à vérifier et corriger) ---
// Ces valeurs doivent correspondre à votre configuration MySQL (ex: dans PhpMyAdmin ou votre outil de gestion de DB)
$servername = "localhost";
$username = "root"; // Généralement 'root' pour XAMPP/WAMP par défaut
$password = ""; // Généralement vide '' pour XAMPP/WAMP par défaut
$dbname = "mon_site_db"; // Le nom de votre base de données

// Vérifiez si la requête est bien une méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire et nettoyez-les
    $nom = htmlspecialchars(trim($_POST['nom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $objet = htmlspecialchars(trim($_POST['objet']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validation simple côté serveur
    if (empty($nom) || empty($email) || empty($objet) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['form_message'] = "Veuillez remplir tous les champs correctement.";
        $_SESSION['form_message_type'] = "error";
        header("Location: index.php#contact"); // Redirige vers la page avec le formulaire
        exit();
    }

    // --- ENVOI DE L'EMAIL D'ALERTE ---
    // Remplacez 'votre_adresse_email@example.com' par l'adresse où vous voulez recevoir les notifications
    $to_email = "youyoucamara40@gmail.com";
    $subject_email = "Nouvelle soumission de contact VR-Rehab: " . $objet;

    $email_body = "Nom: " . $nom . "\n";
    $email_body .= "Email: " . $email . "\n";
    $email_body .= "Objet: " . $objet . "\n\n";
    $email_body .= "Message:\n" . $message . "\n";

    // En-têtes pour l'email
    $headers_email = "From: " . $nom . " <" . $email . ">\r\n";
    $headers_email .= "Reply-To: " . $email . "\r\n";
    $headers_email .= "MIME-Version: 1.0\r\n";
    $headers_email .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Tente d'envoyer l'email
    $mail_sent = mail($to_email, $subject_email, $email_body, $headers_email);

    // --- ENREGISTREMENT DANS LA BASE DE DONNÉES ---
    $db_success = false;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO contacts (nom, email, objet, message, date_soumission) VALUES (:nom, :email, :objet, :message, NOW())");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':objet', $objet);
        $stmt->bindParam(':message', $message);
        $stmt->execute();

        $db_success = true; // L'enregistrement DB a réussi

    } catch(PDOException $e) {
        // Log l'erreur de base de données pour le débogage, mais ne l'affiche pas à l'utilisateur directement
        error_log("Erreur PDO lors de l'enregistrement du contact: " . $e->getMessage());
        // L'erreur de connexion '[HY000] (2002) No such file or directory' vient de là
        // L'erreur d'accès '[1045] Access denied' vient aussi de là
    } finally {
        $conn = null; // Ferme la connexion DB
    }

    // --- GESTION DES MESSAGES FLASH EN FONCTION DU RÉSULTAT ---
    if ($mail_sent && $db_success) {
        $_SESSION['form_message'] = "Votre message a été envoyé par email et enregistré avec succès !";
        $_SESSION['form_message_type'] = "success";
    } elseif ($mail_sent && !$db_success) {
        $_SESSION['form_message'] = "Votre message a été envoyé par email, mais une erreur est survenue lors de l'enregistrement.";
        $_SESSION['form_message_type'] = "warning"; // Nouveau type de message pour avertissement
    } elseif (!$mail_sent && $db_success) {
        $_SESSION['form_message'] = "Votre message a été enregistré avec succès, mais une erreur est survenue lors de l'envoi de l'email d'alerte.";
        $_SESSION['form_message_type'] = "warning";
    } else { // Ni email envoyé ni DB enregistrée
        $_SESSION['form_message'] = "Désolé, une erreur est survenue. Votre message n'a pu être ni envoyé ni enregistré.";
        $_SESSION['form_message_type'] = "error";
    }

    // Redirige toujours l'utilisateur vers la page d'accueil avec le formulaire
    header("Location: index.php#contact");
    exit();

} else {
    // Si quelqu'un tente d'accéder directement à process_form.php sans POST
    header("Location: index.php");
    exit();
}
?>