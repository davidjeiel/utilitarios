function mascaraTel(obj){	
    if (obj.value.length==1){
             obj.value = "(" + obj.value;
            return;
    }
    if (obj.value.length==3){
            obj.value = obj.value + ")";
            return;
    }
    if (obj.value.length==8){
            obj.value = obj.value + "-";
            return;
    }
    if (obj.value.length==14){
            var v_fim = obj.value.substring(10,14)
            var v_ini = obj.value.substring(0,8)
            var v_meio = obj.value.substring(9,10)
            obj.value = v_ini + v_meio+ "-" + v_fim;
            return;
    }
}
