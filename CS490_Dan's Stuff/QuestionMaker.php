<html>
	<head>
		<title>Question Maker</title>
	</head>

    <body>
        <div id = "login">
          <form name="form1" form method ="post" action ="">
            <h1 align="center">Create a Question</h1>
                    <p align="center">
                        Choose the appropriate Course Question Bank
                    </p>
          
                    <p align="center">
                        <label for = "name"> Course: </label>
                        <select>
                            <option value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option value="opel">Opel</option>
                            <option value="audi">Audi</option>
                        </select>
                    </p>
                <hr>
                    <p align = "center">
                        Comments:
                        <textarea name="mcq" id="mcq" rows="5" cols="50" 
                        		  placeholder = "Enter a Username">
                        </textarea><br />
            		</p>
          
                    <p align="center">
                        <input type="submit" id="submit" 
                        value ="Save to Question Bank" name="Submit" />
                    </p>
          </form>
        </div>
    </body>
</html>