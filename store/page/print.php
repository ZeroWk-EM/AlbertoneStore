<?php
//VERIFICO CHE IL PARAMENTRO DELL URL ESISTA E NON SIA VUOTO O DICERSO SA FUNCIOTN ADD
if (empty($_GET) || !isset($_GET['function_print'])) {
    echo "<script type='text/javascript'>
            alert('IMPOSSIBILE ACCEDERE A QUESTA PAGINA SENZA PARAMETRI');
            window.location='../index.php';
        </script>";
} else {
    $action = htmlspecialchars($_GET['function_print']);
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
            <div class="row">
                <h1 class="text-center mt-3 px-5">Lista <?= $nametable ?></h1>
            </div>
            <form class="mx-5 my-4" action="print.php" method="POST">
                <?php if ($isCLiente) { ?>
                    <?php
                    $query = "SELECT id FROM cliente";
                    $result = $mysqli->query($query);
                    $rowcount = mysqli_num_rows($result)
                    ?>
                    <p class="text-center">Clienti Registati <b><?= $rowcount ?></b></p>
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Nome</th>
                                <th scope="col">Cognome</th>
                                <th scope="col">Regione di residenza</th>
                                <th scope="col">Data di Nascita</th>

                                <th scope="col">Azioni</th>
                            </tr>
                        </thead>
                        <?php
                        $query = "SELECT id,cliente.nome,cliente.cognome,regione.nome as regione_residenza,cliente.data_nascita FROM cliente INNER JOIN regione ON cliente.regione_residenza=regione.id_regione";
                        $result = $mysqli->query($query); ?>
                        <tbody>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='text-center'>
                                                    <td>" . $row['nome'] . "</td>
                                                    <td>" . $row['cognome'] . "</td>
                                                    <td>" . $row['regione_residenza'] . "</td>
                                                    <td>" . $row['data_nascita'] . "</td>
                                                    <td>
                                                        <button type='button' class='btn btn-link btn-sm px-3' data-ripple-color='dark'>
                                                            <a href='update.php?function_update=cliente&codeID=" . $row['id'] . "'><i class='far fa-edit'></i></a>
                                                        </button>
                                                        <button type='button' class='btn btn-link btn-sm px-3' data-ripple-color='dark'>
                                                            <a href='remove.php?function_remove=cliente&codeID=" . $row['id'] . "'><i class='far fa-trash-alt'></i></a>    
                                                        </button>
                                                    </td>
                                                </tr>";
                            }
                            echo "</tbody></table>";
                            ?>
                        <?php } else if ($isFattura) { ?>
                            <?php
                            $query = "SELECT id FROM fattura";
                            $result = $mysqli->query($query);
                            $rowcount = mysqli_num_rows($result)
                            ?>
                            <p class="text-center">Fatture Registati <b><?= $rowcount ?></b></p>
                            <table class="table align-middle">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Tipologia</th>
                                        <th scope="col">Importo</th>
                                        <th scope="col">IVA</th>
                                        <th scope="col">Dati Cliente</th>
                                        <th scope="col">Fornitore</th>
                                        <th scope="col">Data Fattura</th>
                                        <th scope="col">Azioni</th>
                                    </tr>
                                </thead>
                                <?php
                                $query = "SELECT fattura.id,fattura.tipologia,fattura.importo,fattura.iva,CONCAT(cliente.nome,' ',cliente.cognome) as 
                                dati_cliente ,fattura.data_fattura,fornitore.denominazione as nome_fornitore FROM fattura INNER JOIN cliente ON 
                                fattura.id_cliente = cliente.id INNER JOIN fornitore ON fattura.id_fornitore = fornitore.id_fornitore";
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
                                                    <td>
                                                        <button type='button' class='btn btn-link btn-sm px-3' data-ripple-color='dark'>
                                                            <a href='update.php?function_update=fattura&codeID=" . $row['id']  . "'><i class='far fa-edit'></i></a>
                                                        </button>
                                                        <button type='button' class='btn btn-link btn-sm px-3' data-ripple-color='dark'>
                                                            <a href='remove.php?function_remove=fattura&codeID=" . $row['id'] . "'><i class='far fa-trash-alt'></i></a>    
                                                        </button>
                                                    </td>
                                                </tr>";
                                    }
                                    echo "</tbody></table>";
                                    ?>
                                <?php } else if ($isProdotto) { ?>
                                    <?php
                                    $query = "SELECT id_prodotto FROM prodotto";
                                    $result = $mysqli->query($query);
                                    $rowcount = mysqli_num_rows($result)
                                    ?>
                                    <p class="text-center">Prodotti Registati <b><?= $rowcount ?></b></p>
                                    <table class="table align-middle">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">Descrizione</th>
                                                <th scope="col">In Produzione</th>
                                                <th scope="col">In commercio</th>
                                                <th scope="col">Data attivazione</th>
                                                <th scope="col">Data disattivazione</th>
                                                <th scope="col">Azioni</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $query = "SELECT * FROM prodotto";
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
                                                    <td>
                                                        <button type='button' class='btn btn-link btn-sm px-3' data-ripple-color='dark'>
                                                            <a href='update.php?function_update=prodotto&codeID=" . $row['id_prodotto'] . "'><i class='far fa-edit'></i></a>
                                                        </button>
                                                        <button type='button' class='btn btn-link btn-sm px-3' data-ripple-color='dark'>
                                                            <a href='remove.php?function_remove=prodotto&codeID=" . $row['id_prodotto'] . "'><i class='far fa-trash-alt'></i></a>    
                                                        </button>
                                                    </td>
                                                </tr>";
                                            }
                                            echo "</tbody></table>";
                                            ?>
                                        <?php } else if ($isFornitore) { ?>
                                            <?php
                                            $query = "SELECT id_fornitore FROM fornitore";
                                            $result = $mysqli->query($query);
                                            $rowcount = mysqli_num_rows($result)
                                            ?>
                                            <p class="text-center">Fornitori Registati <b><?= $rowcount ?></b></p>
                                            <table class="table align-middle">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col">Denominazione</th>
                                                        <th scope="col">Regione di residenza</th>
                                                        <th scope="col">Azioni</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $query = "SELECT id_fornitore,fornitore.denominazione,regione.nome as regione_residenza FROM fornitore INNER JOIN regione ON fornitore.regione_residenza=regione.id_regione";
                                                $result = $mysqli->query($query); ?>
                                                <tbody>
                                                    <?php
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr class='text-center'>
                                                    <td>" . $row['denominazione'] . "</td>
                                                    <td>" . $row['regione_residenza'] . "</td>
                                                    <td>
                                                        <button type='button' class='btn btn-link btn-sm px-3' data-ripple-color='dark'>
                                                            <a href='update.php?function_update=fornitore&codeID=" . $row['id_fornitore'] . "'><i class='far fa-edit'></i></a>
                                                        </button>
                                                        <button type='button' class='btn btn-link btn-sm px-3' data-ripple-color='dark'>
                                                            <a href='remove.php?function_remove=fornitore&codeID=" . $row['id_fornitore'] . "'><i class='far fa-trash-alt'></i></a>    
                                                        </button>
                                                    </td>
                                                </tr>";
                                                    }
                                                    echo "</tbody></table>";
                                                    ?>

                                                <?php }; ?>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
</body>

</html>