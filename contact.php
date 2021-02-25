<?php  session_start();  ?>

<?php
require ('./connexion/con_db.php');

//recuperer les donnees dans la db 
$user = $bdd->prepare("SELECT * FROM medecin ");
$user->execute();
$userinfo = $user->fetch();


$email =$userinfo['email'];
$adress = $userinfo['adress'];
$telephone = $userinfo['telephone'];


?>
<?php 
  /*
     if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['form_contact']))
     { 
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $telephone = $_POST['phone'];
        $message = $_POST['message'];

         $mailTo = "mmeh6201@gmail.com";
         $headers = "From: ".$email;
         $txt = "Vous avez recieve un mail de ".$nom.".\n\n".$message;

        mail($mailTo,$message,$txt,$headers);
     }
*/

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style_page_contact.css" >
    <link rel="stylesheet" href="../../fontawesome/css/all.css" >
    
    
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>

    <style>
    .erreur{
        color:red; font-size:16px; display:block;
        line-height:1.4;
        text-align:center;
    }

      .alert{
      border-radius:5px;
      width:30%;
      padding:18px;
      text-align:center;
      color:white;
      font:18px 'Montserrat',sans-serif;
      background:#4CAF50;
      opacity:0.5;
      margin:auto;
      margin-bottom:5px;
    }

  .closebtn{
    float:right;
    font-weight:bold;
    line-height: 20px;
    font-size:22px;
    cursor:pointer;
    transition: 0.3s;
  }
    </style>
    
</head>
<body>
<?php 
 require './inc/header.php'; 
 ?>

<div id="contact" class="contact-page">

<?php if(isset($_POST['form_contact'])) { ?>
      <div class="alert" >
          <i class="fas fa-check"></i> <?php  echo " Message bien reçu ";  ?>
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
     </div> 
    <?php } ?>

  		<h1>Contactez nous </h1>
  	<div class='row'>
       <div class="col address">
           <address>
               <ul>
                <li><i class="fa fa-clock"></i> Du Samedi au Jeudi de 8h à 19h</li>
                <li><i class="fa fa-map-marker"></i> <?php echo $adress; ?></li>
                <li><i class="fa fa-phone"></i> <span class="ar-text"><?php echo $telephone; ?></span></li>
                <li><i class="fa fa-envelope"></i> <span class="ar-text"><?php echo $email; ?></span></li>
               </ul>
           </address>

           </div>

    <div class="col formulaire">
        <form action="" method="POST" onsubmit="return form_contact(this) ">
        <label for="nom">Nom  </label><input  name="nom" type="text" id="nom" required onblur="verifier_nom()">
        <span id="nom-erreur" class="erreur" ></span>
       
        <label for="prenom">Prenom</label><input  name="prenom" type="text" id="prenom" required onblur="verifier_prenom()">
        <span id="prenom-erreur"  class="erreur"></span>
       
        <label for="email">Email</label><input  name="email" type="email" id="email" required onblur="verifier_email()">
        <span id="email-erreur" class="erreur" ></span>

        <label for="phone">Téléphone</label><input  name="phone" type="text" id="phone" pattern="[0-9]{10}" required onblur="verifier_numero_telephone()">
        <span id="phone-erreur" class="erreur" ></span>

        <label for="message">VOTRE MESSAGE</label>
        <textarea rows="10" name="message" cols="50" id="message" required onblur="verifier_message()">
        </textarea>
        <span id="message-erreur" class="erreur" ></span>
        <input type="submit" name="form_contact" value="Envoyer" >
        </form>
    </div>
       </div>
    </div>
  	  
</div>
  <?php include'./inc/footer.php'; ?>

   <script src="./js/controle.js"></script>
</body>
</html>
 