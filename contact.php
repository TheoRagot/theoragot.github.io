<?php
  if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['adresseMail']) && !empty($_POST['tel']) && !empty($_POST['mess']))
  {
    // Test le code sur un serveur pour voir si tu reçois bien le mail
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['adresseMail'];
    $message = $_POST['mess'];
    $email_to = "theo.ragot12@gmail.com"; // email de ta tante ou de la personne qui doit recevoir le mail

    // c'est pour voir si la boite mail est compatible avec les sauts de ligne
    if(preg_match("#@(hotmail|live|msn).[a-z]{2,4}$#", $email_to)){
        $passage_ligne = "\n";
    }else{
        $passage_ligne = "\r\n";
    }

    $email_subject = "Demande d'information"; // sujet du mail
    $boundary = md5(rand()); // touche pas à ça bg

    function clean_string($string) { // pour nettoyer le message au cas ou y'ai des gros hackeurs
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }

    // remplace le "azazazazaz" par le nom du site
    $headers = "From: \"". "Porte-folio" ."\"<"."site".">" . $passage_ligne;
    $headers.= "Reply-to: \"".$nom."\" <".$email.">" . $passage_ligne;
    $headers.= "MIME-Version: 1.0" . $passage_ligne;
    $headers.= 'Content-Type: multipart/mixed; boundary='.$boundary .' '. $passage_ligne;

    $email_message = '--' . $boundary . $passage_ligne; //Séparateur d'ouverture
    $email_message .= "Content-Type: text/plain; charset='utf-8'" . $passage_ligne; //Type du contenu
    $email_message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne; //Encodage
    // la c'est le contenu du message
    $email_message .= $passage_ligne."Informations :".$passage_ligne."Nom/Prenom : ".$nom." ".$prenom.$passage_ligne."Email : ".$email.$passage_ligne."Message : ".clean_string($message).$passage_ligne;

    // fonction mail pour envoyer le mail, si elle est dans le "if" c'est car elle return un bool
    // donc si elle envoie bien le mail elle return "1" sinon un "0"
    if(mail($email_to,$email_subject, $email_message, $headers)){
      $messageEnvoye = 1; //messageEnvoye sert à afficher ou non le message "Message envoyé"
    } else {
      $messageEnvoye = 0;
    }
  } else {
    $messageEnvoye = 0;
  }
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="style.css">

  </head>
  <body>
    <header class="header headerContact">
      <a href="index.html" class="logoContact" > T.R </a>
    </header>
    <section class="pageContact">
        <div class="ligne">
            <div class=" h1 italique">&lth1&gt</div> 
            <h1> Me Contacter </h1>
            <div class=" h1 italique">&lt/h1&gt</div>
        </div>
        <form class="form"action="contact.php" method="post"> <!-- t'avais oublié l'action et la method -->
            <div class="ligneContact">
                <!-- pense bien à choisir le bon type d'input pour que l'utilisateur soit pas dérangé -->
            <input class="input" type="texte" id="nom" name="nom" placeholder="Nom" value="<?php if(isset($_POST['nom'])){echo $_POST['nom'];}else{echo "";}// si l'utilisateur oubli de mettre une info celle qui sont bonne seront remise automatique dans le formulaire?>">
            <input class="input" type="texte" id="prenom" name="prenom" placeholder="Prénom" value="<?php if(isset($_POST['prenom'])){echo $_POST['prenom'];}else{echo "";} ?>">
            </div>
            <input class="input inputTall" type="email" id="adresseMail" name="adresseMail" placeholder="Adresse Mail" value="<?php if(isset($_POST['adresseMail'])){echo $_POST['adresseMail'];}else{echo "";} ?>">
            <textarea class="input inputVeryTall"name="mess" id="mess" cols="30" rows="10" placeholder="Votre message"><?php if(isset($_POST['mess'])){echo $_POST['mess'];}else{echo "";} ?></textarea>
            <input class="button" type="submit" value="Envoyer">
        </form>
    </section>
    <footer class="footerContact">
            <div class="menu cadre">Me contacter</div>
            <div class="footer">
                <a href="https://www.linkedin.com/in/theo-ragot/">
                    <img src="img/link.png" class="LogoFooter">
                </a>
                <a href="https://github.com/TheoRagot">
                    <img src="img/github.png" class="LogoFooter">
                </a>
            </div>
            <a download class="menu cadre" href="img/CV Théo Ragot.jpg"> Mon Cv</a>
        </footer>
      <div style="display : <?php if($messageEnvoye) {echo "block";}else{echo "none";} ?>">Message envoyé.</div>
      <div style="display : <?php if($messageEnvoye) {echo "none";}else{echo "block";} ?>"></div>
    </div>
  </body>
</html>
