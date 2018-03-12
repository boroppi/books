
// prepend the echo'd div with alert class inside the div that has the container class.	
$(function () { 
	$('div.alert').prependTo('div.container');
	console.log('Moved the div');
});