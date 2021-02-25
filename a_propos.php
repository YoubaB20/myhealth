<?php 
session_start();
?>

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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/propos.css">
    <title>A propos </title>
</head>

<body>
<?php 
 require './inc/header.php'; 
 ?> 
 <header id="showimage">
 
  <h1> My<span>Health</span> c'est un système de réservation <br> de rendez-vous en ligne <br> chez <span>Dr. Dahmane</span> </h1>
   
 
 </header>
 <div class="row-top">
        <div class="col-photos">
               <div class="image">
                  <img src="./img/cabinet-medical.jpg" alt="cabinet medical" >
               </div>
        </div>
         <div class="col-text">
             <h3> Bienvenue chez MyHealth</h3>
             <h2>Meilleurs soins pour votre <br> Bonne santé</h2>
             <div class="text">
             <p> MyHealth est un service Web de prise de RDV en ligne chez Dr Dahmane.
                 Vous aide a prendre RDV sans vous deplacez .
                Pour les patients, un simple clic vous pourrez réserver un RDV .
                Une fois le rendez-vous fixé, le medecin vous envoie un SMS ou un mail 
                de rappel 24h préalablement à l’échéance. 
             </p>
             </div>
         </div>
 </div>

 <div class="row-bottom">
        <h2> A propos de Doctor Dahmane</h2>
           
        
         <div class="col-information">
           <aside class="aside">
               <div class="profile-image">
                   <img src="./img/1.png" alt="Dr. Nasser eddine">
               </div>
               <div class="nom_medecin">
                     <p> Dr. Nasser Eddine Dahmane </p>   
                </div>
                <div class ="speciality">
                    <p> - Médecine générale <br> - Télémédecine </p>
                </div>

           </aside>
           <aside class="aside-add">
                <h1> Adresse & Contact</h1>
                <div class="adresse">
                <p> <i class="fa fa-map-marker"></i>  <?php echo $adress; ?></p>
                </div>
                <div class="adresse-email">
                <p><i class="fa fa-envelope"></i><?php echo $email; ?></p>
                </div>
                <div class="num-telephone">
                <p> <i class="fa fa-phone"></i> <?php  echo $telephone; ?></p>
                </div>
               
           </aside>
           <aside class="aside">
              
               <div class="nom">
                 <p>Dr. Nasser eddine</p>
               </div>
	          <div class="content">
                 <p> Disponible pour la télémédecine à titre de bénévolat ! 
                     Appelez moi au numéro  selon les disponibilités
                     précisées sur <a href="contact.php"> la page contact </a> . Merci 
                 </p>
              </div>
         
          </aside>

         </div>
 </div>






<?php include'./inc/footer.php'; ?>
</body>
</html>