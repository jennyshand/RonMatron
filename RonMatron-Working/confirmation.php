<?php
    function create_Feedback()
    {
        ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="RonMatronFront.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>RonMatron</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="form.css" >
    </head>
    <body >
		<header class="header_topgfront">
		<header class="header_bottomyfront"></header>
		</header>
        <div class="container">
            <div class="imagebg"></div>
            <div class="row " style="margin-top: 50px">
                <div class="col-md-6 col-md-offset-3 form-container">
                    <h2>Your feedback was submitted! Thanks!</h2> 
                    <p> What would you like to do next? </p>
					<form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
						<div>
							<button class="one" name="next_option4" type="submit" value="ask">Ask Something Else</button>
							<button class="two" name="next_option4" type="submit" value="home">Home</button>
							<button class="three" name="next_option4" type="submit" value="faq">Check the FAQ</button>
						</div>
                    </form>
            </div>
			<div class="footer_topyfront">
			<div class="footer_bottomgfront"></div>
			</div>
        </div>
    </body>
</html>
		<?php
    }
?>