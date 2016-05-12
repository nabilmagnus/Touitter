<?php
/**
 * Created by PhpStorm.
 * User: nabil
 * Date: 08/05/16
 * Time: 18:24
 */
session_start();
require('config/database.php');
require('includes/functions.php');

if(!empty($_GET['p']) &&
    is_already_in_use('pseudonyme', $_GET['p'] , 'Touitos')
  && !empty($_GET['token'])) {

    $pseudonyme = $_GET['p'];
$token = $_GET['token'];

    $q = $db->prepare('SELECT email, motPasse FROM Touitos WHERE pseudonyme = ?');
    $q->execute([$pseudonyme]);

    $data = $q->fetch(PDO::FETCH_OBJ);
    $token_verif = sha1($pseudonyme.$data->email.$data->motPasse);

    if($token == $token_verif){

        $q = $db->prepare("UPDATE Touitos SET active = '1' WHERE Pseudo = ? ");
        $q->execute(['$pseudonyme']);

        redirect('login.php');
    }else{
        set_flash('Jetons de sécurité Invalide !' , 'danger');
        redirect('index.php');
    }

}