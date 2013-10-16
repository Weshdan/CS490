<html>
	<head>
		<title>Test Maker</title>
	</head>

    <body>
        <div id = "login">
          <form name="form1" form method ="post" action ="">
            <h1 align="center">Create a Test</h1>
                    <p align="center">
                        <u><strong>Choose the appropriate Course Question Bank.</strong></u><br>
                        <br>
                        ***TEAM: I want a function to extract Course names here <br> and auto-populate the drop down menu***
            		</p>
          
                    <p align="center">
                        <label for = "name"> Course: </label>
                        <select>
                            <option value="volvo">Course1</option>
                            <option value="saab">Course2</option>
                            <option value="opel">Course3</option>
                            <option value="audi">Course4</option>
                        </select>
                    </p>
                    
                <hr>
                
                    <p align="center">
                   	<u><strong>Indicate what kind of Test this will be. </strong></u><strong></strong></p>
                    <p align="center"> 
                  
                                    <input type="radio" name="qtype" 
                                           value="mc">
                                Multiple Choice<br>
                                    <input type="radio" name="qtype" 
                                           value="oe">
                                Open Ended
                </p>
                <hr>
                    <p align="center">
                      <input type="submit" id="submit" 
                                value ="Make a Test" 
                                name="Submit" />
            		</p>
          </form>
        </div>
    </body>
</html>