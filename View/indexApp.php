<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Buriki Daioh</title>
<link rel="icon" type="image/svg" href="img/logo.png" />
<link href="../View/Style_Admin/CssWebPage.css" rel="stylesheet">



</head>
<body>

	<div class="container">
		<header>


			<img alt="logo" src="img/logo.png">

		</header>

		<nav>
			<ul>
				<li><a href="indexApp.php">Inicio</a></li>
				<li><a href="rankingView.php">Ranking</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="multimedia.php">Assets</a></li>
			</ul>
		</nav>

		<section>
			<form action="Juego.php" method="GET" name="formNickname"
				id="formNickname">
				Nickname: <input type="text" name="nickname" value="" required><br>
				<input type="submit" value="   Play!!   ">
			</form>
		</section>


		<footer>
			<p>
				© Francisco Javier Reina Benítez
			</p>

		</footer>

	</div>
</body>
</html>