<?php 

$bdd = new PDO('mysql:localhost;dbname=espace_membre','root','');

if(isset($_POST['forminscription'])) 
{
    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
    {
        echo "Bienvenue" ;
    } else {
        echo "Remplir les champs vide";
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
            <form metode="POST" action="">
                <table>
                    <tr>
                        <td>
                             <label for="pseudo">Pseudo</label>
                        </td>
                        <td>
                            <input type="text"placeholder="votre pseudo" id="pseudo" name="pseudo">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="mail">Mail</label>
                        </td>
                        <td>
                            <input type="mail"placeholder="votre mail" id="mail" name="mail">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="mail2">Confirmation du mail</label>
                        </td>
                        <td>
                            <input type="mail"placeholder="confirmez votre mail" id="mail2" name="mail2">
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
                <input type="submit" value="Valider"> 
            </form>
        </div>
    </body>
</html>