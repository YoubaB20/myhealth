
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../fontawesome/css/all.css" >
    <title>Inscription</title>

    <style>
   * body{
       margin:0;
       padding:0;
       background:#f2f5fa;
   }
    .content{
        width:80%;
        margin:auto;
        align-items:center;
        text-align:center;
        
    }

    .erreur{
        color:red; font-size:16px; display:block;
        text-align:center;
    }

    .content h3{
    font-size: 23px;
    color: #3B55E6;
    font-weight: bold;
    margin-top: 20px;
    margin-bottom: 10px;
    }

    .content p{
        font-size: 16px;
        color:#262d37;
    }
    .content a{
        text-decoration:none;
    }

    .form-content{
        width:50%;
       margin:auto;
       padding:10px;
    }

     .form-control {
    display:block;
    height:36px;
    margin-top:6px;
    margin-bottom:15px;
    width: 100%;
    padding:6px 12px;
    font-size:16px;
    color:#555;
    resize:vertical;
    box-sizing: border-box;
    border:1px solid #ccc;
    border-radius:4px;
    background:white;
 }

  input[type=password] {
   
    width: 95%;
    resize:vertical;
    border-right:none;
    border-top-right-radius:0px;
    border-bottom-right-radius:0px;
 }

 .field-icon{
    margin-top:6px;
    margin-bottom:15px;
    background:white;
    padding-top:10px;
    padding-right:4px;
    z-index:2;
    color:lightblue;
    height:24px;
    width:5%;
    border:1px solid #ccc;
    border-left:none;
    border-top-right-radius:4px;
    border-bottom-right-radius:4px;
}

 .form-control :focus{
    box-shadow:  0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
 }
 .btn-row{
     display:flex;
     margin-top:5px;
 }
 
 .btn-connexion{
    background-color: #4BE1AB;
    width:50%;
    padding:12px 20px;
    border-radius: 4px;
    margin:1px;
    color:#fff;
    font-size:18px;
    cursor:pointer;
    text-align:center;
    border:none;
 }
 .btn-annuler{
    background-color: #ee5138;
    width:50%;
    padding:12px 20px;
    border-radius: 4px;
    margin:1px;
    color:#fff;
    font-size:18px;
    cursor:pointer;
    text-align:center;
    border:none;
 }

 .alert{
      border-radius:5px;
      width:30%;
     padding:2px;
      color:white;
      font:16px 'Montserrat',sans-serif;
      background:red;
      opacity:0.8;
      margin:auto;
      margin-top:10px;
      display:flex;
      flex-direction:row;
    }

   .icon-exclamation{
       text-align:center;
       padding-top:2px;
       flex-grow:2;
       font-size:25px;
   }
   .message-erreur{
       flex-grow:3;
       text-align:center;
       padding-right:15px;
   }
    .closebtn{
    float:right;
    font-weight:bold;
    line-height: 20px;
    font-size:27px;
    cursor:pointer;
    padding:10px 3px;
  }

  .div-password{
      display:flex;
      flex-direction:row;
  }
    </style>
</head>
<body>
    
<?php if(isset($_GET['email-existe'])) { ?>
      <div class="alert" >
          <div class="icon-exclamation"><i class="fas fa-exclamation"></i></div>
          <div class="message-erreur"><?php  echo $_GET['email-existe'];   ?></div> 
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
     </div> 
   <?php } ?>


<div class="content" > 
               <h3>Inscrivez-vous !</h3>
               <p>Créez votre propre compte et prener RDV en ligne GRATUITEMENT</p>
        <div class="form-content">
             <form action="../connexion/inscription_pat.php" method="POST" onsubmit="return form_inscription(this)">
                  <input name="nom" id="nom" type="text" class="form-control" placeholder="Nom" required=""  onblur="verifier_nom()" title="Nom comporte au moins 3 caractéres, chiffres et caractéres speciaux exclus.">
                  <span id="nom-erreur" class="erreur" ></span>
                 
                  <input id="prenom" name="prenom"  type="text" class="form-control" placeholder="Prénom" required="" onblur="verifier_prenom()" title="Prenom comporte au moins 3 caractéres, chiffres et caractéres speciaux exclus.">
                  <span id="prenom-erreur"  class="erreur"></span>

                  <input id="birthday" name="date_de_naissance" type="text" class="form-control" placeholder="Date de naissance" onfocus="(this.type='date')"required="" onblur="verifier_birthday()">
                  <span id="birthday-erreur"  class="erreur"></span>

                  <select class="form-control" required="" id="sexe" name="sexe">
                     <option value="" >Sexe </option>
                     <option value="0" >Homme</option>
                     <option value="1">Femme</option>
                  </select>
                  
                  <input id="phone" name="phone" type="text" class="form-control" placeholder="Téléphone" pattern="[0-9]{9}[^a-zA-Z]" required="" onblur="verifier_numero_telephone()" >
                  <span id="phone-erreur" class="erreur" ></span>
                  
                  <input id="email"  name="email" type="email" class="form-control" placeholder="Email" required="" onblur="verifier_email()">
                  <span id="email-erreur" class="erreur" ></span>
                  
                  <div class="div-password">
                  <input id="password" name="password" type="password" class="form-control" placeholder="Mot de passe" required=""  onblur="verifier_password()">
                  <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  </div>
                  <span id="psw-erreur" class="erreur"></span>
                  
                  <div class="div-password">
                  <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Confirmation du mot de passe" required="" onblur="verifier_password_confirmation()">
                  <span toggle="#password_confirmation" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  </div>
                  <span id="psw-conf-erreur" class="erreur"></span>
                  
                <div class="btn-row">
                  <button type="submit" name="forminscription" class="btn  btn-connexion">ENVOYER</button>
                  <button type="reset"  class="btn  btn-annuler" id="reset" onclick="refresh()">Annuler</button>
                 </div>
             </form>
         </div>
            <p> vous avez déja un compte ?<br>
            <a href="../index.php"> Se connecter</a></p>
 </div>
 

<br>
    <script src="../js/controle.js"></script>
    <script src="../js/jquery-3.5.1.js"><script>
     <script src="../js/jquery.min.js"></script>

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
</html>