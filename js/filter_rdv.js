function afficher_par_nom() 
 {
     var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myNom");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++)
     {
         
        td = tr[i].getElementsByTagName("td")[1];
       if (td) {
                 txtValue = td.textContent || td.innerText;
               if (txtValue.toUpperCase().indexOf(filter) > -1 )
                 {
                  tr[i].style.display ="";
                 } 
                 else
                 {
                 tr[i].style.display = "none";
                 }
              }       
 
        
     }
}


function afficher_par_jour() 
 {
     var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myJour");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++)
     {
        
        td = tr[i].getElementsByTagName("td")[3];
       if (td) {
                 txtValue = td.textContent || td.innerText;
               if (txtValue.toUpperCase().indexOf(filter) > -1)
                 {
                  tr[i].style.display = "";
                 } 
                 else
                 {
                 tr[i].style.display = "none";
                 }
              }       
 
        
     }
}



function afficher_par_date_medecin() 
 {
     var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myDate");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++)
     {
        
        td = tr[i].getElementsByTagName("td")[4];
       if (td) {
                 txtValue = td.textContent || td.innerText;
               if (txtValue.toUpperCase().indexOf(filter) > -1)
                 {
                  tr[i].style.display = "";
                 } 
                 else
                 {
                 tr[i].style.display = "none";
                 }
              }       
 
        
     }
}


function afficher_par_jour_patient() 
 {
     var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myJour");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++)
     {
        
        td = tr[i].getElementsByTagName("td")[1];
       if (td) {
                 txtValue = td.textContent || td.innerText;
               if (txtValue.toUpperCase().indexOf(filter) > -1)
                 {
                  tr[i].style.display = "";
                 } 
                 else
                 {
                 tr[i].style.display = "none";
                 }
              }       
 
        
     }
}

function afficher_par_date_patient() 
 {
     var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myDate");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++)
     {
        
        td = tr[i].getElementsByTagName("td")[2];
       if (td) {
                 txtValue = td.textContent || td.innerText;
               if (txtValue.toUpperCase().indexOf(filter) > -1)
                 {
                  tr[i].style.display = "";
                 } 
                 else
                 {
                 tr[i].style.display = "none";
                 }
              }       
 
        
     }
}

