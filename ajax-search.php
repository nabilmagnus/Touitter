<?php

include_once ('config/database.php');

if(isset($_GET['q'])){
    $motclef = $_GET['q'];
    $q = array('motclef'=>'%'.$motclef.'%');
    $sql = 'SELECT pseudonyme,email FROM Touitos WHERE pseudonyme like :motclef or email like :motclef';
    $req = $db->prepare($sql);
    $req->execute($q);
    $count = $req->rowCount();

    if($count){
        while ($result = $req->fetch(PDO::FETCH_OBJ)){
            echo utf8_encode($result->pseudonyme)."<br/>";
        }
    }else{
        echo "<div id='alerteError'>Aucun resultat pour :".$motclef."</div>";
    }
}


?>