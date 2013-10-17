<html>
	<head>
		<title>OE Question Maker</title>
	</head>

    <body>
        <div id = "login">
          <form name="form1" form method ="post" action ="">
            <h1 align="center">Create an Open Ended Question</h1>
                    <p align="center">
                        <u><strong>Choose the appropriate Course Question Bank.</strong></u><br>
                        <br>
                        ***TEAM: I want a function to extract Course names here <br> and auto-populate the drop down menu***
            		</p>
          
                    <p align="center">
                        <label for = "name"> Course: </label>
                        <select>
                            <option value="course1">Course1</option>
                            <option value="course2">Course2</option>
                            <option value="course3">Course3</option>
                            <option value="course4">Course4</option>
                           <!-- 
						   	<?php
							$result = mysqli_query(
									"SELECT book FROM book",$con);
							 while($row = mysqli_fetch_array($result))
							 {
							  $choiceselect=$row["book"];
							  echo "<OPTION VALUE=\"$bookselect\">"
							  		.$bookselect.'</option>';
							 }
     						?>
                            -->
                        </select>
                    </p>
                    
                <hr>    
                	<p align = "center">
                     <label for = "tc1"> <strong><u>Test Name:</u></strong><br>
                       <br>
                     </label>
                      <input name="tc1" type="text" id="tc1" />
           	</p>
                <hr>
                
                    <p align = "center">
                                <u><strong>Question:</strong></u><br><br>
                        <textarea name="mcq" id="mcq" rows="5" cols="50" 
                                          placeholder = "Enter a Username">
                                </textarea>
            </p>
            
            <hr>
                
                    <p align = "center">
                                <u><strong>Correct Code:</strong></u><br>
                                <br>
                        <textarea name="mcq" id="mcq" rows="5" cols="50" 
                                          placeholder = "Enter a Username">
                                </textarea>
            </p>
            
            <hr>
                
                    <p align = "center">
            <u><strong>Test Cases:</strong></u></p>
                    <p align = "center">Include ( ) and separate each variable with a comma.<br>
                      <br>
                      <label for = "tc1"> Test Case 1: </label>
                      <input name="tc1" type="text" id="tc1" /> <br>
                      <label for = "tc2"> Test Case 2: </label>
                      <input name="tc2" type="text" id="tc2" /> <br>
                      <label for = "tc3"> Test Case 3: </label>
                      <input name="tc3" type="text" id="tc3" /> <br>
                      <label for = "tc4"> Test Case 4: </label>
                      <input name="tc4" type="text" id="tc4" /> <br>
                    </p>
          
				<hr>
			<p align="center">
              <input type="submit" id="submit" 
                                value ="Save to Question Bank" 
                                name="Submit" />
            		</p>
                    
          </form>
        </div>
    </body>
</html>