<?php
      // 1. Conectar con la BD
      $servername = "localhost";
      $database = "covid-analytics-grupo6-api-laravel";
      $username = "test";
      $password = "password";

      // Create connection
      $conn = mysqli_connect($servername, $username, $password, $database);

      // Check connection
      if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
      }

      echo "Connected successfully \n";
      // Fin conectar con la BD
      
      // 1. Sacar datos de la tabla datas

      $query_para_sacar_datos_de_la_tabla_datas = "SELECT * FROM datas";
      
      $result = mysqli_query($conn, $query_para_sacar_datos_de_la_tabla_datas);

      // 2. inertar los datos por filas en la tabla entries
      if($result){
            while($row = mysqli_fetch_assoc($result)){
                  echo "\n";
                  $query_para_sacar_datos_id_countries = 'SELECT id FROM countries WHERE countriesAndterritories ="' .$row["countriesAndTerritories"].'";';
                  $result1 = mysqli_query($conn, $query_para_sacar_datos_id_countries);
                  $country_id = mysqli_fetch_assoc($result1)['id'];
                  $dateRep = $row['dateRep'];
                  $day = $row['day'];
                  $month = $row['month'];
                  $year = $row['year'];
                  $cases = $row['cases'];
                  $deaths = $row['deaths'];
                  $Acumulative_number_for_14_days_of_COVID = $row['Acumulative_number_for_14_days_of_COVID'];
                  $query_insertar_en_entries = "INSERT INTO entries (country_id, dateRep, day, month, year, cases, deaths, Acumulative_number_for_14_days_of_COVID) VALUES (".$country_id.", '".$dateRep."', ".$day.", ".$month.", ".$year.", ".$cases.", ".$deaths.", ".$Acumulative_number_for_14_days_of_COVID.");";
                  print_r($query_insertar_en_entries);
                  
                  mysqli_query($conn, $query_insertar_en_entries);
                  
            }
      }
      
      // cerrar la conx
      mysqli_close($conn);
?>
