<?php

include 'koneksi.php';

/*
	Sebuah blok code untuk menghandle request register dan menambahkan data user ke database
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$validatedData = validate($_POST, [
		"username" => "required|string|min:2|max:32",
		"password" => "required|string|min:8|max:32",
		"email" => "required|email",
		"nama" => "required|string|min:2|max:64",
		"alamat" => "required|string|min2:max:128"
	]);

	$query = $dbh->prepare("INSERT INTO user VALUES (NULL, :username, :password, :email, :nama, :alamat)");
	$query->bindParam(':username', $validatedData['username']);
	$query->bindParam(':password', $validatedData['password']);
	$query->bindParam(':email', $validatedData['email']);
	$query->bindParam(':nama', $validatedData['nama']);
	$query->bindParam(':alamat', $validatedData['alamat']);
	$query->execute();
	redirect("login.php?registered");
}

?>

<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>phpDaisyTemplate</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="absolute w-full background-pattern h-screen opacity-40">
	</div>
	<div class="flex gap-6 justify-end items-center">
		<form action="register.php" method="post" class="flex flex-col justify-center h-screen bg-white shadow-2xl border-stone-400 p-36 w-1/3 z-10">
			<h1 class="text-2xl font-bold text-black mb-8">Register</h1>
			<div class="flex flex-col gap-4 mb-8">
				<?php
				if (!empty($_SESSION["errors"])) {
				?>
					<div class="border-2 text-red-600 font-bold border-red-600 px-4 py-3 rounded-2xl mb-4">
						<?= $_SESSION["errors"] ?>
					</div>
				<?php } ?>
				<div>
					<span>Nama Lengkap</span>
					<input name="nama" type="text" id="email" class="mt-2 w-full px-3 py-3 bg-gray-50 border border-gray-300 rounded-lg outline-none focus:ring-violet-600 focus:border-violet-400" placeholder="Ihsan nul" required>
				</div>
				<div>
					<span>Email</span>
					<input name="email" type="text" id="email" class="mt-2 w-full px-3 py-3 bg-gray-50 border border-gray-300 rounded-lg outline-none focus:ring-violet-600 focus:border-violet-400" placeholder="ihsan@gmail.com" required>
				</div>
				<div>
					<span>Username</span>
					<input name="username" type="text" id="email" class="mt-2 w-full px-3 py-3 bg-gray-50 border border-gray-300 rounded-lg outline-none focus:ring-violet-600 focus:border-violet-400" placeholder="ihsannul" required>
				</div>
				<div>
					<span>Password</span>
					<input name="password" type="password" id="email" class="mt-2 w-full px-3 py-3 bg-gray-50 border border-gray-300 rounded-lg outline-none focus:ring-violet-600 focus:border-violet-400" placeholder="********" required>
				</div>
				<div>
					<span>Alamat</span>
					<textarea name="alamat" type="text" id="email" class="mt-2 w-full px-3 py-3 bg-gray-50 border border-gray-300 rounded-lg outline-none focus:ring-violet-600 focus:border-violet-400" placeholder="Tulis alamat" required></textarea>
				</div>
			</div>
			<button class="bg-violet-600 text-white font-bold p-3 rounded-lg w-full mb-3">Daftar</button>
			<span class="text-center">Sudah punya akun? <a href="login.php" class="font-bold text-violet-600">Login</a></span>
		</form>
	</div>
</body>

</html>

<?php
include 'end.php';
?>