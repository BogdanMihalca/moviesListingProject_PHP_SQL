<?php
function DisplayMovie($singleMovie,$index,$longestRuntime){
    ?>
    <li class="movie-card">
        <div class="movie-poster">
            <img src="<?php if (UR_exists($singleMovie->posterUrl))echo $singleMovie->posterUrl;else echo 'https://v2.cinemaone.net/images/movie_placeholder.png'; ?>" alt="img"/>
        </div>

        <div class="movie-details">
            <h2>
                <?php echo "$index " ,$singleMovie->title; ?>
            </h2>
            <?php
            if ($singleMovie->year >=2010 ){
                echo "<p class='year-2010''>Release year: $singleMovie->year</p>";
            }else{
                echo "<h3>Release year: $singleMovie->year</h3>";
            }
            if(strlen($singleMovie->plot)>100){
                echo "<p>substr($singleMovie->plot,0, 100)</p>";
            }else{
                echo "<p>$singleMovie->plot</p>";
            }
            ?>
            <h3>Lenght:</h3>
            <p><?php echo parseTime($singleMovie->runtime);?></p>
            <div class="progress-bar">
                <div class="progress-inner" style="width:<?php echo ($singleMovie->runtime / $longestRuntime) * 100;  ?>%;"></div>
            </div>

            <a href="single.php?id=<?php echo $singleMovie->id; ?>" class="movie-button">Mai multe detalii >></a>
        </div>
    </li>
<?php } ?>
<?php
function getCookieLongest($movies){
    $cookie_name = "longest-movie-length";
    if(!isset($_COOKIE[$cookie_name])) {
        $longestRuntime=0;
    foreach ($movies as $movie) {
        if($longestRuntime<$movie->runtime)
            $longestRuntime = $movie->runtime;
        }
        setcookie($cookie_name, $longestRuntime);
            return $longestRuntime;
        }else{
            return $_COOKIE[$cookie_name];
        }
    }
function UR_exists($url){
    $headers=get_headers($url);
    return stripos($headers[0],"200 OK")?true:false;
}
function parseTime($time){
    return floor($time/60).' hours and' .$time%60 .'minute';
}
function yearComparison($a, $b)
{

    return $a->year - $b->year;
}
function storeRating(){
    if(isset($_POST['myCheckbox'])){

    }
}

    ?>
