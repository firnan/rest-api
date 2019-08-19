<?php 

	$data = file_get_contents('coba.json');
	$mahasiswa = json_decode($data, true); //jika hanya $data tanpa true maka akan jadi objek, jika array ditambah true

	var_dump($mahasiswa);
	echo $mahasiswa[0]["pembimbing"]["pembimbing1"]; //untuk mengambil nama pembimbing 1 Firnan pada coba.json

 ?>