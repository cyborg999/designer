<?php

$data = array(
	"username" 	=> "root",
	"password" 	=> "",
	"server" 	=> "localhost",
	"database"	=> "designer"
);

function op($data){
	echo "<pre>";
	print_r($data);
}

function opd($data){
	op($data);
	die();
}


function redirect($url){
	header("Location:$url");
}