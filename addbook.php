<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Add Book Review</title>
          <!-- Latest compiled and minified CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
     crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

</head>

    <body>
 
	<?php
	
	require_once('appconfig.php');  // add app config variables that hold where to store file and max image size
   
	require_once('database.php'); // Contains Database class
	
	if(isset($_POST['submit'])) // runs when add review button is clicked
	{//start0
		
		//store what we get from html fields into variables below
		$title = $_POST['title'];
		$genre = $_POST['genre'];
		$review = $_POST['review'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$link = $_POST['store'];                
		$photo = $_FILES['photo']['name'];
		$photo_type = $_FILES['photo']['type'];
		$photo_size = $_FILES['photo']['size'];
		

		//Validation in client side is not enough here we need to valite them again on server side.
		if(!empty($title) && !empty($genre) && !empty($review) &&
		 !empty($name) && !empty($email) && !empty($link) && !empty($photo)) //start1
		{
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo '<div class="alert alert-danger" role="alert">
						Error: Wrong Email format!
				  </div>';
			
			}
			
			elseif(  ( $photo_type == 'image/gif'  ||  $photo_type == 'image/png'
				||  $photo_type == 'image/jpg' 
				||  $photo_type == 'image/jpeg' )
				&&    
				($photo_size > 0  && $photo_size <= MAXFILESIZE) ) 
			{ //start2
				if($_FILES['photo']['error'] == 0) 
				{ //start3
					$target = UPLOADPATH . $photo;
					if(move_uploaded_file($_FILES['photo']['tmp_name'], $target)) 
					{//start4
				
						try
						{
						// Connect to our database
						//$dbc = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
						$dbc = Database::connect();
						//set up error mode, set to exception
						$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

						//prepare the query
						$sql = $dbc->prepare("INSERT INTO book_info(title,
																	genre, 
																	review,
																	name_of_submitter,
																	email_of_submitter,
																	link_to_online_store,
																	image_of_book)
											VALUES (:title, :genre, :review, :name, :email, :link, :image)");

						//bind parameters
						$sql->bindParam(':title', $title, PDO::PARAM_STR, 60);
						$sql->bindParam(':genre', $genre, PDO::PARAM_STR, 50);
						$sql->bindParam(':review', $review, PDO::PARAM_STR, 250);
						$sql->bindParam(':name', $name, PDO::PARAM_STR, 50);
						$sql->bindParam(':email', $email, PDO::PARAM_STR, 100);
						$sql->bindParam(':link', $link, PDO::PARAM_STR, 250);
						$sql->bindParam(':image', $photo,PDO::PARAM_STR, 100);
						
						//execute the query
						$sql->execute();
						
						//Confirm success with the user_error
						echo '<div class="alert alert-success" role="alert">
								Success: Thanks for adding your book review!!
							  </div>';
					   
						
						
						//dispose of variables
						$name = "";
						$email = "";
						$photo = "";

						}

						catch(PDOException $e) 
						{
							echo "Error:". $e->getMessage();
						}

						Database::disconnect(); // close connection

					}//end4
					else
					{
						echo '<div class="alert alert-danger" role="alert">
								Error: There was a problem uploading your file!
							  </div>';
						
					}
				}//end3
				else
				{
					echo '<div class="alert alert-danger" role="alert">
								Error: Uploading File!
							  </div>';
					
				}
			   
			}//end2
			else
			{
				echo '<div class="alert alert-danger" role="alert">
								Error: Your image must be a PNG, JPEG, JPG or GIF and less than 128 KB 
							  </div>';
			
			}      
			
			// Try to delete the temporary screen shot image file
			@unlink($_FILES['screenshot']['tmp_name']);
		}//end1
		else
		{
			echo '<div class="alert alert-danger" role="alert">
			Error: Please enter all the info 
		  </div>';
			   
		}          
	}//end0      


	?>

		<div class="container">
		<button class="btn btn-primary view-list-of-movies"  type="button" 
		onclick="window.location.href='books.php'">View List of Movies</button>
		<h2>Add A New Movie Review</h2>
		<p class="lead blue">Please complete the following form:</p>
			<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="form-group">
					<label for="title">Book Title:</label>
					<input name="title" class="form-control" type="text" required/>
				</div>
				<div class="form-group">
					<label for="genre">Book Genre:</label>
					<input name="genre" class="form-control" type="text" required/>
				</div>
				<div class="form-group">
					<label for="review">Book Review:</label>
					<textarea name="review" class="form-control" rows="3" required></textarea>
				</div>
				<div class="form-group">
					<label for="name">Your Name:</label>
					<input name="name" class="form-control" type="text" required/>
				</div>
				<div class="form-group">
					<label for="email">Your Email: </label>
					<input name="email" class="form-control" type="email" required />
				</div>
				<div class="form-group">
					<label for="store">Link to Online Store:</label>
					<input name="store" class="form-control" type="text" required/>
				</div>
				<div class="form-group">
					<label for="photo">Image of the Book:</label>
					<input name="photo" class="form-control" type="file" class="btn btn-default" required/>
				</div>
				<div class="form-group">
					<input type="submit" value="Add Review" class="btn btn-primary" name="submit" />
				</div>
			</form>
		</div>
       
		<script src="scripts/jquery-3.3.1.min.js"></script>	
		<script src="scripts/moveAddbookAlertDivFunc.js"></script>

    </body>

</html>