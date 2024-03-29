<?php

include 'koneksi.php';

if (isset($_SESSION["UserID"])) {
	redirect("index.php");
}

/*
	Sebuah blok code untuk menghandle login request yang memvalidasi user credential dari database
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$validatedData = validate($_POST, [
		"username" => "required|string",
		"password" => "required|string"
	]);

	$query = $dbh->prepare("SELECT * FROM user WHERE Username = :username");
	$query->bindParam(':username', $validatedData["username"]);
	$query->execute();
	$user = $query->fetch();
	if ($user != null) {
		if (password_verify($validatedData["password"], $user["Password"])) {
			$_SESSION['UserID'] = $user['UserID'];
			$_SESSION['Username'] = $user['Username'];
			redirect("index.php");
		}
	}
	redirect("login.php?failed");
}

?>

<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gallery</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="absolute w-full background-pattern h-screen opacity-40">
	</div>
	<div class="flex gap-6 justify-end items-center">
		<form action="login.php" method="post" class="flex flex-col justify-center h-screen bg-white shadow-2xl border-stone-400 p-36 w-1/3 z-10">
			<?php
			if (isset($_GET["registered"])) {
			?>
				<div class="border-2 text-violet-600 font-bold border-violet-600 px-4 py-6 rounded-2xl mb-4">
					Register sukses, silahkan login.
				</div>
			<?php
			}
			?>
			<?php
			if (isset($_GET["failed"])) {
			?>
				<div class="border-2 text-red-600 font-bold border-red-600 px-4 py-6 rounded-2xl mb-4">
					Username atau password salah!
				</div>
			<?php
			}
			?>
			<h1 class="text-2xl font-bold text-black mb-8">Login</h1>
			<?php
			if (!empty($_SESSION["errors"])) {
			?>
				<div class="border-2 text-red-600 font-bold border-red-600 px-4 py-3 rounded-2xl mb-4">
					<?= $_SESSION["errors"] ?>
				</div>
			<?php } ?>
			<div class="flex flex-col gap-4 mb-8">
				<div>
					<span>Username</span>
					<input name="username" type="text" class="mt-2 w-full px-3 py-3 bg-gray-50 border border-gray-300 rounded-lg outline-none focus:ring-violet-600 focus:border-violet-400" placeholder="ihsan@gmail.com" required>
				</div>
				<div>
					<span>Password</span>
					<input name="password" type="password" class="mt-2 w-full px-3 py-3 bg-gray-50 border border-gray-300 rounded-lg outline-none focus:ring-violet-600 focus:border-violet-400" placeholder="ihsan@gmail.com" required>
				</div>
			</div>
			<button class="bg-violet-600 text-white font-bold p-3 rounded-lg w-full mb-3">Login</button>
			<span class="text-center">Belum punya akun? <a href="register.php" class="font-bold text-violet-600">Daftar</a></span>
		</form>
	</div>
</body>

</html>

<?php
include 'end.php';
?>