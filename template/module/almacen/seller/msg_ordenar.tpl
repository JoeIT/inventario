<center>
  <table class="formulario"   align='center'  border="0"  >
    <tr>
      <th align="center"> 
      	

      </th>
      <th align="center"><b> RESULTADO</b></th>
      </tr>
    <tr>
      <td  scope="row" >{if $result eq 0}
      
      <img src="template/js/alerts/images/positive.png"  border="0"/>
	
      
      {elseif $result eq 1}

      <img src="template/js/alerts/images/important.gif"  border="0"/><br />
    
      {/if}</td>
      <td  scope="row" >
      
      {if $result eq 0}
      <span style="font-size:12px; line-height:20px;color:#374E8A">
     
      Los datos fueron Ordenados.<br />
      A partir de la fecha: <b>{$dateInit}</b>
      </span>
      
      {elseif $result eq 1}
        <span style="font-size:12px; line-height:20px;color:#C00">
      Los datos  <b>NO</b> fueron Ordenados. </span>	<br />
      
      Existe comprobantes bloqueados a partir de la fecha: <b>{$dateInit}</b>
     
      </span>
      {/if}
      <center>
       <div class="buttons">
          <button type="button" name="cancel" class="negative" onclick="parent.location.reload();" > <img src="template/images/icons/delete.png"  border="0"/>Cerrar
            </button>
          </div>   
          </center>
     </td>
      </tr>
    
    
  </table>
 </div> 
</center>