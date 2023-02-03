<?php
//VERIFICO CHE IL PARAMENTRO DELL URL ESISTA E NON SIA VUOTO O DICERSO SA FUNCIOTN ADD
if (empty($_GET) || !isset($_GET['function_update']) && !isset($_GET['codeID'])) {
    echo "<script type='text/javascript'>
            alert('IMPOSSIBILE ACCEDERE A QUESTA PAGINA SENZA PARAMETRI');
            window.location='../index.php';
        </script>";
} else {
    $action = htmlspecialchars($_GET['function_update']);
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
    }
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista <?= ucfirst($action) ?></title>
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
                <h1 class="text-center mt-3 px-5">Modifica <?= ucfirst($action) ?></h1>
            </div>
            <form class="mx-5" action="../backend/updateDB.php" method="POST">
                <?php $selectID = $_GET['codeID']; ?>
                <div class=" text-center mt-3 mb-4">
                    <span>ID</span>
                    <input style="background-color:rgba(60, 66, 69, 0.2);" class="form-control text-center" name="idOBJ" value="<?= $selectID ?> " readonly>
                </div>
                <?php if ($isCLiente) { ?>
                    <?php
                    $query = "SELECT id,cliente.nome,cliente.cognome,regione.nome as regione_residenza,cliente.data_nascita FROM cliente INNER JOIN regione ON cliente.regione_residenza=regione.id_regione WHERE id ='$selectID'";
                    $result = $mysqli->query($query);
                    while ($row = $result->fetch_assoc()) {
                        $old_name = $row['nome'];
                        $old_lastname = $row['cognome'];
                        $old_birth = $row['data_nascita'];
                        $old_residance = $row['regione_residenza'];
                    }
                    ?>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input name="customer_name" type="text" id="formCustomerName" class="form-control" required value="<?= $old_name ?>" />
                                <label class="form-label" for="formCustomerName">Nome</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input name="customer_lastname" type="text" id="formCustomerLastname" class="form-control" required value="<?= $old_lastname ?>" />
                                <label class="form-label" for="formCustomerLastname">Cognome</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input name="customer_birth" type="date" value="<?= $old_birth ?>" class="form-control" required />
                            </div>
                        </div>
                        <?php
                        $query = "SELECT * FROM regione";
                        $result = $mysqli->query($query);
                        ?>
                        <div class="col">
                            <select name="customer_residance" class="form-select" required>
                                <option value="">Selezione la regione di residenza...</option>

                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                    if ($row['nome'] == $old_residance) {
                                        $seleziona = "selected";
                                    } else {
                                        $seleziona = "";
                                    }
                                    echo "<option value='" . $row['id_regione'] . "'" . $seleziona . ">" . $row['nome'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button name="updateCustomer" type="submit" class="btn btn-danger btn-block mb-4">AGGIORNA <?= strtoupper($action); ?></button>
                <?php } else if ($isFattura) { ?>
                    <?php
                    $selectID = $_GET['codeID'];
                    $query = "SELECT * FROM fattura WHERE id ='$selectID'";
                    $result = $mysqli->query($query);
                    while ($row = $result->fetch_assoc()) {
                        $old_type = $row['tipologia'];
                        $old_amount = $row['importo'];
                        $old_vat = $row['iva'];
                        $old_customer = $row['id_cliente'];
                        $old_date = $row['data_fattura'];
                        $old_supplier = $row['id_fornitore'];
                    }
                    ?>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input name="invoice_type" type="text" value="<?= $old_type ?>" id="formInvoiceType" class="form-control" />
                                <label class="form-label" for="formInvoiceType">Tipologia</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input name="invoice_amount" type="number" value="<?= $old_amount ?>" step="0.01" min="0" id="formInvoiceAmount" class="form-control" />
                                <label class="form-label" for="formInvoiceAmount">Importo</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <i class="fas fas fa-percent trailing"></i>
                                <input name="invoice_vat" value="<?= $old_vat ?>" step="0.5" min="0" type="number" id="formInvoiceVAT" class="form-control form-icon-trailing" required />
                                <label class="form-label" for="formInvoiceVAT">IVA</label>

                            </div>
                        </div>
                        <?php
                        $query = "SELECT id,nome,cognome FROM cliente";
                        $result = $mysqli->query($query);
                        ?>
                        <div class="col">
                            <select name="invoice_customer" class="form-select" required>
                                <option value="">Selezione il cliente...</option>
                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                    if ($row['id'] == $old_customer) {
                                        $seleziona = "selected";
                                    } else {
                                        $seleziona = "";
                                    }
                                    echo "<option value='" . $row['id'] . "'" . $seleziona . ">" . $row['nome'] . " " . $row['cognome'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input name="invoice_date" type="date" value="<?= $old_date ?>" class="form-control" required />
                            </div>
                        </div>
                        <?php
                        $query = "SELECT id_fornitore,denominazione FROM fornitore";
                        $result = $mysqli->query($query);
                        ?>
                        <div class="col">
                            <select name="invoice_supplier" class="form-select" required>
                                <option value="">Seleziona il fornitore...</option>
                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                    if ($row['id_fornitore'] == $old_supplier) {
                                        $seleziona = "selected";
                                    } else {
                                        $seleziona = "";
                                    }
                                    echo "<option value='" . $row['id_fornitore'] . "'" . $seleziona . ">" . $row['denominazione'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button name="updateInvoice" type="submit" class="btn btn-danger btn-block mb-4">AGGIORNA <?= strtoupper($action); ?></button>

                <?php } else if ($isProdotto) { ?>
                    <?php
                    $selectID = $_GET['codeID'];
                    $query = "SELECT * FROM prodotto WHERE id_prodotto ='$selectID'";
                    $result = $mysqli->query($query);
                    while ($row = $result->fetch_assoc()) {
                        $old_descrizione = $row['descrizione'];
                        $old_stateProduction = $row['in_produzione'];
                        $old_stateSell = $row['in_commercio'];
                        $old_dateActivation = $row['data_attivazione'];
                        $old_dateUnactivation = $row['data_disattivazione'];
                    }
                    ?>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input name="product_desc" type="text" value="<?= $old_descrizione ?>" id="formProductDesc" class="form-control" required />
                                <label class="form-label" for="formProductDesc">Descrizione</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <span>Articolo in Produzione</span>
                            <select name="inProduction" class="form-select" required>
                                <?php
                                $v1 = 1;
                                $v2 = 0;

                                if ($v1 == $old_stateProduction) {
                                    $selezionaProduzioneSI = "selected";
                                    $selezionaProduzioneNO = "";
                                }

                                if ($v2 == $old_stateProduction) {
                                    $selezionaProduzioneNO = "selected";
                                    $selezionaProduzioneSI = "";
                                }

                                echo "<option value='" . $v1 . "'" . $selezionaProduzioneSI . ">Si</option>
                                      <option value='" . $v2 . "'" . $selezionaProduzioneNO . ">No</option>";
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <span>Articolo in Vendita</span>
                            <select name="inSell" class="form-select" required>
                                <?php
                                $val1 = 1;
                                $val2 = 0;

                                if ($val1 == $old_stateSell) {
                                    $selezionaVenditaSI = "selected";
                                    $selezionaVenditaNO = "";
                                }
                                if ($val2 == $old_stateSell) {
                                    $selezionaVenditaNO = "selected";
                                    $selezionaVenditaSI = "";
                                }
                                echo "<option value='" . $val1 . "'" . $selezionaVenditaSI . ">Si</option>
                                      <option value='" . $val2 . "'" . $selezionaVenditaNO . ">No</option>";
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <span>Data'attivazione</span>
                            <div class="form-outline">
                                <input name="product_dateActivation" type="date" value="<?= $old_dateActivation ?>" id="formProductActivate" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <span>Data disattivazione</span>
                            <div class="form-outline">
                                <input name="product_dateUnActivation" type="date" value="<?= $old_dateUnactivation ?>" id="formProductUnactivate" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <button name="updateProduct" type="submit" class="btn btn-danger btn-block mb-4">AGGIORNA <?= strtoupper($action); ?></button>
                <?php } else if ($isFornitore) { ?>
                    <?php
                    $selectID = $_GET['codeID'];
                    $query = "SELECT id_fornitore,fornitore.denominazione,regione.nome as regione_residenza FROM fornitore INNER JOIN regione ON fornitore.regione_residenza=regione.id_regione WHERE id_fornitore ='$selectID'";
                    $result = $mysqli->query($query);
                    while ($row = $result->fetch_assoc()) {
                        $old_denomin = $row['denominazione'];
                        $old_residance = $row['regione_residenza'];
                    }
                    ?>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input name="supplier_name" value="<?= $old_denomin ?>" type="text" id="formSupplierName" class="form-control" required />
                                <label class="form-label" for="formSupplierName">Nome Azienda</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <?php
                        $query = "SELECT * FROM regione";
                        $result = $mysqli->query($query);
                        ?>
                        <div class="col">
                            <select name="supplier_residance" class="form-select" required>
                                <option value="">Selezione la regione di residenza...</option>

                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                    if ($row['nome'] == $old_residance) {
                                        $seleziona = "selected";
                                    } else {
                                        $seleziona = "";
                                    }
                                    echo "<option value='" . $row['id_regione'] . "'" . $seleziona . ">" . $row['nome'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <button name="updateSupplier" type="submit" class="btn btn-danger btn-block mb-4">AGGIORNA <?= strtoupper($action); ?></button>
                <?php }; ?>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
</body>

</html>