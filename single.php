<?php
    include 'header.php' ;
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $movieID = $_GET["id"];
        $movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;
        if(!array_key_exists($movieID-1, $movies)) {
            echo "<h1>Pagina nu exista</h1>";
            echo "<a href='archive.php'><--- Inapoi la arhive..</a>";
        }else {
            $movie = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies[$movieID-1]
?>
<ul>
        <li class="movie-card">
            <div class="movie-poster">
                <img src="<?php if (UR_exists($movie->posterUrl))echo $movie->posterUrl;else echo 'https://v2.cinemaone.net/images/movie_placeholder.png'; ?>" alt="img"/>
            </div>
            <div class="movie-details">
                <h2>
                    <?php echo $movie->title; ?>
                </h2>
                <?php
                    echo "<p class='year-2010'>Release year:$movie->year</p>";
                    echo "<p>$movie->plot</p>";
                    if(strcmp($movie->director,"N/A")){
                        echo "<h3>Director:</h3>";
                        echo"<p>$movie->director</p>";
                     }
                ?>

                <h3>Actors:</h3>
                <p><?php echo $movie->actors ?></p>
                <h3>Genres:</h3>
                <p>
                    <?php
                    $lastElement = end($movie->genres);
                    foreach ($movie->genres as $genre) {
                        if($genre == $lastElement)
                            echo "$genre ";
                        else
                            echo "$genre, ";
                    }
                    ?>
                </p>
                <h3>Lenght:</h3>
                <p><?php echo floor($movie->runtime/60),' hours and ',$movie->runtime%60,' minute';?></p>
                <div class="progress-bar">
                   <?php include 'longest-movie.php';
                    $longestRuntime = getCookieLongest($movies); ?>
                    <div class="progress-inner" style="width:<?php echo ($movie->runtime / $longestRuntime) * 100;  ?>%;"></div>
                </div>
            </div>
        </li>
</ul>
        <?php  } }else {
        echo "<h1>Pagina nu exista</h1>";
        echo "<a href='archive.php'><--- Inapoi la arhive..</a>";
    } ?>

<?php include_once('footer.php'); ?>
