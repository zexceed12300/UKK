<?php

include 'koneksi.php';

include 'middleware.php';

/*
	sebuah blok code untuk request delete album
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$validatedData = validate($_POST, [
		"albumid" => "required|number"
	]);

	$query = $dbh->prepare("DELETE FROM album WHERE AlbumID = :albumid");
	$query->bindParam(":albumid", $validatedData["albumid"]);
	$query->execute();
	header("location: {$_SERVER['HTTP_REFERER']}");
}
header("location: {$_SERVER['HTTP_REFERER']}");
