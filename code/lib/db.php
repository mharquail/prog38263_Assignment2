<?php

$dbconn = pg_pconnect("host=$pg_host port=$pg_port dbname=$pg_dbname user=$pg_dbuser password=$pg_dbpassword") or die("Could not connect");
if ($debug) {
	echo "host=$pg_host, port=$pg_port, dbname=$pg_dbname, user=$pg_dbuser, password=$pg_dbpassword<br>";
	$stat = pg_connection_status($dbconn);
	if ($stat === PGSQL_CONNECTION_OK) {
		echo 'Connection status ok';
	} else {
		echo 'Connection status bad';
	}    
}

function run_query($dbconn, $query) {
	if ($debug) {
		echo "$query<br>";
	}
	$result = pg_query($dbconn, $query);
	if ($result == False and $debug) {
		echo "Query failed<br>";
	}
	return $result;
}

//database functions
function get_article_list($dbconn){
	$query= 
		"SELECT 
		articles.created_on as date,
		articles.aid as aid,
		articles.title as title,
		authors.username as author,
		articles.stub as stub
		FROM
		articles
		INNER JOIN
		authors ON articles.author=authors.id
		ORDER BY
		date DESC";
return run_query($dbconn, $query);
}

function get_article_list_restricted($dbconn, $author){
	$query=
		"SELECT
		articles.created_on as date,
		articles.aid as aid,
		articles.title as title,
		authors.username as author,
		articles.stub as stub
		FROM
		articles
		INNER JOIN
		authors ON articles.author=authors.id
		WHERE articles.author = ".$author."
		ORDER BY
		date DESC";
return run_query($dbconn, $query);		
}

function verify_author($dbconn, $id){
	$query = "SELECT authors.role FROM authors WHERE authors.id = " .$id;
	$row = pg_fetch_array(run_query($dbconn, $query), 0);

	if($row['role'] == 'admin'){
		return get_article_list($dbconn);
	}
	elseif($row['role'] == 'user'){
		return get_article_list_restricted($dbconn, $id);
	}
}

function get_article($dbconn, $aid) {
	$query= 
		"SELECT 
		articles.created_on as date,
		articles.aid as aid,
		articles.title as title,
		authors.username as author,
		articles.stub as stub,
		articles.content as content
		FROM 
		articles
		INNER JOIN
		authors ON articles.author=authors.id
		WHERE aid='".$aid."'
		LIMIT 1";
return run_query($dbconn, $query);
}

function delete_article($dbconn, $aid) {
	$query= "DELETE FROM articles WHERE aid='".$aid."'";
	return run_query($dbconn, $query);
}

function add_article($dbconn, $title, $content, $author) {
	$stub = substr($content, 0, 30);
	$aid = str_replace(" ", "-", strtolower($title));
	$query="
		INSERT INTO
		articles
		(aid, title, author, stub, content) 
		VALUES
		('$aid', '$title', $author, '$stub', '$content')";
	return run_query($dbconn, $query);
}

function update_article($dbconn, $title, $content, $aid) {
	$query=
		"UPDATE articles
		SET 
		title='$title',
		content='$content'
		WHERE
		aid='$aid'";
	return run_query($dbconn, $query);
}

function authenticate_user($dbconn, $username) {
	pg_query($dbconn, "DEALLOCATE ALL");
	pg_prepare($dbconn, "check_login", "SELECT
		authors.id as id,
		authors.username as username,
		authors.password as password,
		authors.role as role
		FROM
		authors
		WHERE
		username=\$1
		LIMIT 1");
	$sql = pg_execute($dbconn, "check_login", array($username));
	return $sql;
}	
?>
