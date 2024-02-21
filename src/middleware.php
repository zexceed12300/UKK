<?php

/*
	Blok code ini akan di include ke page yg membutuhkan login terlebih dahulu
	agar user guest diarahkan ke login
*/

if (!isset($_SESSION["UserID"])) {
	redirect("login.php");
}
