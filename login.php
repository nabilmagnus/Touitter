<?php

session_start();

include('includes/functions.php');

include('includes/constants.php');

require('config/database.php');

require_once "models/TouitosManager.php";


//Si le formulaire a ete soumis

if (isset($_POST['login'])) {
    extract($_POST);
    if (not_empty(['identifiant', 'motPasse'])) {

//        /*
//                    $identifiant = $_POST['identifiant'];
//                    $motPasse = $_POST['motPasse'];
//                    $id=$_POST['id'];
//                    $_SESSION['ident']=$identifiant;
//                    $active = $_POST['active'];
//        */
//
//        $q = $db->prepare("SELECT id FROM Touitos WHERE pseudonyme = :identifiant AND motPasse = :motPasse AND active='0'");
//
//
//        $q->execute([
//            ':identifiant' => $identifiant,
//            ':motPasse' => sha1($motPasse)
//        ]);
//
//        $userHasBeenFound = $q->rowCount();
//
//        if ($userHasBeenFound == 0) {
//
//        ///    $user = $q->fetch( );
//      //      die(var_dump($user));
////                $user->id;
////                print_r($user);
////            die($user->id);
//
////      $_SESSION['user_id'] =$user->id;
//
//
//            //                 redirect('profil.php');
//
//            header('Location:/profil.php');
//
//            exit();
//
        $touitosManager = new TouitosManager($db);
        if ($user = $touitosManager->login($identifiant, sha1($motPasse))) {
            $_SESSION["touitos"] = $user;
            header('Location:/profil.php');

            exit();

        } else {
            set_flash("Combinaison du pseudonyme et du mot de passe incorrect ! ", 'danger');
            save_input_data();
        }
    }

} else {
    clear_input_data();
}


?>

<?php require('views/login.view.php'); ?>