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
		require_once("feedback.php");
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
			$_SESSION['next-stage'] = "choicethree";
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
	elseif ($_SESSION['next-stage'] == "choicetwo" &&
            array_key_exists("next_option", $_POST))
	{
		if($_POST['next_option'] == "ask")
		{
			create_Conversation();
			$_SESSION['next-stage'] = "choicethree";
		}
		elseif ($_POST['next_option'] == "home")
		{
			session_destroy();
            session_regenerate_id(TRUE);
            session_start();
            create_FrontPage();
            $_SESSION['next-stage'] = "makechoice";
		}
	}
	elseif ($_SESSION['next-stage'] == "choicethree" &&
            array_key_exists("next_option3", $_POST))
	{
		if($_POST['next_option3'] == "faq")
        {       
            create_faq();
            $_SESSION['next-stage'] = "choicetwo";
		}
		elseif ($_POST['next_option3'] == "reply")
		{
			create_Conversation();
			$_SESSION['next-stage'] = "choicethree";
		}
		elseif ($_POST['next_option3'] == "feedback")
		{
			create_Feedback();
			$_SESSION['next-stage'] = "choicefour";
		}
		elseif ($_POST['next_option3'] == "home")
		{
			session_destroy();
            session_regenerate_id(TRUE);
            session_start();
            create_FrontPage();
            $_SESSION['next-stage'] = "makechoice";
		}
	}
	elseif ($_SESSION['next-stage'] == "choicefour" &&
            array_key_exists("next_option4", $_POST))
	{
		if($_POST['next_option4'] == "feedback")
		{
			create_Feedback();
			$_SESSION['next-stage'] = "choicefour";
		}
		elseif($_POST['next_option4'] == "faq")
        {       
            create_faq();
            $_SESSION['next-stage'] = "choicetwo";
		}
		elseif ($_POST['next_option4'] == "home")
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
