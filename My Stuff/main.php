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
    	//returns a list of the course names a person is in
        case getCourses:
            $ans = mysql_query("
                               SELECT DISTINCT CourseName
                               FROM Attends, Teaches, Class
                               WHERE (Attends.SUCID = '".$_SESSION['user']."' OR Teaches.TUCID = '".$_SESSION['user']."')
                               AND Attends.CourseID = Class.CourseID AND Teaches.CourseID = Class.CourseID
                               ");
		$arr = array();
        while($row=mysql_fetch_assoc($ans)){
              $arr[]=$row;
        }
		
		echo json_encode($arr);
			
            break;
         
        //returns a list of all the test information for a given person  (TID,CourseID,Practice,TestName,DueDate,AvailDate)
       	case getTestsForPerson:
        	$ans=mysql_query("
                             Select *
                             FROM Test, Attends,Teaches, Class
                             WHERE (Attends.SUCID = '".$_SESSION['user']."' OR Teaches.TUCID = '".$_SESSION['user']."')
                             AND Attends.CourseID = Class.CourseID AND Teaches.CourseID = Class.CourseID AND Class.CourseID=Test.CourseID
                             ORDER By DayDue ASC");
            $arr=array();
            while($row=mysql_fetch_assoc($ans)){
                $arr[]=$row;
            }
            echo json_encode($arr);
 
            
            break;
    	//inserts MCQ into bank
    	//must know CourseID,Question, and an array of the choices (arrOfChoices) with the correct question being at index 'index'
        case insertMCQuestionToBank:
        	$CourseID = $_POST['CourseID'];
        	$Question = $_POST['Question'];
        	$arrOfChoices = $_POST['arrOfChoices'];
        	$index=$_POST['index'];
            mysql_query("
                        INSERT INTO Questions (TUCID,CourseID)
                        VALUES ('".$_SESSION['user']."','".$CourseID."')
                        ");
            
            $QID=mysql_insert_id();
            
            mysql_query("
                        INSERT INTO MC (MCQID,Question)
                        VALUES ('".$QID."','".$Question."')
                        ");
            
            for($i=0;$i<count($arrOfChoices);$i++){
                if($i==$index)
                    mysql_query("
                                INSERT INTO MC_Options (MCQID,Choice,Correcctness)
                                VALUES ('".$QID."','".$arrOfChoices(i)."',1)
                                ");
                else
                    mysql_query("
                                INSERT INTO MC_Options (MCQID,Choice,Correcctness)
                                VALUES ('".$QID."','".$arrOfChoices(i)."',0)
                                ");
            }
  
            
            break;
        //Insers OEQ into bank
        //must know courseid, question,answer that will be used for testcases,an array of test cases, an array or test case answers    
        case insertOEQuestionToBank:
       		$CourseID = $_POST['CourseID'];
       		$Question = $_POST['Question'];
       		$Answer = $_POST['Answer'];
       		$testCaseArr=$_POST['testCaseArr'];
       		$testAnswerArr=$_POST['testAnswerArr'];       		
            mysql_query("
                        INSERT INTO Questions (TUCID,CourseID)
                        VALUES ('".$_SESSION['user']."','".$CourseID."')
                        ");
            
            $QID=mysql_insert_id();
            
            mysql_query("
                        INSERT INTO OE (OEQID,Question,Answer)
                        VALUES ('".$QID."','".$Question."','".$Answer."')
                        ");
            
            for($i=0;$i<count($testCaseArr);$i++){
                mysql_query("
                            INSERT INTO OE_Answers (OEQID,TestCase,TestAnswer)
                            VALUES ('".$QID."','".$testCaseArr(i)."','".$testAnswerArr(i)."')
                            ");
            }

            
            break;
        //removes question from bank...dont think we are implementing this
        //reuqires courseid and qid    
        case removeQuestionFromBank:
        	$CourseID = $_POST['CourseID'];
			$QID = $_POST['QID'];
            mysql_query("
                        DELETE FROM Questions
                        WHERE QID='".$QID."' AND CourseID='".$CourseID."'
                        ");

            
            break;
        //adds a test
        //need courseid, due date, available date, name of test, and if practice or not(1=practice, 0=real)    
        case addTest:
        	$CourseID = $_POST['CourseID'];
        	$Due = $_POST['Due'];
        	$Avai = $_POST['Avai'];
        	$Name = $_POST['Name'];
        	$Practice = $_POST['Practice'];
            mysql_query("
                        INSET INTO TEST (CourseID, DayDue, DayAvai, TestName, Practice)
                        VALUES ('".$CourseID."', '".$Due."', '".$Avai."', '".$Name."', '".$Practice."')
                        ");
 
            
            break;
        //adds question from bank to test
        //requires qid, tid, and the number of points it is worth on the test    
        case addQuestionToTest:
			$QID = $_POST['QID'];
			$Points = $_POST['Points'];
			$TID = $_POST['TID'];
            mysql_query("
                        INSERT INTO TestQuestions (QID,Points,TID)
                        VALUES ('".$QID."','".$Points."','".$TID."')
                        ");
            break;
        

        //removes a question from the test.  This should only be possible if the test is not live yet...idk if we want this
        //requires TID and QID
        case removeQuestionFromTest:
        	$TID = $_POST['TID'];
        	$QID = $_POST['QID'];
            mysql_query("
                        DELETE FROM TestQuestions
                        WHERE TID='".$TID."' AND QID='".$QID."'
                        ");
   
            
            break;
        
        //gets all the tests for a course (TID,CourseID,Practice,TestName,DueDate,AvailDate)
        //needs courseID
        case getTestForCourse:
        	$CourseID = $_POST['CourseID'];
            $ans=mysql_query("
                             Select *
                             FROM Test
                             WHERE CourseID='".$CourseID."'
                             ORDER By DayDue ASC");
            $arr=array();
            while($row=mysql_fetch_assoc($ans)){
                $arr[]=$row;
            }
            echo json_encode($arr);
 
            
            break;
        
        
        //inserts a students answer and points for a question on a test into the db and updates the students grade for the test
        //needs TID,QID,Answer, and the Points he earned, if it is a MC, Points=-1, if OE, Points are graded by middle
        case InsertStudentAnswerForQuestion:
	        $TID = $_POST['TID'];
	        $QID = $_POST['QID'];
	        $Answer = $_POST['Answer'];
	        $Points = $_POST['Points'];
            if($Points==-1){
                $realAnswer = mysql_query("
                                          SELECT Choice
                                          FROM MC_Options
                                          WHERE MCQID = '".$QID."' AND Correctness = 1");
                
                $maxPoints = mysql_query("
                                         SELECT TestQuestions
                                         WHERE TID='".$TID."' AND QID='".$QID."'
                                         ");
                
                if($realAnswer==$Answer)
                    $Points = $maxPoints;
                else
                    $Points = 0;
            }
            
            mysql_query("
                        INSERT INTO StudentAnswers (SUCID,TID,QID,Answer,PointsEarned)
                        VALUES ('".$_SESSION['user']."','".$TID."','".$QID."','".$Answer."','".$Points."')
                        ");
            
            $temp = mysql_query("
                                SELECT *
                                FROM Takes
                                WHERE TID='".$TID."' AND SUCID = '".$_SESSION['user']."'
                                ");
            
            $temp_rows = mysql_num_rows($temp);
            
            if($temp_rows!=0){
                $currentMaxPts = mysql_query("
                                             SELECT TotalPoints
                                             FROM Takes
                                             WHERE TID = '".$TID."' AND SUCID = '".$_SESSION['user']."'
                                             ");
                $currentPts = mysql_query("
                                          SELECT StudentPoints
                                          FROM Takes
                                          WHERE TID = '".$TID."' AND SUCID = '".$_SESSION['user']."'
                                          ");
                $maxPoints = $maxPoints + $currentMaxPts;
                $Points = $Points + currentPts;
            }
            mysql_query("
                        INSERT INTO Takes (TID,SUCID,TotalPoints,StudentPoints)
                        VALUES ($TID,'".$_SESSION['user']."','".$maxPoints."','".$Points."')
                        ");
            
            
            
            
            break;
        
        
        //Gets the OETestCases for a given question
        //needs QID
        case getOETestCases:
        	$QID = $_POST['QID'];
            $ans= mysql_query("
                              SELECT TestCase
                              FROM OE_Answers
                              WHERE OEQID = '".$QID."'
                              ");
            $arr=array();
            while($row=mysql_fetch_assoc($ans)){
                $arr[]=$row;
            }
            echo json_encode($arr);
            
            
            
            
            break;

		//Gets the MC options for a given question
        //needs QID
        case getMCOptions:
        	$QID = $_POST['QID'];
            $answers = mysql_query("
                                   SELECT Choice
                                   FROM MC_Options
                                   WHERE MCQID = '".$QID."'
                                   ");
            $arr = array();
            while($row=mysql_fetch_assoc($result)){
                $arr[]=$row;
            }
            echo json_encode($arr);
    
            break;
            
            
        //Gets all the MC Questions on a given test
        //needs QID and TID
        case getMCQuestions:
        	$QID = $_POST['QID'];
        	$TID = $_POST['TID'];
            $ans= mysql_query("
								SELECT Question
                                FROM MC
                              	WHERE MCQID = '".$QID."' AND TID='".$TID."'
                              	");   
            $arr=array();
            while($row=mysql_fetch_assoc($ans)){
                $arr[]=$row;
            }
            echo json_encode($arr);
            break;
            
            
        //Gets all the OE Questions on a given test
        //needs QID and TID
        case getMCQuestions:
        	$QID = $_POST['QID'];
        	$TID = $_POST['TID'];
            $ans= mysql_query("
								SELECT Question
                                FROM OE
                              	WHERE OEQID = '".$QID."' AND TID='".$TID."'
                              	");   
            $arr=array();
            while($row=mysql_fetch_assoc($ans)){
                $arr[]=$row;
            }
            echo json_encode($arr);
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
			    echo 'teacher';
                $_SESSION['teacher']=true;
				$_SESSION['status'] = 'authorized';
                
            }
            else if(mysql_fetch_array($student)){
				echo 'student';
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