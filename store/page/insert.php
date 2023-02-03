<?php
//VERIFICO CHE IL PARAMENTRO DELL URL ESISTA E NON SIA VUOTO O DICERSO SA FUNCIOTN ADD
if (empty($_GET) || !isset($_GET['function_add'])) {
    echo "<script type='text/javascript'>
            alert('IMPOSSIBILE ACCEDERE A QUESTA PAGINA SENZA PARAMETRI');
            window.location='../index.php';
        </script>";
} else {
    $action = htmlspecialchars($_GET['function_add']);
    //VERIFICO CHE IL PARAMENTRO DI FUNCIOTN ADD SIA FRA I CONSENTITI
    if ($action == 'cliente' or $action == 'fattura' or $action == 'prodotto' or $action == 'fornitore') {
        //CONNESSIONE DEL DATABASE
        require '../backend/dbconnection.php';

        //VALORI PER LA GENERAZIONE DINAMICA DEL FORM
        $isCLiente = false;
        $isFattura = false;
        $isProdotto = false;
        $isFornitore = false;

        //ATTIVO LA VARIABILE CHE MI SERVE
        switch ($action) {
            case 'cliente':
                $isCLiente = true;
                break;
            case 'fattura':
                $isFattura = true;
                break;
            case 'prodotto':
                $isProdotto = true;
                break;
            case 'fornitore':
                $isFornitore = true;
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
    <title>Inserimento <?= ucfirst($action); ?></title>
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
                <h1 class="text-center mt-3 px-5">Inserimento <?= ucfirst($action); ?></h1>
            </div>
            <form class="mx-5 my-5" action="../backend/insertDB.php" method="POST">
                <?php if ($isCLiente) { ?>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input name="customer_name" type="text" id="formCustomerName" class="form-control" required />
                                <label class="form-label" for="formCustomerName">Nome</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input name="customer_lastname" type="text" id="formCustomerLastname" class="form-control" required />
                                <label class="form-label" for="formCustomerLastname">Cognome</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input name="customer_birth" type="date" value="2000-01-01" class="form-control" required />
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
                                    echo "<option value='" . $row['id_regione'] . "'>" . $row['nome'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button name="addCustomer" type="submit" class="btn btn-danger btn-block mb-4">AGGIUNGI <?= strtoupper($action); ?></button>
                <?php } else if ($isFattura) { ?>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input name="invoice_type" type="text" id="formInvoiceType" class="form-control" />
                                <label class="form-label" for="formInvoiceType">Tipologia</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input name="invoice_amount" type="number" step="0.01" min="0" id="formInvoiceAmount" class="form-control" />
                                <label class="form-label" for="formInvoiceAmount">Importo</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <i class="fas fas fa-percent trailing"></i>
                                <input name="invoice_vat" value="22" step="0.5" min="0" type="number" id="formInvoiceVAT" class="form-control form-icon-trailing" required />
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
                                    echo "<option value='" . $row['id'] . "'>" . $row['nome'] . " " . $row['cognome'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input name="invoice_date" type="date" value="2000-01-01" class="form-control" required />
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
                                    echo "<option value='" . $row['id_fornitore'] . "'>" . $row['denominazione'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button name="addInvoice" type="submit" class="btn btn-danger btn-block mb-4">AGGIUNGI <?= strtoupper($action); ?></button>

                <?php } else if ($isProdotto) { ?>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input name="product_desc" type="text" id="formProductDesc" class="form-control" required />
                                <label class="form-label" for="formProductDesc">Descrizione</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <span>Articolo in Produzione</span>
                            <select name="inProduction" class="form-select" required>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col">
                            <span>Articolo in Vendita</span>
                            <select name="inSell" class="form-select" required>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <span>Data'attivazione</span>
                            <div class="form-outline">
                                <input name="product_dateActivation" type="date" value="2000-01-01" id="formProductActivate" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <span>Data disattivazione</span>
                            <div class="form-outline">
                                <input name="product_dateUnActivation" type="date" value="2000-01-01" id="formProductUnactivate" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <button name="addProduct" type="submit" class="btn btn-danger btn-block mb-4">AGGIUNGI <?= strtoupper($action); ?></button>

                <?php } else if ($isFornitore) { ?>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input name="supplier_name" type="text" id="formSupplierName" class="form-control" required />
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
                                    echo "<option value='" . $row['id_regione'] . "'>" . $row['nome'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <button name="addSupplier" type="submit" class="btn btn-danger btn-block mb-4">AGGIUNGI <?= strtoupper($action); ?></button>

                <?php }; ?>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
</body>

</html>