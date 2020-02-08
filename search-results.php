<?php
include_once('header.php');
$movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;
$longest = getCookieLongest($movies);
$found = false;
if(isset($_GET['search']) && !empty($_GET['search'])) {
    echo "<h1>Search Results for: ", $_GET['search'],"</h1>";
    if(strlen($_GET['search'])<3){echo "<p>Folosiți cel puțin 3 caractere în câmpul de căutare!</p>"; return;}
    function getSearchResults($value){
        return strstr(strtolower( $value->title),strtolower($_GET['search']));
    }
    $movies = array_filter($movies, "getSearchResults"); ?>
    <div class="wrapper">
        <ul>
            <?php
            $index=0;
            foreach ($movies as $singleMovie) {
                $index++;
                displayMovie($singleMovie,$index,$longest);
                $found = true;
              } ?>
        </ul>
    </div>
<?php
        if(!$found){
            echo "<p>Nu a fost gasit nici un film! <br> Incercati alti parametrii de cautare!</p>";
        }
} ?>


<?php include_once('footer.php');?>

