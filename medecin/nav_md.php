

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../fontawesome/css/all.css" >
    <style>

 .nav_connexion{
     background-color:#3A405B;
 }

 .container-nav{
     display:flex;
     flex-direction:row;
     height:60px;
  }
  
 .col-nav{
   flex:1;
  }
   
  .logo-col{
   margin:7px;
   text-align:center;
  }
  
  .logo-col a{
    text-decoration:none;
    color:#FFFFFF;
    font: 36px 'cursive';
    font-weight:bold;
    text-shadow: 1PX 1PX;
    padding:5px 12px;
  }



.logo-col span{
    color:blue;
    font-weight:800;
}
  .salut-col{ 
    padding: 0px 20px;
  }
  .salut-col p{
    font:18px "Montressat",sans-serif;
      color:white ;
  }

  .btn-container{
   display:flex;
   flex-direction:row;
   float:right;
   margin-right:10px;
  
  }

   .gestion_rdv{ 
       border-left:2px groove white;
       border-right:2px groove white;
      }

    .btn{
      background-color:#3A405B;
       color:white;
       font:18px "Montressat",sans-serif;
       border:none;
       cursor: pointer;
       text-align:center;
       padding:19px 30px;
      
   }

   

.dropdown {
  flex-grow:1;
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #ddd;
  width:200px;
  overflow: auto;
  z-index: 1;
}

.dropdown-content a {
  color: black;
  font:14px "Montserrat",sans-serif;
  padding: 16px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ffd;}

.show {display: block;}
 
</style>
</head>
<body>
<nav class="nav_connexion">
  <div class="container-nav">

                <div class="col-nav">
                      <div class="logo-col">
                         <a >  My<span>Health</span> </a>     
                     </div>
                </div>

                <div class="col-nav">
                     <div class="salut-col" >
                         <p>Bonjour Dr. <?php echo $nom; ?> </p>
                     </div>
                 </div>

               <div class="col-nav">
                  <div class="btn-container">
                     <div  class="gestion_rdv">
                          <a href="gestion_rdv.php"><button class="btn" ><i class="far fa-calendar-plus"></i> Afficher RDV</button></a>
                      </div>
 
                      <div class="dropdown col" >
                        <button onclick="functionReglage()" class="btn"> <i class="fas fa-cog"></i> Réglages</button>
                          <div id="myDropdown" class="dropdown-content">
                               <a href="./mon_compte_medecin.php">Mon compte</a>
                               <a href="./reglage_agenda.php">Réglage agenda</a>
                              
                               <a href="../connexion/deconnexion.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                          </div>
                      </div>
                  </div>
                </div>
                  
   </div>
</nav>




<script>

function functionReglage() {
  document.getElementById("myDropdown").classList.toggle("show");
}

//Fermez le menu déroulant si l'utilisateur clique en dehors de celui-ci
window.onclick = function(event) {
  if (!event.target.matches('.btn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script> 
</body>


