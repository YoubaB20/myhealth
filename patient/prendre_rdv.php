<?php 
session_start();
// importer page  de connexion patient
include('../connexion/connexion_pat.php');
include('../connexion/inscription_pat.php');
 setlocale(LC_TIME,'fr');
 //date_default_timezone_set('Africa/Algiers');
 
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

        $reqNbr = $bdd->prepare("SELECT  nbrRdvH FROM rdv_par_heure ");
        $reqNbr->execute();
        $nbr = $reqNbr->fetch();
        $nbrRdv_heure = $nbr['nbrRdvH'];
      
        $requser =$bdd->prepare("SELECT * from agenda order by id");
        $requser->execute();
        $total =$requser->rowcount($requser);
        $jour_work = array();
        if($total > 0 )
        {
           
           
            while( $info = $requser->fetch() )
            {
                $jour_work[] = $info['jour'];
            }
            
        }

      
        $requser =$bdd->prepare("SELECT * from indisponibilites ");
        $requser->execute();
        $total =$requser->rowcount($requser);
        $dateIndisp = array();
        if($total > 0 )
        {
            
            while( $info = $requser->fetch() )
            {
                $dateIndisp[] = $info['date'];
            }
            
        }

       
 
    ?>



  <?php
  // recupere les jour de travail
    function recuperer_jour_travail($array)
    {
      $jours_travail = array();
      if(is_array($array))
      {
        foreach($array as $val)
        {
          $jours_travail[]  = $val;
        }
       
      }
     
     return $jours_travail;
    }


      // recuperer heure debut 
        function recuperer_heure_debut($horaire)
        {
          $heuresDebut = array();
           if(is_array($horaire))
           {
            foreach($horaire as $heure)
            {
               foreach($heure as $hd)
               {
                $heuresDebut[] = $hd['jour']['heureDebut'];
               }
            }
           }
           return $heuresDebut;
        }

         // recuperer fin debut 
         function recuperer_heure_fin($horaire)
         {
           $heuresFin = array();
            if(is_array($horaire))
            {
             foreach($horaire as $heure)
             {
                foreach($heure as $hf)
                {
                 $heuresFin[] = $hf['jour']['heureFin'];
                }
             }
            }
            return $heuresFin;
         }
 ?>
     

     
       





<?php


function cree_calendrier($mois,$annee,$joursTravail,$dateIndisp)
 {

         
      
           //array pour les jours de la semaine
        $joursSemaine = array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');
        // recupere le 1 er jour de mois
        $premierJourMois = mktime(0,0,0,$mois,1,$annee);
         // nombre de jours dans mois 
         $nombreJour = date('t',$premierJourMois);
         // qlq info sur 1jr de mois
         $dateInfo = getdate($premierJourMois);
         // le nom de ce mois actuelle et le formater en francais
         $Mois = $dateInfo['month'];
         $nomMois = utf8_encode(strftime("%B",strtotime("$Mois")));
         
        // returne index 0-6 de 1pr jr du ce mois 
        $jourSemaine = $dateInfo['wday'];

        // date actuelle
       $dateAct = date('Y-m-d-l');
       

          
       
       

           // mois  et annee précédent
       $mois_prec = date('m',mktime(0,0,0,$mois-1,1,$annee)); 
       $annee_prec = date('Y',mktime(0,0,0,$mois-1,1,$annee));
            // mois suivant
       $mois_suiv = date('m',mktime(0,0,0,$mois+1,1,$annee)); 
       $annee_suiv = date('Y',mktime(0,0,0,$mois+1,1,$annee));
         
      
     
        // table 
       $calendrier ="<table>";
       $calendrier.="<div class='calendar-row'>";
       $calendrier.="<div class='date-col' ><h2>$nomMois  $annee </h2> </div>";
       $calendrier.= "<div class='btn-col' ><a class='btn-mois'  href='?mois=".$mois_prec."&annee=".$annee_prec."'><i class='fas fa-chevron-left'></i>Précédent</a>";
       $calendrier.= "<a class='btn-mois' href='?mois=".date('m')."&annee=".date('Y')."'> Mois actuel </a>";
       $calendrier.= "<a class='btn-mois' href='?mois=".$mois_suiv."&annee=".$annee_suiv."'> Suivant<i class='fas fa-chevron-right'></i></a></div>";
       $calendrier.="</div>";
       $calendrier.="<tr>";

          // calendrier header
          foreach( (array)$joursSemaine as $jour)
          {
              $calendrier.="<th> <span class='jour'>$jour</span></th>";
          }

  $calendrier.="</tr><tr>";

         // jours de semaine va avoir 7 colonnes 
           if($jourSemaine > 0)
           {
                for($j=0;$j<$jourSemaine;$j++)
                 {
               $calendrier.="<td class='empty'></td>";
                 }
           }

 // initialisatin compteur jours // variable jour actuelle 
 $jourAct = 1;
 // nombre des mois 
 $mois = str_pad($mois,2,"0",STR_PAD_LEFT);
      
      while($jourAct <= $nombreJour)
      {

         // si 7 colounes atteinte  lancer une nouvelle row 
            if($jourSemaine == 7)
            {
              $jourSemaine = 0;
             $calendrier.="</tr><tr>";
            }

       $jourActRef =  str_pad($jourAct,2,"0",STR_PAD_LEFT);

       $date ="$annee-$mois-$jourActRef";

            // date('l') L minuscule
      $nomJour = strtolower(date('l',strtotime($date)));
         //  les non de semaine en francais  avec ucword() met la 1 lettre en MAJ
       $nomjourfr = ucwords(strftime("%A",strtotime("$nomJour")));

       $evenNum =0;
       $today = $date == date('Y-m-d')." ? 'today' : ";
       // si la date est deja passe alors N/A sinon réservée ou reserve
        if($date < date('Y-m-d') OR in_array($date,$dateIndisp))
        {
            $calendrier.="<td class='N-A'><span class='numjour'>$jourAct</span><a class='indisponible'>Indisponible</a>";
        }
       else if(in_array($nomjourfr,$joursTravail) )
        {
          
          $calendrier.="<td class='$today'><span class='numjour'>$jourAct</span><a href='reserve.php?date=".$date."&jour=".$nomjourfr."' class='btn-reserve'>Disponible</a>";
        } 
        else 
        {
          $calendrier.="<td class='N-A'><span class='numjour'>$jourAct</span><a class='indisponible'>Indisponible</a>";
        }
         

       $calendrier.=" </td>";

       //incrementer compteur
       $jourAct++;
       $jourSemaine++;
      }  
     


 // completer le row de la semaine derniere de mois si nécessaire
 if($jourSemaine != 7)
        {
          $jourRestant = 7-$jourSemaine;
           for($i=0;$i<$jourRestant;$i++)
             {
                 $calendrier.="<td class='empty'></td>";
             }  
        }

 $calendrier.="</tr>";
 $calendrier.="</table>";

   
     
       return $calendrier; 
 


 }

