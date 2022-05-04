<!doctype html>
<html lang="en">
  <head>
    <title>Mapa de Calor</title> 
    <img src="https://ar.ternium.com/media/w5bgrvfz/ternium_logo.jpg " width="250" height="100">
    <header style="text-align: center; font-size:55px; font-family:Abel;">MAPA DE CALOR</header>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css"/>

  </head>
  <body>
        <style>
            @import url(http://fonts.googleapis.com/css?family=Abel);
            .newfont {
            font-family: 'Abel', sans-serif;
            }
            input[type=submit]{
            background-color: Tomato;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
            font-size:20px;
            font-family:'Abel';
            }       
            table{
            border-style:solid;
            border-width:2px;
            border-color:pink;
            width: 70%;
            height: 60px;
            text-align: center;
            background-color: white;
            color: black;
            font-size:20px;
            font-family:'Abel';
            }
            th {
                background-color: tomato;
                color: white;
            }
        </style>
        <h2 style="font-family:Abel; font-size:30px; text-align:center;">Sensores Base de Datos </h2> 
<form name ="formcomp" method ="POST" action="">
<input name="btn_datosComp" type="submit" value="Todos los registros">
<form name ="formidcordhor" method ="POST" action="">
<input name="btn_idcordhor" type="submit" value="Sensor y Lugar">
<form name ="formidppm" method ="POST" action="">
<input name="btn_idppm" type="submit" value="Sensor y PPM">
</form>

<?php 
$conn=new mysqli("localhost","root","","ternium");

    if($conn){
        if (isset($_POST["btn_datosComp"])){   
        $sql="SELECT * FROM sensor";  

        $result=mysqli_query($conn,$sql); 
        echo "<table border='1'>
        <tr>
        <th>ID Sensor</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Coordenadas X</th>
        <th>Coordenadas Y</th>
        <th>PPM</th>
        </tr>";
        
        while($row = mysqli_fetch_array($result))
        
          {
          echo "<tr>";
          echo "<td>" . $row['idSensor'] . "</td>";
          echo "<td>" . $row['fechaSensor'] . "</td>";
          echo "<td>" . $row['horaSensor'] . "</td>";
          echo "<td>" . $row['coordenadasXSensor'] . "</td>";
          echo "<td>" . $row['coordenadasYSensor'] . "</td>";
          echo "<td>" . $row['PPM'] . "</td>";
          echo "</tr>";
          }
        
        echo "</table>";
        }

        if (isset($_POST["btn_idcordhor"])){   
            $sql="SELECT * FROM sensor";  
    
            $result=mysqli_query($conn,$sql); 
            echo "<table border='1'>
            <tr>
            <th>ID Sensor </th>
            <th> Hora </th>
            <th> Coordenadas X </th>
            <th> Coordenadas Y </th>
            </tr>";
            
            while($row = mysqli_fetch_array($result))
            
              {
              echo "<tr>";
              echo "<td>" . $row['idSensor'] . "</td>";
              echo "<td>" . $row['horaSensor'] . "</td>";
              echo "<td>" . $row['coordenadasXSensor'] . "</td>";
              echo "<td>" . $row['coordenadasYSensor'] . "</td>";
              echo "</tr>";
              }
            
            echo "</table>";
            }
            if (isset($_POST["btn_idppm"])){   
                $sql="SELECT * FROM sensor";  
        
                $result=mysqli_query($conn,$sql); 
                echo "<table border='1'>
                <tr>
                <th>ID Sensor</th>
                <th>PPM</th>
                </tr>"
                ;

                while($row = mysqli_fetch_array($result))
                
                  {
                  echo "<tr>";
                  echo "<td>" . $row['idSensor'] . "</td>";
                  echo "<td>" . $row['PPM'] . "</td>";
                  echo "</tr>";
                  }
                
                echo "</table>";
                }
    }
        mysqli_close($conn);

        ?>
    <h3 style="font-family:Abel; font-size:30px; text-align:center;">Graficas<h3>
  <div class="col-lg-12" style="padding-top:10px;">
    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary" onclick="CargarGraficosBar()" style="background-color: Tomato; border: none; color: white; padding: 16px 32px; text-decoration: none; margin: 4px 2px; cursor: pointer; font-size:20px; font-family:'Abel';">PPM por Sensor</button>
        </div>
        <canvas id="myChart" width="30" height="10"></canvas>
    </div>
    </div>      

  </body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
    function CargarGraficosBar(){
        $.ajax({
            url:'controlador_grafico.php',
            type: 'POST'
        }).done(function(resp){
            var titulo = [];
            var cantidad = [];
            var data = JSON.parse(resp);
            for (var i=0; i < data.length ; i++){
                titulo.push(data[i][0]);
                cantidad.push(data[i][5])
            }
                var ctx = document.getElementById('myChart');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: titulo,
                        datasets: [{
                            label: 'PPM por Sensor',
                            data: cantidad,
                            backgroundColor: [
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 159, 64, 0.2)'                                
                            ],
                            borderColor: [
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
        })
    }
    
</script>    