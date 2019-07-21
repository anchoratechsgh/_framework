<?php

/*
*@name $sql
*@desc Here is where the actual database connection takes place
*@param DBTYPE => type of database server
*@param SERVER => server domaine OR IP address
*@param DBUSER => database user
*@param DBPASS => database password
*@param DTBASE => database name
*@ll params set from config.php file
*@author Anchora Technologies
*/
if(MYSQL == TRUE):

	$sql = ADONewConnection( DBTYPE );
	$sql->debug = DEBUG;
	$sql->autoRollback = true;
	$sql->bulkBind = true;
	$db = @$sql->Connect( SERVER, DBUSER, DBPASS, DTBASE );

	if($db == false):
		include(ERROR_FRWK.'error_db.php'); 
		exit();
	endif;

endif;
