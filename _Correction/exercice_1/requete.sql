SELECT a.title, a.content, a.picture a.date_publish, u.firstname, u.lastname
FROM articles AS a 
JOIN users AS u
ON a.id_user = u.id
WHERE a.id = 10