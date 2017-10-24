<?php
		
		
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbName = "skala";

		$conn = new mysqli($servername, $username, $password, $dbName);
		//checking if there were any error during the last connection attempt
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		//the SQL query to be executed
		
		if (!isset($_GET) || empty($_GET))
		{
		    $query = "SELECT COUNT(User_Id) AS total, SUM(Pred='dropout') AS dropout, Batch from drop_pre GROUP BY Batch";
		}
		else

		{
		$iname=$_GET['Institute'];
		$query = "SELECT COUNT(Drop_Count) AS total,SUM(Drop_Count)  AS dropout, batch from dropout_dashboard  where Institute='$iname' GROUP BY batch ";
		
		}
		
		$result = $conn->query($query);
		
		//initialize the array to store the processed data
		$jsonArray = array();
		

		//check if there is any data returned by the SQL Query
		if ($result->num_rows > 0) {
		  //Converting the results into an associative array
		  while($row = $result->fetch_assoc()) {
		    $jsonArrayItem = array();
		    $jsonArrayItem['Batch'] = $row['Batch'];
		    $jsonArrayItem['total'] = $row['total'];
		    $jsonArrayItem['dropout'] = $row['dropout'];
		    

		    //append the above created object into the main array.
		    array_push($jsonArray, $jsonArrayItem);
		  }
		}

		

		//Closing the connection to DB
		$conn->close();
		//set the response content type as JSON
		header('Content-type: application/json');
		//output the return value of json encode using the echo function. 
	
		//$result3 = array_merge($jsonArray,$jsonArray2);
		/*usort($array,
        function($jsonArray, $jsonArray2) { return $jsonArray['date_created'] - $jsonArray2['date_created']; });*/

		echo json_encode($jsonArray);
	?>
