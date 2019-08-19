
function searchMovie() {
	$('#movies-list').html('');

	$.ajax({
		url : 'http://omdbapi.com',
		type : 'get',
		dataType : 'json',
		data : {
			'apikey' : 'fc1c3df8',
			's' : $('#search-input').val() //s adalah kode pada omdb untuk search
		},
		success : function(result) {
			if (result.Response == "True") {
				let movies = result.Search //Search adalah nama key json nya search movies

				$.each(movies, function(i, data) {
					$('#movies-list').append(`
						<div class="col-md-4">
							<div class="card mb-3" >
							  <img src="` + data.Poster + `" class="card-img-top">
							  <div class="card-body">
							    <h5 class="card-title">` + data.Title + `</h5>
							    <h6 class="card-subtitle mb-2 text-muted">` + data.Year + `</h6>
							    <a href="#" class="card-link see-detail" data-toggle="modal" data-target="#exampleModal" data-id="` + data.imdbID + `">See Detail</a>
							  </div>
							</div>
						</div>
					`)
				});

				$('#search-input').val('');

			} else {
				$('#movies-list').html(`
					<div class="col">
						<h1 class="text-center">` + result.Error + `</h1>
					</div>
				`)
			}
		}
	});
} 

$('#search-button').on('click', function () {
	searchMovie();
});

$('#search-input').on('keyup', function (event) {
	if (event.keyCode === 13) { //13 adalah nomer angka keyCode Enter 
		searchMovie();
	}
});

$('#movies-list').on('click', '.see-detail', function (){
	$.ajax({
		url: 'http://omdbapi.com',
		dataType: 'json',
		type: 'get',
		data: {
			'apikey' : 'fc1c3df8',
			'i': $(this).data('id')
		},
		success : function(movie) {
			if (movie.Response === "True") {
				$('.modal-body').html(`
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-4">
								<img src="`+ movie.Poster +`" class="img-fluid">
						</div>

						<div class="col-md-8">
							<ul class="list-group">
							  <li class="list-group-item"><h3>`+ movie.Title +`</h3></li>
							  <li class="list-group-item">Released : `+ movie.Released +`</li>
							  <li class="list-group-item">Genre : `+ movie.Genre +`</li>
							  <li class="list-group-item">Director : `+ movie.Director +`</li>
							  <li class="list-group-item">Cast : `+ movie.Actors +`</li>
							</ul>
						</div>
						</div>
					</div>
				`);
			}
		}
	});
});