<?php
include_once('header.php');
$genres = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->genres;
function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}

?>
<h1>Genres</h1>
<div class="genres-container">
    <?php
    foreach ($genres as $genre){
        echo"<a style='background-color:#",random_color(),"'href='archive.php?genre=$genre'>$genre</a>";
    }
    ?>
</div>

<?php include_once('footer.php');?>
