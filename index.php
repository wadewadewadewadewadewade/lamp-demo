<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Test</title>
    <link rel="stylesheet" href="/build/bundle.css"/>
  </head>
  <body>
    <div>
      <h1>test</h1>
      <span id="loading-indicator">Loading...</span>
    </div>
    <?php

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

      $firstname = 'Timber';
      $lastName = 'Saw';
      $query = sprintf("SELECT firstName, lastName, age FROM user 
        WHERE firstName='%s' AND lastName='%s'",
        $mysqli->real_escape_string($firstname),
        $mysqli->real_escape_string($lastname));

      $result = $mysqli->query($query, $link);
      if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
      }

      while ($row = mysqli_fetch_assoc($result)) {
        echo $row['firstName'];
        echo $row['lastName'];
        echo $row['age'];
      }

      $mysqli=>close();

    ?>
    <script src="/bundle/build.js"></script>
  </body>
</html>