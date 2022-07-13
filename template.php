<!DOCTYPE html   >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="styles.css" />

	<title>APP NewsSystem PHP 7 Custom</title>  
</head>

<body>
<div id="global">
<!-- Header Template -->
<header>
    <a href="index.php" alt="Front-end User"><?php include("header.html"); ?></a>
</header>

<section style="margin: auto">
<!-- Le contenu central -->
    <?= $content ?>  	

</section> 
<!-- Footer Template -->
<footer><?php include("footer.html"); ?></footer>
</div>

</body>
	
</html>


