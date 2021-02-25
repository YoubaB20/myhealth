
 
  
 /*======================                 ==================================*/
  function verifier_nom()
  {
  var nom = document.getElementById("nom").value;
  var regex = /^[A-Za-z]{2,}[^0-9²"_§!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]'’,\-.]+$/;
   if(nom.length <1)
   {
    document.getElementById('nom-erreur').innerHTML= " Veuillez compléter ce champ !";
    return false;
   }
   else if(!regex.test(nom))
   {
    document.getElementById('nom-erreur').innerHTML=" Veuillez saisir un nom valid !";
    return false;
  }
    else
    {
      document.getElementById('nom-erreur').innerHTML= ""; 
      return true;
    }
  }

  /*======================                 ==================================*/
  function verifier_prenom()
  {
  var prenom = document.getElementById("prenom").value;
  var regex = /^[A-Za-z]{2,}[^0-9²"_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]'’,\-.]+$/;
  if(prenom.length <1)
  {
   document.getElementById('prenom-erreur').innerHTML= " Veuillez compléter ce champ !";
   return false;
  }
  else if(!regex.test(prenom))
  {
    document.getElementById('prenom-erreur').innerHTML=" Veuillez saisir un prenom valid !";
   //document.getElementById('prenom-erreur').innerHTML=" Votre prenom doit commencer par:  Majuscule , comporter au moins 3 caractères , chiffres et caractères spéciaux exclus !";
   return false;
  }
    else
    {
      document.getElementById('prenom-erreur').innerHTML= ""; 
     return true;
    }
  }

  /*======================                 ==================================*/
 
   function verifier_birthday()
   {
      //date actuelle 
    var date_act = new Date();
   // var jour_act = date_act.getDate();
   // var mois_act = date_act.getMonth();
   // var annee_act = date_act.getFullYear();
   // document.getElementById("afficher2").innerHTML= jour_act +" "+(mois_act+1)+" "+ annee_act ; 


    // date saisie par user
    var birthday = document.getElementById("birthday").value;
    var date = new Date(birthday);
    //var mois = date.getMonth();
    //var annee = date.getFullYear();
    //document.getElementById("afficher").innerHTML= jour +" "+(mois+1)+" "+ annee;

    if( date < date_act)
    {
        document.getElementById("birthday-erreur").innerHTML= "";
        return true;
    }
    else
    {
        document.getElementById("birthday-erreur").innerHTML= "Veuillez saisir une date  valid !";
        return false;
    }
    } 


    




 /*======================                 ==================================*/
 function verifier_email()
 {
 var email = document.getElementById("email").value;
 var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
 if(email.length <1)
 {
  document.getElementById('email-erreur').innerHTML= " Veuillez compléter ce champ !";
  return false;
 }
  else if(!regex.test(email))
   {
     document.getElementById('email-erreur').innerHTML=" Veuillez saisir un e-mail valid !"+"<br>"+" Exemple: meh@gmail.com "
     return false;
    }
   else
   {
     document.getElementById('email-erreur').innerHTML= ""; 
     return true;
   }
 }



 /*======================                 ==================================*/

function verifier_numero_telephone()
{
 
  var phone =  document.getElementById("phone").value;
  var num = phone.charAt(0);
  var num2 = phone.charAt(1);
  var regex = /^[0-9]{9}[^a-zA-Z]$/;
  if(phone.length <1)
 {
  document.getElementById('phone-erreur').innerHTML= " Veuillez compléter ce champ !";
  return false;
 }
  else if(!regex.test(phone))
   {
    document.getElementById('phone-erreur').innerHTML= " Exemple : 0659468434 ";
    return false;   
   }
  else if(num != "0")
   {
    document.getElementById('phone-erreur').innerHTML= "Numéro commence par: 0  !";  
    return false;
   }
   else if( num2 != "5" && num2 != "6" && num2 != "7" )
   {
    document.getElementById('phone-erreur').innerHTML= "Numéro commence par:05 ou 06 ou 07"; 
    return false;   
   }
   else{
    document.getElementById('phone-erreur').innerHTML= ""; 
    return true;
   }
   

}
  /*======================                 ==================================*/

    function verifier_adress()
    {
      var adress = document.getElementById('adress').value;
       if( adress.length < 4 )
       {
        document.getElementById('adress-erreur').innerHTML= " Veuillez saisir l'adresse ";
        return false;   
       }
       else{
        document.getElementById('adress-erreur').innerHTML= ""; 
        return true;
       }
    }

 /*======================                 ==================================*/

function verifier_password()
{
  var psw = document.getElementById("password").value;
  if(psw.length < 1)
  {
    //document.getElementById('psw-erreur').innerHTML= " Veuillez compléter ce champ !";
     return true;
  }
   else if(psw.length < 6 ||  psw.length >20)
   {
     document.getElementById('psw-erreur').innerHTML= " Votre mot de passe: 6 à 20 caractères !";
      return false;
   }
   else
   {
    document.getElementById('psw-erreur').innerHTML="";
    return true;
   }
   
}

  /*======================                 ==================================*/
function verifier_password_confirmation()
{
  
  var psw = document.getElementById("password").value;
  var psw_confirmation = document.getElementById("password_confirmation").value;
  if( psw_confirmation != psw)
  {
    document.getElementById('psw-conf-erreur').innerHTML =" Vos mots de passe ne correspondent pas !"
    return false;
  }
  else
   {
    document.getElementById('psw-conf-erreur').innerHTML="";
    return true;
   }

}


  /*======================                 ==================================*/
    function verifier_message()
    {

    var message = document.getElementById('message').value;
     
   if(message.length > 1 && message.length < 30)
   {
     document.getElementById('message-erreur').innerHTML=" Veuillez saisir au moins 30 caractéres ! "
     return false;
    }
   else
   {
     document.getElementById('message-erreur').innerHTML= ""; 
     return true;
   }
    }
   
  /*=======================        ===================================*/

function form_modifier_patient()
{
   var nom = verifier_nom();
   var prenom = verifier_prenom();
   var email = verifier_email();
   var numero = verifier_numero_telephone();
   var password = verifier_password();
   var password_conf = verifier_password_confirmation();
   var birthday = verifier_birthday();
   
   if(nom && prenom && birthday && email && numero && password && password_conf)
   {
     return true;
   }
   else{
     return false;
   }
}

 /*=======================        ===================================*/

 function form_contact()
 {
    var nom = verifier_nom();
    var prenom = verifier_prenom();
    var email = verifier_email();
    var numero = verifier_numero_telephone();
    var message = verifier_message();
    
    if(nom && prenom && email && numero && message)
    {
      return true;
    }
    else{
      return false;
    }
 }


  /*======================                 ==================================*/
 function form_inscription()
 {
  var nom = verifier_nom();
  var prenom = verifier_prenom();
  var email = verifier_email();
  var numero = verifier_numero_telephone();
  var password = verifier_password();
  var password_conf = verifier_password_confirmation();
  var birthday = verifier_birthday();

  if(nom && prenom && birthday && birthday && email && numero && password &&password_conf )
  {
    return true;
  }
  else{
    return false;
  }

 }

  /*======================                 ==================================*/
 

 /*======================                 ==================================*/
function form_medecin_compte()
{
  var numero = verifier_numero_telephone();
  var adress = verifier_adress();
  var email = verifier_email();
  var password = verifier_password();
  var password_conf = verifier_password_confirmation();
   if( numero && adress && email && password && password_conf)
   {
     return true;
   }
   else{
     return false;
   }
}

/*======================  recharge la page onclick sur button annuler    ==================================*/
function  refresh()
{
  var reset = document.getElementById('reset');
    reset.addEventListener('click',location.reload(), false);
}


/*======================                 ==================================*/
function verifier_heureRdv()
{
var heureRdv = document.getElementById("heureRdv").value;

 if(heureRdv =="")
 {
   //  alert("Veuillez sélectionner l'heure !");
  document.getElementById('heure-erreur').innerHTML=" Veuillez sélectionner l'heure !";
  return false;
}
  else
  {
    document.getElementById('heure-erreur').innerHTML= ""; 
    return true;
  }
}


function form_confirmation_rdv()
{
  var heure = verifier_heureRdv();
  if (heure == true)
    { return true ; }
    else  { return false; }
}




/*
  var nom,prenom,birthday,telephone,email;
      nom = document.getElementById('nom');
      prenom = document.getElementById('prenom');
      birthday = document.getElementById('birthday');
      telephone = document.getElementById('phone');
      email = document.getElementById('email');
      sexe = document.getElementById('sexe');

      nom.onchange = function(){
        alert(' oui nom ');
     };
  
  prenom.onchange = function(){
    alert(' oui prenom ');
 };

 birthday.onchange = function(){
  alert(' oui date de naissance ');
};

telephone.onchange = function(){
  alert(' oui telephone ');
};

email.onchange = function(){
  alert(' oui email ');
};
  
sexe.onchange = function(){
  alert(' oui sexe ');
};
  
 */
  
 