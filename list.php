<!DOCTYPE html>
<html>
<head>
	<title>View Personal Bucketlist</title>
	<meta charset="UTF-8">
	
	<!-- External Bootstrap 3.3.2 Framework to help with styling -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" />
        <link rel="stylesheet" href="css/custom.css" />
	
</head>

<body>
	<?php include_once('header.php'); ?>
	<div class="check-container">
  		<h1 style="font-family: Geneva">Your Food Bucketlist!</h1>
  		<h4 style="font-family: Geneva"><em>Check off the restaurant(s) that you have visited</em></h3>
  		
  		<div class="checkbox">
    <label>
      <input type="checkbox"> One!
    </label>
  </div>
  
  		<div class="checkbox">
    <label>
      <input type="checkbox"> Two!
    </label>
  </div>
  
  		<div class="checkbox">
    <label>
      <input type="checkbox"> Three!
    </label>
  </div>
  
  		<div align="center">
  			<input type="button" name="button" value="Check Off" id="button" onclick="javascript:removeItem();"/>
  		</div>
  	</div>
  	
  	<script>
  	function removeItem() {
  		var x = document.getElementsByTagName("input");
  			for(i = 0; i < x.length; i++) {
  				if (x[i].checked) {
  					x[i].parentNode.removeChild(x[i]);
  				}
  			}
    }
  	</script>
</body>
</html>
