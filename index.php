<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

$surveyId = 1;
$userId = 1;

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
$thisPage = "http://".$_SERVER['HTTP_HOST'].'/';
if (isset($_SERVER['HTTP_REFERER'])){
  $referer = $_SERVER['HTTP_REFERER'];
}

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST' && $referer === $thisPage) {
  $userId = $_POST['userId'];
  // handle postback
  $putSql = file_get_contents('./src/sql/putAnswerByQuestionId.sql');
  foreach ($_POST as $key => $value) {
    $matches = [];
    preg_match ("/question_(\d+)/", $value, $matches, PREG_OFFSET_CAPTURE);
    if (!empty($matches)) {
      $questionId = $matches[1][0];
      $insert = $mysqli->query(sprintf($putSql, $questionId, $userId));
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8"/>
    <title><?php echo "$surveyName"; ?></title>
    <link rel="stylesheet" href="/build/bundle.css"/>
  </head>
  <body>
    <?php

      echo "<h1>{$surveyName}</h1>\n";

      // get questions
      $result = $mysqli->query(sprintf(
        file_get_contents('./src/sql/getQuestionsBySurveyId.sql'),
        $surveyId)
      );
      if (!$result) {
        die (sprintf("Error getting questions for survey id=%d", $surveyId));
      }

      echo "<form action=\"\" method=\"post\" enctype=\"multipart/form-data\">\n";
      $userId++;
      echo "  <input type=\"hidden\" name=\"userId\" value=\"{$userId}\">\n";
      echo "  <ol class=\"questions\">\n";

      //iterate over questions
      while ($questions = mysqli_fetch_assoc($result)) {
        $questionsId = $questions['id'];
        echo "    <li id=\"questions_{$questionsId}\">\n";
        echo "      <span>{$questions['question']}</span>\n";
        echo "      <ol class=\"question\">\n";

        $subresult = $mysqli->query(sprintf(
          file_get_contents('./src/sql/getQuestionsByQuestionsId.sql'),
          $questionsId)
        );
        if (!$subresult) {
          die (sprintf("Error getting questions for section id=%d", $questionsId));
        }
        while ($question = mysqli_fetch_assoc($subresult)) {
          $moniker = "question_{$question['id']}";
          $name = "questions_{$questionsId}";
          $inputType = $questions['inputtypeName'];
          echo "        <li>\n";
          if ($inputType === 'radio') {
            echo "          <input type=\"radio\" name=\"$name\" id=\"$moniker\" value=\"$moniker\" />";
          } else {
            echo "          <input type=\"{$inputType}\" name=\"$name\" id=\"$moniker\" value=\"$moniker\" />";
          }
          echo "          <label for=\"{$moniker}\">{$question['label']}</label>\n";
          echo "        </li>";
        }
        echo "      </ol>\n";
        echo "    </li>\n";
      }
      echo "  </ol>\n";
      echo "<button type=\"submit\">Done</button>\n"; 
      echo "</form>\n";

      $mysqli->close();

    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/build/bundle.js"></script>
  </body>
</html>