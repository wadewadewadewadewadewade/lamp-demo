SELECT 
  q.id,
  it.label AS inputtypeName,
  q.label AS question
FROM
  questions q
  LEFT JOIN inputtypes it ON q.inputtype = it.id
WHERE
  q.surveyId = %d
ORDER BY
  q.sortorder
