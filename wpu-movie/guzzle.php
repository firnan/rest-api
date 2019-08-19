<?php 
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

//$response = $client->request('GET', 'test');
$response = $client->request('GET', 'http://omdbapi.com', [
	'query' => [
		'apikey' => 'fc1c3df8',
		's' => 'Avengers'
	]	
]);

$result = json_decode($response->getBody()->getContents(), true); //true untuk menjadikan array bukan objek
?>
<!DOCTYPE html>
<html>
<head>
	<title>Movie</title>
</head>
<body>
	<?php foreach($result['Search'] as $movie) : ?> <!-- Search adalah nama array di dalam omdb -->
	<ul>
		<li>Title : <?= $movie['Title']; ?></li>
		<li>Year : <?= $movie['Year'] ?></li>
		<li> 
			<img src="<?= $movie['Poster'] ?>" width="80">
		</li>	
	</ul>
<?php endforeach; ?>
</body>
</html>