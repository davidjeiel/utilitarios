<? include_once "../rs/usuarios.php"; ?>
<label align="center">Selecione o usuário:</label>
<select  name="seletor_usuario" id="seletor_usuario" class="form-control">
    <option></option>
    <? foreach( $recordset as $val ){ ?>
        <option value="<? echo $val['id_usuario']  ;?>"><? echo $val['nome'] ;?></option>
    <? } ;?>
</select>