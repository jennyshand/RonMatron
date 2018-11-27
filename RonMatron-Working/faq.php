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
                font-family: helvetica;
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
                font-family: helvetica;
                font-size: 20px;
                background:#f5ff49; 
                position: fixed;
@@ -53,26 +53,54 @@
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
            .collapsible {
    background-color: forestgreen;
    color: #f3f7ea;
    cursor: pointer;
    border-radius: 25px;
    padding: 18px;
    margin: 15px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
}
 .active, .collapsible:hover {
    background-color: #f5ff49;
    color: black;
    padding: auto;
}
 .content {
    padding: 18px;
    display: none;
    overflow: hidden;
    background-color: #c7ccbd;
    border-radius: 25px;
    font-family: sans-serif;
}
        </style>
    <title> FAQ </title>
    </head>
     <body>
         
     <header class="header_topg">
         Frequently Asked Questions</header>
     <header class="header_bottomy">
        <form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
			<button class="one" name="next_option" type="submit" value="home">Home</button>
            <button class="two" name="next_option" type="submit" value="ask">Ask the RonMatron</button>
        </form>
	</header>

        <button class="collapsible">Where are Print Kiosks Located?</button>
        <div class="content">
            <p>There are Print Kiosks located in the following locations <ul>Natural Resources</ul><ul> Forestry</ul><ul> Harry Griffith Hall</ul><ul> Gist Hall</ul><ul> The University Center</ul><ul> Founders Hall</ul> <ul>Kineseology</ul><ul> Library</ul></p></div>
        <button class="collapsible">How do I access my google drive from a campus computer?</button>
        <div class="content">
            <p>After logging into a campus computer a google drive window should appear; from here you may log in using your student e-mail to access the google drive</p>
        </div>
         </article>
         
   <!-- RIP Footers
    <footer class="footer_topy"></footer>
    <footer class="footer_bottomg"></footer>
    -->
        
        <!-- this is the javascript to make the collapsible sections -->
        <script>
var coll = document.getElementsByClassName("collapsible");
var i;
 for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
    </body>
    
</html> 
		<?php
    }
?>