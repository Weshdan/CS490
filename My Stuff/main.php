<?php
    session_start();
    //1 is true, 0 is false
       
    $username="wgs4";
    $password="dqMuqyd2";
    $server="sql.njit.edu";
    $db="wgs4";
    $qry = $_GET['qry'];
    mysql_connect("sql.njit.edu","wgs4","dqMuqyd2") or die ("Could not connect to the server");
    mysql_select_db ("wgs4") or die ("Couldn't connect to the database");
    
    
    //case CheckInDatabase checks to see if the user is in the db and returns the classes they are in and saves that in _SESSION['result']
    switch ($qry){
        case getCourses:
            $ans = mysql_query("
                               SELECT DISTINCT CourseName
                               FROM Attends, Teaches, Class
                               WHERE (Attends.SUCID = '".$_SESSION['user']."' OR Teaches.TUCID = '".$_SESSION['user']."')
                               AND Attends.CourseID = Class.CourseID AND Teaches.CourseID = Class.CourseID
                               ");

			while($row=mysql_fetch_assoc($ans)){
				echo "<li><a href=\"#\">".$row['CourseName']."</a></li>";
			} 
            break;
            
            
        case insertMCQuestionToBank:
            mysql_query("
                        INSERT INTO Questions (TUCID,CourseID)
                        VALUES ('".$_SESSION['user']."',$CourseID)
                        ");
            
            $QID=mysql_insert_id();
            
            mysql_query("
                        INSERT INTO MC (MCQID,Question)
                        VALUES ($QID,$Question)
                        ");
            
            for($i=0;$i<count($arrOfChoices);$i++){
                if($i==$index)
                    mysql_query("
                                INSERT INTO MC_Options (MCQID,Choice,Correcctness)
                                VALUES ($QID,$arrOfChoices(i),1)
                                ");
                else
                    mysql_query("
                                INSERT INTO MC_Options (MCQID,Choice,Correcctness)
                                VALUES ($QID,$arrOfChoices(i),0)
                                ");
            }
  
            
            break;
            
        case insertOEQuestionToBank:
            mysql_query("
                        INSERT INTO Questions (TUCID,CourseID)
                        VALUES ('".$_SESSION['user']."',$CourseID)
                        ");
            
            $QID=mysql_insert_id();
            
            mysql_query("
                        INSERT INTO OE (OEQID,Question,Answer)
                        VALUES ($QID,$Question,$Answer
                                ");
            
            for($i=0;$i<count($testCaseArr);$i++){
                mysql_query("
                            INSERT INTO OE_Answers (OEQID,TestCase,TestAnswer)
                            VALUES ($QID,$testCaseArr(i),$testAnswerArr(i))
                            ");
            }

            
            break;
            
        case removeQuestionFromBank:
            mysql_query("
                        DELETE FROM Questions
                        WHERE QID='$QID' AND CourseID='$CourseID'
                        ");

            
            break;
            
        case addTest:
            mysql_query("
                        INSET INTO TEST (CourseID, DayDue, DayAvai, TestName, Practice)
                        VALUES ($CourseID, $Due, $Avai, $Name, $Practice)
                        ");
 
            
            break;
            
        case addQuestionToTest:
            mysql_query("
                        INSERT INTO TestQuestions (QID,Points,TID)
                        VALUES ($QID,$Points,$TID)
                        ");
     
            
            break;
            
        case removeQuestionFromTest:
            mysql_query("
                        DELETE FROM TestQuestions
                        WHERE TID=$TID AND QID=$QID
                        ");
   
            
            break;
            
        case getTestForCourse:
            $ans=mysql_query("
                             Select *
                             FROM Test
                             WHERE CourseID=$CourseID
                             ORDER By DayDue ASC");
            $arr=array();
            while($row=mysql_fetch_assoc($ans)){
                $arr[]=$row;
            }
            $_SESSION['result']=arr;
            $tunnel->result();
 
            
            break;
            
        case studentAnswerForQuestion:
            if($Points==-1){
                $realAnswer = mysql_query("
                                          SELECT Choice
                                          FROM MC_Options
                                          WHERE MCQID = $QID AND Correctness = 1");
                
                $maxPoints = mysql_query("
                                         SELECT TestQuestions
                                         WHERE TID=$TID AND QID=$QID");
                
                if($realAnswer==$Answer)
                    $Points = $maxPoints;
                else
                    $Points = 0;
            }
            
            mysql_query("
                        INSERT INTO StudentAnswers (SUCID,TID,QID,Answer,PointsEarned)
                        VALUES ('".$_SESSION['user']."',$TID,$QID,$Answer,$Points
                        ");
            
            $temp = mysql_query("
                                SELECT *
                                FROM Takes
                                WHERE TID=$TID AND SUCID = '".$_SESSION['user']."'
                                ");
            
            $temp_rows = mysql_num_rows($temp);
            
            if($temp_rows!=0){
                $currentMaxPts = mysql_query("
                                             SELECT TotalPoints
                                             FROM Takes
                                             WHERE TID = $TID AND SUCID = '".$_SESSION['user']."'
                                             ");
                $currentPts = mysql_query("
                                          SELECT StudentPoints
                                          FROM Takes
                                          WHERE TID = $TID AND SUCID = '".$_SESSION['user']."'
                                          ");
                $maxPoints = $maxPoints + $currentMaxPts;
                $Points = $Points + currentPts;
            }
            mysql_query("
                        INSERT INTO Takes (TID,SUCID,TotalPoints,StudentPoints)
                        VALUES ($TID,'".$_SESSION['user']."',$maxPoints,$Points
                                ");
            
            
            
            
            break;
            
        case getOETestCases:
            $ans= mysql_query("
                              SELECT TestCase
                              FROM OE_Answers
                              WHERE OEQID = $OEQID
                              ");
            $arr=array();
            while($row=mysql_fetch_assoc($ans)){
                $arr[]=$row;
            }
            $_SESSION['result']=arr;
            $tunnel->result();
            
            
            
            
            break;
            
        case getMCOptions:
            $answers = mysql_query("
                                   SELECT Choice
                                   FROM MC_Options
                                   WHERE MCQID = $MCQID
                                   ");
            $arr = array();
            while($row=mysql_fetch_assoc($result)){
                $arr[]=$row;
            }
            $_SESSION['result']=arr;
            $tunnel->result();
    
            break;
            
        case getMCQuestions:
            $_SESSION['result'] = mysql_query("
                                              SELECT Question
                                              FROM MC
                                              WHERE MCQID = $QID
                                              ");   
            
            break;
            
        case validateUser:
            
            $teacher=mysql_query("
                                 SELECT *
                                 FROM Teacher
                                 WHERE TUCID = '".$_SESSION['user']."'
                                 ");
            $student=mysql_query("
                                 SELECT *
                                 FROM Student
                                 WHERE SUCID = '".$_SESSION['user']."'
                                 ");
            
            if(mysql_fetch_array($teacher)){
			    echo 'Success!';
                $_SESSION['teacher']=true;
				$_SESSION['status'] = 'authorized';
                
            }
            if(mysql_fetch_array($student)){
				echo 'Success!';
                $_SESSION['teacher']=false;
				$_SESSION['status'] = 'authorized';
            } else {
				echo 'Your UCID does not exist in our database';
			}
				
            break;
	    default:
			echo 'Query parse failed';
			break;
    }
    ?>
