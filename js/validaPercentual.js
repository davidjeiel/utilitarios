function validaPercentual(edit)
{	 
  if((event.keyCode<48 || event.keyCode>57) && (event.keyCode != 44)){
    event.returnValue=false;
  }
  if (edit.value > 100)
  {
        alert("O valor máximo é 100%.");
        edit.value="";
        edit.focus();
  }   
}
