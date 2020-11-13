SELECT
  id,
  label
FROM
  question
WHERE
  questionsId = %d
ORDER BY
  sortorder
