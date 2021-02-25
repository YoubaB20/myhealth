<?php 


require ('con_db.php');
   
    // connexion medecin  et verifier si formulaire a ete bien envoyé
   if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['formconnexionmedecin']))
   {   
                     //appel a la db
                 
               // voire si user a taper email et password
            if(!empty($_POST['email']) AND !empty($_POST['password']) )
            {
                $emailconnect = htmlspecialchars($_POST['email']);
                $pswconnect = htmlspecialchars($_POST['password']);

                 $requser =$bdd->prepare("SELECT * FROM medecin WHERE email = ? AND motdepasse = ? ");
                 $requser->execute(array($emailconnect,$pswconnect));
                 $userexist = $requser->rowCount();
                       // verifier si le medecin existe
                        if($userexist == true)
                        {
                          session_start(); 
                          $userinfo = $requser->fetch();
                          $_SESSION ['id'] = $userinfo['id'];
                          
                           // url vers la page information apres login
                          header("Location: ../medecin/mon_compte_medecin.php");
                                                         
                        } 
                        else
                        {  
                           
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

   // modifier  la page mon_compte_medecin
   
  
   if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['formmodifiermedecin']))
 {   
        //appel a la db
  
   // recuperer les données dans la db 
  $moduser = $bdd->prepare("SELECT * FROM medecin WHERE id = ?");
  $moduser->execute(array($_SESSION['id']));
  $userinfo = $moduser->fetch();
          

      // verifier  si user a modifier le champ adresse
     if(isset($_POST['adress']) AND !empty($_POST['adress']) AND ($_POST['adress'] != $userinfo['adress']))
     { 

       $newadress = htmlspecialchars($_POST['adress']);
       // modifier la table medecin 
       $insertadress = $bdd->prepare("UPDATE medecin SET adress = ? WHERE id = ? ");
       $insertadress->execute(array($newadress, $_SESSION['id']));
       header("location: ../medecin/mon_compte_medecin.php?modifier=Modifié avec succès");
       
     }

       // verifier  si user a modifier le champ telephone medecin
     if(isset($_POST['phone']) AND !empty($_POST['phone']) AND ($_POST['phone'] != $userinfo['telephone']))
     { 

       $newtelephone = htmlspecialchars($_POST['phone']);
       // modifier la table medecin 
       $inserttelephone = $bdd->prepare("UPDATE medecin SET telephone = ? WHERE id = ? ");
       $inserttelephone->execute(array($newtelephone, $_SESSION['id']));
       header("location: ../medecin/mon_compte_medecin.php?modifier=Modifié avec succès");
       
     }

      // verifier  si user a modifier le champ email
     if(isset($_POST['email']) AND !empty($_POST['email']) AND ($_POST['email'] != $userinfo['email']))
      { 

        $newemail = htmlspecialchars($_POST['email']);
        // modifier la table medecin 
        $insertemail = $bdd->prepare("UPDATE medecin SET email = ? WHERE id = ? ");
        $insertemail->execute(array($newemail, $_SESSION['id']));
        header("location: ../medecin/mon_compte_medecin.php?modifier=Modifié avec succès");
        
      }
      
  
      // verifier  si user a modifier le champ  mot de passe
     if(isset($_POST['psw']) AND !empty($_POST['psw']) AND isset($_POST['psw2']) AND !empty($_POST['psw2']))
      { 
        $newpsw1 = htmlspecialchars($_POST['psw']);
        $newpsw2 = htmlspecialchars($_POST['psw2']);
         // verifier user si il a taper meme mot de passe
         if($newpsw1 == $newpsw2)
          {
            
               //modifier la table medecin 
             $insertpsw = $bdd->prepare("UPDATE medecin SET motdepasse = ? WHERE id = ? ");
             $insertpsw->execute(array($newpsw1, $_SESSION['id']));
             header("location: ../medecin/mon_compte_medecin.php?modifier=Modifié avec succès");
             
          }
      }
     
  
    

   
}

?>


