<?php
//VERIFICO CHE IL PARAMENTRO DELL URL ESISTA E NON SIA VUOTO O DICERSO SA FUNCIOTN ADD
if (empty($_GET) || !isset($_GET['function_remove'])) {
    echo "<script type='text/javascript'>
            alert('IMPOSSIBILE ACCEDERE A QUESTA PAGINA SENZA PARAMETRI');
            window.location='../index.php';
        </script>";
} else {
    $action = htmlspecialchars($_GET['function_remove']);
    //VERIFICO CHE IL PARAMENTRO DI FUNCIOTN ADD SIA FRA I CONSENTITI
    if ($action == 'cliente' or $action == 'fattura' or $action == 'prodotto' or $action == 'fornitore') {
        //CONNESSIONE DEL DATABASE
        require '../backend/dbconnection.php';

        //VALORI PER LA GENERAZIONE DINAMICA DELLA TABELLA
        $isCLiente = false;
        $isFattura = false;
        $isProdotto = false;
        $isFornitore = false;

        //ATTIVO LA VARIABILE CHE MI SERVE
        switch ($action) {
            case 'cliente':
                $isCLiente = true;
                $nametable = "Clienti";
                break;
            case 'fattura':
                $isFattura = true;
                $nametable = "Fatture";

                break;
            case 'prodotto':
                $isProdotto = true;
                $nametable = "Prodotti";

                break;
            case 'fornitore':
                $isFornitore = true;
                $nametable = "Fornitori";

                break;
        }
    } else {
        //SE IL PARAMETRO E' DIVERSO FRA QUELLI CONSENTITI
        echo "<script type='text/javascript'>
            alert('IMPOSSIBILE ACCEDERE. PARAMETRO [" . $action . "] NON VALIDO');
            window.location='../index.php';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista <?= $nametable ?></title>
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
    <div class="container mt-5">
        <div class="card">
            <?php $selectID = $_GET['codeID']; ?>
            <div class="row">
                <h1 class="text-center mt-3 px-5">Rimozione <?= ucfirst($action) ?></h1>
            </div>
            <?php if ($isCLiente) { ?>
                <table class="table align-middle">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Nome</th>
                            <th scope="col">Cognome</th>
                            <th scope="col">Regione di residenza</th>
                            <th scope="col">Data di Nascita</th>
                        </tr>
                    </thead>
                    <?php
                    $query = "SELECT id,cliente.nome,cliente.cognome,regione.nome as regione_residenza,cliente.data_nascita FROM cliente INNER JOIN regione ON cliente.regione_residenza=regione.id_regione WHERE id='$selectID'";
                    $result = $mysqli->query($query); ?>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {

                            echo "<tr class='text-center'>
                                                    <td>" . $row['nome'] . "</td>
                                                    <td>" . $row['cognome'] . "</td>
                                                    <td>" . $row['regione_residenza'] . "</td>
                                                    <td>" . $row['data_nascita'] . "</td>
                                                </tr>";
                        }
                        echo "</tbody></table>";
                        ?>
                        <h6 class="py-3 text-center">FATTURE COLLEGATE AL CLIENTE</h6>
                        <?php
                        $query = "SELECT * FROM fattura WHERE id_cliente ='$selectID'";
                        $result = $mysqli->query($query);
                        ?>
                        <table class="table align-middle">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Tipologia</th>
                                    <th scope="col">Importo</th>
                                    <th scope="col">IVA</th>
                                    <th scope="col">Data Fattura</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr class='text-center'>
                                                   <td>" . $row['tipologia'] . "</td>
                                                    <td>" . $row['importo'] . "€</td>
                                                    <td>" . $row['iva'] . "%</td>
                                                    <td>" . $row['data_fattura'] . "</td>
                                                </tr>";
                                }
                                echo "</tbody></table>";
                                ?>
                                <form class="mx-5 mb-4" action="../backend/deleteDB.php" method="POST">
                                    <div class="alert alert-danger text-center my-5 " role="alert">
                                        <b>ATTENIONE</b> SE ELIMINI IL CLIENTE VERRANO ELEMINATE ANCHE LE FATTURE AD ESSO COLLEGATE
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" required>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Procedi comunque con l'eliminazione
                                        </label>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <label for="iduser" class="col-form-label">ID</label>
                                            </div>
                                            <div class="col-auto">
                                                <input style="background-color:rgba(60, 66, 69, 0.2);" type="text" id="iduser" name="customer_id" class="form-control" readonly value="<?= $selectID ?>">
                                            </div>
                                        </div>
                                        <button name="removeCustomer" class="btn btn-danger" type="submit">ELIMINA CLIENTE</button>
                                    </div>
                                </form>
                            <?php } else if ($isFattura) { ?>
                                <table class="table align-middle mt-3">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">Tipologia</th>
                                            <th scope="col">Importo</th>
                                            <th scope="col">IVA</th>
                                            <th scope="col">Dati Cliente</th>
                                            <th scope="col">Fornitore</th>
                                            <th scope="col">Data Fattura</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $query = "SELECT fattura.id,fattura.tipologia,fattura.importo,fattura.iva,CONCAT(cliente.nome,' ',cliente.cognome) as 
                                dati_cliente ,fattura.data_fattura,fornitore.denominazione as nome_fornitore FROM fattura INNER JOIN cliente ON 
                                fattura.id_cliente = cliente.id INNER JOIN fornitore ON fattura.id_fornitore = fornitore.id_fornitore WHERE fattura.id='$selectID' ";
                                    $result = $mysqli->query($query); ?>
                                    <tbody>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr class='text-center'>
                                                    <td>" . $row['tipologia'] . "</td>
                                                    <td>" . $row['importo'] . "€</td>
                                                    <td>" . $row['iva'] . "%</td>
                                                    <td>" . $row['dati_cliente'] . "</td>
                                                    <td>" . $row['nome_fornitore'] . "</td>
                                                    <td>" . $row['data_fattura'] . "</td>

                                                </tr>";
                                        }
                                        echo "</tbody></table>";
                                        ?>
                                        <form class="mx-5 mb-4" action="../backend/deleteDB.php" method="POST">
                                            <div class="row g-3 justify-content-center align-items-center my-3">
                                                <div class="col-auto">
                                                    <label for="idInvoice" class="col-form-label">ID</label>
                                                </div>
                                                <div class="col-auto">
                                                    <input style="background-color:rgba(60, 66, 69, 0.2);" type="text" id="idInvoice" name="invoice_id" class="form-control" readonly value="<?= $selectID ?>">
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button name="removeInvoice" class="btn btn-danger mb-3 mr-5" type="submit">ELIMINA FATTURA</button>
                                                <button name="abortRemoveInvoice" class="btn btn-outline-danger mb-3" type="submit">TORNA INDIETRO</button>
                                            </div>
                                        </form>
                                    <?php } else if ($isProdotto) { ?>
                                        <table class="table align-middle">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">Descrizione</th>
                                                    <th scope="col">In Produzione</th>
                                                    <th scope="col">In commercio</th>
                                                    <th scope="col">Data attivazione</th>
                                                    <th scope="col">Data disattivazione</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $query = "SELECT * FROM prodotto WHERE id_prodotto='$selectID'";
                                            $result = $mysqli->query($query); ?>
                                            <tbody>
                                                <?php
                                                while ($row = $result->fetch_assoc()) {
                                                    $value = $row['in_produzione'];
                                                    if ($value == "1") { // if true
                                                        $value = "Si";
                                                    } else {
                                                        $value = "No";
                                                    }
                                                    $value2 = $row['in_commercio'];
                                                    if ($value2 == "1") { // if true
                                                        $value2 = "Si";
                                                    } else {
                                                        $value2 = "No";
                                                    }
                                                    echo "<tr class='text-center'>
                                                    <td>" . $row['descrizione'] . "</td>
                                                    <td>" . $value . "</td>
                                                    <td>" . $value2 . "</td>
                                                    <td>" . $row['data_attivazione'] . "</td>
                                                    <td>" . $row['data_disattivazione'] . "</td>
                                                
                                                </tr>";
                                                }
                                                echo "</tbody></table>";
                                                ?>
                                                <form class="mx-5 mb-4" action="../backend/deleteDB.php" method="POST">
                                                    <div class="row g-3 justify-content-center align-items-center my-3">
                                                        <div class="col-auto">
                                                            <label for="idProduct" class="col-form-label">ID</label>
                                                        </div>
                                                        <div class="col-auto">
                                                            <input style="background-color:rgba(60, 66, 69, 0.2);" type="text" id="idProduct" name="product_id" class="form-control" readonly value="<?= $selectID ?>">
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <button name="removeProduct" class="btn btn-danger mb-3 mr-5" type="submit">ELIMINA PRODOTTO</button>
                                                        <button name="abortRemoveProduct" class="btn btn-outline-danger mb-3" type="submit">TORNA INDIETRO</button>
                                                    </div>
                                                </form>
                                            <?php } else if ($isFornitore) { ?>
                                                <table class="table align-middle">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Denominazione</th>
                                                            <th scope="col">Regione di residenza</th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    $query = "SELECT id_fornitore,fornitore.denominazione,regione.nome as regione_residenza FROM fornitore INNER JOIN regione ON fornitore.regione_residenza=regione.id_regione WHERE id_fornitore='$selectID'";
                                                    $result = $mysqli->query($query); ?>
                                                    <tbody>
                                                        <?php
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<tr class='text-center'>
                                                    <td>" . $row['denominazione'] . "</td>
                                                    <td>" . $row['regione_residenza'] . "</td>
                                                </tr>";
                                                        }
                                                        echo "</tbody></table>";
                                                        ?>
                                                        <h6 class="py-3 text-center">FATTURE COLLEGATE AL FORNITORE</h6>
                                                        <?php
                                                        $query = "SELECT * FROM fattura WHERE id_fornitore ='$selectID'";
                                                        $result = $mysqli->query($query);
                                                        ?>
                                                        <table class="table align-middle">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th scope="col">Tipologia</th>
                                                                    <th scope="col">Importo</th>
                                                                    <th scope="col">IVA</th>
                                                                    <th scope="col">Data Fattura</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<tr class='text-center'>
                                                                        <td>" . $row['tipologia'] . "</td>
                                                                            <td>" . $row['importo'] . "€</td>
                                                                            <td>" . $row['iva'] . "%</td>
                                                                            <td>" . $row['data_fattura'] . "</td>
                                                                        </tr>";
                                                                }
                                                                echo "</tbody></table>";
                                                                ?>
                                                                <form class="mx-5 mb-4" action="../backend/deleteDB.php" method="POST">
                                                                    <div class="alert alert-danger text-center my-5 " role="alert">
                                                                        <b>ATTENIONE</b> SE ELIMINI IL FORNITORE VERRANO ELEMINATE ANCHE LE FATTURE AD ESSO COLLEGATE
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" required>
                                                                        <label class="form-check-label" for="flexCheckChecked">
                                                                            Procedi comunque con l'eliminazione
                                                                        </label>
                                                                    </div>
                                                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                                        <div class="row g-3 align-items-center">
                                                                            <div class="col-auto">
                                                                                <label for="idSupplier" class="col-form-label">ID</label>
                                                                            </div>
                                                                            <div class="col-auto">
                                                                                <input style="background-color:rgba(60, 66, 69, 0.2);" type="text" id="idSupplier" name="supplier_id" class="form-control" readonly value="<?= $selectID ?>">
                                                                            </div>
                                                                        </div>
                                                                        <button name="removeSupplier" class="btn btn-danger" type="submit">ELIMINA FORNITORE</button>
                                                                    </div>
                                                                </form>
                                                            <?php }; ?>
        </div>

    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
</body>

</html>