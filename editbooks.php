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
	
	<div class="modal fade" id="updateModal">
	  <div class="modal-dialog">
		<div class="modal-content">

		  <!-- Modal Header -->
		  <div class="modal-header">
			<h4 class="modal-title">Update the book</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		  </div>

		  <!-- Modal body -->
		  <div class="modal-body">
			<div class="form-group">
				<label for="title">Book Title:</label>
				<input name="title" class="form-control" type="text" required />
			</div>
			<div class="form-group">
				<label for="genre">Book Genre:</label>
				<input name="genre" class="form-control" type="text" required />
			</div>
			<div class="form-group">
				<label for="review">Book Review:</label>
				<textarea name="review" class="form-control" rows="3" required></textarea>
			</div>
			<div class="form-group">
				<label for="name">Your Name:</label>
				<input name="name" class="form-control" type="text" required />
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
				<input name="photo" class="form-control inputfileupload" type="file" required />
			</div>
			
				
			
		  </div>

		  <!-- Modal footer -->
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary uptbtnmdl" >Update</button>
		  </div>
		  <div class="alert response" role="alert" style="display:none;">
				
		  </div>

		</div>
	  </div>
	</div>
	
        <div class="tablecontainer">
          
                    <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Genre</th>
                        <th>Review</th>
                        <th>Name of Reviewer</th>
                        <th>Email Address of Reviewer</th>
                        <th>Link</th>
                        <th>Photo</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once('database.php');
                        $pdo = Database::connect(); // open connection to database

                        $sql = 'SELECT * FROM book_info ORDER BY id DESC'; // select every book from database and order so that newer entries apepar at the top.

                        foreach($pdo->query($sql) as $row) // fetch the enties in the database and loop through them and display inside the table
                        {
                            echo '<tr>';							
                            echo '<td>'. $row['id'] . '</td>';
                            echo '<td>'. $row['title'] . '</td>';
                            echo '<td>'. $row['genre'] . '</td>';
                            echo '<td>'. $row['review'] . '</td>';
                            echo '<td>'. $row['name_of_submitter'] . '</td>';
                            echo '<td>'. $row['email_of_submitter'] . '</td>';
                            echo '<td>'. $row['link_to_online_store'] . '</td>';
                            echo '<td>'. $row['image_of_book'] . '</td>';
                            echo '<td>
                                   
                                    <button type="button" class="btn btn-outline-danger action delete" data-pk="' . $row['id'] . '">Delete</button>
                                    <button type="button" class="btn btn-outline-success action update" data-toggle="modal" data-target="#updateModal" data-pk="' . $row['id'] . '">Update</button>
                                   
                                  </td>';
                            echo '</tr>';
                        }
                        
                        Database::disconnect(); // close the connection
                        ?>
                    </tbody>
                    </table>
   
		
        </div>
		
		<!-- js section -->

		<script src="scripts/jquery-3.3.1.min.js"></script>		
		<script src="scripts/deletefunc.js"></script>
		<script src="scripts/updatefunc.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		
    </body>

</html>