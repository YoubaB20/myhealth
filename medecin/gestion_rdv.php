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

        $email =$userinfo['email'];
        $prenom =$userinfo['prenom'];
        $nom =$userinfo['nom'];
        $adress = $userinfo['adress'];
        $telephone = $userinfo['telephone'];


        $user =$bdd->prepare("SELECT nom,prenom,email,jour,date,tranche,id_patient FROM rdv , patient where rdv.id_patient = patient.id ");
        $user->execute(array());

         $id_patient = array();
         $nomPatient = array();
         $prenomPatient= array();
         $emailPatient = array();
         $date = array();
         $jours = array();
         $heuresDebut = array();
         $heuresFin = array();
        while(  $infordv = $user->fetch())
        {
           $id_patient[] =$infordv['id_patient'];
           $nomPatient [] = $infordv['nom'];
           $prenomPatient [] = $infordv['prenom'];
           $emailPatient [] =$infordv['email'];
           $dt = $infordv['date'];
           $date[] = date('d/m/Y',strtotime("$dt"));
           
           $jours [] = $infordv['jour'];

            $heureRdv = $infordv['tranche'];
            $tranche = explode("-",$heureRdv);
            $heureDebut = $tranche[0];
            $heureFin = $tranche[1];
          $heuresDebut [] = $heureDebut;
          $heuresFin [] =$heureFin;

        } 
        
     ?>


<?php
       
       function creer_table($id_patient,$nomPatient,$prenomPatient,$jours,$date,$heuresDebut,$heuresFin,$emailPatient)
       {
          $id_patient = $id_patient;
          $nomPatient = $nomPatient;
          $prenomPatient = $prenomPatient;
          $emailPatient =$emailPatient;
          $date = $date;
          $nbrdate = count($date);
          $jours = $jours;
          $heuresDebut = $heuresDebut;
          $heuresFin = $heuresFin;
         $tab ="<table id='myTable'>";
         
         $tab.="<tr>";
            $tab.="<th> Id patient  </th>";
            $tab.="<th> Nom patient  </th>";
            $tab.="<th> Email  </th>";
            $tab.="<th> Jour   </th>";
            $tab.="<th> Date   </th>";
            $tab.="<th> Heure Debut  </th>";
            $tab.="<th> Heure Fin  </th>";
         $tab.="</tr>";
         
         if( $nbrdate > 0)
         {   
          for($int=0; $int < $nbrdate ;$int++)
          {
             $tab.="<tr>";
             $tab.="<td><span class='text'> $id_patient[$int] </span> </td>";
             $tab.="<td><span class='text'> $nomPatient[$int]   $prenomPatient[$int] </span> </td>";
             $tab.="<td><span class='text'> $emailPatient[$int]</span> </td>";
             $tab.="<td><span class='text'> $jours[$int]</span> </td>";
             $tab.="<td><span class='text'> $date[$int] </span></td>";
             $tab.="<td><span class='heurerdv'> $heuresDebut[$int] </span> </td>";
             $tab.="<td><span class='heurerdv'> $heuresFin[$int] </span></td>";
             $tab.="</tr>";
             
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
?>
 
<?php require "nav_md.php" ?>

<head>
 <link rel="stylesheet" href="../css/style_medecin.css">
 <style>
    body{
   margin:0;
   padding:0;
}
table {
  border-collapse: collapse;
  width: 97%;
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
  padding:13px;
}



tr:hover {background-color:white;}

.text{
   font:17px 'montserrat',sans-serif;
}
.heurerdv{
   background:#d9d1b9;
   padding:5px 15px;
   border-radius:4px;
   font-weight:bold;
}
 .msg-vide{
   margin-top:15px;
   padding:10px;
   font-size:16px;
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
     font-size:20px;
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

</style>
</head>

<body>
<div class="row">
     <div class="col profil" style="flex-grow:1">
       <h3> <i class="fa fa-user-md"></i> Mon agenda</h3>
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
      <br><br>
     </div>
    
     <div class="col info" style="flex-grow:7">
         <h3> Liste de RDV </h3>
         <hr class="ligne">


          <div class="table-row">
                        <div class="form-group table-col" style="flex-grow:2">
                        <h4>Afficher par: </h4>
                        </div>
                        <div class="table-col" style="flex-grow:2">
                           <input type="text" placeholder=" Nom "  onkeyup="afficher_par_nom()" id="myNom">
                         </div>
                         <div class="table-col" style="flex-grow:2">
                            <input type="text" placeholder=" Jour "  onkeyup="afficher_par_jour()" id="myJour">
                        </div>  
                        <div class="table-col" style="flex-grow:2.4">
                            <input type="text" placeholder="Date jj/mm/aaaa "  onkeyup="afficher_par_date_medecin()" id="myDate">
                        </div>      
              
          </div>
          
          <hr class="ligne">

          <?php
          echo creer_table($id_patient,$nomPatient,$prenomPatient,$jours,$date,$heuresDebut,$heuresFin,$emailPatient);
           
          ?> <br><br><br><br>
         
            
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