?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
    body{
      padding:0;
      margin:0;
    }
    #showimage{
      background-image: url("../img/calendar.jpg");
      background-repeat:none;
      background-size:cover;
      background-position: center;
      height:113vh;
    }

  .calendar-row{
    padding:5px 0px;
    display:flex;
    flex-direction:row;
    height:50px;
  }
  .date-col{
    flex-grow:2;
  }
  .date-col h2{
    color:blue;
    text-align:center;
    font-size:28px;
    margin-top:5px;
    
  }
  .btn-col{
    display:flex;
    flex-grow:1;
  }
  .btn-mois{
          text-align:center;
          border:1px groove blue;
          border-radius:5px;
          padding:10px 15px;
          margin:5px;
          background:#0d38e4;
          text-decoration:none;
          font:16px 'arial';
          color:white;
      }
      .btn-mois i{
        color:white;
        padding:0px 5px;
        
      }
     
   table{
       margin-top:10px;
       width:100%;
       table-layout:fixed;
     }
      
      th{
        width:12%;
        height:36px;
        background:#eee;
        border-radius:3px;
      }
       
      td{
        background:white;
        border:1px groove lightblue; 
        border-radius:5px; 
      }

      .jour{
        font:20px 'Montserrat',sans-serif;
        font-weight:bold;
        color:#111111;
      }
   
      .numjour{
       font-size:19px; 
       font-weight:bold;
       color:#22153a; 
       background:#f0f7f5; 
       padding:2px 0px 2px 8px;
       display:flex;
       border-top-left-radius:5px;
       border-top-right-radius:5px;
      }
      
     
     
      .btn-reserve{
        text-decoration:none;
        padding: 13px 0px;
        text-align:center;
        float:left;
        width:100%;
        font:18px 'Montserrat',sans-serif;
        border-bottom-left-radius:5px;
        border-bottom-right-radius:5px;
        background: linear-gradient(#1230d4,#0a22a5);
        color:white;
        
      }
      .btn-reserve:hover{ /*background:#865e1d;*/ opacity:0.8 }
     
      .indisponible{
        text-decoration:none;
        padding: 13px 0px;
        text-align:center;
        float:left;
        width:100%;
        font:18px 'Arial',sans-serif;
        font-weight:bold;
        color:#407f75;
        border-bottom-left-radius:5px;
        border-bottom-right-radius:5px;
        
      }
      .N-A{
        background: #FFFFFF;
      }
      .N-A .numjour{
        background:#FFFFFF;
        border-bottom:1px groove;
      }

      .empty{
         border:none;
         visibility:hidden;
      }

      .container-calendrier{
        width:65%;
        margin:auto;
      }

      .container{
       
      }
      .titre-header{
        margin:0px;
        text-align:center;
        padding:20px;
      }

      .titre{
        margin:0px;
        color:#1e3ae3;
        font:24px 'Arial Black', Gadget, sans-serif;;
        font-weight:bold;
      }
      .sous-titre{
        font: 19px serif;
        font-style:italic;
      }

    </style>
</head>
<body>
<?php require ("nav_pat.php ") ?>
 <main id="showimage">

  
<?php
             $dateInfo = getdate();
            if(isset($_GET['mois']) AND isset($_GET['annee']))
             {
               $mois = $_GET['mois'];
               $annee = $_GET['annee'];
             }
             else
             {
                $mois = $dateInfo['mon'];
                $annee = $dateInfo['year'];
             }
            

            ?>

    <div class="titre-header">
      <h2 class="titre"> Réserver maintenant votre RDV</h2>
      <h3 class="sous-titre"> Sélectionner la date du RDV  </h3>
    </div>
<div class="container">
        <div class="container-calendrier">
           
       <?php     echo cree_calendrier($mois,$annee,$jour_work,$dateIndisp);  ?>
            
        </div> 
     </div>


     </main>
</body>

                     


<?php
      }
      else
      {
        header('location: ../index.php');
      }
  ?>