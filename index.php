<?php 

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre','root','');

if(isset($_POST['forminscription'])) 
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = $_POST['mdp'];
    $mdp2 = $_POST['mdp2'];   

    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
    {

        $pseudolength = strlen($pseudo);
        if ($pseudolength <= 255)
        {
            if($mail == $mail2)
            { 
                if(filter_var($mail,FILTER_VALIDATE_EMAIL))
                {
                    $reqmail = $bdd->prepare("SELECT * FROM membre WHERE mail = ?");
                    $reqmail->execute(array($mail));
                    $mailexist = $reqmail->rowCount();
                    if($mailexist == 0)
                    {
                        if($mdp == $mdp2)
                        {
                            $mdpcrypt = password_hash($mdp,PASSWORD_BCRYPT );
                            $insertmbr = $bdd->prepare("INSERT INTO membre(pseudo,mail,`mot de passe`) VALUES(?, ? , ? )");
                            $insertmbr ->execute(array($pseudo, $mail, $mdpcrypt));
                            $erreur = "votre compte a bien été créé";
                        }
                        else
                        {
                            $erreur = "Vos mots de passe ne correspondent pas";
                        }
                    }
                    else    
                    {
                        $erreur = "Adresse mail deja utilisée ";
                    }
                }
                else
                {
                    $erreur = "Votre adresse mail n'est pas valide";
                }
            }
            else
            {
                $erreur = "Vos adresses ne corespondent pas";
            }
        }
        else
        {
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractères";
        }
    } else {
        $erreur = "Tous les champs doivent etre complétés";
    }
}

?>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="div" align="center">
             <h2>Inscription</h2><br>
            <form method="POST" action="">
                <table>
                    <tr>
                        <td>
                             <label for="pseudo">Pseudo</label>
                        </td>
                        <td>
                            <input type="text"placeholder="votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo;}?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="mail">Mail</label>
                        </td>
                        <td>
                            <input type="mail"placeholder="votre mail" id="mail" name="mail" value="<?php if(isset($pseudo)) { echo $mail;}?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="mail2">Confirmation du mail</label>
                        </td>
                        <td>
                            <input type="mail"placeholder="confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $pseudo;}?>"/>
                        </td>
                    </tr>   
                        <td>
                            <label for="mdp">Mot de passe</label>
                        </td>
                        <td>
                            <input type="password"placeholder="votre mot de passe" id="mdp" name="mdp">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="mdp2">Confirmation du mot de passe</label>
                        </td>
                        <td>
                            <input type="password"placeholder="confirmez votre mdp" id="mdp2" name="mdp2">
                        </td>
                    </tr>       
                </table> <br><br>
                <input type="submit" value="Valider" name="forminscription"> 
            </form>
            <?php 
            if (isset($erreur))
            {
                echo '<font color="red">'.$erreur."</font>";
            }
            ?>
        </div>
    </body>
</html>