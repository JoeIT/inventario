<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2010
 */

 else if($action == "complete")
 {
    $queryString = $db->real_escape_string($_POST['queryString']);
			
			// Is the string length greater than 0?
			
			if(strlen($queryString) >0) {
				// Run the query: We use LIKE '$queryString%'
				// The percentage sign is a wild-card, in my example of countries it works like this...
				// $queryString = 'Uni';
				// Returned data = 'United States, United Kindom';
				
				// YOU NEED TO ALTER THE QUERY TO MATCH YOUR DATABASE.
				// eg: SELECT yourColumnName FROM yourTable WHERE yourColumnName LIKE '$queryString%' LIMIT 10
				
				$query = $db->query("SELECT value,id FROM countries WHERE value LIKE '$queryString%' LIMIT 10");
				if($query) {
					// While there are results loop through them - fetching an Object (i like PHP5 btw!).
					while ($result = $query ->fetch_object()) {
						// Format the results, im using <li> for the list, you can change it.
						// The onClick function fills the textbox with the result.
						
						// YOU MUST CHANGE: $result->value to $result->your_colum
	         			//echo'<li onClick="fill(\''.$result->value.'\','.$result->id.'\');">'.$result->value.'</li>';
                       /* $li = '<li onClick="fill(\'';
                        $li.= $result->value.'\','\'.$result->id.'\');"';
                        $li.= '>'.$result->value.'</li>';
                        echo $li;*/
                        echo '<li onClick="fill(\''.$result->value.'\','.$result->id.');">'.$result->value.'</li>';
	         		}
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			} else {
				// Dont do anything.
			} // There is a queryString.
    
    
 }

?>