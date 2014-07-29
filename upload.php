<?php 
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>Upload Me Motherfucker!</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Photo Uploader</a>
        </div>
        <div class="collapse navbar-collapse">
        </div><!--/.nav-collapse -->
      </div>
    </div>

   <script type="text/javascript">
   		function checkFile() {
   			var id_val = document.getElementById('photo_chooser').value;
   			if (id_val != '')
   			{
   				var exts = /(.jpg|.jpeg)$/i
   				if(exts.test(id_val))
   				{
   					console.log("Success!")
   				}
   				else 
   				{
   					alert('Only JPEG Supported!');
   				}
   			}
   			else 
   			{
   				alert("Bad!")	
   			}
   		}		
   </script>

    <div class="container">
    	<br><br>
      <div class="starter-template">
        <h1>Upload Your Photo</h1>
        <br>
        <form method="post" action="<?php echo htmlentities($_SERVER['SCRIPT_NAME']) ?>" enctype="multipart/form-data">
    		<input type="file" name="photo" id="photo_chooser" onchange="checkFile()"/> 
    		<br/>
    		<input type="submit" value="Upload"/>    
		</form>
        <p class="lead"></p>
      </div>
    </div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>

<?php 

} elseif (isset($_FILES['photo']) && ($_FILES['photo']['error'] == UPLOAD_ERR_OK)) {
	
	list($width, $height, $type, $attr) = getimagesize($_FILES['photo']['tmp_name']);

	if (exif_imagetype($_FILES['photo']['tmp_name']) != IMAGETYPE_JPEG) {

		echo "BAD!";
    header("Location: http://localhost/error.php");
	
	} elseif ($width != "200" && $height !="200") {

		echo "Photo not the correct size!";
		header("Location: http://localhost/error.php");

	} else {
		
		$newPath = '/Library/WebServer/Documents/uploads/' . basename($_FILES['photo']['name']);

		if ($_FILES["photo"]["size"] >= 100000) {
			
			echo "Image to large!";
			die();
		}
		
		elseif (move_uploaded_file($_FILES['photo']['tmp_name'], $newPath)) {
			
			header("Location: http://localhost/success.php");
		
		} else {
			
			header("Location: http://localhost/error.php");
		}

	}

} else {
	
	echo "Could not be upload!";
}


?>
