<?php
    require 'config.php';
    $query = "SELECT DISTINCT Institute from drop_pre where Institute IS NOT NULL";
    $result = $conn->query($query);
?>

<html>
<head>
<title>Line chart</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Institute performance analysis" />
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <script type="text/javascript">
   google.charts.load('current', {'packages':['bar']});
   google.charts.setOnLoadCallback(drawChart);  
   </script>
</head>



<body>

  <select id="dropdown">
            <?php
                while($row=mysqli_fetch_array( $result)) {
                  echo "<option value=".$row['Institute'].">";
                  echo $row['Institute'];
                   echo "</option>";                
                  }
                

            ?>
</select>
  <script src="pre_dropbatch.js"></script>
	<div id="columnchart_material"></div>
</body>

</html>



