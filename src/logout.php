<?php

include 'koneksi.php';

/*
	Hapus semua data sesi dan redirect ke login
 */

session_start();

session_destroy();

redirect("login.php");
