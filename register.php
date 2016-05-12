<?php

session_start();

require('includes/functions.php');

require('config/database.php');

require('includes/constants.php');



//Si le formulaire a ete soumis

if(isset($_POST['register'])) {

//si tout les champs on été remplis
    if (not_empty(['pseudonyme', 'email', 'motPasse', 'motPasse_confirm', 'statut'])) {


        $errors = []; //Tableau contenant l'ensemble des erreurs

        extract($_POST);

        $pseudonyme = $_POST['pseudonyme'];
        $email = $_POST['email'];
        $motPasse = $_POST['motPasse'];
        $motPasse_confirm = $_POST['motPasse_confirm'];
        $statut = $_POST['statut'];


        if (mb_strlen($pseudonyme) < 8) {
            $errors[] = "Pseudonyme trop court ! ";
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Adresse email invalide !";
        }


        if (mb_strlen($motPasse) < 6) {
            $errors[] = "Mot de passe est trop court ! ";
        } else {

            if ($motPasse != $motPasse_confirm) {
                $errors[] = "Les deux mots de passe ne concordent pas !";
            }
        }

        if (is_already_in_use('pseudonyme', $pseudonyme, 'Touitos')) {
            $errors[] = "pseudonyme déja utilisé !";
        };


        if (is_already_in_use('email', $email, 'Touitos')) {
            $errors[] = "adresse E-m@il déja utilisé !";
        };

        if (count($errors) == 0) {

            // Enrgistrement de l'utilisateur

            //Message de bienvenus

            //Rédirection vers la page de profil

            //Envoie mail d'activation

            $to = $email;
            $subject = WEBSITE_NAME . " - ACTIVATION DE COMPTE ";
            $motPasse=sha1($motPasse);
            $token = sha1($pseudonyme.$email.$motPasse);

            ob_start(); // garder les informations dans la memoire Tempo
            require_once('templates/email/activation.tmpl.php');
            $content = ob_get_clean();

            $headers = 'MIME-version: 1.0' . "\r\n";

            $headers = 'content-type: text/html ; charset=iso-8859-1' . "\r\n";

            mail($to, $subject, $content, $headers);

            set_flash("Mail d'activation envoyer avec succes !", 'succes');

//            redirect('index.php');

           header('Location: index.php');

            $req = $db->prepare('INSERT INTO Touitos (pseudonyme, email, motPasse, statut) VALUES (:pseudonyme, :email, :motPasse, :statut)');
            $req->execute(array(
                'pseudonyme' => $pseudonyme,
                'email' => $email,
                'motPasse' => $motPasse,
                'statut' => $statut
            ));

        }

    } else {

        $errors[] = "Veuillez remplir tout les champs ! ";
        save_input_data();

    }
}

?>

<?php require('views/register.view.php'); ?>