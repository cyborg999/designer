<!DOCTYPE html>
<html>
<head>
	<title>System Designer</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<nav>
	  <a href="index.php">Designer</a> |
	  <a href="tags.php">HTMl Tags</a> |
	  <a href="external.php">External Files</a> |
	  <a href="iamges.php">Images</a> |
	  <a href="fonts.php">Fonts</a>
	</nav>
	<header>
		<?php require_once "model/Model.php";  $model = new Model($data);?>
	</header>