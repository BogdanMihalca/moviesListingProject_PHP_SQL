<?php
include_once('header.php');
$genres = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->genres;
$movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;
usort($movies, 'yearComparison');
$longestRuntime = getCookieLongest($movies);
?>
<div class="banner">
    <?php
    echo"<h1>Vă punem la dispoziție o bază dev ". count($movies) ." filme împărțite pe ". count($genres) ." genuri. </h1>";
    ?>
</div>
<div class="wrapper-home">
    <div>
        <h2>Newest Movies</h2>
        <?php
            for($i=count($movies)-1; $i>count($movies)-11; $i--){
                DisplayMovie($movies[$i],count($movies)-$i,$longestRuntime);
            }
        ?>
    </div>
    <div>
         <h2>Oldest Movies</h2>
        <?php
        for($i=0; $i<10; $i++){
            DisplayMovie($movies[$i],$i+1,$longestRuntime);
        }
        ?>
    </div>
</div>
<?php include_once('footer.php'); ?>