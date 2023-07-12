SELECT SUM(monto1, monto2, monto3) FROM existencia WHERE id = '90'

<?php
     $query = mysql_query("SELECT SUM(monto1, monto2, monto3) FROM mitabla WHERE id = '90'");
     $resultadototal = mysql_result($query, 0);
    //Ahora tienes la suma en en $resultadototal 
?>