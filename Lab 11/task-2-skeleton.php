<!DOCTYPE html>
<html>

<head>
    <title>Task-2</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
    table,
    /* style for table and td markup */
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    td {
        /* adding padding to td */
        padding: 15px;
    }
    </style>
</head>

<body>
    <?php
	echo "<table style='margin: 30px auto'>";	// table starting markup
	for ($row = 1; $row < 7; $row++) {		// total 6 rows from 1-6
		echo "<tr>";	// table row starting
		for ($col = 1; $col < 6; $col++) {		// total 5 columns from 1-5
			echo "<td>$row * $col = " . ($row * $col) . "</td>";	// each column of row
		}
		echo "</tr>";		// table row ending
	}
	echo "</table>"
	?>
</body>

</html>