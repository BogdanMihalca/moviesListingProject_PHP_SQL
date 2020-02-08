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
                   <?php
                    $longestRuntime = getCookieLongest($movies); ?>
                    <div class="progress-inner" style="width:<?php echo ($movie->runtime / $longestRuntime) * 100;  ?>%;"></div>
                </div>
                <form class="rating-form">
                    <fieldset class="rating">
                        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                        <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                        <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                        <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                    </fieldset>
                    <input type="submit" value="Trimite">
                    <?php storeRating(); ?>
                </form>
            </div>
        </li>
</ul>
        <?php  } }else {
        echo "<h1>Pagina nu exista</h1>";
        echo "<a href='archive.php'><--- Inapoi la arhive..</a>";
    } ?>

<?php include_once('footer.php'); ?>
