function reload(){ //Función para recargar la página y agregar el tipo búsqueda de habilidades (Usada en EnterSkills.php)
    var v1=document.getElementById('Tipo').value;
    //document.write(v1);
    self.location='enterSkills.php?cat='+ v1;
}


function DisableDates(){ //Función para desactivar los campos de fecha en el formulario de búsqueda de Bitácora
  if (document.getElementById('cfechas').checked) 
  {
    document.getElementById("fechaini").disabled = true;
  } else {
    document.getElementById("fechaini").disabled = false;
  }
}



