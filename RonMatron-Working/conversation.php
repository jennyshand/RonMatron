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
				<title> Ask me Ronnything? </title>
				<div class="w3-container w3-padding-64">
                    <header class="w3-container header_topgfront" style="height:38.8px" id="header1-green">
                    </header>
                    <header class="w3-container header_bottomyfront" style="height:38.8px" id="header2-yellow">
                    </header>
                </div>
				
				
				<div class="Ron">
		<!--            <div class="w3-white">-->
		<!--                <div class="w3-bar w3-center">-->

		<!--					<div class="w3-bar-item #c7ccbd" style="height:200px">-->
                                
                             
						   
							<div id="Ron">
		<!--                        <div class="w3-container">-->
									<div class="w3-brown w3-container" id="hat">
									<div id="innerhat"></div>
									</div>
									<div class="w3-container w3-center" id="face">
											<!-- <p>Ron's Talking Head Here</p> -->
                                        <div class="face"></div>
                                        <p></p>
											<div class="eye"></div>
                                            vegan
											<div class="eye"></div>
                                        </div>
									</div>
                    
									<div class="w3-black w3-container" id="beard">
										<div id="mouth">
										
										</div>
									</div>
		<!--                        </div>-->
							</div>
		<!--                </div>-->
		<!--            </div>-->
<script>     
$("body").mousemove(function(event) {
  var eye = $(".eye");
  var x = (eye.offset().left) + (eye.width() / 2);
  var y = (eye.offset().top) + (eye.height() / 2);
  var rad = Math.atan2(event.pageX - x, event.pageY - y);
  var rot = (rad * (180 / Math.PI) * -1) + 180;
  eye.css({
    '-webkit-transform': 'rotate(' + rot + 'deg)',
    '-moz-transform': 'rotate(' + rot + 'deg)',
    '-ms-transform': 'rotate(' + rot + 'deg)',
    'transform': 'rotate(' + rot + 'deg)'
  });
});
</script>
                
<?php


