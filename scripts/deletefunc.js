 $(document).on('click', '.delete', function(){ // on click for element that has delete class in this case it is the buttons
  	
	var title = $(this).parent().parent('tr').children('td:nth-child(2)').html();
	if(confirm('Are you sure you want to delete \"' + title + '\" ?'))
	{			
		var id = $(this).attr('data-pk'); // get Id from data-pk attribute of button
		$clicked_btn = $(this); // assign the button to a variable
		$.ajax({  // AJAX call to deletemovie.php file I created which is only for delete query to database
		  url: 'deletebook.php',
		  type: 'GET',
		  data: {    	
			'id': id  
		  },
		  success: function(response){
			//Remove the row from the table if ajax call returns success
			$clicked_btn.parent().parent('tr').remove();
			
		  }
		});
	}
  });