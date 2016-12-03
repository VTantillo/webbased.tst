<?php
      $hn="earth.cs.utep.edu";
      $un="cs5339team2fa16";
      $db="wb_longpre";
      $pw="cs5339!cs5339team2fa16";

      $connection = mysql_connect($hn, $un, $pw);
        if(!$connection){
          die('Could not connect: '. mysql_error());
        }
      mysql_select_db($db, $connection);
      $query  = "SELECT * FROM csdegrees";
      $result = mysql_query($query, $connection);
      echo "
      <html><head>
      <title>Profile List</title>
      </head>
      <style>
      th {
        font-family: arial;
        background-color: #ff7400;
        color: white;
        text-align: left;
        padding: 8px;
      }
      table{
        border-collapse: collapse;
        width: 100%;
      }

      td {
        font-family: arial;
        padding: 5px;
      }

      </style>
      <body>
      <table border=\"2\" style= \"  margin: 0 auto;\" >
      <thead>
        <tr>
          <th>Name</th>
          <th>Academic Year</th>
          <th>Major</th>
        </tr>
      </thead>
      <tbody>";
      if($result){
      while( $row = mysql_fetch_assoc( $result ) ){
            echo
            "<tr>
              <td>".$row['FirstName']." ".$row['LastName']."</td>
              <td>".$row['AcademicYear']."</td>
              <td>".$row['Major']."</td>
            </tr>\n";
          }
        }
      echo "</tbody>
    </table></body>
    </html>";
    mysql_close($connection);
?>   
    