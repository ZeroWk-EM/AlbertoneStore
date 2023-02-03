<?php
require 'backend/dbconnection.php';
?>
<!DOCTYPE html>
<html lang="it">

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
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body style="background-color: #EA3546;">
    <div class="container mt-5">
        <div class="card">
            <div class="row my-3">
                <div class="row justify-content-center">
                    <a class="btn btn-outline-info col-lg-2" href="control_panel.php">AREA RISERVATA</a>
                </div>
                <h1 class="text-center mt-3 px-5">Albertone Store</h1>
                <h5 class="text-center mt-3 px-5">TUTTO QUELLO CHE CERCHI NOI TE LO DIAMO</h5>
            </div>
            <div class="row">
                <?php
                $query = "SELECT * FROM prodotto";
                $result = $mysqli->query($query);
                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="products col-12 mb-4 d-flex flex-column flex-lg-row justify-content-center justify-content-lg-start align-items-center align-items-lg-start">
                        <img class="rounded" src="assets/<?= $row['img'] ?>" alt="<?= $row['descrizione'] ?>">
                        <div class="product-text d-flex flex-column">
                            <h5 class="mt-3 mx-4 text-center"><?= strtoupper($row['descrizione']); ?></h5>
                            <p class="mt-3 mx-4 text-center">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iste, nostrum? Ad omnis minima veniam. Facere nesciunt exercitationem iste quam omnis. Reprehenderit, incidunt. Sed fugit tenetur, quia vero dolorem culpa delectus?</p>
                            <button type="button" class="mx-4 btn btn-success">COMPRA PRODOTTO</button>
                        </div>
                        <hr class="hr" />
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
</body>

</html>