<?php

 include_once('con_db.php');

   //verifier si le formulaire a été envoyé  action inscription patient
   if(isset($_POST['forminscription']) AND $_SERVER["REQUEST_METHOD"] == "POST" )
   {
           //verifier les champs sont pas vides
          if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['date_de_naissance']) AND !empty($_POST['email']) AND !empty($_POST['password'])  AND !empty($_POST['password_confirmation']) AND  !empty($_POST['phone']) )
           {
                  
                  $nom = htmlspecialchars($_POST['nom']);
                  $prenom = htmlspecialchars($_POST['prenom']);
                  $date_de_naissance = htmlspecialchars($_POST['date_de_naissance']);
                  $email = htmlspecialchars($_POST['email']);
                  $password = htmlspecialchars($_POST['password']);
                  $password2 = htmlspecialchars($_POST['password_confirmation']);
                  $phone = htmlspecialchars($_POST['phone']);
                  
                     
                    if(isset($_POST['sexe']) )
                    {
                         $choix = $_POST['sexe'];
                         $sexe ="";
                         if($choix =="0")  { $sexe = "Homme"; }else if ($choix =="1") {  $sexe = "Femme"; }
                   
                         // voire si email n'existe pas deja 
                            $reqemail = $bdd->prepare("SELECT * FROM patient WHERE email = ? ");
                            $reqemail->execute(array($email));
                            $emailexist = $reqemail->rowcount();
                              if($emailexist == false)
                                 {

                                  // verifier les 2 mot de passe si sont identiques
                                    if($password == $password2)
                                       {
                                        
                                           //inserer patient a la db
                                         $insertuser = $bdd-> prepare("INSERT INTO patient(nom,prenom,email,motdepasse,telephone,dateDeNaissance,sexe)values(?,?,?,?,?,?,?)"); 
                                         $insertuser ->execute(array($nom,$prenom,$email,$password,$phone,$date_de_naissance,$sexe));
                                         
                                         // recuperer les donnees user inscrit 
                                         $requser = $bdd->prepare("SELECT * FROM patient where   nom = ? AND prenom = ? AND email = ?");
                                         $requser->execute(array($nom,$prenom,$email));
                                         $userinfo = $requser->fetch();
                                           // demarrer la session 
                                       session_start();
                                       $_SESSION['id'] = $userinfo['id'];
                                       header("location: ../patient/mon_compte.php");
                                       
                                         
                                        }
                                      
                                 }  
                                 else
                                 { /*  
                                   echo "<div style='text-align:center;margin-top:50px;font-size:18px;padding:20px;line-height:1.6;'>";
                                     echo " Email existe deja <br>";
                                     echo "Veuillez saisir un autre email .";
                                  echo "</div>";
                                  */
                                   header('location: ../patient/inscription.php?email-existe=Email existe déja <br> Veuillez saisir un autre email');
                                 }
                     }

           }
          


    }
    


?>

