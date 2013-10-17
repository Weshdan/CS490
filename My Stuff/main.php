<?php
require_once 'http://web.njit.edu/~sam53/tunnel.php';

    
    $username="wgs4";
    $password="dqMuqyd2";
    $server="sql.njit.edu";
    $db="wgs4";
    
    mysqli_connect($server,$username,$password) or die ("Could not connect to the server");
    mysql_select_db ($db) or die ("Couldn't connect to the database");
    
    
    
    //case 0 checks to see if the user is in the db
    switch ($i){
        case checkInDatabase:
            $student=mysql_query("SELECT * FROM Student WHERE SUCID = '".$_SESSION['user']."'")
            $rows_student = mysql_num_rows($student);
            $teacher=mysql_query("SELECT * FROM Teacher WHERE TUCID = '".$_SESSION['user']."'")
            $rows_teacher = mysql_num_rows($teacher);
            
            if($rows_student==1 OR $rows_teacher==1){
                $ans = mysql_query("SELECT DISTINCT CourseName FROM Attends, Teaches, Class WHERE (Attends.SUCID = '"._SESSION['user']."' OR Teaches.TUCID = '"._SESSION['user']."') AND Attends.CourseID = Class.CourseID AND Teaches.CourseID = Class.CourseID");
                $arr = array();
                while($row=mysql_fetch_assoc($ans)){
                    $arr[]=$row
                }
                _SESSION['result']=arr;
            }
                
            
            if($rows_student==1){
                while ($row = mysql_fetch_array($result)) {
                    $array[] = $row;
                }
                $_SESSION['teacher']=false;
                header("location:http://web.njit.edu/~dc98/CS490/lobby.php");
                break;
                
            }else if($rows_teacher==1){
                $_SESSION['teacher']=true;
                header("location:http://web.njit.edu/~dc98/CS490/lobby.php");
                break;
            }
            
            $_SESSION['response'] = "Your UCID does not exist in the database";
            header("location:http://web.njit.edu/~dc98/CS490/login.php?status=usernotexists");
            
            break;
            
            
        case getCourses:
            $ans = mysql_query("SELECT DISTINCT CourseName FROM Attends, Teaches, Class WHERE (Attends.SUCID = '"._SESSION['user']."' OR Teaches.TUCID = '"._SESSION['user']."') AND Attends.CourseID = Class.CourseID AND Teaches.CourseID = Class.CourseID");
            $arr = array();
            while($row=mysql_fetch_assoc($ans)){
                $arr[]=$row
            }
            _SESSION['result']=arr;
            $tunnel->result();
            break;
            
            
        case insertMCQuestionToBank:
            mysql_query("INSERT INTO Questions (TUCID,CourseID) VALUES ('".$_SESSION['user']."',$CourseID)");
            
            $QID=mysql_insert_id();
            
            mysql_query("INSERT INTO MC (MCQID,Question) VALUES ($QID,$Question");
            
            for($i=0;$i<count($arrOfChoices);$i++){
                if($i==$index)
                    mysql_query("INSERT INTO MC_Options (MCQID,Choice,Correcctness) VALUES ($QID,$arrOfChoices(i),1)");
                else
                    mysql_query("INSERT INTO MC_Options (MCQID,Choice,Correcctness) VALUES ($QID,$arrOfChoices(i),0)");
            }
            break;
            
        case insertOEQuestionToBank:
            mysql_query("INSERT INTO Questions (TUCID,CourseID) VALUES ('".$_SESSION['user']."',$CourseID)");
            
            $QID=mysql_insert_id();
            
            mysql_query("INSERT INTO OE (OEQID,Question,Answer) VALUES ($QID,$Question,$Answer");
            
            for($i=0;$i<count($testCaseArr);$i++){
                mysql_query("INSERT INTO OE_Answers (OEQID,TestCase,TestAnswer) VALUES ($QID,$testCaseArr(i),$testAnswerArr(i))");
            }
            break;
            
        case removeQuestionFromBank:
            mysql_query("DELETE FROM Questions WHERE QID='$QID' AND CourseID='$CourseID'");
            break;
            
        case addTest:
            mysql_query("INSET INTO TEST (CourseID, DayDue, DayAvai, TestName, Practice) VALUES ($CourseID, $Due, $Avai, $Name, $Practice)");
            break;
            
        case addQuestionToTest:
            mysql_query("INSERT INTO TestQuestions (QID,Points,TID) VALUES ($QID,$Points,$TID)");
            break;
            
        case removeQuestionFromTest:
            mysql_query("DELETE FROM TestQuestions WHERE TID=$TID AND QID=$QID");
            break;
            
        case getTestForCourse:
            $ans=mysql_query("Select * FROM Test WHERE CourseID=$CourseID ORDER By DayDue ASC");
            arr=array();
            while($row=mysql_fetch_assoc($ans)){
                $arr[]=$row
            }
            _SESSION['result']=arr;
            $tunnel->result();
            break;
            
        case studentAnswerForQuestion:
            if($Points==-1){
                $realAnswer = mysql_query("SELECT Choice FROM MC_Options WHERE MCQID = $QID AND Correctness = 1");
                
                $maxPoints = mysql_query("SELECT TestQuestions WHERE TID=$TID AND QID=$QID");
                
                if($realAnswer==$Answer)
                    $Points = $maxPoints;
                else
                    $Points = 0;
            }
            
            mysql_query("INSERT INTO StudentAnswers (SUCID,TID,QID,Answer,PointsEarned) VALUES ('".$_SESSION['user']."',$TID,$QID,$Answer,$Points");
            
            $temp = mysql_query("SELECT * FROM Takes WHERE TID=$TID AND SUCID = '"._SESSION['user']."'");
            
            $temp_rows = mysql_num_rows($temp);
            
            if($temp_rows!=0){
                $currentMaxPts = mysql_query("SELECT TotalPoints FROM Takes WHERE TID = $TID AND SUCID = '"._SESSION['user']."'")
                $currentPts = mysql_query("SELECT StudentPoints FROM Takes WHERE TID = $TID AND SUCID = '"._SESSION['user']."'")
                $maxPoints = $maxPoints + $currentMaxPts;
                $Points = $Points + currentPts;
            }
            mysql_query("INSERT INTO Takes (TID,SUCID,TotalPoints,StudentPoints) VALUES ($TID,'"._SESSION['user']."',$maxPoints,$Points");
            break;
            
        case getOETestCases:
            $ans= mysql_query("SELECT TestCase FROM OE_Answers WHERE OEQID = $OEQID");
            arr=array();
            while($row=mysql_fetch_assoc($ans)){
                $arr[]=$row
            }
            $_SESSION['result']=arr;
            $tunnel->result();
            break;
            
        case getMCOptions:
            $answers = mysql_query("SELECT Choice FROM MC_Options WHERE MCQID = $MCQID");
            $arr = array();
            while($row=mysql_fetch_assoc($result)){
                $arr[]=$row
            }
            $_SESSION['result']=arr;
            $tunnel->result();
            break;
            
        case getMCQuestions:
            _SESSION['result'] = mysql_query("SELECT Question FROM MC WHERE MCQID = $QID");
            break;
            
    }
    /*
    class main{
        
        //1 is true, 0 is false
        
        

        //Returns a list of the class names that the teacher/student is in
        
        function getCourses(){
            
        }
        
        //Inserts mc questions into Questions, MC, and MC Questions
        
        function insertMCQuestionToBank($TUCID,$CourseID,$Question,$arrOfChoices,$indexOfCorrect){
           
            
        }
        
        //Inserts oe questions into Questions, OE, and OE_Answers
        
        function insertOEQuestionToBank($TUCID,$CourseID,$Question,$Answer,$testCaseArr, $testAnswerArr){
           
        }
        
        //Removes questions from Questions
        
        function removeQuestionFromBank($QID, $CourseID){
        }
        
        //Adds a test into Test
        
        function addTest($CourseID, $Due, $Avai, $Name, $Practice){
        }
        
        //Removes a test from Test
        
        function removeTest($TID){
        }
        
        //Adds a question to TestQuestions
         
        function addQuestionToTest($QID,$TID,$Points){
        }
        
        //Removes a question from TestQuestions
        
        function removeQuestionFromTest($TID, $QID){
        }
        
        //Returns a list of tests for a course from Test 
        
        function getTestForCourse($CourseID){
            
        }
        
        //Adds the students answer and point value into StudentAnswer
        //Updates or starts a Test entry for a student and a test
        
        function studentAnswerForQuestion($TID,$QID,$Answer,$Points=-1){
            
        }
        
        //Returns the test cases for OE questions
        
        function getOETestCases($OEQID){
            
        }
        
        //returns the test case answers for OE questions
        
        function getOETestAnswers($OEQID){
            
        }

        function getMCOptions($QID){
            
        }
        
        function getMCQuestions($QID){
            
        }
    }