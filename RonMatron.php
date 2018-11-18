<?php
    session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<!--
   10/4/18
   URL: http://nrs-projects.humboldt.edu/~jes1098/RonMatron/RonMatron.php
-->

<head>
    <title> Ronmatron </title>
    <meta charset="utf-8" />

    <?php
        require_once("faq.php");
        require_once("frontPage.php");
		require_once("conversation.php");
     ?>

    <link href="http://users.humboldt.edu/smtuttle/styles/normalize.css"
          type="text/css" rel="stylesheet" />

<!--    <link href="chatBot.css"
          type="text/css" rel="stylesheet" />

    <script src="calcResp.js" type="text/javascript" async="async">
    </script>
-->
</head>

<body>

    <?php
    if (! array_key_exists('next-stage', $_SESSION))
    {
        create_FrontPage();
        $_SESSION['next-stage'] = "makechoice";
    }
	elseif ($_SESSION['next-stage'] == "makechoice")
    {
        if($_POST['option'] == "faq")
        {       
            create_faq();
            $_SESSION['next-stage'] = "choicetwo";
        }
		elseif($_POST['option'] == "ask")
		{
			create_Conversation();
			$_SESSION['next-stage'] = "choicetwo";
		}
		else
		{
			session_destroy();
            session_regenerate_id(TRUE);
            session_start();
            create_FrontPage();
            $_SESSION['next-stage'] = "makechoice";
        }
	}
	 else
    {
        ?>
        <p> <strong> YIKES! should NOT have been able to reach
            here! </strong> </p>
        <?php
        session_destroy();
        session_regenerate_id(TRUE);
        session_start();
        create_FrontPage();
        $_SESSION['next-stage'] = "makechoice";
    }
?>

</body>
</html>