function valida_data(data){
    var v_dia = data.value.substring(0,2);
    var v_mes = data.value.substring(3,5);
    var v_ano = data.value.substring(6,10);	
    if (v_dia > 31)	{
            alert("Data inválida");
            data.focus(); 
            return(false);
    }
    if (v_mes > 12)	{
            alert("Data inválida");
            data.focus(); 
            return(false);
    }
    if(v_dia == "00" || v_mes == "00"){
            alert("Data inválida");
            data.focus(); 
            return(false) ;
    }
    if (v_dia == "31"){
            if ((v_mes == "04") || (v_mes == "06") || (v_mes == "09") || (v_mes == "11")){
                    alert("Data inválida");
                    data.focus(); 
                    return(false);
            }
    }
    if (v_mes == "02"){
            if (!(v_ano%4))	{
                    if (v_dia > 29)	{
                            alert("Data inválida");
                            data.focus(); 
                            return(false);
                    }
            }
            else if (v_dia > 28){
                    alert("Data inválida");
                    data.focus(); 
                    return(false);
            }	
    }		
}