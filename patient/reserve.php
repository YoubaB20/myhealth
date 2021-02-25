<?php 
session_start();
// importer page  de connexion patient
include('../connexion/connexion_pat.php');
include('../connexion/inscription_pat.php');
setlocale(LC_TIME,'fr');
 ?>

<?php 

$date =$_GET['date'];
$jour =$_GET['jour'];

?>

<?php 
      if(isset($_SESSION['id']) )
      {
        
        //recuperer les donnees dans la db 
        $user = $bdd->prepare("SELECT * FROM patient WHERE id = ?");
        $user->execute(array($_SESSION['id']));
        $userinfo = $user->fetch();
        $id_patient=$userinfo['id'];
        $nom =$userinfo['nom'];
        $prenom =$userinfo['prenom'];
        $email =$userinfo['email'];

        $reqNbr = $bdd->prepare("SELECT  nbrRdvH FROM rdv_par_heure ");
        $reqNbr->execute();
        $nbr = $reqNbr->fetch();
        $nbrRdv_heure = $nbr['nbrRdvH'];
      
        
       
        $requser =$bdd->prepare("SELECT * from agenda where jour = ?");
        $requser->execute(array($jour));
        $info = $requser->fetch();

        $requser =$bdd->prepare("SELECT * from rdv where date = ?");
        $requser->execute(array($date));
      
        $total =$requser->rowcount($requser);
        $reserver = array();
        if($total > 0 )
        {
            
           while($tranches_reserver = $requser->fetch())
           {
                $reserver[] = $tranches_reserver['tranche'];
           }
        }
       
 
    ?>
    <?php
           
           
         
           if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['confirmationRdv']))
          {   
            $heureRdv = $_POST['heureRdv'];
          
            $requser =$bdd->prepare("SELECT * from rdv where date = ? and tranche = ?");
            $requser->execute(array($date,$heureRdv));
            $total =$requser->rowcount($requser);
            if($total > 0 )
            {
                // msg pour eviter une 2 eme insertion de date a la bd on cas ou il a reload page ;
              
            }
            else
            {

              if(isset($_POST['heureRdv']) AND !empty($_POST['heureRdv']))
              {
                
                 
                 // pour extraire l heure debut et heure fin
                // $temps = explode("-",$heureRdv);
                 // index 0 pour heure debut  et 1 pour heureFin |
              // $heureDebut = $temps[0];
               // $heureFin = $temps[1];

               $reqinsert =$bdd->prepare("INSERT INTO rdv (date,jour,tranche,id_patient) values (?,?,?,?)");
               $reqinsert->execute(array($date,$jour,$heureRdv,$id_patient));
              
               $reserver[] =$heureRdv;
               $msg =" Votre RDV a été enregistré ";
              
              }
            }
              
          }
          
          
   
          
     ?>

<?php

  
  function trancheTemps($duration,$cleanup,$debut,$fin)
   {
      $debut = new DateTime($debut);
      $fin =  new Datetime($fin);
      $intervalle = new DateInterval("PT".$duration."M");
      $cleanUpIntervalle = new DateInterval("PT".$cleanup."M");
      $tranches = array();

        for($intDebut =$debut;$intDebut < $fin;$intDebut->add($intervalle)->add($cleanUpIntervalle))
        {
          $finPeriod = clone $intDebut;
          $finPeriod->add($intervalle);
          if($finPeriod > $fin)
         {
          break;
         }

          $tranches[] = $intDebut->format("H:i")." - ".$finPeriod->format("H:i");

        }

     return $tranches;

   }

?>


<?php require ("nav_pat.php ") ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
    <style>
  body{
    margin:0;
    padding:0;
  }

  #showimage{
      background-image: url("../img/calendar.jpg");
      background-repeat:none;
      background-size:cover;
      background-position: center;
      height:100vh;
      display:flex;
      flex-direction:row;
     
    }

    .container{
      width:70%;
    }
    .date-reserve{
        text-align:center;
        padding:10px;
       
    }
    .date-reserve h2{
      color:#1e3ae3;
        font:24px 'montserrat',sans-serif;
        font-weight:bold;
    }
    .sous-titre{
        font: 19px serif;
        font-style:italic;
      }

    .alert{
      border-left:6px groove blue;
      width:50%;
      padding:20px;
      text-align:center;
      color:black;
      font:18px 'Montserrat',sans-serif;
      background:#eeeff7;
      opacity:0.7;
      margin:auto;
    }

    .container-tranche{
        display:flex;
        flex-wrap: wrap;
        width:80%;
        margin:auto;
        
    }

     .tranche.reserve{
         text-align:center;
         border:1px groove white;
         width:22%;
         padding:10px 15px;
         margin:10px;
         border-radius:4px;
      /*   background:#16f916;*/
        background:white;
         cursor:pointer;
     }
     .tranche.reserve i{
       color:blue;
       font-size:18px;
     }
     
     .tranche.deja-reserve{
        text-align:center;
         border:1px groove red;
         width:22%;
         padding:10px 15px;
         margin:10px;
         border-radius:4px;
         background:#ff2300;
     }
     .tranche.deja-reserve i{
       color:black;
       font-size:18px;
     }

     .temps{
         font-size:17px;
     }


     .modal{
       margin:150px 6px;
       width: 450px; 
       height: 250px;  
   }

   .modal-content{
    box-shadow: 0 4px 8px 0 rgba(0, 1, 0, 0.9);
    padding:10px;
    width:90%;
    height:90%;
    
 
    }

    .modal-header{
       text-align:center;
    }
    .modal-header h3{
       color:blue;
       
    }
     .modal-header span{
    margin-left:15px;
     }


