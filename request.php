<?php
require_once "model/Model.php";

$model = new Model($data);

if(isset($_REQUEST)){
	$method = $_REQUEST['m'];

	$model->{$method}();
}