if(array_key_exists("insert-answer-box", $_POST))
{
    //THIS ONE IS GOOD!!!
    $a_id = $_SESSION['answer-id'];
    $ans = $_POST['insert-answer-box'];
    
//    for ($x = 0; $x < strlen($ans); $x++)
//    {
//        if ($ans[$x] == ".")
//        {
//            $ans[$x] = "";
//        }
//        else if ($ans[$x] == "?")
//        {
//            $ans[$x] = "";
//        }
//        else if ($ans[$x] == "!")
//        {
//            $ans[$x] = "";
//        }
//        else if ($ans[$x] == "\"")
//        {
//            $ans[$x] = "";
//        }
//        else if ($ans[$x] == "'")
//        {
//            $ans[$x] = "";
//        }
//    }
    
    $usr = '';
    $pwd = '';

    $db_conn_str = 
                "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                           (HOST = cedar.humboldt.edu)
                                           (PORT = 1521))
                                (CONNECT_DATA = (SID = STUDENT)))";

    $connctn = oci_connect($usr, $pwd, $db_conn_str);

    if (!$connctn)
    {
        ?>
        <p> Connection dont work </p>
    <?php
        exit;
        
    }
    
    $update_answer = "update answer2 
                       set answer_name = :ans 
                       where answer_id = :id ";
    $update_answer_stmt = oci_parse($connctn, $update_answer);
    oci_bind_by_name($update_answer_stmt, ":ans", $ans);
    oci_bind_by_name($update_answer_stmt, ":id", $a_id);
    oci_execute($update_answer_stmt, OCI_DEFAULT);
    oci_commit($connctn);
    oci_free_statement($update_answer_stmt);
    
    oci_close($connctn);
}

        
if(!array_key_exists("input-box", $_POST))
{
    
}
else
{

    $a_string = $_POST['input-box'];
//    echo $a_string;
    echo '<br />';
    $lower_string = strtolower($a_string);

    $array_analysis = $lower_string;

    //$token = strtok($lower_string, " ");
    $token_array = strtok($array_analysis, " ");

    //echo 'Original String: ';
    //echo $lower_string;
    //echo '<br />';


    //Check every word in the string and maintain a count of the strings.
    //Check to see if a word is more likely to be a keyword than other words
    //in the string. Take the word that is most likely to be the keyword and
    //grab an answer based on that.

    //2nd action possibly
    //Check every word in the string again and update the count of words occuring.
    //Check for any word that could indicate what in the question they might want.
    //Harder to determine, may have to be plugged in manually

    //array for the FOR loops

    $a_array = array();
    $conjunction_array = array("and", "or", "is", "so", "the", "did", "but", "yet", "that", "then", "i", "could", "drop", "are");
    $punctuation_array = array(".", "?", "!", "(", ")", "\"", "'". "[", "]", "{", "}");
    $completed_array = array();


    //LOG IN, DONT TOUCH

    $usr = '';
    $pwd = '';

    $db_conn_str = 
                "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                           (HOST = cedar.humboldt.edu)
                                           (PORT = 1521))
                                (CONNECT_DATA = (SID = STUDENT)))";

    $connctn = oci_connect($usr, $pwd, $db_conn_str);



    if (!$connctn)
    {
        ?>
        <p> Connection dont work </p>
    <?php
        exit;
    }

    // END OF LOG IN

    $token_counter2 = 0;
    $array_creater_counter = 0;
    while ($token_array != false)
        {
            $a_array[$array_creater_counter] = $token_array;
            $array_creater_counter += 1;
            if ($token_counter2 === str_word_count($array_analysis))
            {
                $token_array = false;
            }
            $token_counter2++;
            $token_array = strtok(" ");
        }


    //This is a very poorly made O(n^2) loop, that I regret creating but it works. This is pivotal for the keywords
    $i = 0;
    foreach ($a_array as $value)
        {
            $array_flag = 0;
            foreach ($conjunction_array as $comparison)
            {
                if ($value == $comparison)
                {
                    $array_flag = 1;
                }
            }
            if($array_flag == 0)
            {
                $completed_array[$i] = $value;
                $i++;
            }
        }
    $keyword_string = "";
    //Important takes the array and remakes it into a keyword string. There has got to be a better way of doing this.
    foreach ($completed_array as $value)
    {
        $keyword_string .= "$value ";
    }

    //Removes punctuation by searching through each char in a string.
    for ($x = 0; $x < strlen($keyword_string); $x++)
    {
        if ($keyword_string[$x] == ".")
        {
            $keyword_string[$x] = "";
        }
        else if ($keyword_string[$x] == "?")
        {
            $keyword_string[$x] = "";
        }
        else if ($keyword_string[$x] == "!")
        {
            $keyword_string[$x] = "";
        }
        else if ($keyword_string[$x] == "\"")
        {
            $keyword_string[$x] = "";
        }
        else if ($keyword_string[$x] == "'")
        {
            $keyword_string[$x] = "";
        }
    }

    //echo $keyword_string;
    //Checks the major keywords for what exactly somebody wants

    $token_counter = 0;
    $key = $keyword_string;
    $keyword_to_bind = $keyword_string;
    $non_general_flag = true;
    $token = strtok($lower_string, " ");

    $answer_null = '';

    //Initial category selection
    //Note to self, make entries for every word entered by the user, unless a entry already // exists then ignore it.

    while ($token !== false)
    {
    //        echo $token;
    //        echo '<br />';


            if ($token === "where")
            {
                $token = false;
                $non_general_flag = false;

                //Does a check to see if a keyword is already entered into the database and if it has it skips inserting another one. Possible revition depedent on time ot allow 3 answers per keyword
                $select_check = "select keyword_id from keyword2 where keyword_name = :keyword_to_bind and category_id = '0002'";
                $select_check_stmt = oci_parse($connctn, $select_check);
                oci_bind_by_name($select_check_stmt, ":keyword_to_bind", $keyword_to_bind);
                oci_execute($select_check_stmt);
                oci_commit($connctn);
                oci_fetch($select_check_stmt);
                $select_key = oci_result($select_check_stmt, "KEYWORD_ID");
                oci_free_statement($select_check_stmt);
                // If keywords don't exist then we enter to do inserts into all keyword, keyword_has_answer, and answer table.
                if ($select_key == '')
                {

                     //echo "This WHERE WORKS";

                     /*Finds the max value for in Keyword so that it can insert one higher. This saved me the trouble of writing a stupid trigger. Less efficent and not as generalized but hay no trigger.*/
                    $select_insert = "select max(keyword_id) from keyword2";
                    $select_insert_stmt = oci_parse($connctn, $select_insert);
                    oci_execute($select_insert_stmt);
                    oci_commit($connctn);
                    oci_fetch($select_insert_stmt);
                    $max_keyword_id = oci_result($select_insert_stmt, "MAX(KEYWORD_ID)");

                    $max_keyword_id = $max_keyword_id + 1;
                    oci_free_statement($select_insert_stmt);
                    // Finds the max value for the Answer table so that I can insert one higher thus again saving me the trouble of writing a hence forth stupid trigger. 
                    $select_insert_answer = "select max(answer_id) from answer2";
                    $select_insert_answer_stmt = oci_parse($connctn, $select_insert_answer);
                    oci_execute($select_insert_answer_stmt);
                    oci_commit($connctn);
                    oci_fetch($select_insert_answer_stmt);
                    $max_answer_id = oci_result($select_insert_answer_stmt, "MAX(ANSWER_ID)");

                    $max_answer_id = $max_answer_id + 1;
                    oci_free_statement($select_insert_answer_stmt);



                    // Inserts keyword inputted by users for future questions.
                    $insert_where = "insert into keyword2 
                                    values
                                    (:max_keyword_id, '0002', :keyword_to_bind)";
                    $insert_where_stmt = oci_parse($connctn, $insert_where);
                    oci_bind_by_name($insert_where_stmt, ":max_keyword_id", $max_keyword_id);
                    oci_bind_by_name($insert_where_stmt, ":keyword_to_bind", $keyword_to_bind);
                    oci_execute($insert_where_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_where_stmt);



                    //Inserts into the answer table the answer to the questions given.
                    $insert_where_a = "insert into answer2 
                                    values
                                    (:max_answer_id, '0002', :answer)";
                    $insert_where_a_stmt = oci_parse($connctn, $insert_where_a);
                    oci_bind_by_name($insert_where_a_stmt, ":answer", $answer_null);
                    oci_bind_by_name($insert_where_a_stmt, ":max_answer_id", $max_answer_id);
                    oci_execute($insert_where_a_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_where_a_stmt);

                    //Inserts the keyword ID and the answer id into the keyword_has_answer table for look up. It does this for relational database purposes.
                    $insert_where_kha = "insert into keyword_has_answer2 
                                    values
                                    (:max_keyword_id, :max_answer_id)";
                    $insert_where_kha_stmt = oci_parse($connctn, $insert_where_kha);
                    oci_bind_by_name($insert_where_kha_stmt, ":max_keyword_id", $max_keyword_id);
                    oci_bind_by_name($insert_where_kha_stmt, ":max_answer_id", $max_answer_id);
                    oci_execute($insert_where_kha_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_where_kha_stmt);

                    ?>
                <div class="w3-card-4">
                    
                    <div class="w3-container w3-green">
                    <h2>We don't seem to have an answer... Could you provide us with an answer?</h2>
                    </div>
                    <form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
                    <input type="text" class="w3-input" name="insert-answer-box" id="insert-answer-box" placeholder="Type text here" minlength="1" maxlength="144" />
					  <button class="w3-butn w3-margin w3-blue" type="submit" onclick="chatFunction()" id="chat_button" name="next_option3"
                      value="reply">
					  Submit Answer
					  </button>
                    </form>
                </div>
                    <?php
                    $_SESSION["answer-id"] = $max_answer_id;
                    
                }
                else
                {

                    $where_str_search = "select keyword_id from keyword2 where keyword_name = :key and category_id = '0002'";
                    $where_str_search_stmt = oci_parse($connctn, $where_str_search);
                    oci_bind_by_name($where_str_search_stmt, ":key", $key);
                    oci_execute($where_str_search_stmt);
                    oci_commit($connctn);
                    oci_fetch($where_str_search_stmt);
                    $response = oci_result($where_str_search_stmt, "KEYWORD_ID");
                    ?>
                      <?php

                    oci_free_statement($where_str_search_stmt);

                    //******************************
                    //This query uses the keyword_has_answer to table to figure out which
                    //answer in the table is related to the keyword.
                    //******************************

                   $where_key_to_ans = "select answer_id 
                                        from keyword_has_answer2
                                        where keyword_id = :k_id";
                    $where_key_to_ans_stmt = oci_parse($connctn, $where_key_to_ans);

                    oci_bind_by_name($where_key_to_ans_stmt, ":k_id", $response);

                    oci_execute($where_key_to_ans_stmt);

                    oci_fetch($where_key_to_ans_stmt);

                    $k_t_a = oci_result($where_key_to_ans_stmt, "ANSWER_ID");

                    ?>
                    <?php
                        oci_free_statement($where_key_to_ans_stmt);

                    //********************************************
                    //This table gets the answer from the previous tables query
                    //*********************************************

                    $where_ans = "select answer_name from answer2 where answer_id = :k_t_a";
                    $where_ans_stmt = oci_parse($connctn, $where_ans);
                    oci_bind_by_name($where_ans_stmt, "k_t_a", $k_t_a);
                    oci_execute($where_ans_stmt);
                    oci_fetch($where_ans_stmt);
                    $answer = oci_result($where_ans_stmt, "ANSWER_NAME");
                    oci_commit($connctn);

                    if ($answer == '')
                    {
                    
                        $_SESSION["answer-id"] = $k_t_a;
                        ?>
                    <div class="w3-card-4">
                    
                    <div class="w3-container w3-green">
                    <h2>We don't seem to have an answer... Could you provide us with an answer?</h2>
                    </div>
                    <form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
                    <input type="text" class="w3-input" name="insert-answer-box" id="insert-answer-box" placeholder="Type text here" minlength="1" maxlength="144" />
					  <button class="w3-butn w3-margin w3-blue" type="submit" onclick="chatFunction()" id="chat_button" name="next_option3"
                      value="reply">
					  Submit Answer
					  </button>
                    </form>
                    </div>
                        <?php

                    }
                    else
                    {
                        
                        ?>
                        <div class="w3-container w3-center" style="text-align:center" id="message-area">
                            <h1 class="w3-round" id="chat1">
                                <?= $answer ?>
                            </h1>
                            </div>
                        <?php
                    }
                        oci_free_statement($where_ans_stmt);
                }


            }
            elseif ($token === "when")
            {
                $token = false;



                //Does a check to see if a keyword is already entered into the database and if it has it skips inserting another one. Possible revition depedent on time ot allow 3 answers per keyword
                $select_check = "select keyword_id from keyword2 where keyword_name = :keyword_to_bind and category_id = '0003'";
                $select_check_stmt = oci_parse($connctn, $select_check);
                oci_bind_by_name($select_check_stmt, ":keyword_to_bind", $keyword_to_bind);
                oci_execute($select_check_stmt);
                oci_commit($connctn);
                oci_fetch($select_check_stmt);
                $select_key = oci_result($select_check_stmt, "KEYWORD_ID");
                oci_free_statement($select_check_stmt);
                // If keywords don't exist then we enter to do inserts into all keyword, keyword_has_answer, and answer table.
                if ($select_key == '')
                {
                     //echo "This when WORKS";

                     /*Finds the max value for in Keyword so that it can insert one higher. This saved me the trouble of writing a stupid trigger. Less efficent and not as generalized but hay no trigger.*/
                    $select_insert = "select max(keyword_id) from keyword2";
                    $select_insert_stmt = oci_parse($connctn, $select_insert);
                    oci_execute($select_insert_stmt);
                    oci_commit($connctn);
                    oci_fetch($select_insert_stmt);
                    $max_keyword_id = oci_result($select_insert_stmt, "MAX(KEYWORD_ID)");
                    $max_keyword_id = $max_keyword_id + 1;
                    oci_free_statement($select_insert_stmt);
                    // Finds the max value for the Answer table so that I can insert one higher thus again saving me the trouble of writing a hence forth stupid trigger. 
                    $select_insert_answer = "select max(answer_id) from answer2";
                    $select_insert_answer_stmt = oci_parse($connctn, $select_insert_answer);
                    oci_execute($select_insert_answer_stmt);
                    oci_commit($connctn);
                    oci_fetch($select_insert_answer_stmt);
                    $max_answer_id = oci_result($select_insert_answer_stmt, "MAX(ANSWER_ID)");
                    $max_answer_id = $max_answer_id + 1;
                    oci_free_statement($select_insert_answer_stmt);
                    // Inserts keyword inputted by users for future questions.
                    $insert_when = "insert into keyword2 
                                    values
                                    (:max_keyword_id, '0003', :keyword_to_bind)";
                    $insert_when_stmt = oci_parse($connctn, $insert_when);
                    oci_bind_by_name($insert_when_stmt, ":max_keyword_id", $max_keyword_id);
                    oci_bind_by_name($insert_when_stmt, ":keyword_to_bind", $keyword_to_bind);
                    oci_execute($insert_when_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_when_stmt);
                    //Inserts into the answer table the answer to the questions given.
                    $insert_when_a = "insert into answer2 
                                    values
                                    (:max_answer_id, '0003', :answer)";
                    $insert_when_a_stmt = oci_parse($connctn, $insert_when_a);
                    oci_bind_by_name($insert_when_a_stmt, ":answer", $answer_null);
                    oci_bind_by_name($insert_when_a_stmt, ":max_answer_id", $max_answer_id);
                    oci_execute($insert_when_a_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_when_a_stmt);
                    //Inserts the keyword ID and the answer id into the keyword_has_answer table for look up. It does this for relational database purposes.
                    $insert_when_kha = "insert into keyword_has_answer2 
                                    values
                                    (:max_keyword_id, :max_answer_id)";
                    $insert_when_kha_stmt = oci_parse($connctn, $insert_when_kha);
                    oci_bind_by_name($insert_when_kha_stmt, ":max_keyword_id", $max_keyword_id);
                    oci_bind_by_name($insert_when_kha_stmt, ":max_answer_id", $max_answer_id);
                    oci_execute($insert_when_kha_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_when_kha_stmt);

                    ?>
                    <div class="w3-card-4">
                    
                    <div class="w3-container w3-green">
                    <h2>We don't seem to have an answer... Could you provide us with an answer?</h2>
                    </div>
                    <form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
                    <input type="text" class="w3-input" name="insert-answer-box" id="insert-answer-box" placeholder="Type text here" minlength="1" maxlength="144" />
					  <button class="w3-butn w3-margin w3-blue" type="submit" onclick="chatFunction()" id="chat_button" name="next_option3"
                      value="reply">
					  Submit Answer
					  </button>
                    </form>
                </div>
                    <?php
                    $_SESSION["answer-id"] = $max_answer_id;

                }
                else
                {

                    $when_str_search = "select keyword_id from keyword2 where keyword_name = :key and category_id = '0003'";
                    $when_str_search_stmt = oci_parse($connctn, $when_str_search);
                    oci_bind_by_name($when_str_search_stmt, ":key", $key);
                    oci_execute($when_str_search_stmt);
                    oci_commit($connctn);
                    oci_fetch($when_str_search_stmt);
                    $response = oci_result($when_str_search_stmt, "KEYWORD_ID");
                    ?>
                      <?php
                    oci_free_statement($when_str_search_stmt);
                    //******************************
                    //This query uses the keyword_has_answer to table to figure out which
                    //answer in the table is related to the keyword.
                    //******************************
                   $when_key_to_ans = "select answer_id 
                                        from keyword_has_answer2
                                        where keyword_id = :k_id";
                    $when_key_to_ans_stmt = oci_parse($connctn, $when_key_to_ans);
                    oci_bind_by_name($when_key_to_ans_stmt, ":k_id", $response);
                    oci_execute($when_key_to_ans_stmt);
                    oci_fetch($when_key_to_ans_stmt);
                    $k_t_a = oci_result($when_key_to_ans_stmt, "ANSWER_ID");
                    ?>
                    <?php
                        oci_free_statement($when_key_to_ans_stmt);
                    //********************************************
                    //This table gets the answer from the previous tables query
                    //*********************************************
                    $when_ans = "select answer_name from answer2 where answer_id = :k_t_a";
                    $when_ans_stmt = oci_parse($connctn, $when_ans);
                    oci_bind_by_name($when_ans_stmt, "k_t_a", $k_t_a);
                    oci_execute($when_ans_stmt);
                    oci_fetch($when_ans_stmt);
                    $answer = oci_result($when_ans_stmt, "ANSWER_NAME");

                    if ($answer == '')
                    {
                        ?>
                    <div class="w3-card-4">
                    
                    <div class="w3-container w3-green">
                    <h2>We don't seem to have an answer... Could you provide us with an answer?</h2>
                    </div>
                    <form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
                    <input type="text" class="w3-input" name="insert-answer-box" id="insert-answer-box" placeholder="Type text here" minlength="1" maxlength="144" />
					  <button class="w3-butn w3-margin w3-blue" type="submit" onclick="chatFunction()" id="chat_button" name="next_option3"
                      value="reply">
					  Submit Answer
					  </button>
                    </form>
                    </div>
                        <?php

                    }
                    else
                    {
                        ?>
                        <div class="w3-container" id="message-area">
                            <h1 class="w3-round" id="chat1">
                                <?= $answer ?>
                            </h1>
                            </div>
                        <?php
                    }
                        oci_free_statement($when_ans_stmt);
                }









            }
            elseif ($token === "how")
            {
                $token = false;

                $select_check = "select keyword_id from keyword2 where keyword_name = :keyword_to_bind and category_id = '0005'";
                $select_check_stmt = oci_parse($connctn, $select_check);
                oci_bind_by_name($select_check_stmt, ":keyword_to_bind", $keyword_to_bind);
                oci_execute($select_check_stmt);
                oci_commit($connctn);
                oci_fetch($select_check_stmt);
                $select_key = oci_result($select_check_stmt, "KEYWORD_ID");
                oci_free_statement($select_check_stmt);
                // If keywords don't exist then we enter to do inserts into all keyword, keyword_has_answer, and answer table.
                if ($select_key == '')
                {

                     //echo "This how WORKS";

                     /*Finds the max value for in Keyword so that it can insert one higher. This saved me the trouble of writing a stupid trigger. Less efficent and not as generalized but hay no trigger.*/
                    $select_insert = "select max(keyword_id) from keyword2";
                    $select_insert_stmt = oci_parse($connctn, $select_insert);
                    oci_execute($select_insert_stmt);
                    oci_commit($connctn);
                    oci_fetch($select_insert_stmt);
                    $max_keyword_id = oci_result($select_insert_stmt, "MAX(KEYWORD_ID)");


                    $max_keyword_id = $max_keyword_id + 1;
                    oci_free_statement($select_insert_stmt);
                    // Finds the max value for the Answer table so that I can insert one higher thus again saving me the trouble of writing a hence forth stupid trigger. 
                    $select_insert_answer = "select max(answer_id) from answer2";
                    $select_insert_answer_stmt = oci_parse($connctn, $select_insert_answer);
                    oci_execute($select_insert_answer_stmt);
                    oci_commit($connctn);
                    oci_fetch($select_insert_answer_stmt);
                    $max_answer_id = oci_result($select_insert_answer_stmt, "MAX(ANSWER_ID)");

                    $max_answer_id = $max_answer_id + 1;
                    oci_free_statement($select_insert_answer_stmt);



                    // Inserts keyword inputted by users for future questions.
                    $insert_how = "insert into keyword2 
                                    values
                                    (:max_keyword_id, '0005', :keyword_to_bind)";
                    $insert_how_stmt = oci_parse($connctn, $insert_how);
                    oci_bind_by_name($insert_how_stmt, ":max_keyword_id", $max_keyword_id);
                    oci_bind_by_name($insert_how_stmt, ":keyword_to_bind", $keyword_to_bind);
                    oci_execute($insert_how_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_how_stmt);



                    //Inserts into the answer table the answer to the questions given.
                    $insert_how_a = "insert into answer2 
                                    values
                                    (:max_answer_id, '0005', :answer)";
                    $insert_how_a_stmt = oci_parse($connctn, $insert_how_a);
                    oci_bind_by_name($insert_how_a_stmt, ":answer", $answer_null);
                    oci_bind_by_name($insert_how_a_stmt, ":max_answer_id", $max_answer_id);
                    oci_execute($insert_how_a_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_how_a_stmt);

                    //Inserts the keyword ID and the answer id into the keyword_has_answer table for look up. It does this for relational database purposes.
                    $insert_how_kha = "insert into keyword_has_answer2 
                                    values
                                    (:max_keyword_id, :max_answer_id)";
                    $insert_how_kha_stmt = oci_parse($connctn, $insert_how_kha);
                    oci_bind_by_name($insert_how_kha_stmt, ":max_keyword_id", $max_keyword_id);
                    oci_bind_by_name($insert_how_kha_stmt, ":max_answer_id", $max_answer_id);
                    oci_execute($insert_how_kha_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_how_kha_stmt);

                    ?>
                    <div class="w3-card-4">
                    
                    <div class="w3-container w3-green">
                    <h2>We don't seem to have an answer... Could you provide us with an answer?</h2>
                    </div>
                    <form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
                    <input type="text" class="w3-input" name="insert-answer-box" id="insert-answer-box" placeholder="Type text here" minlength="1" maxlength="144" />
					  <button class="w3-butn w3-margin w3-blue" type="submit" onclick="chatFunction()" id="chat_button" name="next_option3"
                      value="reply">
					  Submit Answer
					  </button>
                    </form>
                </div>
                    <?php
                    $_SESSION["answer-id"] = $max_answer_id;

                }
                else
                {

                    $how_str_search = "select keyword_id from keyword2 where keyword_name = :key and category_id = '0005'";
                    $how_str_search_stmt = oci_parse($connctn, $how_str_search);
                    oci_bind_by_name($how_str_search_stmt, ":key", $key);
                    oci_execute($how_str_search_stmt);
                    oci_commit($connctn);
                    oci_fetch($how_str_search_stmt);
                    $response = oci_result($how_str_search_stmt, "KEYWORD_ID");
                    ?>
                      <?php

                    oci_free_statement($how_str_search_stmt);

                    //******************************
                    //This query uses the keyword_has_answer to table to figure out which
                    //answer in the table is related to the keyword.
                    //******************************

                   $how_key_to_ans = "select answer_id 
                                        from keyword_has_answer2
                                        where keyword_id = :k_id";
                    $how_key_to_ans_stmt = oci_parse($connctn, $how_key_to_ans);

                    oci_bind_by_name($how_key_to_ans_stmt, ":k_id", $response);

                    oci_execute($how_key_to_ans_stmt);

                    oci_fetch($how_key_to_ans_stmt);

                    $k_t_a = oci_result($how_key_to_ans_stmt, "ANSWER_ID");

                    ?>
                    <?php
                        oci_free_statement($how_key_to_ans_stmt);

                    //********************************************
                    //This table gets the answer from the previous tables query
                    //*********************************************

                    $how_ans = "select answer_name from answer2 where answer_id = :k_t_a";
                    $how_ans_stmt = oci_parse($connctn, $how_ans);
                    oci_bind_by_name($how_ans_stmt, "k_t_a", $k_t_a);
                    oci_execute($how_ans_stmt);
                    oci_fetch($how_ans_stmt);
                    $answer = oci_result($how_ans_stmt, "ANSWER_NAME");

                    if ($answer == '')
                    {
                        $_SESSION["answer-id"] = $k_t_a;
                        ?>
                    <div class="w3-card-4">
                    
                    <div class="w3-container w3-green">
                    <h2>We don't seem to have an answer... Could you provide us with an answer?</h2>
                    </div>
                    <form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
                    <input type="text" class="w3-input" name="insert-answer-box" id="insert-answer-box" placeholder="Type text here" minlength="1" maxlength="144" />
					  <button class="w3-butn w3-margin w3-blue" type="submit" onclick="chatFunction()" id="chat_button" name="next_option3"
                      value="reply">
					  Submit Answer
					  </button>
                    </form>
                </div>
                        <?php

                    }
                    else
                    {
                        ?>
                        <div class="w3-container" id="message-area">
                            <h1 class="w3-round" id="chat1">
                                <?= $answer ?>
                            </h1>
                            </div>
                        <?php
                    }
                        oci_free_statement($how_ans_stmt);
                }

            }
            elseif ($token === "why")
            {
                $token = false;

                //Does a check to see if a keyword is already entered into the database and if it has it skips inserting another one. Possible revition depedent on time ot allow 3 answers per keyword
                $select_check = "select keyword_id from keyword2 where keyword_name = :keyword_to_bind and category_id = '0004'";
                $select_check_stmt = oci_parse($connctn, $select_check);
                oci_bind_by_name($select_check_stmt, ":keyword_to_bind", $keyword_to_bind);
                oci_execute($select_check_stmt);
                oci_commit($connctn);
                oci_fetch($select_check_stmt);
                $select_key = oci_result($select_check_stmt, "KEYWORD_ID");
                oci_free_statement($select_check_stmt);
                // If keywords don't exist then we enter to do inserts into all keyword, keyword_has_answer, and answer table.
                if ($select_key == '')
                {
                     //echo "This why WORKS";

                     /*Finds the max value for in Keyword so that it can insert one higher. This saved me the trouble of writing a stupid trigger. Less efficent and not as generalized but hay no trigger.*/
                    $select_insert = "select max(keyword_id) from keyword2";
                    $select_insert_stmt = oci_parse($connctn, $select_insert);
                    oci_execute($select_insert_stmt);
                    oci_commit($connctn);
                    oci_fetch($select_insert_stmt);
                    $max_keyword_id = oci_result($select_insert_stmt, "MAX(KEYWORD_ID)");
                    $max_keyword_id = $max_keyword_id + 1;
                    oci_free_statement($select_insert_stmt);
                    // Finds the max value for the Answer table so that I can insert one higher thus again saving me the trouble of writing a hence forth stupid trigger. 
                    $select_insert_answer = "select max(answer_id) from answer2";
                    $select_insert_answer_stmt = oci_parse($connctn, $select_insert_answer);
                    oci_execute($select_insert_answer_stmt);
                    oci_commit($connctn);
                    oci_fetch($select_insert_answer_stmt);
                    $max_answer_id = oci_result($select_insert_answer_stmt, "MAX(ANSWER_ID)");
                    $max_answer_id = $max_answer_id + 1;
                    oci_free_statement($select_insert_answer_stmt);
                    // Inserts keyword inputted by users for future questions.
                    $insert_why = "insert into keyword2 
                                    values
                                    (:max_keyword_id, '0004', :keyword_to_bind)";
                    $insert_why_stmt = oci_parse($connctn, $insert_why);
                    oci_bind_by_name($insert_why_stmt, ":max_keyword_id", $max_keyword_id);
                    oci_bind_by_name($insert_why_stmt, ":keyword_to_bind", $keyword_to_bind);
                    oci_execute($insert_why_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_why_stmt);
                    //Inserts into the answer table the answer to the questions given.
                    $insert_why_a = "insert into answer2 
                                    values
                                    (:max_answer_id, '0004', :answer)";
                    $insert_why_a_stmt = oci_parse($connctn, $insert_why_a);
                    oci_bind_by_name($insert_why_a_stmt, ":answer", $answer_null);
                    oci_bind_by_name($insert_why_a_stmt, ":max_answer_id", $max_answer_id);
                    oci_execute($insert_why_a_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_why_a_stmt);
                    //Inserts the keyword ID and the answer id into the keyword_has_answer table for look up. It does this for relational database purposes.
                    $insert_why_kha = "insert into keyword_has_answer2 
                                    values
                                    (:max_keyword_id, :max_answer_id)";
                    $insert_why_kha_stmt = oci_parse($connctn, $insert_why_kha);
                    oci_bind_by_name($insert_why_kha_stmt, ":max_keyword_id", $max_keyword_id);
                    oci_bind_by_name($insert_why_kha_stmt, ":max_answer_id", $max_answer_id);
                    oci_execute($insert_why_kha_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_why_kha_stmt);

                    ?>
                    <div class="w3-card-4">
                    
                    <div class="w3-container w3-green">
                    <h2>We don't seem to have an answer... Could you provide us with an answer?</h2>
                    </div>
                    <form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
                    <input type="text" class="w3-input" name="insert-answer-box" id="insert-answer-box" placeholder="Type text here" minlength="1" maxlength="144" />
					  <button class="w3-butn w3-margin w3-blue" type="submit" onclick="chatFunction()" id="chat_button" name="next_option3"
                      value="reply">
					  Submit Answer
					  </button>
                    </form>
                </div>
                    <?php
                    $_SESSION["answer-id"] = $max_answer_id;

                }
                else
                {

                    $why_str_search = "select keyword_id from keyword2 where keyword_name = :key and category_id = '0004'";
                    $why_str_search_stmt = oci_parse($connctn, $why_str_search);
                    oci_bind_by_name($why_str_search_stmt, ":key", $key);
                    oci_execute($why_str_search_stmt);
                    oci_commit($connctn);
                    oci_fetch($why_str_search_stmt);
                    $response = oci_result($why_str_search_stmt, "KEYWORD_ID");
                    ?>
                      <?php
                    oci_free_statement($why_str_search_stmt);
                    //******************************
                    //This query uses the keyword_has_answer to table to figure out which
                    //answer in the table is related to the keyword.
                    //******************************
                   $why_key_to_ans = "select answer_id 
                                        from keyword_has_answer2
                                        where keyword_id = :k_id";
                    $why_key_to_ans_stmt = oci_parse($connctn, $why_key_to_ans);
                    oci_bind_by_name($why_key_to_ans_stmt, ":k_id", $response);
                    oci_execute($why_key_to_ans_stmt);
                    oci_fetch($why_key_to_ans_stmt);
                    $k_t_a = oci_result($why_key_to_ans_stmt, "ANSWER_ID");
                    ?>
                    <?php
                        oci_free_statement($why_key_to_ans_stmt);
                    //********************************************
                    //This table gets the answer from the previous tables query
                    //*********************************************
                    $why_ans = "select answer_name from answer2 where answer_id = :k_t_a";
                    $why_ans_stmt = oci_parse($connctn, $why_ans);
                    oci_bind_by_name($why_ans_stmt, "k_t_a", $k_t_a);
                    oci_execute($why_ans_stmt);
                    oci_fetch($why_ans_stmt);
                    $answer = oci_result($why_ans_stmt, "ANSWER_NAME");

                    if ($answer == '')
                    {
                        $_SESSION["answer-id"] = $k_t_a;
                        ?>
                    <div class="w3-card-4">
                    
                    <div class="w3-container w3-green">
                    <h2>We don't seem to have an answer... Could you provide us with an answer?</h2>
                    </div>
                    <form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
                    <input type="text" class="w3-input" name="insert-answer-box" id="insert-answer-box" placeholder="Type text here" minlength="1" maxlength="144" />
					  <button class="w3-butn w3-margin w3-blue" type="submit" onclick="chatFunction()" id="chat_button" name="next_option3"
                      value="reply">
					  Submit Answer
					  </button>
                    </form>
                    </div>
                        <?php

                    }
                    else
                    {
                        ?>
                        <div class="w3-container" id="message-area">
                            <h1 class="w3-round" id="chat1">
                                <?= $answer ?>
                            </h1>
                            </div>
                        <?php
                    }
                        oci_free_statement($why_ans_stmt);
                }









            }
            elseif ($token === "what")
            {
                $token = false;



                //Does a check to see if a keyword is already entered into the database and if it has it skips inserting another one. Possible revition depedent on time ot allow 3 answers per keyword
                $select_check = "select keyword_id from keyword2 where keyword_name = :keyword_to_bind";
                $select_check_stmt = oci_parse($connctn, $select_check);
                oci_bind_by_name($select_check_stmt, ":keyword_to_bind", $keyword_to_bind);
                oci_execute($select_check_stmt);
                oci_commit($connctn);
                oci_fetch($select_check_stmt);
                $select_key = oci_result($select_check_stmt, "KEYWORD_ID");
                oci_free_statement($select_check_stmt);
                // If keywords don't exist then we enter to do inserts into all keyword, keyword_has_answer, and answer table.
                if ($select_key == '')
                {
                     //echo "This what WORKS";

                     /*Finds the max value for in Keyword so that it can insert one higher. This saved me the trouble of writing a stupid trigger. Less efficent and not as generalized but hay no trigger.*/
                    $select_insert = "select max(keyword_id) from keyword2";
                    $select_insert_stmt = oci_parse($connctn, $select_insert);
                    oci_execute($select_insert_stmt);
                    oci_commit($connctn);
                    oci_fetch($select_insert_stmt);
                    $max_keyword_id = oci_result($select_insert_stmt, "MAX(KEYWORD_ID)");
                    $max_keyword_id = $max_keyword_id + 1;
                    oci_free_statement($select_insert_stmt);
                    // Finds the max value for the Answer table so that I can insert one higher thus again saving me the trouble of writing a hence forth stupid trigger. 
                    $select_insert_answer = "select max(answer_id) from answer2";
                    $select_insert_answer_stmt = oci_parse($connctn, $select_insert_answer);
                    oci_execute($select_insert_answer_stmt);
                    oci_commit($connctn);
                    oci_fetch($select_insert_answer_stmt);
                    $max_answer_id = oci_result($select_insert_answer_stmt, "MAX(ANSWER_ID)");
                    $max_answer_id = $max_answer_id + 1;
                    oci_free_statement($select_insert_answer_stmt);
                    // Inserts keyword inputted by users for future questions.
                    $insert_what = "insert into keyword2 
                                    values
                                    (:max_keyword_id, '0001', :keyword_to_bind)";
                    $insert_what_stmt = oci_parse($connctn, $insert_what);
                    oci_bind_by_name($insert_what_stmt, ":max_keyword_id", $max_keyword_id);
                    oci_bind_by_name($insert_what_stmt, ":keyword_to_bind", $keyword_to_bind);
                    oci_execute($insert_what_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_what_stmt);
                    //Inserts into the answer table the answer to the questions given.
                    $insert_what_a = "insert into answer2 
                                    values
                                    (:max_answer_id, '0001', :answer)";
                    $insert_what_a_stmt = oci_parse($connctn, $insert_what_a);
                    oci_bind_by_name($insert_what_a_stmt, ":answer", $answer_null);
                    oci_bind_by_name($insert_what_a_stmt, ":max_answer_id", $max_answer_id);
                    oci_execute($insert_what_a_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_what_a_stmt);
                    //Inserts the keyword ID and the answer id into the keyword_has_answer table for look up. It does this for relational database purposes.
                    $insert_what_kha = "insert into keyword_has_answer2 
                                    values
                                    (:max_keyword_id, :max_answer_id)";
                    $insert_what_kha_stmt = oci_parse($connctn, $insert_what_kha);
                    oci_bind_by_name($insert_what_kha_stmt, ":max_keyword_id", $max_keyword_id);
                    oci_bind_by_name($insert_what_kha_stmt, ":max_answer_id", $max_answer_id);
                    oci_execute($insert_what_kha_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_what_kha_stmt);

                    ?>
                    <div class="w3-card-4">
                    
                    <div class="w3-container w3-green">
                    <h2>We don't seem to have an answer... Could you provide us with an answer?</h2>
                    </div>
                    <form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
                    <input type="text" class="w3-input" name="insert-answer-box" id="insert-answer-box" placeholder="Type text here" minlength="1" maxlength="144" />
					  <button class="w3-butn w3-margin w3-blue" type="submit" onclick="chatFunction()" id="chat_button" name="next_option3"
                      value="reply">
					  Submit Answer
					  </button>
                    </form>
                </div>
                    <?php
                    $_SESSION["answer-id"] = $max_answer_id;

                }
                else
                {

                    $what_str_search = "select keyword_id from keyword2 where keyword_name = :key and category_id = '0001'";
                    $what_str_search_stmt = oci_parse($connctn, $what_str_search);
                    oci_bind_by_name($what_str_search_stmt, ":key", $key);
                    echo " The Key \n ";
                    echo $key;
                    oci_execute($what_str_search_stmt);
                    oci_commit($connctn);
                    oci_fetch($what_str_search_stmt);
                    $response = oci_result($what_str_search_stmt, "KEYWORD_ID");
                    echo " THE response ";
                    echo $response;
                    ?> 
                    <br />
                      <?php
                    oci_free_statement($what_str_search_stmt);
                    //******************************
                    //This query uses the keyword_has_answer to table to figure out which
                    //answer in the table is related to the keyword.
                    //******************************
                   $what_key_to_ans = "select answer_id 
                                        from keyword_has_answer2
                                        where keyword_id = :k_id";
                    $what_key_to_ans_stmt = oci_parse($connctn, $what_key_to_ans);
                    oci_bind_by_name($what_key_to_ans_stmt, ":k_id", $response);
                    oci_execute($what_key_to_ans_stmt);
                    oci_fetch($what_key_to_ans_stmt);
                    $k_t_a = oci_result($what_key_to_ans_stmt, "ANSWER_ID");
                    ?>
                    <?php
                        oci_free_statement($what_key_to_ans_stmt);
                    //********************************************
                    //This table gets the answer from the previous tables query
                    //*********************************************
                    $what_ans = "select answer_name from answer2 where answer_id = :k_t_a";
                    $what_ans_stmt = oci_parse($connctn, $what_ans);
                    oci_bind_by_name($what_ans_stmt, "k_t_a", $k_t_a);
                    oci_execute($what_ans_stmt);
                    oci_fetch($what_ans_stmt);
                    $answer = oci_result($what_ans_stmt, "ANSWER_NAME");

                    if ($answer == '')
                    {
                        $_SESSION["answer-id"] = $k_t_a;
                        ?>
                    <div class="w3-card-4">
                    
                    <div class="w3-container w3-green">
                    <h2>We don't seem to have an answer... Could you provide us with an answer?</h2>
                    </div>
                    <form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
                    <input type="text" class="w3-input" name="insert-answer-box" id="insert-answer-box" placeholder="Type text here" minlength="1" maxlength="144" />
					  <button class="w3-butn w3-margin w3-blue" type="submit" onclick="chatFunction()" id="chat_button" name="next_option3"
                      value="reply">
					  Submit Answer
					  </button>
                    </form>
                    </div>
                        <?php

                    }
                    else
                    {
                        ?>
                        <div class="w3-container" id="message-area">
                            <h1 class="w3-round" id="chat1">
                                <?= $answer ?>
                            </h1>
                            </div>
                        <?php
                    }
                        oci_free_statement($what_ans_stmt);
                }







            }
            elseif ($token === "who")
            {
                $token = false;

                /*Does a check to see if a keyword is already entered into the database and if it has it skips inserting another one. Possible revition depedent on time ot allow 3 answers per keyword*/

                $select_check = "select keyword_id from keyword2 where keyword_name = :keyword_to_bind and category_id = '0007'";
                $select_check_stmt = oci_parse($connctn, $select_check);
                oci_bind_by_name($select_check_stmt, ":keyword_to_bind", $keyword_to_bind);
                oci_execute($select_check_stmt);
                oci_commit($connctn);
                oci_fetch($select_check_stmt);
                $select_key = oci_result($select_check_stmt, "KEYWORD_ID");
                oci_free_statement($select_check_stmt);
                // If keywords don't exist then we enter to do inserts into all keyword, keyword_has_answer, and answer table.
                if ($select_key == '')
                {
                     //echo "This who WORKS";

                     /*Finds the max value for in Keyword so that it can insert one higher. This saved me the trouble of writing a stupid trigger. Less efficent and not as generalized but hay no trigger.*/
                    $select_insert = "select max(keyword_id) from keyword2";
                    $select_insert_stmt = oci_parse($connctn, $select_insert);
                    oci_execute($select_insert_stmt);
                    oci_commit($connctn);
                    oci_fetch($select_insert_stmt);
                    $max_keyword_id = oci_result($select_insert_stmt, "MAX(KEYWORD_ID)");
                    $max_keyword_id = $max_keyword_id + 1;
                    oci_free_statement($select_insert_stmt);
                    // Finds the max value for the Answer table so that I can insert one higher thus again saving me the trouble of writing a hence forth stupid trigger. 
                    $select_insert_answer = "select max(answer_id) from answer2";
                    $select_insert_answer_stmt = oci_parse($connctn, $select_insert_answer);
                    oci_execute($select_insert_answer_stmt);
                    oci_commit($connctn);
                    oci_fetch($select_insert_answer_stmt);
                    $max_answer_id = oci_result($select_insert_answer_stmt, "MAX(ANSWER_ID)");
                    $max_answer_id = $max_answer_id + 1;
                    oci_free_statement($select_insert_answer_stmt);
                    // Inserts keyword inputted by users for future questions.
                    $insert_who = "insert into keyword2 
                                    values
                                    (:max_keyword_id, '0007', :keyword_to_bind)";
                    $insert_who_stmt = oci_parse($connctn, $insert_who);
                    oci_bind_by_name($insert_who_stmt, ":max_keyword_id", $max_keyword_id);
                    oci_bind_by_name($insert_who_stmt, ":keyword_to_bind", $keyword_to_bind);
                    oci_execute($insert_who_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_who_stmt);
                    //Inserts into the answer table the answer to the questions given.
                    $insert_who_a = "insert into answer2 
                                    values
                                    (:max_answer_id, '0007', :answer)";
                    $insert_who_a_stmt = oci_parse($connctn, $insert_who_a);
                    oci_bind_by_name($insert_who_a_stmt, ":answer", $answer_null);
                    oci_bind_by_name($insert_who_a_stmt, ":max_answer_id", $max_answer_id);
                    oci_execute($insert_who_a_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_who_a_stmt);
                    //Inserts the keyword ID and the answer id into the keyword_has_answer table for look up. It does this for relational database purposes.
                    $insert_who_kha = "insert into keyword_has_answer2 
                                    values
                                    (:max_keyword_id, :max_answer_id)";
                    $insert_who_kha_stmt = oci_parse($connctn, $insert_who_kha);
                    oci_bind_by_name($insert_who_kha_stmt, ":max_keyword_id", $max_keyword_id);
                    oci_bind_by_name($insert_who_kha_stmt, ":max_answer_id", $max_answer_id);
                    oci_execute($insert_who_kha_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_who_kha_stmt);

                    ?>
                    <div class="w3-card-4">
                    
                    <div class="w3-container w3-green">
                    <h2>We don't seem to have an answer... Could you provide us with an answer?</h2>
                    </div>
                    <form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
                    <input type="text" class="w3-input" name="insert-answer-box" id="insert-answer-box" placeholder="Type text here" minlength="1" maxlength="144" />
					  <button class="w3-butn w3-margin w3-blue" type="submit" onclick="chatFunction()" id="chat_button" name="next_option3"
                      value="reply">
					  Submit Answer
					  </button>
                    </form>
                </div>
                    <?php
                    $_SESSION["answer-id"] = $max_answer_id;

                }
                else
                {

                    $who_str_search = "select keyword_id from keyword2 where keyword_name = :key and category_id = '0007'";
                    $who_str_search_stmt = oci_parse($connctn, $who_str_search);
                    oci_bind_by_name($who_str_search_stmt, ":key", $key);
                    oci_execute($who_str_search_stmt);
                    oci_commit($connctn);
                    oci_fetch($who_str_search_stmt);
                    $response = oci_result($who_str_search_stmt, "KEYWORD_ID");
                    ?>
                      <?php
                    oci_free_statement($who_str_search_stmt);
                    //******************************
                    //This query uses the keyword_has_answer to table to figure out which
                    //answer in the table is related to the keyword.
                    //******************************
                   $who_key_to_ans = "select answer_id 
                                        from keyword_has_answer2
                                        where keyword_id = :k_id";
                    $who_key_to_ans_stmt = oci_parse($connctn, $who_key_to_ans);
                    oci_bind_by_name($who_key_to_ans_stmt, ":k_id", $response);
                    oci_execute($who_key_to_ans_stmt);
                    oci_fetch($who_key_to_ans_stmt);
                    $k_t_a = oci_result($who_key_to_ans_stmt, "ANSWER_ID");
                    ?>
                    <?php
                        oci_free_statement($who_key_to_ans_stmt);
                    //********************************************
                    //This table gets the answer from the previous tables query
                    //*********************************************
                    $who_ans = "select answer_name from answer2 where answer_id = :k_t_a";
                    $who_ans_stmt = oci_parse($connctn, $who_ans);
                    oci_bind_by_name($who_ans_stmt, "k_t_a", $k_t_a);
                    oci_execute($who_ans_stmt);
                    oci_fetch($who_ans_stmt);
                    $answer = oci_result($who_ans_stmt, "ANSWER_NAME");

                    if ($answer == '')
                    {
                        $_SESSION["answer-id"] = $k_t_a;
                        ?>
                    <div class="w3-card-4">
                    
                    <div class="w3-container w3-green">
                    <h2>We don't seem to have an answer... Could you provide us with an answer?</h2>
                    </div>
                    <form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
                    <input type="text" class="w3-input" name="insert-answer-box" id="insert-answer-box" placeholder="Type text here" minlength="1" maxlength="144" />
					  <button class="w3-butn w3-margin w3-blue" type="submit" onclick="chatFunction()" id="chat_button" name="next_option3"
                      value="reply">
					  Submit Answer
					  </button>
                    </form>
                    </div>
                        <?php

                    }
                    else
                    {
                        ?>
                        <div class="w3-container" id="message-area">
                            <h1 class="w3-round" id="chat1">
                                <?= $answer ?>
                            </h1>
                            </div>
                        <?php
                    }
                        oci_free_statement($who_ans_stmt);
                }
            }
            else
            {
                $token_counter++;
                $token = strtok(" ");
            }

            if ($token_counter === str_word_count($lower_string))
            {
    //            echo "A general statement";
                $token = false;

                $select_check = "select keyword_id from keyword2 where keyword_name = :keyword_to_bind and category_id = '0000'";
                $select_check_stmt = oci_parse($connctn, $select_check);
                oci_bind_by_name($select_check_stmt, ":keyword_to_bind", $keyword_to_bind);
                oci_execute($select_check_stmt);
                oci_commit($connctn);
                oci_fetch($select_check_stmt);
                $select_key = oci_result($select_check_stmt, "KEYWORD_ID");
                oci_free_statement($select_check_stmt);
                // If keywords don't exist then we enter to do inserts into all keyword, keyword_has_answer, and answer table.
                if ($select_key == '')
                {
                     //echo "This general WORKS";

                     /*Finds the max value for in Keyword so that it can insert one higher. This saved me the trouble of writing a stupid trigger. Less efficent and not as generalized but hay no trigger.*/
                    $select_insert = "select max(keyword_id) from keyword2";
                    $select_insert_stmt = oci_parse($connctn, $select_insert);
                    oci_execute($select_insert_stmt);
                    oci_commit($connctn);
                    oci_fetch($select_insert_stmt);
                    $max_keyword_id = oci_result($select_insert_stmt, "MAX(KEYWORD_ID)");
                    $max_keyword_id = $max_keyword_id + 1;
                    oci_free_statement($select_insert_stmt);
                    // Finds the max value for the Answer table so that I can insert one higher thus again saving me the trouble of writing a hence forth stupid trigger. 
                    $select_insert_answer = "select max(answer_id) from answer2";
                    $select_insert_answer_stmt = oci_parse($connctn, $select_insert_answer);
                    oci_execute($select_insert_answer_stmt);
                    oci_commit($connctn);
                    oci_fetch($select_insert_answer_stmt);
                    $max_answer_id = oci_result($select_insert_answer_stmt, "MAX(ANSWER_ID)");
                    $max_answer_id = $max_answer_id + 1;
                    oci_free_statement($select_insert_answer_stmt);
                    // Inserts keyword inputted by users for future questions.
                    $insert_general = "insert into keyword2 
                                    values
                                    (:max_keyword_id, '0000', :keyword_to_bind)";
                    $insert_general_stmt = oci_parse($connctn, $insert_general);
                    oci_bind_by_name($insert_general_stmt, ":max_keyword_id", $max_keyword_id);
                    oci_bind_by_name($insert_general_stmt, ":keyword_to_bind", $keyword_to_bind);
                    oci_execute($insert_general_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_general_stmt);
                    //Inserts into the answer table the answer to the questions given.
                    $insert_general_a = "insert into answer2 
                                    values
                                    (:max_answer_id, '0000', :answer)";
                    $insert_general_a_stmt = oci_parse($connctn, $insert_general_a);
                    oci_bind_by_name($insert_general_a_stmt, ":answer", $answer_null);
                    oci_bind_by_name($insert_general_a_stmt, ":max_answer_id", $max_answer_id);
                    oci_execute($insert_general_a_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_general_a_stmt);
                    //Inserts the keyword ID and the answer id into the keyword_has_answer table for look up. It does this for relational database purposes.
                    $insert_general_kha = "insert into keyword_has_answer2 
                                    values
                                    (:max_keyword_id, :max_answer_id)";
                    $insert_general_kha_stmt = oci_parse($connctn, $insert_general_kha);
                    oci_bind_by_name($insert_general_kha_stmt, ":max_keyword_id", $max_keyword_id);
                    oci_bind_by_name($insert_general_kha_stmt, ":max_answer_id", $max_answer_id);
                    oci_execute($insert_general_kha_stmt, OCI_DEFAULT);
                    oci_commit($connctn);
                    oci_free_statement($insert_general_kha_stmt);

                    ?>
                    <div class="w3-card-4">
                    
                    <div class="w3-container w3-green">
                    <h2>We don't seem to have an answer... Could you provide us with an answer?</h2>
                    </div>
                    <form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
                    <input type="text" class="w3-input" name="insert-answer-box" id="insert-answer-box" placeholder="Type text here" minlength="1" maxlength="144" />
					  <button class="w3-butn w3-margin w3-blue" type="submit" onclick="chatFunction()" id="chat_button" name="next_option3"
                      value="reply">
					  Submit Answer
					  </button>
                    </form>
                </div>
                    <?php
                    $_SESSION["answer-id"] = $max_answer_id;

                }
                else
                {

                    $general_str_search = "select keyword_id from keyword2 where keyword_name = :key and category_id = '0000'";
                    $general_str_search_stmt = oci_parse($connctn, $general_str_search);
                    oci_bind_by_name($general_str_search_stmt, ":key", $key);
                    oci_execute($general_str_search_stmt);
                    oci_commit($connctn);
                    oci_fetch($general_str_search_stmt);
                    $response = oci_result($general_str_search_stmt, "KEYWORD_ID");
                    ?>
                      <?php
                    oci_free_statement($general_str_search_stmt);
                    //******************************
                    //This query uses the keyword_has_answer to table to figure out which
                    //answer in the table is related to the keyword.
                    //******************************
                   $general_key_to_ans = "select answer_id 
                                        from keyword_has_answer2
                                        where keyword_id = :k_id";
                    $general_key_to_ans_stmt = oci_parse($connctn, $general_key_to_ans);
                    oci_bind_by_name($general_key_to_ans_stmt, ":k_id", $response);
                    oci_execute($general_key_to_ans_stmt);
                    oci_fetch($general_key_to_ans_stmt);
                    $k_t_a = oci_result($general_key_to_ans_stmt, "ANSWER_ID");
                    ?>
                    <?php
                        oci_free_statement($general_key_to_ans_stmt);
                    //********************************************
                    //This table gets the answer from the previous tables query
                    //*********************************************
                    $general_ans = "select answer_name from answer2 where answer_id = :k_t_a";
                    $general_ans_stmt = oci_parse($connctn, $general_ans);
                    oci_bind_by_name($general_ans_stmt, "k_t_a", $k_t_a);
                    oci_execute($general_ans_stmt);
                    oci_fetch($general_ans_stmt);
                    $answer = oci_result($general_ans_stmt, "ANSWER_NAME");

                    if ($answer == '')
                    {
                        $_SESSION["answer-id"] = $k_t_a;
                        ?>
                    <div class="w3-card-4">
                    
                    <div class="w3-container w3-green">
                    <h2>We don't seem to have an answer... Could you provide us with an answer?</h2>
                    </div>
                    <form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
                    <input type="text" class="w3-input" name="insert-answer-box" id="insert-answer-box" placeholder="Type text here" minlength="1" maxlength="144" />
					  <button class="w3-butn w3-margin w3-blue" type="submit" onclick="chatFunction()" id="chat_button" name="next_option3"
                      value="reply">
					  Submit Answer
					  </button>
                    </form>
                    </div>
                        <?php

                    }
                    else
                    {
                        ?>
                            <div class="w3-container" id="message-area">
                            <h1 class="w3-round" id="chat1">
                                <?= $answer ?>
                            </h1>
                            </div>
                        <?php
                    }
                        oci_free_statement($general_ans_stmt);
                }

            }


        }


?>
<br />
<?php
date_default_timezone_set("America/Los_Angeles");
echo "The Time is " . date("h:i:sa");


oci_close($connctn);
}
?>
				
				<div class="w3-container" id="message-area">
				
				</div>
				
				<div class="w3-container w3-margin w3-round" id="form-input-rounded-box">
					<form id="input-rounded-box" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method="post">
					  <input type="text" class="w3-input" name="input-box" id="input-box" placeholder="Type text here" minlength="1" maxlength="144" />
					  <button class="w3-butn w3-margin w3-blue" type="submit" onclick="chatFunction()" id="chat_button" name="next_option3"
                      value="reply">
					  Chat
					  </button>
					  <div>
						<button class="one" name="next_option3" type="submit" value="feedback">Provide Feedback</button>
						<button class="two" name="next_option3" type="submit" value="home">Home</button>
						<button class="three" name="next_option3" type="submit" value="faq">Check the FAQ</button>
					  </div>
					</form>
				</div>
				
				
				
            <div class="w3-container w3-padding-64">
                <footer class="footer_topyfront"> </footer>
                <footer class="footer_bottomgfront"></footer>
            </div>
			</body>
		</html>
		<?php
    }
?>
