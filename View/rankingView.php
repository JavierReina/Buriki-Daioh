<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Buriki Daioh</title>
<link rel="icon" type="image/svg" href="img/logo.png" />
<meta name="title" content="Ejemplo web responsive">
<meta name="keywords" content="código,css,css3,web,responsive">
<link href="../View/Style_Admin/CssWebPage.css" rel="stylesheet">
<link href="../View/Style_Admin/tableCss.css" rel="stylesheet">


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

	
			 <div id="tablaScroll">
			<table  id="miyazaki">
				<thead>
					<tr>
						<th id="f">Top</th>
						<th id="f">Date</th>
						<th id="t">Nickname</th>
						<th id="t">Score</th>


					</tr>
					</thead>
					<tbody>
    <?php
				require_once '../Model/Ranking.php';
				// si es igual a ajax
				
				// Obtiene todas las propiedades
				$data ['ranking'] = Ranking::getAllListRanking ();
				$i = 1;
				foreach ( $data ['ranking'] as $allRanking ) {
				
					?>
      <tr id="ranking_<?= $allRanking->getId() ?>" align="center"
						data-id="<?= $allRanking->getId() ?>">

						<td class="top"><?=	$i++;?></td>
						<td class="date"><?= $allRanking->getDate() ?></td>
						<td class="nickname"><?= $allRanking->getNickname() ?></td>
						<td class="score"><?= $allRanking->getScore() ?></td>



					</tr>


      <?php
				}
				?>
				</tbody>
  </table>
		</div>
	

		<footer>
	<p>
				© Francisco Javier Reina Benítez
			</p>


		</footer>

	</div>
</body>
</html>