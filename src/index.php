<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$credentials = json_decode(file_get_contents('../credentials.json'), true);
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

$surveyId = 1;

// get survey
$result = $mysqli->query(sprintf("SELECT `name` FROM survey WHERE id = %d", $surveyId));
if (!$result) {
  die (sprintf("Cannot find survey id=%d", $surveyId));
}
$surveyName = "unknown";
while ($row = mysqli_fetch_assoc($result)) {
  $surveyName = $row['name'];
}

$referer = "";
$thisPage = "http://".$_SERVER['HTTP_HOST'].'/src/';
if (isset($_SERVER['HTTP_REFERER'])){
  $referer = $_SERVER['HTTP_REFERER'];
}

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST' && $referer === $thisPage) {
  // handle postback
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8"/>
    <title><?php echo "$surveyName"; ?> Results</title>
    <link rel="stylesheet" href="/build/bundle.css"/>
  </head>
  <body>
    <?php

      echo "<h1>{$surveyName} Results</h1>\n";

      // get rollup
      $result = $mysqli->query(sprintf("call rollup(%d);",$surveyId));
      if (!$result) {
        die (sprintf("Error getting rollup for survey id=%d", $surveyId));
      }

      echo "<form action=\"\" method=\"post\" enctype=\"multipart/form-data\">\n";
      echo "  <ol class=\"questions\">\n";

      //iterate over questions
      while ($questions = mysqli_fetch_assoc($result)) {
        echo "    <li>\n";
        echo "      <span>{$questions['question']}</span>\n";
        echo "      <span>{$questions['answer']}</span>\n";
        echo "      <span>{$questions['total']}</span>\n";
        echo "    </li>\n";
      }
      echo "  </ol>\n";
      //echo "<button type=\"submit\">Done</button>\n"; 
      echo "</form>\n";

      $mysqli->close();

    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/build/bundle.js"></script>
  </body>
</html>