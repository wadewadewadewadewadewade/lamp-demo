<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$wysiwyg = false;

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8"/>
    <title>Test</title>
    <?php
    if ($wysiwyg) {
      // loaded from https://github.com/raphaelcruzeiro/jquery-notebook with files in dist placed into build
      echo "<link rel=\"stylesheet\" href=\"http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css\" />\n";
      echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"src/js/jquery.notebook.css\" />\n";
    }
    ?>
    <link rel="stylesheet" href="/build/bundle.css"/>
  </head>
  <body>
    <div>
      <h1>test</h1>
      <span id="loading-indicator">Loading...</span>
    </div>
    <?php

      if ($wysiwyg) {
        echo "<div class=\"my-editor\"></div>\n";
      }

      $credentials = json_decode(file_get_contents('./credentials.json'), true);
      if (!$credentials) {
        die('Could not load credentials');
      }

      $mysqli = new mysqli(
        $credentials['host'],
        $credentials['username'], $credentials['password'],
        $credentials['database']);
      
      if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
      }

      $firstName = 'Timber';
      $lastName = 'Saw';
      $query = sprintf("SELECT firstName, lastName, age FROM user ");
        /*WHERE firstName='%s' AND lastName='%s'",
        $mysqli->real_escape_string($firstName),
        $mysqli->real_escape_string($lastName));*/

      $result = $mysqli->query($query);
      if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
      }

      echo "<div class=\"cards\">\n";
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<div>";
        echo "<span>{$row['firstName']}</span>";
        echo "<span>{$row['lastName']}</span>";
        echo "<span>{$row['age']}</span>";
        echo "</div>\n";
      }
      echo "</div>\n";

      $mysqli->close();

    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php
    if ($wysiwyg) {
      echo "<script src=\"build/jquery.notebook.js\"></script>\n";
      echo "<script>$(document).ready(function(){ $('.my-editor').notebook(); });</script>\n";
    }
    ?>
    <script src="/build/bundle.js"></script>
  </body>
</html>