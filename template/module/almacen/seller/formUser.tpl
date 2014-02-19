<table class="formulario" align='center'  border="1"  width="100%">
<tr>
    <td align="right" scope="row">Nombres</td>
    <td><input type="text" name="client[name]" id="name" value="{$item.name}" /></td>
    <td align="right">Apellidos</td>
    <td><input type="text" name="client[lastName]" id="lastName" value="{$item.lastName}" /></td>
  </tr>
  <tr>
    <td align="right" scope="row">Telefonos</td>
    <td><input type="text" name="client[phones]" id="phones" value="{$item.phones}" /></td>
    <td align="right">Email</td>
    <td><input type="text" name="client[email]" id="email" value="{$item.email}" /></td>
  </tr>
</table>
<input type='hidden' value='' id='clientId' name="clientId">

