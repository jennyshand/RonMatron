<?php
    function hsu_conn_sess($usr, $pwd)
    {
        // set up db connection string
        $db_conn_str =
            "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                       (HOST = cedar.humboldt.edu)
                                       (PORT = 1521))
                            (CONNECT_DATA = (SID = STUDENT)))";
        // let's try to log on using this string!
        $connctn = oci_connect($usr, $pwd, $db_conn_str);
        // complain and destroy session exit from HERE if fails!
        if (! $connctn)
        {
        ?>
            <p> Could not log into Oracle, sorry. </p>
            <p> <a
                href="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
                Try again </a>
            </p>
            <?php
            require_once("328footer.html");
            ?>
</body>
</html>
            <?php
            session_destroy();
            exit;
        }
        return $connctn;
    }
?>