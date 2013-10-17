<?php
    session_start();

    
    $username="wgs4";
    $password="dqMuqyd2";
    $server="sql.njit.edu";
    $db="wgs4";
    
    mysql_connect("sql.njit.edu","wgs4","dqMuqyd2") or die ("Could not connect to the server");
    mysql_select_db ("wgs4") or die ("Couldn't connect to the database");
    
    
    //case CheckInDatabase checks to see if the user is in the db and returns the classes they are in and saves that in _SESSION['result']
    switch ($i){
        case default:
            $student=mysql_query("SELECT * FROM Student WHERE SUCID = '".$_SESSION['user']."'")
            $teacher=mysql_query("SELECT * FROM Teacher WHERE TUCID = '".$_SESSION['user']."'")
            
            if(mysql_fetch_array($student)){
                $_SESSION['teacher']=false;
                header("location:http://web.njit.edu/~dc98/CS490/lobby.php");
                
            }else if(mysql_fetch_array($teacher)){
                $_SESSION['teacher']=true;
                header("location:http://web.njit.edu/~dc98/CS490/lobby.php");
            }
            else{
                $_SESSION['response'] = "Your UCID does not exist in the database";
                header("location:http://web.njit.edu/~dc98/CS490/login.php?status=usernotexists");
            }
            
            
            
            unset($_SESSION['query']);
            break;
    }
    ?>
    
 