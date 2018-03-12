$(document).on('click', '.update', function(){ // on click event for update button inside the table row
	
	// get the id from it's attribute
	id = $(this).attr('data-pk');
	
	form_data = new FormData(); // initialize empty FormData incase user does not try to upload file.
	
	// assign jQuery selectors some names 
	$title = $("input[name='title']");
	$genre = $("input[name='genre']");
	$review = $("textarea[name='review']");
	$name = $("input[name='name']");
	$email = $("input[name='email']");
	$link = $("input[name='store']");
	
	title = $(this).parent().parent('tr').children('td:nth-child(2)').html();
	var genre = $(this).parent().parent('tr').children('td:nth-child(3)').html();
	var review = $(this).parent().parent('tr').children('td:nth-child(4)').html();
	var name = $(this).parent().parent('tr').children('td:nth-child(5)').html();
	var email = $(this).parent().parent('tr').children('td:nth-child(6)').html();
	var _link = $(this).parent().parent('tr').children('td:nth-child(7)').html();
	
	
	
	//get values of the inputs
	$title.val(title);
	$genre.val(genre);
	$review.val(review);
	$name.val(name);
	$email.val(email);
	$link.val(_link);
	
  });
  
  $(function() {
     $("input:file").change(function (e){ // input where we upload the file.. whenever a file uploaded it triggers the event
  		
		file_data = e.currentTarget.files[0]; // get the uploaded file
		form_data = new FormData(); //create a form
		form_data.append('photo', file_data); // append the stuff into the form that we are going to submit via ajax
     });
  });
  
  $(document).on('click', '.uptbtnmdl', function(){ // on click event for update 
  
	// get the values inside the inputs
	var title = $("input[name='title']").val();
	var genre = $("input[name='genre']").val();
	var review = $("textarea[name='review']").val();
	var name = $("input[name='name']").val();
	var email = $("input[name='email']").val();
	var _link = $("input[name='store']").val();
	
	form_data.append('id',id);
	form_data.append('title',title);
	form_data.append('genre',genre);
	form_data.append('review',review);
	form_data.append('name',name);
	form_data.append('email',email);
	form_data.append('link',_link);
	
		 for (var p of form_data) { // for debugging form data
			console.log(p);
		 }	
		
	$.ajax({  // AJAX call to deletemovie.php file I created which is only for delete query to database
		url: 'updatebook.php',		
        cache: false,
        contentType: false,
        processData: false,
		type: 'POST',
		data: form_data,
		
		success: function(response){
			
			if(response == 'Updated successfuly')
			{
				$alertdiv = $('.alert.response'); // assign a name for the selector
				$alertdiv.html(response);
				$alertdiv.removeClass('alert-danger');
				$alertdiv.addClass('alert-success');
				$alertdiv.fadeIn('slow').fadeOut(5000);
				
				$('.table > tbody > tr').each(function () { // loop through all rows in table
					if(id == (($(this).children('td:nth-child(1)').html()))) // find the row we edited
					{		
						//update the table row accordingly...
						$(this).children('td:nth-child(2)').text(title);
						$(this).children('td:nth-child(3)').text(genre);
						$(this).children('td:nth-child(4)').text(review);
						$(this).children('td:nth-child(5)').text(name);
						$(this).children('td:nth-child(6)').text(email);
						$(this).children('td:nth-child(7)').text(_link);
						$(this).children('td:nth-child(8)').text(file_data.name);
					}
				});
			}
			else{
				$alertdiv = $('.alert.response'); // assign a name for the selector
				$alertdiv.html(response);
				$alertdiv.removeClass('alert-success');
				$alertdiv.addClass('alert-danger');
				$alertdiv.fadeIn('slow').fadeOut(5000);
			}
		  }
	});
	
  });
	
  
 