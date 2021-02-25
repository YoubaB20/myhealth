<?php
 session_start(); 
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="./css/style_index.css">
</head>

<body>
<?php require "./inc/header.php"  ?>
   <header id="showimage">
      
     <p class="text1"> Nous prenons soin de votre santé <br> à chaque instant </p> 
   
     <p class="text2"> Prenez <strong>rendez-vous</strong> en ligne <strong> 24h/24 </strong> et  <strong>7j/7 </strong> <br/> 
      C'est innovant, rapide et <strong> gratuit</strong>. </p> 
      <?php if (isset($_SESSION['id']) == true)
      {
          ?>
        
        <a href="./patient/prendre_rdv.php" class="button"> Prendre rdv </a> 
    <?php 
    }
      else
      {
          ?>
        <a  onclick="document.getElementById('modalConnexion').style.display='block'" class="button"> Prendre rdv </a> 
     <?php } ?>
      
    
   </header>

   <div class="container-row">
      
   <div class="steps">
          <p>  “Comment faire ?” Suivez ces étapes :       </p>

       <div class="row">
            <div class="col">
                <article>
                    <header> Première étape</header>
                    <div class="content">
                        <img src="./img/icon_login.jpg" >
                    </div>
                    <footer>  Connectez-vous </footer>
                </article>
           </div>
            <div class="col">
                <article>
                    <header>Deuxième étape </header>
                    <div class="content">
                        <img src="./img/prendre_rdv.png" alt="">
                    </div>
                    <footer> Prendre un RDV</footer>
                </article>
            </div>
            <div class="col">
                <article>
                    <header>Troisème étape </header>
                    <div class="content">
                        <img src="./img/confirmer_rdv.png" alt="">
                    </div>
                    <footer>Confirmer le RDV </footer>
                </article>
            </div> 
        </div>
</div>


   </div>




    <!-- modal connexion -->
    <div  id="modalConnexion" class="modal">
     <div class="modal-content">
  
       <div class="nav-content">
           <div class="tabcontent" >
              <h3>Connexion</h3>
             <p> Identifiez-vous pour accéder à votre compte</p>
            <form action="./connexion/connexion_pat.php" method="POST">
                <input type="email" class="form-control" placeholder="Email" name="email"  required="">

                <div class="div-password">
                <input id ="password_mod_con" type="password" class="form-control" name="password" placeholder="Mot de passe" required="">
                <span toggle="#password_mod_con" class="fa fa-fw fa-eye field-icon toggle-password_mod"></span>
                </div>

                <label>
                 <input type="checkbox" id="remember" name="remember" > Se souvenir de moi sur cet appareil                       
                </label>
            
                <a href="" class="remember-password">Mot de passe oublié ?</a>
                <button  name="formprendreRDV" class="btn  btn-connexion ">Accéder à mon compte</button>
                
            </form>  
           </div>
           
           <p>Vous n'avez pas de compte? <br>
            <a href="./patient/inscription.php">S'inscrire</a></p>

       </div>
      
       
     
      </div>
    </div>


    
 <!-- pour le modal -->
 <script>
  var modalCon = document.getElementById('modalConnexion');
 
  var modal = document.getElementById('modal');

   window.onclick = function(event){
    if(event.target == modal){
       modal.style.display= 'none';
     }

     if(event.target == modalCon){
       modalCon.style.display= 'none';
     }
     
     if(event.target == modal_md){
       modal_md.style.display= 'none';
     }
   }

   </script>
 
 
 <script>
 
   $(".toggle-password_mod").click(function() {

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
<?php require "./inc/footer.php" ?>
</html>