<?php

require_once('database.php');
require_once('appconfig.php');
ob_start(); // start the output buffer

$id = $_POST['id'];
$title = $_POST['title'];
$genre = $_POST['genre'];
$review = $_POST['review'];
$name = $_POST['name'];
$email = $_POST['email'];
$link = $_POST['link'];

if(isset($_FILES['photo'])) {
	$photo = $_FILES['photo']['name'];
	$photo_type = $_FILES['photo']['type'];
	$photo_size = $_FILES['photo']['size'];
}

else {
	echo 'Image is required';
	return;
}
	


if(!empty($id) && !empty($title) && !empty($genre) && !empty($review) && !empty($name) && !empty($email) && !empty($link))
{
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Wrong email format';
	return;
	}
	
	if( !( $photo_type == 'image/gif'  ||  $photo_type == 'image/png'
                        ||  $photo_type == 'image/jpg' 
                        ||  $photo_type == 'image/jpeg' )
	||    
	!($photo_size > 0  && $photo_size <= MAXFILESIZE) ) 
	{
			echo 'Error: Your image must be a PNG, JPEG, JPG or GIF and less than 128 KB';	
			return;
	}	
	
	
	if(is_numeric($id))
	{
		
		if($_FILES['photo']['error'] == 0) 
		{ 
		$target = UPLOADPATH . $photo;
			if(move_uploaded_file($_FILES['photo']['tmp_name'], $target)) 
			{
			
				$pdo = Database::connect(); //Open connection to database

				$sql = "UPDATE book_info " .
				"SET title=:title, genre=:genre, review=:review, name_of_submitter=:name_of_submitter, " .
				"email_of_submitter=:email_of_submitter, " .
				"link_to_online_store = :link_to_online_store, image_of_book = :image " .
				"WHERE id= :id "; //update query
				
				$cmd = $pdo->prepare($sql);
				//bind parameter
				$cmd->bindParam(':title', $title);
				$cmd->bindParam(':genre', $genre);
				$cmd->bindParam(':review', $review);
				$cmd->bindParam(':name_of_submitter', $name);
				$cmd->bindParam(':email_of_submitter', $email);
				$cmd->bindParam(':link_to_online_store', $link);
				$cmd->bindParam(':image', $photo);
				$cmd->bindParam(':id', $id, PDO::PARAM_INT); 
				
				$passed = $cmd->execute(); // assign boolean value of execute		
		
			
				if($passed)
				{
					echo 'Updated successfuly';
					//echo json_encode($response);
				}
				else {
					echo 'Update failed';
				}
			
				// disconnect
				Database::disconnect();
					
			}
			else {
				echo 'Error cannot move the file to the directory';
				
			}		
		}
		else {
			echo 'Error: Uploading photo';
			
		}
	}
}
else
{
	echo 'All fields are required';
}

ob_flush(); // clear the output buffer

?>