<center>
<table class="formulario" align='center' style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px" border="1" cellspacing="0" cellpadding="0"  width="90%">
 
 
     <td scope="row">Fecha</td>
     <td>{$smarty.now|date_format:"%Y-%m-%d"} </td>
   </tr>
    <td width="22%"  nowrap="nowrap" >Para</td>
    <td width="78%">{$item.destino|htmlentities}</td>
  </tr>
 
  <tr>
    <td scope="row">De</td>
    <td>{$item.origen|htmlentities}</td>
  </tr>
   <tr>
     <td scope="row">Referencia</td>
     <td>{$item.referencia}</td>
   </tr>
  
   <tr>
     <td scope="row">Asunto</td>
     <td>{$item.asunto}</td>
   </tr>
</table>
<br />
{$item.description}

</center>