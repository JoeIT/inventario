<?php

/**
 * @author Johan Vera P.
 * @copyright 2010
 */

class reportGral
{
    var $table;
    function reportGral()
    {
        $this->table = "product_item";
        
    }  
      /**
     * Lista de las categorias
     * */
    function getListCategory()
    {
        global $db;        
        $sql = " select * from product_category order by name";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
}

?>