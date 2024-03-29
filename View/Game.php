<html lang="es">
<head>
<title>Prueba juego</title>
<script src="phaser.js"></script>
<script type="text/javascript">
		window.onload = function() {
			var game = new Phaser.Game(400, 600, Phaser.AUTO, '', {
				preload : preload,
				create : create,
				update : update
			});
			var score = 0;
			var kill = 0;
			var sonido;
			var nickname = "pru";
            var t;
            var style;
            var explosions;
            var stateText;
            var scoreString = '';
            var scoreText;

			function preload() {
				game.load.image('sky', 'assets/sky.png');
				game.load.image('star', 'assets/star.png');
				game.load.spritesheet('dude', 'assets/dude.png', 32, 48);
				game.load.spritesheet('kaboom', 'assets/explode.png', 128, 128);
				game.load.audio('spop', 'assets/pop.mp3');
			}

			function create() {
				
				game.physics.startSystem(Phaser.Physics.ARCADE);
				game.add.sprite(0, 0, 'sky');
				
				// Añadimos el sprite del jugador en la coordenada (32,game.world.height)
				player = game.add.sprite(32, game.world.height - 150, 'dude');

				// Activamos la física al jugador
				game.physics.arcade.enable(player);
				// Propiedades de la física: Bote, gravedad y colisiones en el world
				//player.body.bounce.y = 0;
				//player.body.gravity.y = 0;
				player.body.collideWorldBounds = true;
				// Our two animations, walking left and right.
				player.animations.add('left', [ 0, 1, 2, 3 ], 10, true);
				player.animations.add('right', [ 5, 6, 7, 8 ], 10, true);

				stars = game.add.group();
				stars.enableBody = true;
				// Here we'll create 12 of them evenly spaced apart
				explosions = game.add.group();
				
				game.time.events.loop(Phaser.Timer.SECOND*1,createStar, this);
				game.time.events.loop(Phaser.Timer.SECOND*0.5,sumScore, this);




			    //  The score
			    scoreString = 'Score : ';
			    scoreText = game.add.text(10, 10, scoreString + score, { font: '34px Arial', fill: '#fff' });

			    //  Text
			    stateText = game.add.text(game.world.centerX,game.world.centerY,' ', { font: '30px Arial', fill: '#fff' });
			    stateText.anchor.setTo(0.5, 0.5);
			    stateText.visible = false;

				sonido = game.add.audio('spop');
				
				game.camera.follow(player);

                style = { font: "65px Arial", fill: "#ff0044", align: "center" };
                t = game.add.text(game.world.centerX-350, 0, score, style);



			}

			function createStar() {

			    //  A bouncey ball sprite just to visually see what's going on.
			    
			    var star = stars.create(Math.random()*400, 0, 'star');

			    game.physics.enable(star, Phaser.Physics.ARCADE);

			    star.body.bounce.y = 0.9;

			    star.body.velocity.y = 100;


				
			}

			function createExplosion(player){

				 var explosion = explosions.create(player.body.x,player.body.y, 'kaboom');


				
			}
		
			function update() {
				// Collide the player and the stars with the platforms
			   
				game.physics.arcade.overlap(player, stars, enemyHitsPlayer, null,
						this);

								

				cursors = game.input.keyboard.createCursorKeys();
				// Reset the players velocity (movement)
				player.body.velocity.y = 0;
				player.body.velocity.x = 0;
				if (cursors.left.isDown) {
					// Move to the left
					player.body.velocity.x -= 150;
					player.animations.play('left');
				} else if (cursors.right.isDown) {
					// Move to the right
					player.body.velocity.x += 150;
					player.animations.play('right');
				} else {
					// Stand still
					player.animations.stop();
					player.frame = 4;
				}
				if (cursors.up.isDown) {
					// Move to the right
					player.body.velocity.y -= 150;
					player.animations.stop();
				} else if (cursors.down.isDown) {
					// Move to the right
					player.body.velocity.y += 150;
					player.animations.stop();
				} else {
					// Stand still
					player.animations.stop();
					player.frame = 4;
				}
				
				// Allow the player to jump if they are touching the ground.
				if (cursors.up.isDown && player.body.touching.down) {
					player.body.velocity.y = -500;
				}

			   

			    

			}
			//function collectStar(player, star) {
				//sonido.play();
				//star.kill();
				// Sumamos 10 a la puntuación

				//score += 10;
				//scoreText.text = 'Score: ' + score;

                  //Campio los valores antes de que actualize
			//}
			
			function sumScore(){
				score++;         //this value will hold the score of every player. I need to pass it to the leader board using php. How?
                scoreText.text = scoreString + score;
			}

			function endGame(){
					finalScore = score;

					submitScore("pru", finalScore);
				}

			function enemyHitsPlayer (player, star) {
			    
			    star.kill();



			    //  And create an explosion :)
			    createExplosion(player);

			    // When the player dies
					scoreText.visible = false;
			        player.kill();
			        stars.callAll('kill');

			        endGame();

			        stateText.text=" GAME OVER \n Click to restart \n Score: "+finalScore;
			        stateText.visible = true;

			        

			        //the "click to restart" handler
			        
			    

			}

		function restart () {
			score=-1;
		    //  A new level starts
		    
		    //resets the life count

		    //  And brings the aliens back from the dead :)
		    stars.removeAll();
		    createStar();
		    
			explosions.removeAll();
		    //revives the player
		    player.revive();
		    //hides the text
		    stateText.visible = false;
		    scoreText.visible = true;

		}
			function submitScore(username, score) {

				sonido.play();
		

			    var data="nicknameNew="+nickname+"&scoreNew="+score;
				
			    var request = new XMLHttpRequest();
			    request.open('POST', '../Controller/GameAdd.php', true);
			    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			    request.onload = function() {
			      if (request.status >= 200 && request.status < 400){
				        game.input.onTap.addOnce(restart,this);
				        console.log(data);
			      } else {
			        // We reached our target server, but it returned an error

			      }
			    };  
			    request.send(data);
			}


						

		};
	</script>
</head>
<body>



</body>

</html>