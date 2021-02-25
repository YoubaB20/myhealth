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
       
      $prenom = $userinfo['prenom'];
      $nom =$userinfo['nom'];
      $email =$userinfo['email'];
      $adress = $userinfo['adress'];
      $telephone = $userinfo['telephone'];

        // recuperer les données de travail
        
        $reqNbr = $bdd->prepare("SELECT  nbrRdvH FROM rdv_par_heure ");
        $reqNbr->execute();
        $nbr = $reqNbr->fetch();
        $nbrRDV_heure = $nbr['nbrRdvH'];

        $user = $bdd->prepare("SELECT  id, jour,heureDebut,heureFin FROM agenda  order by id ");
        $user->setFetchMode(PDO::FETCH_ASSOC);
        $user->execute();

        $total =$user->rowcount($user);
        $jours_travail = array();

       if($total >0)
       {
         while( $info =$user->fetch())
         {
           $jours_travail[] = $info['jour']; 
          
         }
       }
               // recuperer les valeur heures debut et fin pr chaque jour existe dans le tableau jours_travail
               if(in_array("Dimanche",$jours_travail))
               { 
                  $user = $bdd->prepare("SELECT  heureDebut,heureFin FROM agenda  where jour = 'Dimanche' ");
                  $user->execute();
                  while( $info =$user->fetch())
                 {
                  $hdDimanche = $info['heureDebut'];
                  $hfDimanche = $info['heureFin'];
                 }
               } 

               if(in_array("Lundi",$jours_travail))
               { 
                  $user = $bdd->prepare("SELECT  heureDebut,heureFin FROM agenda  where jour = 'Lundi' ");
                  $user->execute();
                  while( $info =$user->fetch())
                 {
                  $hdLundi = $info['heureDebut'];
                  $hfLundi = $info['heureFin'];
                 }
               } 

               if(in_array("Mardi",$jours_travail))
               { 
                  $user = $bdd->prepare("SELECT  heureDebut,heureFin FROM agenda  where jour = 'Mardi' ");
                  $user->execute();
                  while( $info =$user->fetch())
                 {
                  $hdMardi = $info['heureDebut'];
                  $hfMardi = $info['heureFin'];
                 }
               } 

               if(in_array("Mercredi",$jours_travail))
               { 
                  $user = $bdd->prepare("SELECT  heureDebut,heureFin FROM agenda  where jour = 'Mercredi' ");
                  $user->execute();
                  while( $info =$user->fetch())
                 {
                  $hdMercredi = $info['heureDebut'];
                  $hfMercredi = $info['heureFin'];
                 }
               } 

               if(in_array("Jeudi",$jours_travail))
               { 
                  $user = $bdd->prepare("SELECT  heureDebut,heureFin FROM agenda  where jour = 'Jeudi' ");
                  $user->execute();
                  while( $info =$user->fetch())
                 {
                  $hdJeudi = $info['heureDebut'];
                  $hfJeudi= $info['heureFin'];
                 }
               } 
      
               if(in_array("Vendredi",$jours_travail))
               { 
                  $user = $bdd->prepare("SELECT  heureDebut,heureFin FROM agenda  where jour = 'Vendredi' ");
                  $user->execute();
                  while( $info =$user->fetch())
                 {
                  $hdVendredi = $info['heureDebut'];
                  $hfVendredi = $info['heureFin'];
                 }
               } 
  
               if(in_array("Samedi",$jours_travail))
               { 
                  $user = $bdd->prepare("SELECT  heureDebut,heureFin FROM agenda where jour = 'Samedi' ");
                  $user->execute();
                  while( $info =$user->fetch())
                 {
                  $hdSamedi = $info['heureDebut'];
                  $hfSamedi = $info['heureFin'];
                 }
               } 

               
        
      
    ?>

<?php
   
   // fonction qui recupere heure debut chaque jr
  function select_heure_debut($choix)
  {
    
    $heuredebut="";
    switch($choix)
    {
      case "1" : $heuredebut="08:00"; break;
      case "2" : $heuredebut="09:00"; break;
      case "3" : $heuredebut="10:00"; break;
      case "4" : $heuredebut="11:00"; break;
      case "5" : $heuredebut="12:00"; break;
      case "6" : $heuredebut="13:00"; break;
      case "7" : $heuredebut="14:00"; break;
      case "8" : $heuredebut="15:00"; break;
      case "9" : $heuredebut="16:00"; break;
      case "10" : $heuredebut="17:00"; break;

    }
    return $heuredebut;
  }
  
  // recupere heure de fin chaque jr  
  function select_heure_fin($choix)
  {
    $heurefin="";
    switch($choix)
    {
      case "1" : $heurefin="08:00"; break;
      case "2" : $heurefin="09:00"; break;
      case "3" : $heurefin="10:00"; break;
      case "4" : $heurefin="11:00"; break;
      case "5" : $heurefin="12:00"; break;
      case "6" : $heurefin="13:00"; break;
      case "7" : $heurefin="14:00"; break;
      case "8" : $heurefin="15:00"; break;
      case "9" : $heurefin="16:00"; break;
      case "10" :$heurefin="17:00"; break;

    }
    return $heurefin;
  }
   // nbr des rdv par heure
  function nbr_rdv_heure($choix)
  {
    $nbrRDV="";
    switch($choix)
    {
      case "1" : $nbrRDV= 1; break;
      case "2" : $nbrRDV= 2; break;
      case "3" : $nbrRDV= 3; break;
      case "4" : $nbrRDV= 4; break;
     
    }
    return $nbrRDV;
  }
 // voire si la table exist dans db
  function tableExist($database , $tableName)
  {
     $bol=false;
      $reponse = $database -> query('show tables');
     while($data = $reponse -> fetch())
     {
        if($data[0] == $tableName )
          {
                $bol = true;
          }
     }
     return $bol;
  }

  
   
   

   

