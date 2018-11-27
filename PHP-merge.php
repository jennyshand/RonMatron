<title> Version 0.8.0 </title>

<?php
session_start();
$a_string = 'Where is Cotton Eyed Joe?';
$lower_string = strtolower($a_string);
//echo 'Hello /n';
$array_analysis = $lower_string;
$token = strtok($lower_string, " ");
$token_array = strtok($array_analysis, " ");
echo 'Original String: ';
echo $lower_string;
echo '<br />';
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
$conjunction_array = array("and", "or", "is", "so", "the", "did", "where", "but", "yet", "that", "then", "when", "how", "why", "who", "i", "could");
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
// END OF LOG IN SHIT
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
    echo '<br />';
    echo "$value <br />";
    echo '<br />';
    $keyword_string .= "$value ";
}
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
echo $keyword_string;
//Checks the major keywords for what exactly somebody wants
$token_counter = 0;
$key = $keyword_string;
$keyword_to_bind = $keyword_string;
$answer_null = '';
echo '<br />';
echo 'Key: ';
echo $keyword_to_bind;
echo '<br />';
//Initial category selection
//Note to self, make entries for every word entered by the user, unless a entry already // exists then ignore it.
while ($token != false)
    {
        if ($token === "where")
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
            echo '<br />';
            echo '<br />';
            echo '<br />';
            echo $select_key;
            echo '<br />';
            echo '<br />';
            echo '<br />';
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
                echo '<br />';
                echo $max_keyword_id;
                $max_keyword_id = $max_keyword_id + 1;
                echo '<br />';
                echo $max_keyword_id;
                oci_free_statement($select_insert_stmt);
                // Finds the max value for the Answer table so that I can insert one higher thus again saving me the trouble of writing a hence forth stupid trigger. 
                $select_insert_answer = "select max(answer_id) from answer2";
                $select_insert_answer_stmt = oci_parse($connctn, $select_insert_answer);
                oci_execute($select_insert_answer_stmt);
                oci_commit($connctn);
                oci_fetch($select_insert_answer_stmt);
                $max_answer_id = oci_result($select_insert_answer_stmt, "MAX(ANSWER_ID)");
                echo '<br />';
                echo $max_answer_id;
                $max_answer_id = $max_answer_id + 1;
                echo '<br />';
                echo $max_answer_id;
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
                <h1>This is the first time this has been asked... Could you provide us with an answer? </h1>
                <?php
                
            }
            else
            {
                
                $where_str_search = "select keyword_id from keyword2 where keyword_name = :key and category_id = '0002'";
                $where_str_search_stmt = oci_parse($connctn, $where_str_search);
                oci_bind_by_name($where_str_search_stmt, ":key", $key);
                echo " The Key \n ";
                echo $key;
                oci_execute($where_str_search_stmt);
                oci_commit($connctn);
                oci_fetch($where_str_search_stmt);
                $response = oci_result($where_str_search_stmt, "KEYWORD_ID");
                echo " THE response ";
                echo $response;
                ?>
                <h1> Where Keyword ID <?= $response ?> </h1> 
                <br />
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
                <h1> Where Keyword to answer ID: <?= $k_t_a ?> </h1> <br />
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
                
                if ($answer == '')
                {
                    ?>
                    <h1>We don't seem to have an answer... Could you provide us with an answer? </h1>
                    <?php
                    
                }
                else
                {
                    ?>
                    <h1> Where Answer to question: <?= $answer ?> </h1>
                    <br />
                    <?php
                }
                    oci_free_statement($where_ans_stmt);
            }
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
        }
        elseif ($token === "when")
        {
            echo "This WHEN WORKS";
            $token = false;
            //Does a check to see if a keyword is already entered into the database and if it has it skips inserting another one. Possible revition depedent on time ot allow 3 answers per keyword
            $select_check = "select keyword_id from keyword2 when keyword_name = :keyword_to_bind";
            $select_check_stmt = oci_parse($connctn, $select_check);
            oci_bind_by_name($select_check_stmt, ":keyword_to_bind", $keyword_to_bind);
            oci_execute($select_check_stmt);
            oci_commit($connctn);
            oci_fetch($select_check_stmt);
            $select_key = oci_result($select_check_stmt, "KEYWORD_ID");
            oci_free_statement($select_check_stmt);
            echo '<br />';
            echo '<br />';
            echo '<br />';
            echo $select_key;
            echo '<br />';
            echo '<br />';
            echo '<br />';
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
                echo '<br />';
                echo $max_keyword_id;
                $max_keyword_id = $max_keyword_id + 1;
                echo '<br />';
                echo $max_keyword_id;
                oci_free_statement($select_insert_stmt);
                // Finds the max value for the Answer table so that I can insert one higher thus again saving me the trouble of writing a hence forth stupid trigger. 
                $select_insert_answer = "select max(answer_id) from answer2";
                $select_insert_answer_stmt = oci_parse($connctn, $select_insert_answer);
                oci_execute($select_insert_answer_stmt);
                oci_commit($connctn);
                oci_fetch($select_insert_answer_stmt);
                $max_answer_id = oci_result($select_insert_answer_stmt, "MAX(ANSWER_ID)");
                echo '<br />';
                echo $max_answer_id;
                $max_answer_id = $max_answer_id + 1;
                echo '<br />';
                echo $max_answer_id;
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
                <h1>This is the first time this has been asked... Could you provide us with an answer? </h1>
                <?php
                
            }
            else
            {
                
                $when_str_search = "select keyword_id from keyword2 when keyword_name = :key and category_id = '0003'";
                $when_str_search_stmt = oci_parse($connctn, $when_str_search);
                oci_bind_by_name($when_str_search_stmt, ":key", $key);
                echo " The Key \n ";
                echo $key;
                oci_execute($when_str_search_stmt);
                oci_commit($connctn);
                oci_fetch($when_str_search_stmt);
                $response = oci_result($when_str_search_stmt, "KEYWORD_ID");
                echo " THE response ";
                echo $response;
                ?>
                <h1> when Keyword ID <?= $response ?> </h1> 
                <br />
                  <?php
                oci_free_statement($when_str_search_stmt);
                //******************************
                //This query uses the keyword_has_answer to table to figure out which
                //answer in the table is related to the keyword.
                //******************************
               $when_key_to_ans = "select answer_id 
                                    from keyword_has_answer2
                                    when keyword_id = :k_id";
                $when_key_to_ans_stmt = oci_parse($connctn, $when_key_to_ans);
                oci_bind_by_name($when_key_to_ans_stmt, ":k_id", $response);
                oci_execute($when_key_to_ans_stmt);
                oci_fetch($when_key_to_ans_stmt);
                $k_t_a = oci_result($when_key_to_ans_stmt, "ANSWER_ID");
                ?>
                <h1> when Keyword to answer ID: <?= $k_t_a ?> </h1> <br />
                <?php
                    oci_free_statement($when_key_to_ans_stmt);
                //********************************************
                //This table gets the answer from the previous tables query
                //*********************************************
                $when_ans = "select answer_name from answer2 when answer_id = :k_t_a";
                $when_ans_stmt = oci_parse($connctn, $when_ans);
                oci_bind_by_name($when_ans_stmt, "k_t_a", $k_t_a);
                oci_execute($when_ans_stmt);
                oci_fetch($when_ans_stmt);
                $answer = oci_result($when_ans_stmt, "ANSWER_NAME");
                
                if ($answer == '')
                {
                    ?>
                    <h1>We don't seem to have an answer... Could you provide us with an answer? </h1>
                    <?php
                    
                }
                else
                {
                    ?>
                    <h1> When Answer to question: <?= $answer ?> </h1>
                    <br />
                    <?php
                }
                    oci_free_statement($when_ans_stmt);
            }
            
            
            
            
            
            
            
            
            
            
            
            
            
        }
        elseif ($token === "how")
        {
            echo "This HOW WORKS";
            $token = false;
            
            
            
            
            
            
            
            
            
            
            
        }
        elseif ($token === "why")
        {
            echo "This WHY WORKS";
            $token = false;
            
            //Does a check to see if a keyword is already entered into the database and if it has it skips inserting another one. Possible revition depedent on time ot allow 3 answers per keyword
            $select_check = "select keyword_id from keyword2 why keyword_name = :keyword_to_bind";
            $select_check_stmt = oci_parse($connctn, $select_check);
            oci_bind_by_name($select_check_stmt, ":keyword_to_bind", $keyword_to_bind);
            oci_execute($select_check_stmt);
            oci_commit($connctn);
            oci_fetch($select_check_stmt);
            $select_key = oci_result($select_check_stmt, "KEYWORD_ID");
            oci_free_statement($select_check_stmt);
            echo '<br />';
            echo '<br />';
            echo '<br />';
            echo $select_key;
            echo '<br />';
            echo '<br />';
            echo '<br />';
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
                echo '<br />';
                echo $max_keyword_id;
                $max_keyword_id = $max_keyword_id + 1;
                echo '<br />';
                echo $max_keyword_id;
                oci_free_statement($select_insert_stmt);
                // Finds the max value for the Answer table so that I can insert one higher thus again saving me the trouble of writing a hence forth stupid trigger. 
                $select_insert_answer = "select max(answer_id) from answer2";
                $select_insert_answer_stmt = oci_parse($connctn, $select_insert_answer);
                oci_execute($select_insert_answer_stmt);
                oci_commit($connctn);
                oci_fetch($select_insert_answer_stmt);
                $max_answer_id = oci_result($select_insert_answer_stmt, "MAX(ANSWER_ID)");
                echo '<br />';
                echo $max_answer_id;
                $max_answer_id = $max_answer_id + 1;
                echo '<br />';
                echo $max_answer_id;
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
                <h1>This is the first time this has been asked... Could you provide us with an answer? </h1>
                <?php
                
            }
            else
            {
                
                $why_str_search = "select keyword_id from keyword2 why keyword_name = :key and category_id = '0004'";
                $why_str_search_stmt = oci_parse($connctn, $why_str_search);
                oci_bind_by_name($why_str_search_stmt, ":key", $key);
                echo " The Key \n ";
                echo $key;
                oci_execute($why_str_search_stmt);
                oci_commit($connctn);
                oci_fetch($why_str_search_stmt);
                $response = oci_result($why_str_search_stmt, "KEYWORD_ID");
                echo " THE response ";
                echo $response;
                ?>
                <h1> why Keyword ID <?= $response ?> </h1> 
                <br />
                  <?php
                oci_free_statement($why_str_search_stmt);
                //******************************
                //This query uses the keyword_has_answer to table to figure out which
                //answer in the table is related to the keyword.
                //******************************
               $why_key_to_ans = "select answer_id 
                                    from keyword_has_answer2
                                    why keyword_id = :k_id";
                $why_key_to_ans_stmt = oci_parse($connctn, $why_key_to_ans);
                oci_bind_by_name($why_key_to_ans_stmt, ":k_id", $response);
                oci_execute($why_key_to_ans_stmt);
                oci_fetch($why_key_to_ans_stmt);
                $k_t_a = oci_result($why_key_to_ans_stmt, "ANSWER_ID");
                ?>
                <h1> why Keyword to answer ID: <?= $k_t_a ?> </h1> <br />
                <?php
                    oci_free_statement($why_key_to_ans_stmt);
                //********************************************
                //This table gets the answer from the previous tables query
                //*********************************************
                $why_ans = "select answer_name from answer2 why answer_id = :k_t_a";
                $why_ans_stmt = oci_parse($connctn, $why_ans);
                oci_bind_by_name($why_ans_stmt, "k_t_a", $k_t_a);
                oci_execute($why_ans_stmt);
                oci_fetch($why_ans_stmt);
                $answer = oci_result($why_ans_stmt, "ANSWER_NAME");
                
                if ($answer == '')
                {
                    ?>
                    <h1>We don't seem to have an answer... Could you provide us with an answer? </h1>
                    <?php
                    
                }
                else
                {
                    ?>
                    <h1> why Answer to question: <?= $answer ?> </h1>
                    <br />
                    <?php
                }
                    oci_free_statement($why_ans_stmt);
            }
            
            
            
            
            
            
            
            
            
            
            
        }
        elseif ($token === "what")
        {
            echo "This WHAT WORKS";
            $token = false;
            //Does a check to see if a keyword is already entered into the database and if it has it skips inserting another one. Possible revition depedent on time ot allow 3 answers per keyword
            $select_check = "select keyword_id from keyword2 what keyword_name = :keyword_to_bind";
            $select_check_stmt = oci_parse($connctn, $select_check);
            oci_bind_by_name($select_check_stmt, ":keyword_to_bind", $keyword_to_bind);
            oci_execute($select_check_stmt);
            oci_commit($connctn);
            oci_fetch($select_check_stmt);
            $select_key = oci_result($select_check_stmt, "KEYWORD_ID");
            oci_free_statement($select_check_stmt);
            echo '<br />';
            echo '<br />';
            echo '<br />';
            echo $select_key;
            echo '<br />';
            echo '<br />';
            echo '<br />';
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
                echo '<br />';
                echo $max_keyword_id;
                $max_keyword_id = $max_keyword_id + 1;
                echo '<br />';
                echo $max_keyword_id;
                oci_free_statement($select_insert_stmt);
                // Finds the max value for the Answer table so that I can insert one higher thus again saving me the trouble of writing a hence forth stupid trigger. 
                $select_insert_answer = "select max(answer_id) from answer2";
                $select_insert_answer_stmt = oci_parse($connctn, $select_insert_answer);
                oci_execute($select_insert_answer_stmt);
                oci_commit($connctn);
                oci_fetch($select_insert_answer_stmt);
                $max_answer_id = oci_result($select_insert_answer_stmt, "MAX(ANSWER_ID)");
                echo '<br />';
                echo $max_answer_id;
                $max_answer_id = $max_answer_id + 1;
                echo '<br />';
                echo $max_answer_id;
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
                <h1>This is the first time this has been asked... Could you provide us with an answer? </h1>
                <?php
                
            }
            else
            {
                
                $what_str_search = "select keyword_id from keyword2 what keyword_name = :key and category_id = '0001'";
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
                <h1> what Keyword ID <?= $response ?> </h1> 
                <br />
                  <?php
                oci_free_statement($what_str_search_stmt);
                //******************************
                //This query uses the keyword_has_answer to table to figure out which
                //answer in the table is related to the keyword.
                //******************************
               $what_key_to_ans = "select answer_id 
                                    from keyword_has_answer2
                                    what keyword_id = :k_id";
                $what_key_to_ans_stmt = oci_parse($connctn, $what_key_to_ans);
                oci_bind_by_name($what_key_to_ans_stmt, ":k_id", $response);
                oci_execute($what_key_to_ans_stmt);
                oci_fetch($what_key_to_ans_stmt);
                $k_t_a = oci_result($what_key_to_ans_stmt, "ANSWER_ID");
                ?>
                <h1> what Keyword to answer ID: <?= $k_t_a ?> </h1> <br />
                <?php
                    oci_free_statement($what_key_to_ans_stmt);
                //********************************************
                //This table gets the answer from the previous tables query
                //*********************************************
                $what_ans = "select answer_name from answer2 what answer_id = :k_t_a";
                $what_ans_stmt = oci_parse($connctn, $what_ans);
                oci_bind_by_name($what_ans_stmt, "k_t_a", $k_t_a);
                oci_execute($what_ans_stmt);
                oci_fetch($what_ans_stmt);
                $answer = oci_result($what_ans_stmt, "ANSWER_NAME");
                
                if ($answer == '')
                {
                    ?>
                    <h1>We don't seem to have an answer... Could you provide us with an answer? </h1>
                    <?php
                    
                }
                else
                {
                    ?>
                    <h1> what Answer to question: <?= $answer ?> </h1>
                    <br />
                    <?php
                }
                    oci_free_statement($what_ans_stmt);
            }
            
            
            
            
            
            
            
            
            
            
        }
        elseif ($token === "who")
        {
            echo "This WHO WORKS";
            $token = false;
            
            
            
            
            
            
            
            
        }
        else
        {
            $token_counter++;
            $token = strtok(" ");
        }
    
        if ($token_counter === str_word_count($lower_string))
        {
            echo "A general statement";
            $token = false;
            
            
            
        }
    }
?>
<br />
<?php
date_default_timezone_set("America/Los_Angeles");
echo "The Time is " . date("h:i:sa");
oci_close($connctn);
session_destroy();
?>
