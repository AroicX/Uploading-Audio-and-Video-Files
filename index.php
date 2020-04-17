<?php  
	error_reporting('E_ERROR');
	$db = mysqli_connect('localhost', 'root', '','file');
	if(mysqli_connect_errno()){
		echo 'Database connection failed with the following errors'.mysqli_connect_error();
		die();
	}

	

	if(isset($_POST['uploadfilesub'])){
		$filename = $_FILES['uploadfile']['name'];
		$filenametempname = $_FILES['uploadfile']['tmp_name'];
		$folder = 'picture/';
		$path = $folder.$filename;

		move_uploaded_file($filenametempname, $folder.$filename);

		$insert = $db->query("INSERT INTO `path` ( `image_path`) VALUES ('$path')");

		if ($insert) {
			echo "Uploaded"; 
		}

	}

	$select3 = $db->query("SELECT * FROM `path`");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" enctype="multipart/form-data">
		<input type="file" name="uploadfile">
		<input type="submit" name="uploadfilesub" value="upload">
	</form>

	<?php while($rows2 = mysqli_fetch_assoc($select3)):
									$src = $rows2['image_path'];
								?>	

								 <?php echo "<audio src='$src' controls></audio>"?>
									
								<?php endwhile;?>
</body>
</html>