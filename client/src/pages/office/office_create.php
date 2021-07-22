
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
        <div class="request-form">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

            <form class="form" role="form">
                <div class="row">
                    <label class="col-2 col-form-label">Request IDs</label>
                    <div class="form-group col no-gutters">
                        <label class="col-12 col-form-label" for="req_id">Request Id</label>
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-hashtag"></i></div>
                                </div>
                                <input id="req_id" name="req_id" type="text" class="form-control" aria-describedby="req_idHelpBlock" required="required" readonly>
                            </div>
                            <span id="req_idHelpBlock" class="form-text text-muted">Automatically generated request id</span>
                        </div>
                    </div>
                    <div class="form-group col no-gutters">
                        <label class="col-12 col-form-label" for="prod_code">Product Code</label>
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-tag"></i></div>
                                </div>
                                <input id="prod_code" name="prod_code" type="text" class="form-control" aria-describedby="prod_codeHelpBlock" required="required" readonly>
                            </div>
                            <span id="prod_codeHelpBlock" class="form-text text-muted">Automatically generated product code</span>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <label class="col-2 col-form-label">Counts</label>
                    <div class="form-group col no-gutters">
                        <label for="prod" class="col-2 col-form-label">Product</label>
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-archive"></i>
                                    </div>
                                </div>
                                <input id="prod" name="prod" type="text" class="form-control" aria-describedby="prodHelpBlock" required="required">
                            </div>
                            <span id="prodHelpBlock" class="form-text text-muted">Insert a product name in the field and select the corresponding one</span>
                        </div>
                    </div>
                    <div class="form-group col no-gutters">
                        <label class="col-2">Flavour</label>
                        <div class="col-12">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="flavour" id="flavour_0" type="radio" aria-describedby="flavourHelpBlock" required="required" class="custom-control-input" value="red">
                                <label for="flavour_0" class="custom-control-label">red</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="flavour" id="flavour_1" type="radio" aria-describedby="flavourHelpBlock" required="required" class="custom-control-input" value="blue">
                                <label for="flavour_1" class="custom-control-label">blue</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="flavour" id="flavour_2" type="radio" aria-describedby="flavourHelpBlock" required="required" class="custom-control-input" value="green">
                                <label for="flavour_2" class="custom-control-label">green</label>
                            </div>
                            <span id="flavourHelpBlock" class="form-text text-muted">Select the flavour of the product</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="notes" class="col-2 col-form-label">Notes</label>
                    <div class="col-10">
                        <textarea id="notes" name="notes" cols="40" rows="5" class="form-control" aria-describedby="notesHelpBlock"></textarea>
                        <span id="notesHelpBlock" class="form-text text-muted">Add notes to this request</span>
                    </div>
                </div>
                <div class="form-group row">
                    <input hidden id="date_creation" name="date_creation" type="text" aria-describedby="date_creationHelpBlock" required="required" class="form-control" readonly>
                </div>
                <div class="form-group row">
                    <label for="date_due" class="col-2 col-form-label">Due Date</label>
                    <div class="col-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                            <input id="date_due" name="date_due" type="date" class="form-control" aria-describedby="date_dueHelpBlock" required="required">
                        </div>
                        <span id="date_dueHelpBlock" class="form-text text-muted">Date before which the counting should be completed</span>
                    </div>
                </div>
                <div class="form-group row">
                    <input hidden id="status" name="status" type="text" class="form-control" aria-describedby="statusHelpBlock" required="required" readonly>
                </div>

                <div class="row">
                    <label class="col-2 col-form-label">Counts</label>
                    <div class="form-group col no-gutters">
                        <label for="count_previous" class="col-2 col-form-label">Previous Count</label>
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-bar-chart-o"></i>
                                    </div>
                                </div>
                                <input id="count_previous" name="count_previous" type="text" class="form-control" aria-describedby="count_previousHelpBlock" readonly>
                            </div>
                            <span id="count_previousHelpBlock" class="form-text text-muted">Automatically generated previous count</span>
                        </div>
                    </div>
                    <div class="form-group col no-gutters">
                        <label for="count_last" class="col-2 col-form-label">Last Count</label>
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-refresh"></i>
                                    </div>
                                </div>
                                <input id="count_last" name="count_last" type="text" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row col-12 justify-content-center">
                        <button name="submit" type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>

    </main>

    <?php
      $connection -> close();
    ?>
  </body>
</html>
