<?php /* Smarty version 2.6.26, created on 2014-02-04 15:53:38
         compiled from module/almacen/seller/msg_ordenar.tpl */ ?>
<center>
  <table class="formulario"   align='center'  border="0"  >
    <tr>
      <th align="center"> 
      	

      </th>
      <th align="center"><b> RESULTADO</b></th>
      </tr>
    <tr>
      <td  scope="row" ><?php if ($this->_tpl_vars['result'] == 0): ?>
      
      <img src="template/js/alerts/images/positive.png"  border="0"/>
	
      
      <?php elseif ($this->_tpl_vars['result'] == 1): ?>

      <img src="template/js/alerts/images/important.gif"  border="0"/><br />
    
      <?php endif; ?></td>
      <td  scope="row" >
      
      <?php if ($this->_tpl_vars['result'] == 0): ?>
      <span style="font-size:12px; line-height:20px;color:#374E8A">
     
      Los datos fueron Ordenados.<br />
      A partir de la fecha: <b><?php echo $this->_tpl_vars['dateInit']; ?>
</b>
      </span>
      
      <?php elseif ($this->_tpl_vars['result'] == 1): ?>
        <span style="font-size:12px; line-height:20px;color:#C00">
      Los datos  <b>NO</b> fueron Ordenados. </span>	<br />
      
      Existe comprobantes bloqueados a partir de la fecha: <b><?php echo $this->_tpl_vars['dateInit']; ?>
</b>
     
      </span>
      <?php endif; ?>
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