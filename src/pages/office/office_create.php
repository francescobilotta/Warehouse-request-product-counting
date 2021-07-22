
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="../../assets/img/favicon.png">

        <title>Warehouse counter</title>
        <!-- Bootstrap -->

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>


        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>




        <!-- Common styles -->
        <link href="../../assets/css/common.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="./res/css/office_create.css" rel="stylesheet">
    </head>
    <body>

    <main role="main" class="container">

        <?php
            $host="portale";
            $username="root";
            $password="basilicagoiano";
            $database="testing";
            $connection = new mysqli($host, $username, $password, $database, 3306) or die("Errore nella connessione MySQL");
        ?>

        <div class="header">
            <h1>Request creation</h1>
        </div>

        <div class="sub-header">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="filters" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filters
            </button>
            <div class="dropdown-menu" aria-labelledby="filters">
                <a class="dropdown-item" href="#">Most Recent</a>
                <a class="dropdown-item" href="#">Oldest</a>
                <a class="dropdown-item" href="#">Upcoming due date</a>

                <a class="dropdown-item" href="#">
                    <label class="form-check-label" for="flexCheckChecked">
                        <input class="" type="checkbox" value="showClosed" id="flexCheckChecked">
                        Show closed
                    </label>
                </a>
            </div>
            <button type="button" class="btn btn-primary">Add Request</button>
        </div>
        <div class="request-table">
            
        </div>

    </main>

    <?php
      $connection -> close();
    ?>
  </body>
</html>
