<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
session_start();
 ?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profile Page</title>
  </head>
  <body>
    <h1>Profile</h1>
    <div>
      <?php

         $db_name = $_ENV['MOVIE_DB_NAME'];
         $host_name = "localhost";
         $p_id = "root";
         $p_pass = "";

         $pdo = new PDO("mysql:dbname={$db_name};
                         host={$host_name};
                         charset=utf8mb4",
                         "{$p_id}","{$p_pass}");

         if (!$pdo) {
           echo "ERROR";
         }

         $list = $pdo -> prepare("SELECT * FROM movie");

         $list -> execute();

         if (!$list) {
           echo "ERROR";
         }else {
          while ($data = $list -> fetch()) {
            echo <<< WHL
            <li><iframe width="560" height="315"
                      src="https://www.youtube.com/embed/{$data["mvid"]}"
                      frameborder="0" allow="autoplay; encrypted-media"
                      allowfullscreen></iframe></li>
WHL;
          }
         }
      ?>
    </div>
  </body>
</html>
