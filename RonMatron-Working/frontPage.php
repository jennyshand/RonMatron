<?php
    function create_FrontPage()
    {
        ?>
		<html lang="en">
		<head>
			<meta charset="UTF-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrom=1">
			<meta name="robots" content="index,follow">
			<link rel="stylesheet" type="text/css" href="RonMatronFront.css">
			<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">

			<title>Welcome to RonMatron</title>

		</head>
		<body>
			<header class="header_topgfront">
			<header class="header_bottomyfront"></header>
			</header>
			<div class="container12">
				<header class="stuff">

			<div> 
				<img src="Ron.PNG" alt="Ron's Face">
				</div>


					<div class="row"> 
						<div class="og">    
						<div class="itmHolder">
							<div class="title" >
									<h1> Welcome to RonMatron </h1>
						</div>
								<div class="sub" id="header-nav">
								<form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">

									<button class="one" name="option" type="submit" value="faq">Check the FAQ</button>
                 
									<button class="two" name="option" type="submit" value="ask">Ask the RonMatron</button>
								</form>
								</div>
							</div>
						</div>
					</div>
				</header>
				<div class="footer_topyfront">
				<div class="footer_bottomgfront"></div>
				</div>
			</div>
		</body>    
		</html>
		<?php
    }
?>
