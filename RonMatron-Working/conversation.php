<?php
    function create_Conversation()
    {
        ?>
		<!DOCTYPE html>
		<!--
		Last Modified by: Matthew Compelube
		Last Modified date: 11/3/18
		Created by: Matthew Compelube
		created date: 11/3/2018
		-->

		<html>
			<head>
				<meta charset="utf-8" />
				<link rel="stylesheet" type="text/css" href="RonMatronFront.css">
				<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
				<script
					src="https://code.jquery.com/jquery-3.3.1.min.js"
					integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
					crossorigin="anonymous">
				</script>

			</head>
			<body>
				<title> RonMatron Alpha Version </title>
				<header class=" w3-container w3-green" style="height:38.8px" id="header1-green">
					<p> RonMatron ðŸ¤– </p>
				</header>
				<header class="w3-container w3-yellow" style="height:38.8px" id="header2-yellow">
				</header>
				
				
				<div class="w3-container" id="containerofron">
		<!--            <div class="w3-white">-->
		<!--                <div class="w3-bar w3-center">-->
		<!--
							<div class="w3-bar-item w3-white" style="width:33.3%">
								<p> </p>
							</div>
		-->
						   
							<div id="Ron">
		<!--                        <div class="w3-container">-->
									<div class="w3-brown w3-container" id="hat">
									<div id="innerhat"></div>
									</div>
									<div class="w3-container w3-center" id="face">
											<!-- <p>Ron's Talking Head Here</p> -->
											<div class="w3-white" id="eye"></div>
											<div class="w3-white " id="eye"></div>
									</div>
									<div class="w3-black w3-container" id="beard">
										<div id="mouth">
										
										</div>
									</div>
		<!--                        </div>-->
							</div>
		<!--                </div>-->
		<!--            </div>-->
				</div>
				
				<div class="w3-container" id="message-area">
				
				</div>
				
				<div class="w3-container w3-margin w3-round" id="form-input-rounded-box">
					<form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
					  <input type="text" class="w3-input" name="input-box" id="input-box" placeholder="Type text here" min="1" />
					  <button class="w3-butn w3-margin w3-blue" type="submit" onclick="chatFunction()" id="chat_button" name="next_option3" value="reply">
					  Chat
					  </button>
					  <div>
						<button class="one" name="next_option3" type="submit" value="home">Home</button>
						<button class="two" name="next_option3" type="submit" value="faq">Check the FAQ</button>
					  </div>
					</form>
				</div>
				
				
				<script>
					function chatFunction()
					{
						var value1 = document.getElementById("chat1");
						var value3 = document.getElementById("chat3");
						var value5 = document.getElementById("chat5");
						var chatText = document.getElementById("input-box");
						
		//                value1.innerHTML = chatText.value
						
						var testval = value1.innerHTML;
						var textval = chatText.innerHTML;
						
						if (value1.innerHTML == 1)
							{
								value1.innerHTML = chatText.value;
		//                        value3.innerHTML = document.getElementById("chat1").value;
		//                        value5.innerHTML = testval.length;
							}
						else if (value3.innerHTML == 3 && value1.innerHTML != 1)
							{
								value3.innerHTML = value1.innerHTML;
								value1.innerHTML = chatText.value;
							}
						else if (value5.innerHTML == 5 && value3.innerHTML != 3)
							{
								value5.innerHTML = value3.innerHTML;
								value3.innerHTML = value1.innerHTML;
								value1.innerHTML = chatText.value;
							}
						else
							{
								value5.innerHTML = value3.innerHTML;
								value3.innerHTML = value1.innerHTML;
								value1.innerHTML = chatText.value;
							}
						
					}
				</script>
				
				<div>
					<footer class=" w3-container w3-green w3-border-top" style="height:38.8px" id="footer1-green">
						<p> </p>
					</footer>
					<footer class="w3-container w3-yellow" style="height:38.8px" id="footer2-yellow">
						<p> </p>
					</footer>
				</div>
			</body>
		</html>
		<?php
    }
?>
