<html>
	<head>
		<title>Question Maker</title>
	</head>

    <body>
        <div id = "login">
          <form name="form1" form method ="post" action ="">
            <h1 align="center">Create a Question</h1>
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
                
                    <p align="center">
                   	<u><strong>Indicate the type of Question this will be. </strong></u><strong></strong></p>
                    <p align="center"> 
                  
                                    <input type="radio" name="qtype" 
                                           value="mc">
                                Multiple Choice<br>
                                    <input type="radio" name="qtype" 
                                           value="oe">
                                Open Ended
                    </p>
            
                <hr>
                
                    <p align = "center">
                                <u><strong>Type out your Question:</strong></u><br><br>
                        <textarea name="mcq" id="mcq" rows="5" cols="50" 
                                          placeholder = "Enter a Username">
                                </textarea>
            </p>
          
				<hr>
           	<p align="center">
                        ***TEAM: I think I may need a function to first ask how many choices we give and then ask what the answers shoudl be? Otherwise this is just easier.***
                      			<br>
                                <br>
		                <u><strong>Multiple Choice Answers (For MC Only):</strong></u><br>
                        <br>
              <label for = "mca"> Answer Choice 1: </label>
			  <input type="text" 
                               name="mca1" 
                               required 
                               title = "You must write a Choice"
                               placeholder = "Answer Choice 1"/>
                        <br>
                       	<label for = "mca"> Answer Choice 2: </label>
			  <input type="text" 
                               name="mca2" 
                               required 
                               title = "You must write a Choice"
                               placeholder = "Answer Choice 2"/>
                        <br>
                        <label for = "mca"> Answer Choice 3: </label>
      					<input type="text" 
                               name="mca3" 
                               required 
                               title = "You must write a Choice"
                               placeholder = "Answer Choice 3"/>
                        <br>
                        <label for = "mca"> Answer Choice 4: </label>
			  <input type="text" 
                               name="mca4" 
                               required 
                               title = "You must write a Choice"
                               placeholder = "Answer Choice 4"/>
                        <br>
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