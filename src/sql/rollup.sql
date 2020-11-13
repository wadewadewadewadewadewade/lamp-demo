DELIMITER $$

CREATE PROCEDURE rollup(IN surveyId MEDIUMINT)
BEGIN
  
CREATE TEMPORARY TABLE rollup (
  id MEDIUMINT NOT NULL AUTO_INCREMENT,
  questionsId MEDIUMINT NOT NULL,
  questionId MEDIUMINT NOT NULL,
  total MEDIUMINT DEFAULT 0,
  PRIMARY KEY (ID)
);

CREATE TEMPORARY TABLE rollupreduced (
  id MEDIUMINT NOT NULL AUTO_INCREMENT,
  questionsId MEDIUMINT NOT NULL,
  total MEDIUMINT DEFAULT 0,
  PRIMARY KEY (ID)
);

-- totall answers
INSERT INTO rollup (questionsId, questionId, total)
SELECT
  qs.id AS questionsId,
  q.id AS questionId,
  count(a.userId) AS total
FROM
  answer a
  LEFT JOIN question q ON a.questionId = q.id
  LEFT JOIN questions qs ON q.questionsId = qs.id
WHERE
  qs.surveyId = surveyId
GROUP BY
  qs.id,
  q.id
ORDER BY
  qs.sortorder,
  count(a.userId) DESC;

-- get most commen answer by question
INSERT INTO rollupreduced (questionsId, total)
SELECT questionsId, MAX(total) AS total FROM rollup GROUP BY questionsId;

-- format result
SELECT
  qs.label AS question,
  q.label AS answer,
  rrr.total
FROM (
  SELECT DISTINCT 
    r.questionsId,
    r.questionId,
    r.total
  FROM
    rollup r
    WHERE EXISTS (
      SELECT questionsId, total
      FROM rollupreduced rr
      WHERE r.questionsId = rr.questionsId AND r.total = rr.total
    )
  ) rrr
  LEFT JOIN questions qs on rrr.questionsId = qs.id
  LEFT JOIN question q on rrr.questionId = q.id;


DROP TEMPORARY TABLE rollup;
DROP TEMPORARY TABLE rollupreduced;

END $$

DELIMITER ;