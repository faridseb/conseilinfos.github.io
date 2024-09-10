




<?php


$servername = 'localhost' ;
$database = 'informatique';
$username = 'root';
$password = '';

try{
    $bdd = new PDO("mysql:host=$servername; dbname=$database",$username,$password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    

    if(isset($_POST['ok'])){
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['mdp']);
        $mdp2 = sha1($_POST['mdp2']);
        if(!empty($nom) AND !empty($prenom) AND !empty($email) AND !empty($mdp) AND !empty($mdp2) ){

        
        if(strlen($nom) < 20){
            if(strlen($prenom) < 20){
                $reqEmail = $bdd->prepare("SELECT * FROM user WHERE email = ?");
                $reqEmail->execute(
                    array($email)
                );
                if($reqEmail->rowCount() == 0 ){
                    if($mdp == $mdp2){
                        $requete = $bdd->prepare("INSERT INTO user VALUES (0,?,?,?,?)");
                        $requete->execute(
                            array($nom,$prenom,$email,$mdp)
                        );
                        $message = 'INSCRIPTION REUSSI' ;
                    }
                    else{
                        $erreur = 'LES MOTS DE PASSE NE CORRESPONDENT PAS ' ;
                    }
                }
                else{
                    $erreur = 'VOTRE EMAIL EST DEJA UTILISER';
                }
            }
            else{
            $erreur = 'LE PREMOM EST TROP LONG' ;
            }
            
        }
        else{
            $erreur = 'LE MOM EST TROP LONG' ;
        }
    }

    else{
        $erreur = 'VEUILLER REMPLIR TOUS LES CHAMPS' ;
    }

    }

}
catch(PDOException $e){
    echo "ERREUR " . $e->getMessage();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign.css">
    <title>Sign in</title>
</head>
<body>


    <form action="" method="POST">
        <div class="container">
            <h1>CONSEIL SIGN IN</h1>
            <?php
                if(isset($erreur)){
                    echo '<p style= "backdrop-filter: blur(150px); box-shadow: 0 1px 5px black; color: white; margin-top: 10px; padding: 7px; text-align: center; font-weight: bold;">'.$erreur.'</p>';
                }

                if(isset($message)){
                    echo '<p style= "backdrop-filter: blur(150px); box-shadow: 0 1px 5px black; color:green; margin-top: 10px; padding: 7px; text-align: center; font-weight: bold;">'.$message.'</p>';
                }

            ?> 
            <div class="box">
                <label for="">NOM :</label>
                <input type="text" placeholder="NAME" name="nom">
            </div>
            <div class="box">
                <label for="">Prenom :</label>
                <input type="text" placeholder="PRENOM" name="prenom">
            </div>
            <div class="box">
                <label for="">Email :</label>
                <input type="email" placeholder="Email" name="email">
            </div>
            <div class="box">
                <label for="">Mot de passe :</label>
                <input type="password" placeholder="PASSWORD" name="mdp">
            </div>
            <div class="box">
                <label for="">Confirmer le mot de passe :</label>
                <input type="password" placeholder="CONFIRM PASSWORD" name="mdp2">
            </div>
            <div class="box1">
                <input type="submit" value="SIGN IN" name="ok">
            </div>
        </div>
        
    </form>




</body>
</html>


