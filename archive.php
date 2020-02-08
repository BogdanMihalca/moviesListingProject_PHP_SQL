    <?php
    include_once('header.php');
	// Accesați acest link pentru a vedea lista originală cu toate filmele pe care am
	// folosit-o mai jos: https://github.com/yegor-sytnyk/movies-list/blob/master/db.json
	$movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;
    $longestRuntime = getCookieLongest($movies);
	//lista actori (cu dubluri)
	$actorsList = array();
	?>

	<div class="loader">
		<h1>Please wait...</h1>
	</div>
        <?php
            if(isset($_GET['genre']) && !empty($_GET['genre'])){
                function callback($value){
                    return in_array($_GET['genre'], $value->genres);
                }
                $movies = array_filter($movies, "callback");
                echo "<h1>Movies genre: ", $_GET['genre'],"</h1>";
            }
        ?>

		<div class="wrapper">
			<ul>
				<?php
					$index=0;
					foreach ($movies as $singleMovie) {
							$index++;
							displayMovie($singleMovie,$index,$longestRuntime);
                     $pieces = explode(",", $singleMovie->actors); $actorsList = array_merge($actorsList, $pieces);
				  }?>
			</ul>
			<div class="sidebar">
				<h3>Actors:</h3>
				<ol>
					<?php
					$actorsList = array_unique($actorsList);
					sort($actorsList);
						foreach ($actorsList as $actor) {
							echo "<li>",$actor,'</li>';

						}
					 ?>
				</ol>
			</div>
			<script type="text/javascript">
				document.getElementsByClassName('loader')[0].style.display = 'none';
			</script>
			
		</div>
    <?php include_once('footer.php');?>