.form-group .form-control{
    width:60%;
    height:36px;
    padding:6px 0px;
    font-size:18px;
    color:#555;
    border:1px solid #ccc;
    border-radius:4px;
    resize:vertical;
    box-sizing: border-box;
    font-style:bold;
    margin-left:70px;
    text-align:center;
}
   
  .btn-footer{
     text-align:center;
     margin-top:15px;
  }
.btnconfirme, .btnannuler {
  font:18px "Montressat" ,sans-serif;
  padding: 14px 20px;
  margin: 8px;
  border: none;
  border-radius:5px;
  cursor: pointer;
  width: 40%;
  opacity: 0.9;
 
}
.btnannuler {
  background-color: #f04b31;
  color: white;
}

.btnconfirme {
    color: white;
    background-color: #8edc36;
}
button:hover {
  opacity:1;
}

.ligne{
  margin-top:10px;
  margin-bottom:10px;
  border: 0;
  border-top: 1px groove #eee;
}

.closebtn{
    float:right;
    font-weight:bold;
    line-height: 20px;
    font-size:22px;
    cursor:pointer;
    transition: 0.3s;
  }

  .erreur{
        color:red; font-size:16px; display:block;
        text-align:center;
    }

    
    </style>
</head>

 

 <body>
 <main id="showimage">
  <div class="container">
  
          <div class="date-reserve">
             <h2> Réserver pour : <?php echo $jour." ".date('d/m/Y',strtotime("$date")); ?></h2>
             <h3 class="sous-titre"> Sélectionner l'heure et confirmer </h3>
          </div>

          <?php if(isset($msg))
           { ?>
            <div class="alert" >
            <i class="fas fa-check"></i> <?php  echo $msg;  ?>
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
           </div>
           <?php }  ?>
           <div class="container-tranche">
             <?php 

                  $duration = 60 / $nbrRdv_heure;
                   $cleanup = 0;
                  $debut = $info['heureDebut'];
                  $fin = $info['heureFin'];
     
                  $tranchetemps = trancheTemps($duration,$cleanup,$debut,$fin);
                     foreach($tranchetemps as $tr)
                     {
                        ?>
                      <?php if(in_array($tr,$reserver)) 
                        { ?>
                           <button class='tranche deja-reserve' name="booked" title="Deja réservé"><i class="fas fa-check-circle" ></i>  <span class='temps'><?php  echo $tr; ?></span></button>
                       <?php } 
                         else { ?>
              
                              <button class='tranche reserve'  data-tranche="<?php echo $tr; ?>" title="Ajouter"><i class="fas fa-plus-circle" ></i> <span class='temps'><?php  echo $tr; ?></span></button>
                        <?php  }?>
      
                       <?php 
                        }
                        ?>
    
          </div>

         
</div>
 
     
     <!-- Modal -->
 <div id="myModal" class="modal " >
 
    <div class="modal-content">
      <div class="modal-header">
         <div style="flex-grow:4;">
         <h3 class="modal-title">Réservez à : <!--<span class="temps" id="tranche">--> </span></h4>
         </div>
        
        
      </div>
      <hr class='ligne'>
      <div class="modal-body">
          
               <form action="" method="POST" onsubmit="return form_confirmation_rdv(this)">
                    <div class="form-group">
                     <input class="form-control" type="text" readonly name="heureRdv" id="heureRdv" >
                     <span id="heure-erreur"  class="erreur"></span>
                    </div>
                    <hr class='ligne'>
                 <div class="btn-footer">
                    <button type="submit" class="btnconfirme" name="confirmationRdv"  onclick="verifier_heureRdv()">Confirmer</button>
                    <button type="reset" class="btnannuler" id="reset" onclick="refresh()">Annuler</button>
                 </div>
                </form>
      </div>
      
</div>

  
</div>
  
</main>
     <script src="../js/controle.js"></script>
     <script src="../js/jquery-3.5.1.js"><script>
     <script src="../js/jquery.min.js"></script>
     
     <script>
     $(".reserve").click(function(){
         var timeslot = $(this).attr('data-tranche');
         $("#tranche").html(timeslot);
         $("#heureRdv").val(timeslot);
        // $("#myModal").modal("show");
     })
     
     </script>
 </body>


<?php
      }
      else
      {
        header('location: ../index.php');
      }
  ?>