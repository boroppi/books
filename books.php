<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Books</title>
          <!-- Latest compiled and minified CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
     crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    

</head>

    <body>
        <div class="container">
        <button class="btn btn-primary addnewreview"  type="button"
        onclick="window.location.href='addbook.php'">Add a new review</button>
           
           <?php
            require_once('database.php'); //Contains Database class
            $pdo = Database::connect();
            $sql = "SELECT * FROM book_info order by id DESC;"; // query to grab all books ordered so that new entries appear at top
                        
            echo '<h1>List of Books</h1>';

            foreach($pdo->query($sql) as $row) { //fetch all the books and loop through them
                echo '<div class="row">
                        <div class="col-12"><h3 class="title">'.$row['title'].'</h3></div>
                        <div class="col-3"><img src="images/'. $row['image_of_book'] . '" ></div>
                        <div class="col-9"><p class="genre">Genre:&nbsp; '.$row['genre'].'</p><p class="reviewed-by">Reviewed by:&nbsp;<a href="mailto:'.$row['email_of_submitter'].'"> '  .  $row['name_of_submitter'] . '</a> </p> <br> 
                                   <p class="review-p">'. $row['review'] .'</p> 
                        </div>
                        <div class="w-100"></div>
                        <div class="col-12">Link to store:&nbsp; <a href="'. $row['link_to_online_store'].'">'.$row['link_to_online_store'].'</a> </div>            
                      </div>';
            }   
           Database::disconnect(); // close the connection
            ?>

           
                
           
        </div>
    </body>

</html>