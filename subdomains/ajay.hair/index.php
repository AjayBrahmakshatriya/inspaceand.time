
<?php 
function datestr($fname) {
	return filemtime(dirname(__FILE__).'/'.$fname);
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hair</title>
<link rel="icon" type="image/png" href="https://intimeand.space/images/oldman.jpg">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200&display=swap" rel="stylesheet">

<link rel="stylesheet" href="style.css?v=<?php echo(datestr('style.css'));?>" />
</head>

<body>
<div id="article">
<h1>ajay's hair</h1>
<div id="main-panel">
<center>This website is a monument to my vanity</center>
</div>
</div>
</body>


</html>
