 <!DOCTYPE html>
 <html>

 <head>
     <title>Task-1</title>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 </head>

 <body>

     <?php
    $month_temp = "78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 81, 76, 73,  
					68, 72, 73, 75, 65, 74, 63, 67, 65, 64, 68, 73, 75, 79, 73";  // string of temperatures

    $temp_array = array_map('intval', explode(" ", $month_temp));
    // converting string of temperatures into array of int values
    sort($temp_array);  // sorting the array of temp values
    $temp_array = array_slice($temp_array, 1);  // removing the default 0 index value
    $len = count($temp_array);      // calculate the lenght of temperature array
    $avg = array_sum($temp_array) / $len;   // finding the average
    echo "Average Temperature is : $avg </br>";   // printing the average
    echo "List of seven lowest temperatures : ";  // printing the seven lowest temperatures using for loop below
    for ($i = 0; $i < 7; $i++) {
      if ($i != 6)
        echo "$temp_array[$i], ";
      else
        echo $temp_array[$i];
    }
    echo "</br>List of seven highest temperatures : ";
    // printing the seven highest temperatures using the for loop below
    for ($i = $len - 7; $i < $len; $i++) {
      if ($i != $len - 1)
        echo "$temp_array[$i], ";
      else echo $temp_array[$i];
    }
    ?>
 </body>

 </html>