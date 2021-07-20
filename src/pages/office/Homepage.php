
<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../assets/img/favicon.png">

    <title>Warehouse counter</title>

    <!-- Bootstrap -->
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- Popper JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Common styles -->
      <link href="../../assets/common.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./res/css/Homepage.css" rel="stylesheet">
  </head>
  <body>

    <main role="main" class="container">

    <?php
      $username="root";
      $password="basilicagoiano";
      $database="processi";
      $mysqli = new mysqli("localhost", $username, $password, $database, 3306) or die("Errore nella connessione MySQL");
      echo $mysqli->host_info . "\n";
    ?>

      <div class="starter-template">
        <h1>Office</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
      </div>

    </main>

    <?php
      $mysqli -> close();
    ?>
  </body>
</html>
