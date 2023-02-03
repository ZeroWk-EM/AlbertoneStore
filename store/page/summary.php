<?php
require '../backend/dbconnection.php';
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resoconto</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../assets/icon/icon_java-16.png">
    <link type="image/png" sizes="32x32" rel="icon" href="../assets/icon/icon_java-32.png">
    <link type="image/png" sizes="96x96" rel="icon" href="../assets/icon/icon_java-96.png">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet" />
</head>

<body style="background-color: #EA3546;">
    <div class="container my-5">
        <div class="card">
            <h1 class="text-center mt-3 px-3">RESOCONTO GENERALE</h1>
            <hr class="mx-5 mb-5">
            <div class="row">
                <!-- SINISTRA -->
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="row">
                        <!-- RECORD DB -->
                        <div class="col-12 col-md-12 col-lg-6">
                            <h5 class="text-center">RECORD DB</h5>
                            <ul class="list-group list-group-light mx-5 my-3">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Clienti registrati</div>
                                    </div>
                                    <?php
                                    $query = "SELECT id FROM cliente";
                                    $result = $mysqli->query($query);
                                    $rowcount = mysqli_num_rows($result)
                                    ?>
                                    <span class="badge badge-danger rounded-pill"><?= $rowcount ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Fatture registrate</div>
                                    </div>
                                    <?php
                                    $query = "SELECT id FROM fattura";
                                    $result = $mysqli->query($query);
                                    $rowcount = mysqli_num_rows($result)
                                    ?>
                                    <span class="badge badge-danger rounded-pill"><?= $rowcount ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Prodotti registrati</div>
                                    </div>
                                    <?php
                                    $query = "SELECT id_prodotto FROM prodotto";
                                    $result = $mysqli->query($query);
                                    $rowcount = mysqli_num_rows($result)
                                    ?>
                                    <span class="badge badge-danger rounded-pill"><?= $rowcount ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Fornitori registrati</div>
                                    </div>
                                    <?php
                                    $query = "SELECT id_fornitore FROM fornitore";
                                    $result = $mysqli->query($query);
                                    $rowcount = mysqli_num_rows($result)
                                    ?>
                                    <span class="badge badge-danger rounded-pill"><?= $rowcount ?></span>
                                </li>
                            </ul>
                        </div>
                        <!-- ANALISI FATTURE -->
                        <div class="col-12 col-md-12 col-lg-6">
                            <h5 class="text-center">ANALISI FATTURE</h5>
                            <ul class="list-group list-group-light mx-5 my-3">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Fatture con IVA 4%</div>
                                    </div>
                                    <?php
                                    $query = "SELECT COUNT(iva) as numero_fatture FROM fattura WHERE iva = 4;";
                                    $result = $mysqli->query($query);
                                    $row = $result->fetch_assoc();
                                    ?>
                                    <span class="badge badge-warning rounded-pill"><?= $row['numero_fatture'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Fatture con IVA 10%</div>
                                    </div>
                                    <?php
                                    $query = "SELECT COUNT(iva) as numero_fatture FROM fattura WHERE iva = 10;";
                                    $result = $mysqli->query($query);
                                    $row = $result->fetch_assoc();
                                    ?>
                                    <span class="badge badge-warning rounded-pill"><?= $row['numero_fatture'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Fatture con IVA 20%</div>
                                    </div>
                                    <?php
                                    $query = "SELECT COUNT(iva) as numero_fatture FROM fattura WHERE iva = 20;";
                                    $result = $mysqli->query($query);
                                    $row = $result->fetch_assoc();
                                    ?>
                                    <span class="badge badge-warning rounded-pill"><?= $row['numero_fatture'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Fatture con IVA 22%</div>
                                    </div>
                                    <?php
                                    $query = "SELECT COUNT(iva) as numero_fatture FROM fattura WHERE iva = 22;";
                                    $result = $mysqli->query($query);
                                    $row = $result->fetch_assoc();
                                    ?>
                                    <span class="badge badge-warning rounded-pill"><?= $row['numero_fatture'] ?></span>
                                </li>
                            </ul>
                        </div>
                        <!--ANALISI REGIONE -->
                        <div class="col">
                            <h5 class="text-center mt-3">RESIDENZA CLIENTI</h5>
                            <ul class="list-group list-group-light mx-5 my-3">
                                <?php
                                $query = "SELECT regione.nome AS regione_nome,COUNT(regione_residenza) AS residenti FROM cliente INNER JOIN regione ON cliente.regione_residenza=regione.id_regione GROUP BY regione_residenza;";
                                $result = $mysqli->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo "<li class='list-group-item d-flex justify-content-between align-items-start'>
                            <div class='ms-2 me-auto'>
                                <div class='fw-bold'>Residenti totali  " . $row['regione_nome'] . "</div>
                            </div>
                            <span class='badge badge-success rounded-pill'>" . $row['residenti'] . "</span>
                        </li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- DESTRA -->
                <div class="col-12 col-md-12 col-lg-5">
                    <h5 class="text-center">INTROITI ANNUALI</h5>
                    <ul class="list-group list-group-light mx-5 my-3">
                        <?php
                        $query = "SELECT YEAR(data_fattura) as anno_fatturazione,SUM(importo) as totale FROM fattura GROUP BY anno_fatturazione";
                        $result = $mysqli->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo "<li class='list-group-item d-flex justify-content-between align-items-start'>
                            <div class='ms-2 me-auto'>
                                <div class='fw-bold'>Incasso totale - " . $row['anno_fatturazione'] . "</div>
                            </div>
                            <span class='badge badge-primary rounded-pill'>" . $row['totale'] . " €</span>
                        </li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
</body>

</html>