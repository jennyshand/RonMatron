<?php
    function create_faq()
    {
        ?>
		<!DOCTYPE html>
		<html>
			<head>
				<!-- CSS lives here -->
				<style>
					body {
						background-color: #c7ccbd;
						color: black;
					}
					.header_topg{
						border: 20px;
						padding: 15px;
						text-align: center;
						color: #f3f7ea;
						font-family: fantasy;
						font-size: 20px;
						background:forestgreen; 
						position: absolute;
						top: 0;
						width: 100%;
						left: 0px;                
					}
					.header_bottomy{
						border: 20px;
						padding: 15px;
						text-align: center;
						background-color: #f5ff49;
						position: absolute;
						top: 40px;
						width: 100%;
						left: 0px;
					}
					.footer_topy{
						
						border: 20px;
						padding: 15px;
						text-align: center;
						color: #f3f7ea;
						font-family: fantasy;
						font-size: 20px;
						background:#f5ff49; 
						position: fixed;
						bottom: 30px;
						width: 100%;
						left: 0px; 
					}
					.footer_bottomg{
						border: 20px;
						padding: 15px;
						text-align: center;
						color: forestgreen;
						font-family: fantasy;
						font-size: 20px;
						background:forestgreen; 
						position: fixed;
						bottom: 0;
						width: 100%;
						left: 0px; 
					}
					.body_section{
						background: #eff7ea;
						border-style: hidden;
						border-radius: 25px;
						border-collapse: collapse;
						border-color: dimgray;
						left: 15%;   
						right: 15%;
						top: 20%;
						bottom: auto;
						padding: 20px;
						position: absolute;
						text-align: left;
						text
						font-family: arial;
					}
				</style>
			<title> FAQ </title>
			</head>
			<body>
				
			<header class="header_topg">
				Frequently Asked Questions</header>
			<header class="header_bottomy">
				<nav>
					<a href="/Home/">Home</a> |
					<a href="/RonChat/">RonChat</a>
				</nav></header>
			<article class="body_section">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? </article>
				 
			<footer class="footer_topy"></footer>
			<footer class="footer_bottomg"></footer>
				
			</body>
			
		</html>
		<?php
    }
?>
