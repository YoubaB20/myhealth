<?php 
 
//appel a la db
    require_once('con_db.php');
   
    // connexion medecin  et verifier si formulaire a ete bien envoyé
   if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['formconnexionpatient']))
   {   
                   // voire si user a taper email et password
            if(!empty($_POST['email']) AND !empty($_POST['password']) )
            {
                $emailconnect = htmlspecialchars($_POST['email']);
                $pswconnect = htmlspecialchars($_POST['password']);

                 $requser =$bdd->prepare("SELECT * FROM patient WHERE email = ? AND motdepasse = ? ");
                 $requser->execute(array($emailconnect,$pswconnect));
                 $userexist = $requser->rowCount();
                       // verifier si le patient existe
                        if($userexist == true)
                        {
                          session_start(); 
                          $userinfo = $requser->fetch();
                          $_SESSION ['id'] = $userinfo['id'];
                          
                           // url vers la page prendre rdv apres login
                          header("Location: ../patient/mon_compte.php");
                                                          
                        } 
                        else
                        {  
                            // email ou mot de passe sont pas valides
                           
                            echo "<div style='text-align:center;margin-top:50px;font-size:18px;padding:20px;line-height:1.7;'>";
                            echo " Email ou mot de passe invalide ! <br>";
                            echo "Veuillez saisir votre email et mot de passe correctement .<br>";
                            echo"<a style='text-decoration:none;' href='../index.php' > Aller vers page d'accueil </a>";
                            echo "</div>";
                            
                        }

            }   
            
             
   }

      // connexion vers page prendre rdv
   if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['formprendreRDV']))
   {   
                   // voire si user a taper email et password
            if(!empty($_POST['email']) AND !empty($_POST['password']) )
            {
                $emailconnect = htmlspecialchars($_POST['email']);
                $pswconnect = htmlspecialchars($_POST['password']);

                 $requser =$bdd->prepare("SELECT * FROM patient WHERE email = ? AND motdepasse = ? ");
                 $requser->execute(array($emailconnect,$pswconnect));
                 $userexist = $requser->rowCount();
                       // verifier si le patient existe
                        if($userexist == true)
                        {
                          session_start(); 
                          $userinfo = $requser->fetch();
                          $_SESSION ['id'] = $userinfo['id'];
                          
                           // url vers la page prendre rdv apres login
                          header("Location: ../patient/prendre_rdv.php");
                                                          
                        } 
                        else
                        {  
                            // email ou mot de passe sont pas valides
                           
                            echo "<div style='text-align:center;margin-top:50px;font-size:18px;padding:20px;line-height:1.7;'>";
                            echo " Email ou mot de passe invalide ! <br>";
                            echo "Veuillez saisir votre email et mot de passe correctement .<br>";
                            echo"<a style='text-decoration:none;' href='../index.php' > Aller vers page d'accueil </a>";
                            echo "</div>";
                            
                        }

            }   
            
             
   }
   
  
  

?>


<?php
// modifier  la page mon_compte_patient
   
  
   if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['formmodifierpatient']))
 {   
    
   // recuperer les données dans la db 
  $moduser = $bdd->prepare("SELECT * FROM patient WHERE id = ?");
  $moduser->execute(array($_SESSION['id']));
  $userinfo = $moduser->fetch();
    
     // verifier  si user a modifier le champ nom
     if(isset($_POST['nom']) AND !empty($_POST['nom']) AND ($_POST['nom'] != $userinfo['nom']))
      { 
        $newnom = htmlspecialchars($_POST['nom']);
        // modifier la table patient
        $insertnom = $bdd->prepare("UPDATE patient SET nom = ? WHERE id = ? ");
        $insertnom->execute(array($newnom, $_SESSION['id']));
        header("location: ../patient/mon_compte.php?modifier=Modifié avec succès");
      } 
     
     
       // verifier  si user a modifier le champ prenom
     if(isset($_POST['prenom']) AND !empty($_POST['prenom']) AND ($_POST['prenom'] != $userinfo['prenom']))
     { 
       $newprenom = htmlspecialchars($_POST['prenom']);
       // modifier la table patient
       $insertprenom = $bdd->prepare("UPDATE patient SET prenom = ? WHERE id = ? ");
       $insertprenom->execute(array($newprenom, $_SESSION['id']));
       header("location: ../patient/mon_compte.php?modifier=Modifié avec succès");
     }
    
      // verifier  si user a modifier le champ date de naissance
      if(isset($_POST['birthday']) AND !empty($_POST['birthday']) AND ($_POST['birthday'] != $userinfo['dateDeNaissance']))
      { 
        $newbirthday = htmlspecialchars($_POST['birthday']);
        // modifier la table patient
        $insertbirthday = $bdd->prepare("UPDATE patient SET dateDeNaissance = ? WHERE id = ? ");
        $insertbirthday->execute(array($newbirthday, $_SESSION['id']));
        header("location: ../patient/mon_compte.php?modifier=Modifié avec succès");
      }

       // verifier  si user a modifier le champ sexe
     if(isset($_POST['sexe']) )
     { 
      $choix = $_POST['sexe'];
      $sexe ="";
      if($choix =="0")  { $sexe = "Homme"; }else if ($choix =="1") {  $sexe = "Femme"; }
       // modifier la table patient
       $insertsexe = $bdd->prepare("UPDATE patient SET sexe = ? WHERE id = ? ");
       $insertsexe->execute(array($sexe, $_SESSION['id']));
       header("location: ../patient/mon_compte.php?modifier=Modifié avec succès");
     }
      
       // verifier  si user a modifier le champ phone
     if(isset($_POST['phone']) AND !empty($_POST['phone']) AND ($_POST['phone'] != $userinfo['phone']))
     { 
       $newphone = htmlspecialchars($_POST['phone']);
       // modifier la table patient
       $insertphone = $bdd->prepare("UPDATE patient SET telephone = ? WHERE id = ? ");
       $insertphone->execute(array($newphone, $_SESSION['id']));
       header("location: ../patient/mon_compte.php?modifier=Modifié avec succès");
     }

      // verifier  si user a modifier le champ email
     if(isset($_POST['email']) AND !empty($_POST['email']) AND ($_POST['email'] != $userinfo['email']))
      { 
        $newemail = htmlspecialchars($_POST['email']);
        // modifier la table patient
        $insertemail = $bdd->prepare("UPDATE patient SET email = ? WHERE id = ? ");
        $insertemail->execute(array($newemail, $_SESSION['id']));
        header("location: ../patient/mon_compte.php?modifier=Modifié avec succès");
      }
      
  
      // verifier  si user a modifier le champ  mot de passe
     if(isset($_POST['password']) AND !empty($_POST['password']) AND isset($_POST['password_confirmation']) AND !empty($_POST['password_confirmation']))
      { 
              $newpsw1 = htmlspecialchars($_POST['password']);
              $newpsw2 = htmlspecialchars($_POST['password_confirmation']);
          // verifier user si il a taper meme mots de passe
          
         if($newpsw1 == $newpsw2)
          {  
               //modifier la table medecin 
             $insertpsw = $bdd->prepare("UPDATE patient SET motdepasse = ? WHERE id = ? ");
             $insertpsw->execute(array($newpsw1, $_SESSION['id']));
             header("location: ../patient/mon_compte.php?modifier=Modifié avec succès");
          }
          
       }
      
  
    
      
   
  }

?>