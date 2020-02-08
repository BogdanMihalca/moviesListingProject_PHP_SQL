<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <title>Curs 5 - Tema</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include_once ('functions.php');
?>
<header>
    <img src="images/logo.png" alt="logo">
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="archive.php">Movies</a></li>
            <li><a href="genres.php">Genres</a></li>
            <li><a href="#">Contact</a></li>
            <!-- The form -->
            <li>
                <form class="search-form" action="search-results.php" method="get">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </li>
        </ul>
    </nav>
</header>