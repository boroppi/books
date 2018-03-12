<?php
require_once('database.php');
ob_start(); // start the output buffer



$id = $_GET['id'];

if(is_numeric($id))
{
	
	
	$pdo = Database::connect(); //Open connection to database

	$sql = "DELETE FROM book_info WHERE id= :id "; // select every book from database and order so that newer entries apepar at the top.
	
	$cmd = $pdo->prepare($sql);
    $cmd->bindParam(':id', $id, PDO::PARAM_INT); //bind parameter
    $cmd->execute();

	
    // disconnect
    $conn = null;

}

ob_flush(); // clear the output buffer

?>