?>

  <?php
    
    // button sauvegarder  gestion de travail
     if(isset($_POST['agenda']))
     {     

           // verifier si la table agenda exist alors il supprime cree une autre il insere les donnee de travail
           // sinon il cree une table 
        if(tableExist($bdd,'agenda') == true)
         {
                    $reqsup = $bdd->prepare("DROP TABLE agenda ");
                    $reqsup->execute();
           
                    $reqcree = $bdd->prepare(" CREATE table agenda (id int(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,jour varchar(30) NOT NULL,heureDebut time NOT NULL,heureFin time NOT NULL)");
                    $reqcree->execute(); 

             if(!empty($_POST['jourTravail']))
             {
               $jours_travail = $_POST['jourTravail'];
            
                foreach($jours_travail as $jr)
                { 
                      //inserer les jours a la bd
            
                      //verifier si le jour a ete coché alors il recupere les heures debut et heure fin
                      if($jr=="Dimanche")
                      {
                         if(isset($_POST['HeureDebutDIM']) AND isset($_POST['HeureFinDIM']))
                         {
                            $heureDebutDimanche = select_heure_debut($_POST['HeureDebutDIM']) ;
                            $heureFinDimanche = select_heure_fin($_POST['HeureFinDIM']) ; 
                            $reqinsert = $bdd->prepare("INSERT INTO agenda (jour,heureDebut,heureFin) values(?,?,?)");
                            $reqinsert->execute(array($jr,$heureDebutDimanche,$heureFinDimanche));
                 
                         }
                      }
            
                     if($jr =="Lundi")
                      {
                         if(isset($_POST['HeureDebutLUN']) AND isset($_POST['HeureFinLUN']))
                         {
                           $heureDebutLundi = select_heure_debut($_POST['HeureDebutLUN']) ; 
                           $heureFinLundi = select_heure_fin($_POST['HeureFinLUN']) ;
                           $reqinsert = $bdd->prepare("INSERT INTO agenda (jour,heureDebut,heureFin) values(?,?,?)");
                           $reqinsert->execute(array($jr,$heureDebutLundi,$heureFinLundi));
              
                         }
                      }

                       if($jr =="Mardi")
                       {
                          if(isset($_POST['HeureDebutMAR']) AND isset($_POST['HeureFinMAR']))
                           {
                            $heureDebutMardi = select_heure_debut($_POST['HeureDebutMAR']) ; 
                            $heureFinMardi = select_heure_fin($_POST['HeureFinMAR']) ;
                            $reqinsert = $bdd->prepare("INSERT INTO agenda (jour,heureDebut,heureFin) values(?,?,?)");
                            $reqinsert->execute(array($jr,$heureDebutMardi,$heureFinMardi));
                
                           } 
                       }

                        if($jr=="Mercredi")
                         {
                           if(isset($_POST['HeureDebutMER']) AND isset($_POST['HeureFinMER']))
                           {
                             $heureDebutMercredi = select_heure_debut($_POST['HeureDebutMER']) ; 
                             $heureFinMercredi = select_heure_fin($_POST['HeureFinMER']) ;
                             $reqinsert = $bdd->prepare("INSERT INTO agenda (jour,heureDebut,heureFin) values(?,?,?)");
                             $reqinsert->execute(array($jr,$heureDebutMercredi,$heureFinMercredi));
                           }
                         }

              if($jr=="Jeudi")
              {
              if(isset($_POST['HeureDebutJEU']) AND isset($_POST['HeureFinJEU']))
              {
                   $heureDebutJeudi = select_heure_debut($_POST['HeureDebutJEU']) ; 
                   $heureFinJeudi = select_heure_fin($_POST['HeureFinJEU']) ;
                   $reqinsert = $bdd->prepare("INSERT INTO agenda (jour,heureDebut,heureFin) values(?,?,?)");
                 $reqinsert->execute(array($jr,$heureDebutJeudi,$heureFinJeudi));
                 }
              }
    
              if($jr=="Vendredi" )
              {
              if(isset($_POST['HeureDebutVEN']) AND isset($_POST['HeureFinVEN']))
              {
                   $heureDebutVendredi = select_heure_debut($_POST['HeureDebutVEN']) ; 
                   $heureFinVendredi = select_heure_fin($_POST['HeureFinVEN']) ;
                   $reqinsert = $bdd->prepare("INSERT INTO agenda (jour,heureDebut,heureFin) values(?,?,?)");
                 $reqinsert->execute(array($jr,$heureDebutVendredi,$heureFinVendredi));
                 }   
              }
    
              if($jr =="Samedi")
              {
              if(isset($_POST['HeureDebutSAM']) AND isset($_POST['HeureFinSAM']))
              {
                   $heureDebutSamedi = select_heure_debut($_POST['HeureDebutSAM']) ; 
                   $heureFinSamedi = select_heure_fin($_POST['HeureFinSAM']) ;
                   $reqinsert = $bdd->prepare("INSERT INTO agenda (jour,heureDebut,heureFin) values(?,?,?)");
                   $reqinsert->execute(array($jr,$heureDebutSamedi,$heureFinSamedi));
                 }
              }

               
            }
           
          }// fin !empty($_POST['jourTravail'])
           

           } 

          else 
         {
            $reqcree = $bdd->prepare(" CREATE table agenda (id int(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,jour varchar(30) NOT NULL,heureDebut time NOT NULL,heureFin time NOT NULL)");
            $reqcree->execute(); 

            if(!empty($_POST['jourTravail']))
            {
              $jours_travail = $_POST['jourTravail'];

           foreach($jours_travail as $jr)
            { 

              
              //verifier si le jour a ete coché alors il recupere les heures debut et heure fin
              if($jr=="Dimanche")
              {
              if(isset($_POST['HeureDebutDIM']) AND isset($_POST['HeureFinDIM']))
              {
                   $heureDebutDimanche = select_heure_debut($_POST['HeureDebutDIM']) ;
                   $heureFinDimanche = select_heure_fin($_POST['HeureFinDIM']) ; 
                   $reqinsert = $bdd->prepare("INSERT INTO agenda (jour,heureDebut,heureFin) values(?,?,?)");
                   $reqinsert->execute(array($jr,$heureDebutDimanche,$heureFinDimanche));
                 
               }
              }
            
              if($jr =="Lundi")
              {
              if(isset($_POST['HeureDebutLUN']) AND isset($_POST['HeureFinLUN']))
              {
                 $heureDebutLundi = select_heure_debut($_POST['HeureDebutLUN']) ; 
                 $heureFinLundi = select_heure_fin($_POST['HeureFinLUN']) ;
                 $reqinsert = $bdd->prepare("INSERT INTO agenda (jour,heureDebut,heureFin) values(?,?,?)");
                 $reqinsert->execute(array($jr,$heureDebutLundi,$heureFinLundi));
              
               }
              }

              if($jr =="Mardi")
              {
              if(isset($_POST['HeureDebutMAR']) AND isset($_POST['HeureFinMAR']))
              {
                 $heureDebutMardi = select_heure_debut($_POST['HeureDebutMAR']) ; 
                 $heureFinMardi = select_heure_fin($_POST['HeureFinMAR']) ;
                 $reqinsert = $bdd->prepare("INSERT INTO agenda (jour,heureDebut,heureFin) values(?,?,?)");
                 $reqinsert->execute(array($jr,$heureDebutMardi,$heureFinMardi));
                
                } 
              }

              if($jr=="Mercredi")
                 {
              if(isset($_POST['HeureDebutMER']) AND isset($_POST['HeureFinMER']))
              {
                   $heureDebutMercredi = select_heure_debut($_POST['HeureDebutMER']) ; 
                   $heureFinMercredi = select_heure_fin($_POST['HeureFinMER']) ;
                   $reqinsert = $bdd->prepare("INSERT INTO agenda (jour,heureDebut,heureFin) values(?,?,?)");
                  $reqinsert->execute(array($jr,$heureDebutMercredi,$heureFinMercredi));
                 }
              }

              if($jr=="Jeudi")
              {
              if(isset($_POST['HeureDebutJEU']) AND isset($_POST['HeureFinJEU']))
              {
                   $heureDebutJeudi = select_heure_debut($_POST['HeureDebutJEU']) ; 
                   $heureFinJeudi = select_heure_fin($_POST['HeureFinJEU']) ;
                   $reqinsert = $bdd->prepare("INSERT INTO agenda (jour,heureDebut,heureFin) values(?,?,?)");
                 $reqinsert->execute(array($jr,$heureDebutJeudi,$heureFinJeudi));
                 }
              }
    
              if($jr=="Vendredi" )
              {
              if(isset($_POST['HeureDebutVEN']) AND isset($_POST['HeureFinVEN']))
              {
                   $heureDebutVendredi = select_heure_debut($_POST['HeureDebutVEN']) ; 
                   $heureFinVendredi = select_heure_fin($_POST['HeureFinVEN']) ;
                   $reqinsert = $bdd->prepare("INSERT INTO agenda (jour,heureDebut,heureFin) values(?,?,?)");
                 $reqinsert->execute(array($jr,$heureDebutVendredi,$heureFinVendredi));
                 }   
              }
    
              if($jr =="Samedi")
              {
              if(isset($_POST['HeureDebutSAM']) AND isset($_POST['HeureFinSAM']))
              {
                   $heureDebutSamedi = select_heure_debut($_POST['HeureDebutSAM']) ; 
                   $heureFinSamedi = select_heure_fin($_POST['HeureFinSAM']) ;
                   $reqinsert = $bdd->prepare("INSERT INTO agenda (jour,heureDebut,heureFin) values(?,?,?)");
                   $reqinsert->execute(array($jr,$heureDebutSamedi,$heureFinSamedi));
                 }
              }
               
               
            }
          }// fin !empty($_POST['jourTravail']) 
 
          }
          
      

          if(isset($_POST['nbrRdvH']))
          {
            $nbrRDV_heure = nbr_rdv_heure($_POST['nbrRdvH']);
            $reqinsert = $bdd->prepare("UPDATE  rdv_par_heure  SET nbrRdvH = ?  ");
            $reqinsert->execute(array($nbrRDV_heure));
          }

        
         
        
       header("location: reglage_agenda.php?modifier=Modifié avec succès");
     }

     // ajouter une date 
      if(isset($_POST['ajouterDate']))
      {
        if(isset($_POST['dateIND']))
        {
           
              $dateIND = $_POST['dateIND'];

            $requser = $bdd->prepare("SELECT * FROM indisponibilites where date = ? ");
            $requser->execute(array($dateIND));
            $total =$requser->rowcount($requser);
            if($total > 0 )
            {
               // msg pour eviter une 2 eme insertion de date a la bd on cas ou il a reload page ; 
               header('location: reglage_agenda.php?date_existe=Oops date existe déja ');
            }
            else
            {
            $requser = $bdd->prepare("INSERT INTO indisponibilites (date) values (?) "); 
            $requser->execute(array($dateIND));
            header('location: reglage_agenda.php?ajouter=Ajouté avec succès');
            
            }
        }  

      }

      if(isset($_POST['afficherDate']))
      {
       
          $requser =$bdd-> prepare("SELECT * FROM indisponibilites ");
          $requser->execute();
          // $date = $_POST['dateIND'];
           // $dateIND = date('d/m/Y',strtotime("$date"));
          $date = array();
         while( $donnee = $requser->fetch())
         {
         // $dt = $donnee['date'];
         // $date [] =  date('d/m/Y',strtotime("$dt"));
            $date[] = $donnee['date'];
         }

        
      }

     

      function cree_table($date)
      {
        $date = $date;
        $nbrdate = count($date);

        $tab ="<table>";
         
        $tab.="<tr>";
           $tab.="<th> Date   </td>";
           $tab.="<th> Action  </td>";
          
          
        $tab.="</tr>";
        if( $nbrdate > 0)
        {  
            for($int=0; $int < $nbrdate ;$int++)
          {
           $datefr = date('d/m/Y',strtotime("$date[$int]"));
           $tab.="<tr>";
           $tab.="<td><span class='text'> $datefr</span> </td>";
           $tab.="<td> <a href='?date=".$date[$int]."' class='supprimer-date-ind' > Supprimer  </a> </td> ";
           
           $tab.="</tr>";
              
          }
        }
        else
        {
          $msg =" Aucune date ajouter ";
        }
        $tab.="</table>";

        if(isset($msg))
        {
         $tab.="<div class='msg-vide'>  $msg </div>";
        }

     return $tab;
      }
 
   
      if(isset($_GET['date']))
      {
        $datesup = $_GET['date'];
        $reqsup = $bdd->prepare("DELETE FROM indisponibilites WHERE date = ? ");
        $reqsup->execute(array($datesup));
        header('location: reglage_agenda.php?supprimer=Supprimé avec succès');
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
.row{
    display:flex;
    flex-direction:row;
 }

.col.profil{
   padding:10px 0px 0px 70px;
 }
.col.profil h3{
   color:blue;
   font:22px "Montserrat",sans-serif;
   padding: 5px 0px 2px 20px;
  
 }
.col.info{
  padding:10px 0px 0px 3px;

 }
.col.info h3{
   color:#3A405B;
   font:30px "Montserrat",sans-serif;
   margin:50px 0px 2px 10px;
   text-align:left;
 }

.agenda h4{
    color:#3A405B;
   font:24px "Montserrat",sans-serif;
   margin:10px 0px;
   text-align:left;
  }

.agenda-row{
    display:flex;
    height:40px;
  }
.agenda-col{
    flex:1;
    text-align:left;
    padding-left: 10px;
   
  }
.form-group p{
    color:#3A405B;
   font:18px "Montserrat",sans-serif;
   margin:10px 0px;
   text-align:left;
  }
.form-group .form-control{
    width:55%;
    height:36px;
    padding:6px 12px;
    font-size:18px;
    color:#555;
    border:1px solid #ccc;
    margin-top:6px;
    margin-bottom:16px;
    border-radius:4px;
    resize:vertical;
    box-sizing: border-box;
    font-style:bold;
 }
  

.btn-ajouter button{
  background-color: #4BE1AB;
  border-color: #4BE1AB;
  padding:6px 20px;
  border-radius: 4px;
  color:#fff;
  font-size:18px;
  cursor:pointer;
  text-align:center;}

.supprimer-date-ind{
    text-decoration:none;
    color:white;
    padding:5px 10px;
    border-radius:4px;
    background:#f60a0a;}

.btn-ajouter button:hover{
  box-shadow:0 2px 2px 0 rgba(0,0,0,0.4);
 }

.btn-afficher-date button{
  background-color: #4BE1AB;
  border-color: #4BE1AB;
  padding:6px 20px;
  border-radius: 4px;
  color:#fff;
  font-size:18px;
  cursor:pointer;
  text-align:center;
  }
  .btn-afficher-date button:hover{
  box-shadow:0 2px 2px 0 rgba(0,0,0,0.4);
 }
.form-group label .checkbox{
  cursor: pointer;
 }

.form-group .jour{
  font:16px 'Montsserat',sans-serif;
  display: block;
  position: relative;
  margin-bottom: 12px;
  padding-top:10px;
  cursor: pointer;
  font-size: 18px;
  user-select: none;
 }
 
.ligne{
  margin-top: 20px;
  margin-bottom: 20px;
  margin-right:10px;
  border: 0;
  border-top: 1px solid #eee;}

table {
  
  border-collapse: collapse;
  width: 60%;
  table-layout:fixed;
  border:1px groove lightblue;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

th {
   color:#3A405B;
   font:16px "Montserrat",sans-serif;
   font-weight:bold;
   text-align: center;
   border-bottom:2px groove lightblue;
}
td {
  text-align: center;
  padding:10px;
}
tr:hover {background-color:white;
}

.text{
  font:18px 'montserrat',sans-serif;
}
.msg-vide{
   margin-top:15px;
   margin-left:22%;
   float:left;
   text-align:center;
   padding:10px;
   font-size:16px;
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
    .alert-existe{
      border-radius:5px;
      width:30%;
      padding:18px;
      text-align:center;
      color:white;
      font:18px 'Montserrat',sans-serif;
      background:red;
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

   <?php if(isset($_GET['supprimer'])) { ?>
      <div class="alert" >
          <i class="fas fa-check"></i> <?php  echo $_GET['supprimer'];   ?>
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
     </div> 
   <?php } ?>

   <?php if(isset($_GET['ajouter'])) { ?>
      <div class="alert" >
          <i class="fas fa-check"></i> <?php  echo $_GET['ajouter'];   ?>
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
     </div> 
    
   <?php   } ?>
   
   <?php if(isset($_GET['date_existe'])) { ?>
      <div class="alert-existe" >
          <i class="fas fa-exclamation"></i> <?php  echo $_GET['date_existe'];   ?>
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
     </div> 
    
   <?php   } ?>


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
   </div>
    
    <div class="col info" style="flex-grow:3">
         <h3>Réglage agenda</h3>
         <hr class="ligne">
      <div class="agenda">
      <form id="form" action="reglage_agenda.php" method="POST">
                <div class="agenda-row">
                        <div class="form-group agenda-col">
                          <p>Nombre de  Rendez-vous/heure: </p>
                        </div>
                        <div class="form-group agenda-col">
                              <select name="nbrRdvH" id="nbrRdvH" class="form-control">
                                  <option value="1" <?php if($nbrRDV_heure =="1") echo "selected"; ?>>1</option>
                                  <option value="2" <?php if($nbrRDV_heure =="2") echo "selected"; ?>>2</option>
                                  <option value="3" <?php if($nbrRDV_heure =="3") echo "selected"; ?>>3</option>
                                  <option value="4" <?php if($nbrRDV_heure =="4") echo "selected"; ?>>4</option>
                               </select>
                         </div>
              
                 </div>
                 <hr class="ligne">
           <h4>Planning hebdomadaire</h4>
              <br>
           <div class="agenda-row">
                        <div class="form-group agenda-col">
                          <p > Jours </p>
                        </div>
                        <div class="form-group agenda-col">
                            <p>Heure de debut</p>
                         </div>
                         <div class="form-group agenda-col">
                         <p>Heure de fin</p>
                         </div>
              
                 </div>
                 <hr class="ligne">
             
                 <div class="agenda-row">
                        <div class="form-group agenda-col">
                        <label class="jour"> 
                     
                       <input type="checkbox" class="checkbox" name="jourTravail[]" value="Dimanche" <?php if(in_array("Dimanche",$jours_travail)) echo "checked" ?> >
                       Dimanche
                        </label>
                        
                        </div>
                        <div class="form-group agenda-col">
                        
                        
                        <select name="HeureDebutDIM" id="HeureDebut" class="form-control temps-debut" >
                           <option value="1"  <?php if(isset($hdDimanche)) if($hdDimanche =="08:00:00") echo "selected";  ?> >08:00</option>
                           <option value="2"  <?php if(isset($hdDimanche)) if($hdDimanche =="09:00:00") echo "selected"; ?> >09:00</option>
                           <option value="3"  <?php if(isset($hdDimanche)) if($hdDimanche =="10:00:00") echo "selected"; ?> >10:00</option>
                           <option value="4"  <?php if(isset($hdDimanche)) if($hdDimanche =="11:00:00") echo "selected"; ?> >11:00</option>
                           <option value="5"  <?php if(isset($hdDimanche)) if($hdDimanche =="12:00:00") echo "selected"; ?> >12:00</option>
                           <option value="6"  <?php if(isset($hdDimanche)) if($hdDimanche =="13:00:00") echo "selected"; ?> >13:00</option>
                           <option value="7"  <?php if(isset($hdDimanche)) if($hdDimanche =="14:00:00") echo "selected"; ?> >14:00</option>
                           <option value="8"  <?php if(isset($hdDimanche)) if($hdDimanche =="15:00:00") echo "selected"; ?> >15:00</option>
                           <option value="9"  <?php if(isset($hdDimanche)) if($hdDimanche =="16:00:00") echo "selected"; ?> >16:00</option>
                           <option value="10" <?php if(isset($hdDimanche)) if($hdDimanche =="17:00:00") echo "selected"; ?>>17:00</option>
                           
                        </select>
                         </div>
                         <div class="form-group agenda-col">
                         <select name="HeureFinDIM" id="HeureFin"  class="form-control temps-fin">
                           <option value="1"  <?php if(isset($hfDimanche)) if($hfDimanche =="08:00:00") echo "selected"; ?> >08:00</option>
                           <option value="2"  <?php if(isset($hfDimanche)) if($hfDimanche =="09:00:00") echo "selected"; ?> >09:00</option>
                           <option value="3"  <?php if(isset($hfDimanche)) if($hfDimanche =="10:00:00") echo "selected"; ?> >10:00</option>
                           <option value="4"  <?php if(isset($hfDimanche)) if($hfDimanche =="11:00:00") echo "selected"; ?> >11:00</option>
                           <option value="5"  <?php if(isset($hfDimanche))if($hfDimanche =="12:00:00")  echo "selected"; ?> >12:00</option>
                           <option value="6"  <?php if(isset($hfDimanche))if($hfDimanche =="13:00:00")  echo "selected"; ?> >13:00</option>
                           <option value="7"  <?php if(isset($hfDimanche))if($hfDimanche =="14:00:00")  echo "selected"; ?> >14:00</option>
                           <option value="8"  <?php if(isset($hfDimanche)) if($hfDimanche =="15:00:00") echo "selected"; ?> >15:00</option>
                           <option value="9"  <?php if(isset($hfDimanche))if($hfDimanche =="16:00:00")  echo "selected"; ?> >16:00</option>
                           <option value="10" <?php if(isset($hfDimanche)) if($hfDimanche =="17:00:00") echo "selected"; ?>>17:00</option>
                        </select>
                         </div>
              
                 </div>
                 <hr class="ligne">

                 <div class="agenda-row">
                        <div class="form-group agenda-col">
                        <label class="jour">    
                       <input type="checkbox" class="checkbox" name="jourTravail[]" value="Lundi" <?php if(in_array("Lundi",$jours_travail)) echo "checked" ?>>
                       Lundi
                        </label>
                        </div>
                        <div class="form-group agenda-col">
                        <select name="HeureDebutLUN" id="HeureDebut" class="form-control temps-debut">
                           <option value="1"  <?php if(isset($hdLundi)) if($hdLundi =="08:00:00") echo "selected";  ?> >08:00</option>
                           <option value="2"  <?php if(isset($hdLundi)) if($hdLundi =="09:00:00") echo "selected"; ?> >09:00</option>
                           <option value="3"  <?php if(isset($hdLundi)) if($hdLundi =="10:00:00") echo "selected"; ?> >10:00</option>
                           <option value="4"  <?php if(isset($hdLundi)) if($hdLundi =="11:00:00") echo "selected"; ?> >11:00</option>
                           <option value="5"  <?php if(isset($hdLundi)) if($hdLundi =="12:00:00") echo "selected"; ?> >12:00</option>
                           <option value="6"  <?php if(isset($hdLundi)) if($hdLundi =="13:00:00") echo "selected"; ?> >13:00</option>
                           <option value="7"  <?php if(isset($hdLundi)) if($hdLundi =="14:00:00") echo "selected"; ?> >14:00</option>
                           <option value="8"  <?php if(isset($hdLundi)) if($hdLundi =="15:00:00") echo "selected"; ?> >15:00</option>
                           <option value="9"  <?php if(isset($hdLundi)) if($hdLundi =="16:00:00") echo "selected"; ?> >16:00</option>
                           <option value="10" <?php if(isset($hdLundi)) if($hdLundi =="17:00:00") echo "selected"; ?>>17:00</option>
                          
                        </select>
                         </div>
                         <div class="form-group agenda-col">
                         <select name="HeureFinLUN" id="HeureFin"  class="form-control temps-fin">
                           <option value="1"  <?php if(isset($hfLundi)) if($hfLundi =="08:00:00") echo "selected";  ?> >08:00</option>
                           <option value="2"  <?php if(isset($hfLundi)) if($hfLundi =="09:00:00") echo "selected"; ?> >09:00</option>
                           <option value="3"  <?php if(isset($hfLundi)) if($hfLundi =="10:00:00") echo "selected"; ?> >10:00</option>
                           <option value="4"  <?php if(isset($hfLundi)) if($hfLundi =="11:00:00") echo "selected"; ?> >11:00</option>
                           <option value="5"  <?php if(isset($hfLundi)) if($hfLundi =="12:00:00") echo "selected"; ?> >12:00</option>
                           <option value="6"  <?php if(isset($hfLundi)) if($hfLundi =="13:00:00") echo "selected"; ?> >13:00</option>
                           <option value="7"  <?php if(isset($hfLundi)) if($hfLundi =="14:00:00") echo "selected"; ?> >14:00</option>
                           <option value="8"  <?php if(isset($hfLundi)) if($hfLundi =="15:00:00") echo "selected"; ?> >15:00</option>
                           <option value="9"  <?php if(isset($hfLundi)) if($hfLundi =="16:00:00") echo "selected"; ?> >16:00</option>
                           <option value="10" <?php if(isset($hfLundi)) if($hfLundi =="17:00:00") echo "selected"; ?>>17:00</option>
                        </select>
                         </div>
              
                 </div>
                 <hr class="ligne">

                 <div class="agenda-row">
                        <div class="form-group agenda-col">
                        <label class="jour">    
                       <input type="checkbox" class="checkbox" name="jourTravail[]" value="Mardi" <?php  if(in_array("Mardi",$jours_travail)) echo "checked"  ?>>
                      Mardi
                        </label>
                        </div>
                        <div class="form-group agenda-col">
                        <select name="HeureDebutMAR" id="HeureDebut" class="form-control temps-debut">
                           <option value="1"  <?php if(isset($hdMardi)) if($hdMardi =="08:00:00") echo "selected";  ?> >08:00</option>
                           <option value="2"  <?php if(isset($hdMardi)) if($hdMardi =="09:00:00") echo "selected"; ?> >09:00</option>
                           <option value="3"  <?php if(isset($hdMardi)) if($hdMardi =="10:00:00") echo "selected"; ?> >10:00</option>
                           <option value="4"  <?php if(isset($hdMardi)) if($hdMardi =="11:00:00") echo "selected"; ?> >11:00</option>
                           <option value="5"  <?php if(isset($hdMardi)) if($hdMardi =="12:00:00") echo "selected"; ?> >12:00</option>
                           <option value="6"  <?php if(isset($hdMardi)) if($hdMardi =="13:00:00") echo "selected"; ?> >13:00</option>
                           <option value="7"  <?php if(isset($hdMardi)) if($hdMardi =="14:00:00") echo "selected"; ?> >14:00</option>
                           <option value="8"  <?php if(isset($hdMardi)) if($hdMardi =="15:00:00") echo "selected"; ?> >15:00</option>
                           <option value="9"  <?php if(isset($hdMardi)) if($hdMardi =="16:00:00") echo "selected"; ?> >16:00</option>
                           <option value="10" <?php if(isset($hdMardi)) if($hdMardi =="17:00:00") echo "selected"; ?>>17:00</option>
                           
                        </select>
                         </div>
                         <div class="form-group agenda-col">
                         <select name="HeureFinMAR" id="HeureFin"  class="form-control temps-fin">
                           <option value="1"  <?php if(isset($hfMardi)) if($hfMardi =="08:00:00") echo "selected";  ?> >08:00</option>
                           <option value="2"  <?php if(isset($hfMardi)) if($hfMardi =="09:00:00") echo "selected"; ?> >09:00</option>
                           <option value="3"  <?php if(isset($hfMardi)) if($hfMardi =="10:00:00") echo "selected"; ?> >10:00</option>
                           <option value="4"  <?php if(isset($hfMardi)) if($hfMardi =="11:00:00") echo "selected"; ?> >11:00</option>
                           <option value="5"  <?php if(isset($hfMardi)) if($hfMardi =="12:00:00") echo "selected"; ?> >12:00</option>
                           <option value="6"  <?php if(isset($hfMardi)) if($hfMardi =="13:00:00") echo "selected"; ?> >13:00</option>
                           <option value="7"  <?php if(isset($hfMardi)) if($hfMardi =="14:00:00") echo "selected"; ?> >14:00</option>
                           <option value="8"  <?php if(isset($hfMardi)) if($hfMardi =="15:00:00") echo "selected"; ?> >15:00</option>
                           <option value="9"  <?php if(isset($hfMardi)) if($hfMardi =="16:00:00") echo "selected"; ?> >16:00</option>
                           <option value="10" <?php if(isset($hfMardi)) if($hfMardi =="17:00:00") echo "selected"; ?>>17:00</option>
                        </select>
                         </div>
              
                 </div>
                 <hr class="ligne">

                 <div class="agenda-row">
                        <div class="form-group agenda-col">
                        <label class="jour">    
                       <input type="checkbox" class="checkbox" name="jourTravail[]" value="Mercredi" <?php if(in_array("Mercredi",$jours_travail)) echo "checked" ?>>
                       Mercredi
                        </label>
                        </div>
                        <div class="form-group agenda-col">
                        <select name="HeureDebutMER" id="HeureDebut" class="form-control temps-debut">
                           <option value="1"  <?php if(isset($hdMercredi)) if($hdMercredi =="08:00:00") echo "selected";  ?> >08:00</option>
                           <option value="2"  <?php if(isset($hdMercredi)) if($hdMercredi =="09:00:00") echo "selected"; ?> >09:00</option>
                           <option value="3"  <?php if(isset($hdMercredi)) if($hdMercredi =="10:00:00") echo "selected"; ?> >10:00</option>
                           <option value="4"  <?php if(isset($hdMercredi)) if($hdMercredi =="11:00:00") echo "selected"; ?> >11:00</option>
                           <option value="5"  <?php if(isset($hdMercredi)) if($hdMercredi =="12:00:00") echo "selected"; ?> >12:00</option>
                           <option value="6"  <?php if(isset($hdMercredi)) if($hdMercredi =="13:00:00") echo "selected"; ?> >13:00</option>
                           <option value="7"  <?php if(isset($hdMercredi)) if($hdMercredi =="14:00:00") echo "selected"; ?> >14:00</option>
                           <option value="8"  <?php if(isset($hdMercredi)) if($hdMercredi =="15:00:00") echo "selected"; ?> >15:00</option>
                           <option value="9"  <?php if(isset($hdMercredi)) if($hdMercredi =="16:00:00") echo "selected"; ?> >16:00</option>
                           <option value="10" <?php if(isset($hdMercredi)) if($hdMercredi =="17:00:00") echo "selected"; ?>>17:00</option>
                          
                        </select>
                         </div>
                         <div class="form-group agenda-col">
                         <select name="HeureFinMER" id="HeureFin"  class="form-control temps-fin">
                           <option value="1"  <?php if(isset($hfMercredi)) if($hfMercredi =="08:00:00") echo "selected";  ?> >08:00</option>
                           <option value="2"  <?php if(isset($hfMercredi)) if($hfMercredi =="09:00:00") echo "selected"; ?> >09:00</option>
                           <option value="3"  <?php if(isset($hfMercredi)) if($hfMercredi =="10:00:00") echo "selected"; ?> >10:00</option>
                           <option value="4"  <?php if(isset($hfMercredi)) if($hfMercredi =="11:00:00") echo "selected"; ?> >11:00</option>
                           <option value="5"  <?php if(isset($hfMercredi)) if($hfMercredi =="12:00:00") echo "selected"; ?> >12:00</option>
                           <option value="6"  <?php if(isset($hfMercredi)) if($hfMercredi =="13:00:00") echo "selected"; ?> >13:00</option>
                           <option value="7"  <?php if(isset($hfMercredi)) if($hfMercredi =="14:00:00") echo "selected"; ?> >14:00</option>
                           <option value="8"  <?php if(isset($hfMercredi)) if($hfMercredi =="15:00:00") echo "selected"; ?> >15:00</option>
                           <option value="9"  <?php if(isset($hfMercredi)) if($hfMercredi =="16:00:00") echo "selected"; ?> >16:00</option>
                           <option value="10" <?php if(isset($hfMercredi)) if($hfMercredi =="17:00:00") echo "selected"; ?>>17:00</option>
                        </select>
                         </div>
              
                 </div>
                 <hr class="ligne">


                 <div class="agenda-row">
                        <div class="form-group agenda-col">
                        <label class="jour">    
                       <input type="checkbox" class="checkbox" name="jourTravail[]" value="Jeudi" <?php if(in_array("Jeudi",$jours_travail)) echo "checked" ?>>
                       Jeudi
                        </label>
                        </div>
                        <div class="form-group agenda-col">
                        <select name="HeureDebutJEU" id="HeureDebut" class="form-control temps-debut">
                           <option value="1"  <?php if(isset($hdJeudi)) if($hdJeudi =="08:00:00") echo "selected";  ?> >08:00</option>
                           <option value="2"  <?php if(isset($hdJeudi)) if($hdJeudi=="09:00:00") echo "selected"; ?> >09:00</option>
                           <option value="3"  <?php if(isset($hdJeudi)) if($hdJeudi =="10:00:00") echo "selected"; ?> >10:00</option>
                           <option value="4"  <?php if(isset($hdJeudi)) if($hdJeudi =="11:00:00") echo "selected"; ?> >11:00</option>
                           <option value="5"  <?php if(isset($hdJeudi)) if($hdJeudi =="12:00:00") echo "selected"; ?> >12:00</option>
                           <option value="6"  <?php if(isset($hdJeudi)) if($hdJeudi =="13:00:00") echo "selected"; ?> >13:00</option>
                           <option value="7"  <?php if(isset($hdJeudi)) if($hdJeudi =="14:00:00") echo "selected"; ?> >14:00</option>
                           <option value="8"  <?php if(isset($hdJeudi)) if($hdJeudi =="15:00:00") echo "selected"; ?> >15:00</option>
                           <option value="9"  <?php if(isset($hdJeudi)) if($hdJeudi =="16:00:00") echo "selected"; ?> >16:00</option>
                           <option value="10" <?php if(isset($hdJeudi)) if($hdJeudi =="17:00:00") echo "selected"; ?>>17:00</option>
                           
                        </select>
                         </div>
                         <div class="form-group agenda-col">
                         <select name="HeureFinJEU" id="HeureFin"  class="form-control temps-fin">
                           <option value="1"  <?php if(isset($hfJeudi)) if($hfJeudi =="08:00:00") echo "selected";  ?> >08:00</option>
                           <option value="2"  <?php if(isset($hfJeudi)) if($hfJeudi=="09:00:00") echo "selected"; ?> >09:00</option>
                           <option value="3"  <?php if(isset($hfJeudi)) if($hfJeudi =="10:00:00") echo "selected"; ?> >10:00</option>
                           <option value="4"  <?php if(isset($hfJeudi)) if($hfJeudi =="11:00:00") echo "selected"; ?> >11:00</option>
                           <option value="5"  <?php if(isset($hfJeudi)) if($hfJeudi =="12:00:00") echo "selected"; ?> >12:00</option>
                           <option value="6"  <?php if(isset($hfJeudi)) if($hfJeudi =="13:00:00") echo "selected"; ?> >13:00</option>
                           <option value="7"  <?php if(isset($hfJeudi)) if($hfJeudi =="14:00:00") echo "selected"; ?> >14:00</option>
                           <option value="8"  <?php if(isset($hfJeudi)) if($hfJeudi =="15:00:00") echo "selected"; ?> >15:00</option>
                           <option value="9"  <?php if(isset($hfJeudi)) if($hfJeudi =="16:00:00") echo "selected"; ?> >16:00</option>
                           <option value="10" <?php if(isset($hfJeudi)) if($hfJeudi =="17:00:00") echo "selected"; ?>>17:00</option>
                        </select>
                         </div>
              
                 </div>
                 <hr class="ligne">


                 <div class="agenda-row">
                        <div class="form-group agenda-col">
                        <label class="jour">    
                       <input type="checkbox" class="checkbox" name="jourTravail[]" value="Vendredi" <?php if(in_array("Vendredi",$jours_travail)) echo "checked" ?>>
                       Vendredi
                        </label>
                        </div>
                        <div class="form-group agenda-col">
                        <select name="HeureDebutVEN" id="HeureDebut" class="form-control temps-debut">
                           <option value="1"  <?php if(isset($hdVendredi)) if($hdVendredi =="08:00:00") echo "selected";  ?> >08:00</option>
                           <option value="2"  <?php if(isset($hdVendredi)) if($hdVendredi=="09:00:00") echo "selected"; ?> >09:00</option>
                           <option value="3"  <?php if(isset($hdVendredi)) if($hdVendredi =="10:00:00") echo "selected"; ?> >10:00</option>
                           <option value="4"  <?php if(isset($hdVendredi)) if($hdVendredi =="11:00:00") echo "selected"; ?> >11:00</option>
                           <option value="5"  <?php if(isset($hdVendredi)) if($hdVendredi =="12:00:00") echo "selected"; ?> >12:00</option>
                           <option value="6"  <?php if(isset($hdVendredi)) if($hdVendredi =="13:00:00") echo "selected"; ?> >13:00</option>
                           <option value="7"  <?php if(isset($hdVendredi)) if($hdVendredi =="14:00:00") echo "selected"; ?> >14:00</option>
                           <option value="8"  <?php if(isset($hdVendredi)) if($hdVendredi =="15:00:00") echo "selected"; ?> >15:00</option>
                           <option value="9"  <?php if(isset($hdVendredi)) if($hdVendredi =="16:00:00") echo "selected"; ?> >16:00</option>
                           <option value="10" <?php if(isset($hdVendredi)) if($hdVendredi =="17:00:00") echo "selected"; ?>>17:00</option>
                           
                        </select>
                         </div>
                         <div class="form-group agenda-col">
                         <select name="HeureFinVEN" id="HeureFin"  class="form-control temps-fin">
                           <option value="1"  <?php if(isset($hfVendredi)) if($hfVendredi =="08:00:00") echo "selected";  ?> >08:00</option>
                           <option value="2"  <?php if(isset($hfVendredi)) if($hfVendredi=="09:00:00") echo "selected"; ?> >09:00</option>
                           <option value="3"  <?php if(isset($hfVendredi)) if($hfVendredi =="10:00:00") echo "selected"; ?> >10:00</option>
                           <option value="4"  <?php if(isset($hfVendredi)) if($hfVendredi =="11:00:00") echo "selected"; ?> >11:00</option>
                           <option value="5"  <?php if(isset($hfVendredi)) if($hfVendredi =="12:00:00") echo "selected"; ?> >12:00</option>
                           <option value="6"  <?php if(isset($hfVendredi)) if($hfVendredi =="13:00:00") echo "selected"; ?> >13:00</option>
                           <option value="7"  <?php if(isset($hfVendredi)) if($hfVendredi =="14:00:00") echo "selected"; ?> >14:00</option>
                           <option value="8"  <?php if(isset($hfVendredi)) if($hfVendredi =="15:00:00") echo "selected"; ?> >15:00</option>
                           <option value="9"  <?php if(isset($hfVendredi)) if($hfVendredi =="16:00:00") echo "selected"; ?> >16:00</option>
                           <option value="10" <?php if(isset($hfVendredi)) if($hfVendredi =="17:00:00") echo "selected"; ?>>17:00</option>
                        </select>
                         </div>
              
                 </div>
                 <hr class="ligne">

                 <div class="agenda-row">
                        <div class="form-group agenda-col">
                        <label class="jour">    
                       <input type="checkbox" class="checkbox" name="jourTravail[]" value="Samedi" <?php  if(in_array("Samedi",$jours_travail)) echo "checked" ?>>
                      Samedi
                        </label>
                        </div>
                        <div class="form-group agenda-col">
                        <select name="HeureDebutSAM" id="HeureDebut" class="form-control temps-debut">
                           <option value="1"  <?php if(isset($hdSamedi)) if($hdSamedi =="08:00:00") echo "selected";  ?> >08:00</option>
                           <option value="2"  <?php if(isset($hdSamedi)) if($hdSamedi=="09:00:00") echo "selected"; ?> >09:00</option>
                           <option value="3"  <?php if(isset($hdSamedi)) if($hdSamedi =="10:00:00") echo "selected"; ?> >10:00</option>
                           <option value="4"  <?php if(isset($hdSamedi)) if($hdSamedi =="11:00:00") echo "selected"; ?> >11:00</option>
                           <option value="5"  <?php if(isset($hdSamedi)) if($hdSamedi =="12:00:00") echo "selected"; ?> >12:00</option>
                           <option value="6"  <?php if(isset($hdSamedi)) if($hdSamedi =="13:00:00") echo "selected"; ?> >13:00</option>
                           <option value="7"  <?php if(isset($hdSamedi)) if($hdSamedi =="14:00:00") echo "selected"; ?> >14:00</option>
                           <option value="8"  <?php if(isset($hdSamedi)) if($hdSamedi =="15:00:00") echo "selected"; ?> >15:00</option>
                           <option value="9"  <?php if(isset($hdSamedi)) if($hdSamedi =="16:00:00") echo "selected"; ?> >16:00</option>
                           <option value="10" <?php if(isset($hdSamedi)) if($hdSamedi =="17:00:00") echo "selected"; ?>>17:00</option>
                      
                        </select>
                         </div>
                         <div class="form-group agenda-col">
                         <select name="HeureFinSAM" id="HeureFin"  class="form-control temps-fin">
                           <option value="1"  <?php if(isset($hfSamedi)) if($hfSamedi =="08:00:00") echo "selected";  ?> >08:00</option>
                           <option value="2"  <?php if(isset($hfSamedi)) if($hfSamedi=="09:00:00") echo "selected"; ?> >09:00</option>
                           <option value="3"  <?php if(isset($hfSamedi)) if($hfSamedi =="10:00:00") echo "selected"; ?> >10:00</option>
                           <option value="4"  <?php if(isset($hfSamedi)) if($hfSamedi =="11:00:00") echo "selected"; ?> >11:00</option>
                           <option value="5"  <?php if(isset($hfSamedi)) if($hfSamedi =="12:00:00") echo "selected"; ?> >12:00</option>
                           <option value="6"  <?php if(isset($hfSamedi)) if($hfSamedi =="13:00:00") echo "selected"; ?> >13:00</option>
                           <option value="7"  <?php if(isset($hfSamedi)) if($hfSamedi =="14:00:00") echo "selected"; ?> >14:00</option>
                           <option value="8"  <?php if(isset($hfSamedi)) if($hfSamedi =="15:00:00") echo "selected"; ?> >15:00</option>
                           <option value="9"  <?php if(isset($hfSamedi)) if($hfSamedi =="16:00:00") echo "selected"; ?> >16:00</option>
                           <option value="10" <?php if(isset($hfSamedi)) if($hfSamedi =="17:00:00") echo "selected"; ?>>17:00</option>
                        </select>
                         </div>
              
                 </div>
                 <hr class="ligne">
         
                 <div class="agenda-row">
                      <div class="agenda-col">
                       <div class="btn-sauvegarder">
                         <button type="submit" name="agenda" id="disable"> Sauvegarder</button>
                       </div>
                       </div>
                 </div>
                 
    </form>       
            <br>

    <hr class="ligne">
              <h4> Mettre a jour vos indisponibilités:</h4>
              <form action="reglage_agenda.php" method="POST"> 
                <div class="agenda-row">
                        <div class="form-group agenda-col" style="flex-grow:1.9">
                          <p>Ajouter une date : </p>
                        </div>
                        <div class="form-group agenda-col" style="flex-grow:2">
                          <input type="date" name="dateIND" class="form-control" required>
                         </div>
                         <div class="agenda-col" style="flex-grow:1">
                            <div class="btn-ajouter">
                            <button type="submit" name="ajouterDate"> Ajouter </button>
                            </div>
                        </div>
              
                </div>
                </form>
                <hr class="ligne">
                <form action="reglage_agenda.php" method="POST">
                <div class="agenda-row">
                       <div class="form-group agenda-col" style="flex-grow:4">
                          <p>Afficher les dates indisponibles: </p>
                        </div>
                         <div class="agenda-col" style="flex-grow:1">
                            <div class="btn-afficher-date">
                            <button type="submit" name="afficherDate"> Afficher </button>
                            </div>
                         </div>
              </div>
              </form>
          <?php 
            
           if(isset($_POST['afficherDate']))
              {
                  echo cree_table($date);  
              }
              ?>
              
       <br><br><br><br> <br><br><br><br>
          
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
</body>

<?php
      }
      else
      {
        header('location: ../index.php');
      }
  ?>