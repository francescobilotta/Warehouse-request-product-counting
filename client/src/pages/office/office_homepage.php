
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
        <link href="./res/css/office_homepage.css" rel="stylesheet">
    </head>
    <body>

    <main role="main" class="container">

        <?php
            /* Connection */
            $host="portale";
            $username="root";
            $password="basilicagoiano";
            $database="testing";
            $connection = new mysqli($host, $username, $password, $database, 3306) or die("Errore nella connessione MySQL");
        ?>

        <div class="header">
            <h1>Office</h1>
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
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>MODIFY</th>
                        <th>STATUS</th>
                        <th>PRODUCT</th>
                        <th>FLAVOUR</th>
                        <th>NOTES</th>
                        <th>REQUEST DATE</th>
                        <th>DUE DATE</th>
                        <th>CLOSED DATE</th>
                        <th>LAST COUNT</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        /* Table creation */
                        $queryGetRequests = "SELECT requestId, productCode, productName, productFlavour, notes, requestDate, dueDate, requestState, isClosed, expectedCount, previousCount, lastCount, terminationDate, expectedGroundCount FROM Request ORDER BY requestId";
                        $results = mysqli_query($connection, $queryGetRequests);
                        $rowcount = mysqli_num_rows($results);
                        $i = 0; 
                        while ($i < $rowcount) {
                            $row = mysqli_fetch_row($results);
                            $requestId = $row[0];
                            $productCode = $row[1];
                            $productName = $row[2];
                            $productFlavour = $row[3];
                            $requestNotes = $row[4];
                            $requestCreationDate = $row[5];
                            $requestDueDate = $row[6];
                            $requestState = $row[7];
                            $requestIsClosed = $row[8];
                            $requestExpectedCount = $row[9];
                            $requestPreviousCount = $row[10];
                            $requestLastCount = $row[11];
                            $requestTerminationDate = $row[12];
                            $expectedGroundCount = $row[13];
                    ?>

                    <tr>
                        <td>
                            <a type="button" class="btn btn-default" aria-label="Left Align" href='office_update.php?requestId=<?php echo $requestId;?>'>
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                        </td>
                        <td> <?php echo $requestState;?> </td>
                        <td> <?php echo $productName;?> </td>
                        <td> <?php echo $productFlavour;?> </td>
                        <td> <?php echo $requestNotes;?> </td>
                        <td> <?php echo $requestCreationDate;?> </td>
                        <td> <?php echo $requestDueDate;?> </td>
                        <td> <?php echo $requestTerminationDate;?> </td>
                        <td> <?php echo $requestLastCount;?> </td>
                    </tr>

                    <?php 
                        $i++;
                        }
                    ?> 
                </tbody>
            </table>
        </div>

    </main>

    <?php
      $connection -> close();
    ?>
  </body>
</html>
