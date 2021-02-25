
<?php 
// importer page  de connexion md
include('./connexion/connexion_md.php');
include('./connexion/connexion_pat.php');
 ?>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../fontawesome/css/all.css" > 
   
    <style>
      
 *{
    margin:0;
    padding:0;
    box-sizing: border-box;
}
.header{
    width:100%;
    height:70px;
    background-color: #f8f9fb ;
    
}

.interne_header{
    width:92%;
    height: 100%;
    margin:auto;
  
}

.logo_container{
    float:left;
    height:100%;
    padding:10px;
}
.logo_container h2{ 
    float:left;
    font-size:38px;
    color:#111111;
    font-family: 'cursive';
    text-shadow: 1PX 1PX;
}
.logo_container span{
    color:blue;
    font-weight:800;
}
.logo_container .icon {
    display: none;
  }
  
  
.navigation{
    float:right;    
}
.navigation a{
    float:left;
    display:block;
    text-align:center;
    padding:10px;
    position:relative;
    top:16px;
    bottom:16px;
    font-size:18px;
    text-decoration:none;
    margin:0px 7px 0px 7px;
    font-family:'cursive';
    color:#111111 ; 
    cursor:pointer;
}
.navigation a:hover{ 
    color:blue;
}
 

  
  @media screen and (max-width: 800px){
    .logo_container{width:100%;}
    .logo_container a.icon {
       float:right;
       display:block;
       font-size:26px;
       padding-top:10px;
        
      }
    }
    @media screen and (max-width: 800px) {
      .navigation{width:100%;
        background-color:  #white;
        padding-bottom:20px;
    }
      .navigation a {display: none;}
      
    }
    
    @media screen and (max-width: 800px) {
      .navigation.responsive {position: relative;}
      .navigation.responsive a {
        float: none;
        display: block;
        text-align: center;
      }
    }
  /*=======connexion ======*/
  .modal{
display:none;
position: fixed; 
z-index: 1; 
left: 0;
top: 0;
width: 100%; 
height: 100%; 
overflow: auto; 
background: rgba(58, 64, 91, 0.71);
padding-top: 50px;

}
.modal_md{
  display:none;
position: fixed; 
z-index: 1; 
left: 0;
top: 0;
width: 100%; 
height: 100%; 
overflow: auto; 
background: rgba(58, 64, 91, 0.71);
padding-top: 50px;

}
.modal-content{
background-color: #fff;
width:50%;
margin:auto;
}

.tab-nav ul{
    list-style-type: none;
    margin-bottom:5px;
    display:flex;
}

.tab-nav li{
   flex:1;
   text-align:center;
}

.tab-nav li a{
 text-decoration:none;
 color: #3A405B;
 padding: 20px;
 background-color: #E4E7EF;
 margin: 0;
 display:block;
 font-size: 18px;
 cursor:pointer;
}

.nav-content{
    text-align:center;
    padding:30px 50px;
   
}

.nav-content h3{
    font-size: 23px;
    color: #3B55E6;
    font-weight: bold;
    margin-top: 20px;
    margin-bottom: 10px;
    
    
}
.nav-content p{
    font-size: 17px;
    margin: 15px 0 17px;
    color:#262d37;
}

.nav-content a{
  text-decoration:none;
  font-size:16px;
}

 .form-control {
    display:block;
    height:36px;
    margin-top:6px;
    margin-bottom:16px;
    width:100%;
    padding:6px 12px;
    font-size:16px;
    color:#555;
    resize:vertical;
    box-sizing: border-box;
    border:1px solid #ccc;
    border-radius:4px;
 }

 .form-control :focus{
    box-shadow:  0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
 }

 input[type=password] {
   width: 100%;
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
    z-index:2;
    color:lightblue;
    height:36px;
    border:1px solid #ccc;
    border-left:none;
    border-top-right-radius:4px;
    border-bottom-right-radius:4px;
}


 label{
     color:#3A405B;
     display:block;
     margin-bottom:20px;
     text-align:left;
     padding:5px;
     text-transform: uppercase;
     font-weight: normal;
}
 
 input[type=checkbox]{
     margin:4px;
     
 }
 .remember-password{
     text-decoration:none;
     color: #000; 
 }

  .btn-connexion{
    background-color: #4BE1AB;
    display:block;
    width:100%;
    padding:12px 20px;
    border-radius: 4px;
    margin-top:5px;
    color:#fff;
    font-size:18px;
    cursor:pointer;
    text-align:center;
    border:none;
 }
 .btn-connexion :hover{
    background-color: #398439;
 }

 .div-password{
      display:flex;
      flex-direction:row;
  }
 
    </style>
