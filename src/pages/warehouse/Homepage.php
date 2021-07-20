
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../asset/img/favicon.png">

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
      <link href="../../asset/common.css" rel="stylesheet">
    <!-- Custom styles for this template -->
      <link href="Homepage.css" rel="stylesheet">
    <link href="./res/css/Homepage.css" rel="stylesheet">
  </head>

  
  <body>

    <main role="main" class="container">

    <?php
      $mysqli = new mysqli("localhost","root","basilicagoiano","processi");

      if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
      }
    ?>

    <?php
      $username="root";
      $password="basilicagoiano";
      $database="processi";
      $mysqli = new mysqli("localhost", $username, $password, $database, 3306) or die("Errore nella connessione MySQL");
      echo $mysqli->host_info . "\n";
		?>

      <div class="starter-template">
        <h1>Warehouse</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
      </div>

    </main>

    <!-- Bootstrap core JavaScript | Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    
    <?php
      $mysqli -> close();
    ?>
    </body>
</html>
