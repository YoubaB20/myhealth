<?php 
session_start();
// importer page  de connexion md
include('../connexion/connexion_md.php');

 ?>
<?php 
    if(isset($_SESSION['id']))
    {
      
      //recuperer les donnees dans la db 
      $user = $bdd->prepare("SELECT * FROM medecin WHERE id = ?");
      $user->execute(array($_SESSION['id']));
      $userinfo = $user->fetch();
    
      $nom = $userinfo['nom'];
      $prenom = $userinfo['prenom'];
      $email =$userinfo['email'];
     
      $specialite = $userinfo['specialite'];
      $adress = $userinfo['adress'];
      $telephone = $userinfo['telephone'];
      

   
 ?>
  
    
<?php require "nav_md.php" ?>

 <head>
  <link rel="stylesheet" href="../css/style_medecin.css">
  <style>
    body{
   margin:0;
   padding:0;
}


.erreur{
        color:red; font-size:16px; display:block;
        line-height:1.4;
    }

    .alert{
      border-radius:5px;
      width:30%;
      padding:18px;
      text-align:center;
      color:white;
      font:18px 'Montserrat',sans-serif;
      background:#4CAF50;
      opacity:0.7;
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
    <div class="col profil" style="flex-grow:1">
      <h3> <i class="fa fa-user-md"></i> Mon espace</h3>
      <aside>
           <div class="text-center">
		    <a class="profile-image"><img src="../img/1.png" alt=""></a>
	       </div>

	   <div class="info">
		<h3><a class="nom">Dr. Nasser Eddine DAHMANE <br> 	</a></h3>
		<p class="speciality"><strong>Médecine générale, Télémédecine</strong> </p>	
	   </div>
	  <address>
		<p><strong><?php echo $adress; ?></strong></p>
		<p><?php echo $telephone; ?></p>
		<p><?php echo $email; ?></p>
	  </address>
      </aside>
 
     </div>
      
    <div class="col info" style="flex-grow:4">
         <h3>Informations personnelles</h3>
         <hr class="ligne">
       <form id="form" class="form" method="POST" action="" onsubmit="return form_medecin_compte(this) ">
        <!--<div class="form-row">-->
            
        <div class="col-form">
        <div class="form-row">
           <div class="form-group colun">
             <label for="name">Nom  </label>
             <input readonly name="name" type="text" id="name" value="<?php echo $nom ?>">
           </div>
           <div class="form-group colun">
             <label for="prenom">Prenom</label>
             <input readonly name="prenom" type="text" id="prenom" value="<?php echo $prenom?>">
           </div>
        </div>
        </div>

        <div class="col-form">
        <div class="form-row">
           <div class="form-group colun">
             <label for="prenom">Sexe</label>
             <input readonly name="sexe" type="text" id="sexe" value="Homme">
           </div>
        
          <div class="form-group colun">
           <label for="specialite">Spécialités</label>
           <input readonly type="text" id="specialite" value="<?php echo $specialite ?>">
          </div>
        </div>
        </div> 


        <h4> Changer l'adresse ou téléphone </h4>
        <div class="col-form">
        <div class="form-row">
          <div class="form-group colun">
           <label for="adress">Adresse de l'etablissement</label>
           <input name="adress" type="text" id="adress" value="<?php echo $adress ?>" onblur="verifier_adress()" title="au moins 3 caractéres ">
           <span id="adress-erreur" class="erreur" ></span>
          </div>
       
          <div class="form-group colun">
            <label for="tel">Téléphone </label>
            <input  name="phone" type="text" id="phone" value="<?php echo $telephone ?>" onblur="verifier_numero_telephone()">
            <span id="phone-erreur" class="erreur" ></span>
          </div>
        </div>
        </div>

          <hr class="ligne">
                     
        <h4> Changer l'email </h4>
        <div class="col-form">
        <div class="form-row">
             <div class="form-group colun" >
               <label for="email">Email</label>
               <input type="email" name="email" id="email" value="<?php echo $email ?>" onblur="verifier_email()">
               <span id="email-erreur" class="erreur" ></span>
             </div>
             <div class="form-group colun" >
             <!-- vide -->
             </div>
        </div>
        </div>   
    

        <h4> Changer mot de passe </h4>
        <div class="col-form">
        <div class="form-row">
            <div class="form-group colun" >
            <div class="div-password">
                <input type="password" name="psw" id="password" onblur="verifier_password()" placeholder="Mot de passe" title="changer mot de passe">
                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
                <span id="psw-erreur" class="erreur"></span>
             </div>
             <div class="form-group colun" >
             <div class="div-password">
                <input type="password" name="psw2" id="password_confirmation" onblur="verifier_password_confirmation()"placeholder="Confirmer mot de passe" title="confirmer le mot de passe">
                <span toggle="#password_confirmation" class="fa fa-fw fa-eye field-icon toggle-password"></span>
              </div>  
                <span id="psw-conf-erreur" class="erreur"></span>
             </div>
        </div>
        </div>

               <hr class="ligne">
                 <div class="btn-sauvegarder">
                  <button name="formmodifiermedecin" id="disable"> Sauvegarder</button>
                 </div>
          
        </form>
        
    </div>
    </div>
</div>
  <br><br><br>
  <script>
  
 
</script>
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

  </body>
  <?php 
   
    }
    else
    {
      header('location: ../index.php');
    }
    ?>