</head>
<body>

    <div class="header"> 
      <div class="interne_header"> 
          <div class="logo_container">
            <h2>My<span>Health</span></h2>
          <a href="javascript:void(0);" class="icon" onclick="myFunction()">
           <i class="fa fa-bars"></i></a>
          </div>
          <div class="navigation" id="mynav">
           <a href="index.php" >Accueil</a> 
           <a href="contact.php">Contact</a>
           <a href="a_propos.php">A propos</a>

           <?php if (isset($_SESSION['id']) == true)
             {
           ?>
            <a href="./patient/mon_compte.php" ><i class="fa fa-user"></i> connexion</a> 
           <?php 
             }
           else
            {
           ?>
             <a  onclick="document.getElementById('modal').style.display='block'" ><i class="fa fa-user"></i> connexion</a>  
           <?php } ?>
        
            <a  class="btn-medecin" onclick="document.getElementById('modal_md').style.display='block'" ><i class="fa fa-user-md"></i> Espace medecin</a>  
         
          
             
          </div>
       </div>
   </div>

   <!-- modal connexion -->
   <div  id="modal" class="modal">
     <div class="modal-content">
  
      
       <div class="nav-content">
           <div class="tabcontent" >
              <h3>Connexion</h3>
            <p> Identifiez-vous pour accéder à votre compte</p>
            <form action="./connexion/connexion_pat.php" method="POST">
                <input type="email" class="form-control" placeholder="Email" name="email"  required="">

                <div class="div-password">
                <input id ="password" type="password" class="form-control" name="password" placeholder="Mot de passe" required="">
                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>

                <label>
                 <input type="checkbox" id="remember" name="remember" > Se souvenir de moi sur cet appareil                       
                </label>
                <a href="" class="remember-password">Mot de passe oublié ?</a>
                <button  name="formconnexionpatient" class="btn  btn-connexion ">Accéder à mon compte</button>
            </form>  
           </div>
           
            <p>Vous n'avez pas de compte? <br>
            <a href="./patient/inscription.php">S'inscrire</a></p>

       </div>
      
       
     
      </div>
    </div>


    <!-- modal medecin -->
    <div class="modal_md" id="modal_md"> 
      <div class="modal-content">
    <div class="nav-content" >
              <h3>Connexion medecin</h3>
            <p> Identifiez-vous pour accéder à votre compte</p>

            <form action="./connexion/connexion_md.php" method="POST">
                <input type="email" class="form-control" placeholder="Email" name="email"  required>
               
                
                <div class="div-password">
                <input id ="password_medecin" type="password" class="form-control" name="password" placeholder="Mot de passe" required="">
                <span toggle="#password_medecin" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                
                <label >
                 <input type="checkbox" id="remember" name="remember" > Se souvenir de moi sur cet appareil                       
                </label>
            
            <a href="" class="remember-password">Mot de passe oublié ?</a>
           <button   name="formconnexionmedecin" class="btn  btn-connexion ">Accéder à mon compte</button>
           
            </form>  
           </div>
            
           </div>
    </div>






    <!-- script pour screen media -->
<script>
function myFunction() {
  var x = document.getElementById("mynav");
  if (x.className === "navigation") {
    x.className += " responsive";
  } else {
    x.className = "navigation";
  }
}
</script>
 <!-- pour le modal -->
 <script>
  var modal = document.getElementById('modal');
  var modal_md = document.getElementById('modal_md');
 
   window.onclick = function(event){
     if(event.target == modal){
       modal.style.display= 'none';
     }
     if(event.target == modal_md){
       modal_md.style.display= 'none';
     }
   }

   </script>
 
 
     <script src="./js/jquery-3.5.1.js"><script>
     <script src="./js/jquery.min.js"></script>
     

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
