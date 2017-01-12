<?php
// let client's browser know to expect text/csv file attachment
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// connect to database
$conn = mysql_connect('localhost', <username> , <password>);
mysql_select_db(<DBname>);

// create file pointer connected to output stream
$output = fopen('php://output', 'w');

// get table data
$rows = mysql_query('SELECT * FROM Registration');

// get column names
$field = mysql_num_fields($rows);  
for ( $i = 0; $i < $field; $i++ ) 
   $names[] = mysql_field_name( $rows, $i );

// output column names
fputcsv($output, $names);
     
// output table data
while ($row = mysql_fetch_assoc($rows))
    fputcsv($output, $row); // possible to change delimiter/enclosure

// clean up
mysql_close($conn);
fclose($output);
?>
