<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albertone Store</title>
    <link type="image/png" sizes="16x16" rel="icon" href="assets/icon/icon_java-16.png">
    <link type="image/png" sizes="32x32" rel="icon" href="assets/icon/icon_java-32.png">
    <link type="image/png" sizes="96x96" rel="icon" href="assets/icon/icon_java-96.png">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet" />

</head>

<body style="background-color: #EA3546;">
    <div class="container mt-4">
        <div class="card">
            <div class="row">
                <h1 class="text-center mt-5 px-5">DASHBOARD D'AMMINISTRAZIONE</h1>
                <h5 class="text-center mt-3 px-5">ALBERTONE STORE</h5>
            </div>
            <hr class="mx-5">
            <div class="row justify-content-center gap-3 mx-5 my-3">
                <span class="text-center px-5"><b>SELECT / UPDATE / REMOVE</b></span>
                <a class="btn btn-outline-info col-lg-2" href="page/print.php?function_print=cliente">CLIENTI</a>
                <a class="btn btn-outline-info col-lg-2" href="page/print.php?function_print=fattura">FATTURE</a>
                <a class="btn btn-outline-info col-lg-2" href="page/print.php?function_print=prodotto">PRODOTTI</a>
                <a class="btn btn-outline-info col-lg-2" href="page/print.php?function_print=fornitore">FORNITORI</a>
            </div>
            <hr class="mx-5">
            <div class="row justify-content-center gap-3 mx-5 my-3 mb-5">
                <span class="text-center px-5"><b>INSERT INTO</b></span>
                <a class="btn btn-outline-success col-lg-2" href="page/insert.php?function_add=cliente">AGGIUNGI CLIENTE</a>
                <a class="btn btn-outline-success col-lg-2" href="page/insert.php?function_add=fattura">AGGIUNGI FATTURA</a>
                <a class="btn btn-outline-success col-lg-2" href="page/insert.php?function_add=prodotto">AGGIUNGI PRODOTTO</a>
                <a class="btn btn-outline-success col-lg-2" href="page/insert.php?function_add=fornitore">AGGIUNGI FORNITORE</a>
            </div>
            <hr class="mx-5">
            <div class="row justify-content-center gap-3 mx-5 my-3 mb-5">
                <a class="btn btn-outline-warning col-lg-2" href="page/summary.php">RESOCONTO</a>
            </div>
        </div>
    </div>
</body>

</html>