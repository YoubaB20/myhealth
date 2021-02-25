<?php 
session_start();
// importer page  de connexion patient
include('../connexion/connexion_pat.php');
 ?>
   <?php 
      if(isset($_SESSION['id']))
      {
        
        //recuperer les donnees dans la db 
        $user = $bdd->prepare("SELECT * FROM patient WHERE id = ?");
        $user->execute(array($_SESSION['id']));
        $userinfo = $user->fetch();
        
        $nom =$userinfo['nom'];
        $prenom =$userinfo['prenom'];
       
        $user =$bdd->prepare("SELECT date,jour,tranche FROM rdv WHERE id_patient = ?  ");
        $user->execute(array($_SESSION['id']));
        
         $date = array();
         $jours = array();
         $tranches = array();
        // $heuresDebut = array();
        // $heuresFin = array();
        while(  $infordv = $user->fetch())
        {
          // $dt = $infordv['date'];
          // $date[] = date('d/m/Y',strtotime("$dt"));
             $date[] = $infordv['date'];
           
           $jours [] =  $infordv['jour'];
            $tranches [] = $infordv['tranche'];
          //  $heureRdv = $infordv['tranche'];
           // $tranche = explode("-",$heureRdv);
          //  $heureDebut = $tranche[0];
          //  $heureFin = $tranche[1];
         // $heuresDebut [] = $heureDebut;
        //  $heuresFin [] =$heureFin;

        }
        
     
    ?>

<?php
       
       function creer_table($jours,$date,$tranches)
       {
          $numero = 1;
          $date = $date;
          $nbrdate = count($date);
          $jours = $jours;
          $tranches = $tranches;
          //$heuresDebut = $heuresDebut;
         // $heuresFin = $heuresFin;
         $tab ="<table id='myTable'>";
         
         $tab.="<tr>";
            $tab.="<th> Numéro   </th>";
            $tab.="<th> Jour   </th>";
            $tab.="<th> Date   </th>";
            $tab.="<th> Heure  </th>";
            $tab.="<th> Action  </th>";
         $tab.="</tr>";
         
         if( $nbrdate > 0)
         {  
         for($int=0; $int < $nbrdate ;$int++)
         {
            $datefr = date('d/m/Y',strtotime("$date[$int]"));
            $tab.="<tr>";
            $tab.="<td><span class='text'> $numero </span> </td>";
            $tab.="<td><span class='text'> $jours[$int]</span> </td>";
            $tab.="<td><span class='text'> $datefr </span> </td>";
            $tab.="<td><span class='heurerdv'> $tranches[$int] </span></td>";
            $tab.="<td> <a href='?date=".$date[$int]."&heure=".$tranches[$int]."' class='supprimer-rdv' title='Supprimer le rdv !!!' > Supprimer  </a> </td> ";

            $tab.="</tr>";
            $numero++;
         }
      }
      else
      {
         $msg =" Aucun rendez-vous ";
      }
      


         $tab.="</table>";

         if(isset($msg))
         {
          $tab.="<div class='msg-vide'>  $msg </div>";
         }

      return $tab;
       }


   //supprimer un rdv 
     
   if(isset($_GET['date']) AND isset($_GET['heure']))
      {
        $date = $_GET['date'];
        $heure = $_GET['heure'];
        $reqsup = $bdd->prepare("DELETE FROM rdv WHERE date = ? AND tranche = ? ");
        $reqsup->execute(array($date,$heure));
        header('location: mes_rdv.php?supprimer=Supprimé avec succès');
      }
     
    
?>

<?php require ("nav_pat.php ") ?>  

<head>
 <link rel="stylesheet" href="../css/style_patient.css">

  <style>
     body{
    margin:0;
    padding:0;
    
  }
 table {
  border-collapse: collapse;
  width: 85%;
  table-layout:auto;
  border:1px groove lightblue;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

th {
   color:#3A405B;
   font:16px "Montserrat",sans-serif;
   padding:12px ;
   font-weight:bold;
   text-align: center;
   border-bottom:2px groove lightblue;
}
 td {
  text-align: center;
  padding:10px;
 
}

tr:hover {background-color:white;}

.text{
   font:17px 'montserrat',sans-serif;
}

.heurerdv{
   background:#d9d1b9;
   padding:5px 10px;
   border-radius:4px;
   font-weight:bold;
}
 .msg-vide{
   margin-top:15px;
   padding:10px 0px;
   font-size:16px;
   width:85%;
  
 }

 .supprimer-rdv{
    text-decoration:none;
    color:white;
    padding:5px 10px;
    border-radius:4px;
    background:#f60a0a;
 }


 .table-row{
    display:flex;
    height:40px;
  }
.table-col{
    flex:1;
    text-align:left;
    padding-left: 10px;
  }
  .table-row h4{
     
     color:#3A405B;
   font:20px "Montserrat",sans-serif;
   margin:10px 0px;
   text-align:left;
  }
  .table-col input{
    width:70%;
    margin:4px;
    height:30px;
    padding:6px 12px;
    font-size:16px;
    color:#555;
    border:1px solid #ccc;
    border-radius:4px;
    resize:vertical;
    box-sizing: border-box;
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
  
<?php if(isset($_GET['supprimer'])) { ?>
      <div class="alert" >
          <i class="fas fa-check"></i> <?php  echo $_GET['supprimer'];   ?>
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
           <h3>Mes rendez-vous</h3>
           <hr class="ligne">
             
           <div class="table-row">
                        <div class="form-group table-col" style="flex-grow:2">
                        <h4>Afficher la liste par: </h4>
                        </div>
                        
                         <div class="table-col" style="flex-grow:2">
                            <input type="text" placeholder=" Jour "  onkeyup="afficher_par_jour_patient()" id="myJour">
                        </div> 
                        <div class="table-col" style="flex-grow:2">
                            <input type="text" placeholder="Date jj/mm/aaaa "  onkeyup="afficher_par_date_patient()" id="myDate">
                        </div> 
                        <div class="table-col" style="flex-grow:2">

                        </div>      
              
          </div>

          <hr class="ligne">

            <?php echo creer_table($jours,$date,$tranches);?> <br><br><br><br>
         </div>

      </div>
  </div>

  <script src="../js/filter_rdv.js"></script>


</body>


<?php
      }
      else
      {
        header('location: ../index.php');
      }
  ?>