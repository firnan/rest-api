<?php 
	
	/*$mahasiswa = [
		[
			"nama" => "Firnan Sholihuda",
			"nim" => "123140088",
			"email" => "firnan@gmail.com"
		],
		[
			"nama" => "Alvani Rizky",
			"nim" => "123140027",
			"email" => "alvani@gmail.com"
		]
	];*/

	//var_dump($mahasiswa); //bentuknya masih Array

	$dbh = new PDO('mysql:host=localhost;dbname=skripsi', 'root', '');
	$db = $dbh->prepare('SELECT * FROM dosen');
	$db->execute();
	$mahasiswa = $db->fetchAll(PDO::FETCH_ASSOC); //untuk membuat jadi susunan asosiatif

	$data = json_encode($mahasiswa);
	echo $data;
 ?>