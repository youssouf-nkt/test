<?php
$servername = "localhost";
$username = "root"; // Mettez "root"
$password = ""; // Laissez la chaîne vide "" (pas d'espace à l'intérieur)
$dbname = "mon_site_db";

// Vérifiez si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire et les nettoyer
    $nom = htmlspecialchars(trim($_POST['nom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $objet = htmlspecialchars(trim($_POST['objet']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validation simple côté serveur
    if (empty($nom) || empty($email) || empty($objet) || empty($message)) {
        session_start();
        $_SESSION['form_message'] = "Merci de remplir tous les champs obligatoires.";
        $_SESSION['form_message_type'] = "error";
        header("Location: index.php#contact"); // Redirige vers la page d'accueil avec l'ancre
        exit();
    }

    // Valider l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        session_start();
        $_SESSION['form_message'] = "L'adresse email n'est pas valide.";
        $_SESSION['form_message_type'] = "error";
        header("Location: index.php#contact");
        exit();
    }

    try {
        // Créer une nouvelle connexion PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        // Configurer le mode d'erreur PDO à Exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête SQL pour éviter les injections SQL
        $stmt = $conn->prepare("INSERT INTO contacts (nom, email, objet, message) VALUES (:nom, :email, :objet, :message)");

        // Binder les paramètres
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':objet', $objet);
        $stmt->bindParam(':message', $message);

        // Exécuter la requête
        $stmt->execute();

        // Stocker un message de succès dans la session
        session_start();
        $_SESSION['form_message'] = "Votre message a été envoyé avec succès et enregistré !";
        $_SESSION['form_message_type'] = "success";

        // Rediriger l'utilisateur vers la page d'accueil avec un message de succès
        header("Location: index.php#contact");
        exit();

    } catch (PDOException $e) {
        // En cas d'erreur de base de données
        session_start();
        $_SESSION['form_message'] = "Une erreur est survenue lors de l'enregistrement de votre message : " . $e->getMessage();
        $_SESSION['form_message_type'] = "error";
        header("Location: index.php#contact");
        exit();
    } finally {
        // Fermer la connexion
        $conn = null;
    }
} else {
    // Si la requête n'est pas POST, rediriger vers la page d'accueil
    header("Location: index.php");
    exit();
}
?>