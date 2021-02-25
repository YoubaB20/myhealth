<?php 
session_start();
// importer page  de connexion patient
include('../connexion/connexion_pat.php');
include('../connexion/inscription_pat.php');

 ?>
   <?php 
      if(isset($_SESSION['id']) )
      {
        
        //recuperer les donnees dans la db 
        $user = $bdd->prepare("SELECT * FROM patient WHERE id = ?");
        $user->execute(array($_SESSION['id']));
        $userinfo = $user->fetch();

       $nom =$userinfo['nom'];
       $prenom =$userinfo['prenom'];
       $email = $userinfo['email'];
       $date_de_naissance =$userinfo['dateDeNaissance'];
       $sexe = $userinfo['sexe'];
       $phone = $userinfo['telephone'];
        
      
       
 
    ?>


<?php require ("nav_pat.php ") ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_patient.css">

  <style>
    body{
    margin:0;
    padding:0;
  }

  .erreur{
        color:red; font-size:16px; display:block;
       
    }
    


    .alert{
      border-radius:5px;
      width:30%;
      padding:18px;
      text-align:center;
      color:white;
      font:18px 'Montserrat',sans-serif;
      background:#4CAF50;
      opacity:0.8;
      margin:auto;
      margin-top:10px;
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
    <?php if(isset($_GET['modifier'])) { ?>
      <div class="alert" >
          <i class="fas fa-check"></i> <?php  echo $_GET['modifier'];   ?>
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
     </div> 
    <?php } ?>

  <div class="row">

      <div class="col profil" style="flex-grow:1;">
         <h3> <i class="fa fa-user"></i> Mon espace</h3>
       <aside>
           <div class="text-center">
		    <a class="profile-image"><img src="../img/avatar.jpg" alt="" ></a>
	       </div>
	       <div class="info">
		    <h3><a class="nom"><?php echo $nom.' '.$prenom; ?> <br> 	</a></h3>
	       </div>
       </aside>

      </div>

      <div class="col info" style="flex-grow:4">
      <h3>Informations personnelles</h3>
      <hr class="ligne">
                                              <!--  onsubmit="return verifier_form(this)" -->
         <form id="form" class="form" method="POST" action=""   onsubmit="return form_modifier_patient(this)"   >
             <div class="col-form">
            <div class="form-row">
              <div class="form-group colun">
                <label for="name">Nom  </label>
                <input  name="nom" type="text" id="nom" required="" title="Nom comporte au moins 3 caractéres, chiffres et caractéres speciaux exclus " value="<?php echo $nom; ?>" onblur="verifier_nom()">
                <span id="nom-erreur" class="erreur" ></span>
              </div>
              <div class="form-group colun">
                <label for="prenom">Prénom </label>
                <input  name="prenom" type="text" id="prenom" required="" title="Prenom comporte au moins 3 caractéres, chiffres et caractéres speciaux exclus " value="<?php echo $prenom; ?>" onblur="verifier_prenom()">
                <span id="prenom-erreur" class="erreur" ></span>
              </div>
              
            </div>
              <hr class="ligne">

              <div class="col-form">
              <div class="form-row">
              <div class="form-group colun">
              <label for="birthday">Date de naissance</label>
               <input type="date" name="birthday" id="birthday" required="" value="<?php echo $date_de_naissance; ?>" onblur="verifier_birthday()">
               <span id="birthday-erreur"  class="erreur"></span>
              </div>
              <div class="form-group colun">
              <label for="sexe">Sexe</label>
              
               <select class="form-control"  id="sexe" name="sexe" >
                <option value="0" <?php if($sexe =="Homme") echo "selected"; ?> > Homme</option>
                 <option value="1" <?php if($sexe =="Femme") echo "selected"; ?> > Femme</option>  
               </select>
              
              </div>
            </div>
            </div>
              
            <hr class="ligne">

            <div class="col-form">
              <div class="form-row">
              <div class="form-group colun">
                <label for="phone">Telephone </label>
                <input onblur="verifier_numero_telephone()" name="phone" type="text" id="phone"  pattern="[0-9]{10}" value="<?php echo $phone; ?>">
                <span id="phone-erreur" class="erreur" ></span>
              </div>
              <div class="form-group colun">
                <label for="email">Email</label>
                <input  name="email" type="email" id="email" required="" value="<?php echo $email; ?>" onblur="verifier_email()">
                <span id="email-erreur" class="erreur" ></span>
              </div>
            </div>
            </div>

              <hr class="ligne">

              <h4>Changer mot de passe </h4>
              <div class="col-form">
              <div class="form-row">
              <div class="form-group colun">
              <div class="div-password">
                <input onblur="verifier_password()" name="password" type="password" id="password"  placeholder="Mot de passe" title="Changer mot de passe" >
                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <span id="psw-erreur" class="erreur"></span>
              </div>
              
              <div class="form-group colun">
              <div class="div-password">
                <input  onblur="verifier_password_confirmation()"  name="password_confirmation" type="password" id="password_confirmation" placeholder="Confirmer mot de passe" title="Confirmer mot de passe" >
                <span toggle="#password_confirmation" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <span id="psw-conf-erreur" class="erreur"></span>
              </div>
            </div>
            
            </div>
           
              <hr class="ligne">
              <div class="col-form">
                  <div class="btn-sauvegarder">
                    <button name="formmodifierpatient" id="disable"> Sauvegarder</button>
                  </div>
                  
              </div>
              
        <form>
        
         </div>
      </div>
  </div>

  
  <script src="../js/controle.js"></script>
     <script src="../js/jquery-3.5.1.js"><script>
     <script src="../js/jquery.min.js"></script>

<script>
  
  
  $(function(){
    $('#disable').prop('disabled', true);
    $('#form :input').on('change', function(){
        $('#disable').prop('disabled',false);
    });
});
</script>

 <script>
 
   $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
       input.attr("type", "text");
    } else {
         input.attr("type", "password");
        }
      });
      
 </script>
 
<br><br><br><br><br>
 </body>
  
 <?php
      }
      else
      {
        header('location: ../index.php');
      }
  ?>