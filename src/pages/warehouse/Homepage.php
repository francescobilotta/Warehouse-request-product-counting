<!DOCTYPE html>
<html lang="it">
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
		$id_oper_loggato=$_GET['id_oper_loggato'];
		
		$username="root";
		$password="basilicagoiano";
		$database="processi";
		$db = mysql_connect("localhost", "root", "basilicagoiano")
		or die("Errore nella connessione MySQL");
		mysql_select_db($database, $db) or die("Database inesistente");
			
			//CHECK SE L'OPERATORE E' DISABILITATO, se si, bisognerà rieffetturare il login
			$query_check_se_operatore_disabilitato = "SELECT ID_oper, disabilitato FROM Operatore WHERE ID_oper = '$id_oper_loggato'";
			$dati_check_se_operatore_disabilitato = mysql_query($query_check_se_operatore_disabilitato);
			$dato = mysql_fetch_assoc($dati_check_se_operatore_disabilitato);
			$check_se_operatore_disabilitato = $dato['id_oper'];
			$check_se_operatore_disabilitato = $dato['disabilitato'];
			if($check_se_operatore_disabilitato == 1){
				$stringa_file_redirect = "'autenticazione_scadenzario.php'";
				$stringa_redirect = '"window.location.href='.$stringa_file_redirect.';"';
				echo "<button id='autenticazione_back_button' class='button' onclick=".$stringa_redirect."> LOG OUT </button>";
				
				exit("L'operatore è stato disabilitato dall'amministratore, riprovare con un altro account.");
			}
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
  </body>
</html>
