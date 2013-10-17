<html>
	<head>
		<title>Question Maker</title>
	</head>

    <body>
        <div id = "login">
          <form name="form1" form method ="post" action ="">
            <h1 align="center">Question Bank</h1>
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
                        
                         <?php
								//If You aren't authorized, we send you back to the login page
								//This is to ensure that you don't just directly link to this url.
								if($_SESSION['status'] !='authorized') 
								{
									header("location: login.php");
								}
								else
								//if(isset($_SESSION['user'])) 
								{
									//If result exists, meaning we have acquired SQL info, 
									//otherwise Query to retrieve classes.
									if(isset($_SESSION['result']))
									{		
										$counter = count ($_SESSION['result'] );
	
										for ($x=0; $x<$counter; $x++)
										{
											//echo "<b>Course Name:</b> ".$_SESSION['result'][$x][0]."<br>";
											echo "<a href=\"#\">".$_SESSION['result'][$x][0]."</a>";
											echo "<option value=\"course".($y=$x+1)."\">"
												 .$_SESSION['result'][$x][0]."Course1</option>";
										} 
											
										//unset($_SESSION['status']);	
									} 
									else 
									{	
										$_SESSION['query'] = "getCourses";
									
										header("location:http://web.njit.edu/~sam53/tunnel.php");
									}
								} 
							?>   
                        </select>
                    </p>
                <hr>
           	<p align="center">
                        ***TEAM: I think I may need a function to first ask how many choices we give and then ask what the answers shoudl be? Otherwise this is just easier.***
                      			<br>
                                <br>
		                <u><strong>Answer Choices:</strong></u><br>
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