<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="">
<meta name="author" content="Rexsdev &amp; Design">
<title><?php $sql = "SELECT * FROM settings"; $result = mysqli_query($conn, $sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) {  echo $row['title']; }}?> | <?php if(isset($title)){ echo $title; }?></title>
<link href="<?php echo DIR;?>/assets/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo DIR;?>/assets/css/style.css" rel="stylesheet">
<link href="<?php echo DIR;?>/assets/css/admin.css" rel="stylesheet">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  <script>
          tinymce.init({
              selector: "textarea",
		      font_formats: "Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;Lucida Console=Monaco,monospace;Comic Sans MS=cursive,sans-serif;Trebuchet MS=Helvetica, sans-serif;Verdana=Geneva, sans-serif; Lato= helvetica, sans-serif",
			  fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
              plugins: [
                  "advlist wordcount autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | sizeselect | bold italic | fontselect |  fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image" 
          });
	</script>
</head>
<body>
<?
"\r\n";		
?>