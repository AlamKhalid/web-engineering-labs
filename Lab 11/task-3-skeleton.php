<!DOCTYPE html>
<html>

<head>
    <title>Task-3</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
    <h3 style="text-align: center">Chess Board - PHP Nested Loops</h3>

    <?php
  $colors = array("black", "white");    // introducing the colors for chess board as array
  echo "<table style='margin: 20px auto; border: 1px solid gray; padding: 0'>";
  // writing the table opening markup
  for ($row = 0; $row < 8; $row++) {
    echo "<tr>";  // start of table row markup inside table
    $num = $row % 2 == 0 ? 0 : 1;   // starting color for a particular row
    for ($col = 0; $col < 8; $col++) {
      echo "<td width='60px' height='60px' bgcolor='$colors[$num]'></td>";  // the chess one square
      $num = $num == 0 ? 1 : 0; // change the color for next column accordingly
    }
    echo "</tr>"; // end of table row markup
  }
  echo "</table>";  // end of table markup

  ?>
    </table>
</body>

</html>