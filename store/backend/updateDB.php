<?php
if (isset($_POST['updateCustomer'])) {
    require 'dbconnection.php';
    //SANIFICAZIONE VALORI DEL CLIENTE
    $idUser = htmlspecialchars($_POST['idOBJ']);
    $nome_cliente = htmlspecialchars($_POST['customer_name']);
    $cognome_cliente = htmlspecialchars($_POST['customer_lastname']);
    $nascita_cliente = htmlspecialchars($_POST['customer_birth']);
    $regione_cliente = htmlspecialchars($_POST['customer_residance']);
    //PREVENZIONE MYSQL INJECTION
    $idUser = $mysqli->real_escape_string($idUser);
    $nome_cliente = $mysqli->real_escape_string($nome_cliente);
    $cognome_cliente = $mysqli->real_escape_string($cognome_cliente);
    $nascita_cliente = $mysqli->real_escape_string($nascita_cliente);
    $regione_cliente = $mysqli->real_escape_string($regione_cliente);
    //QUERY
    $query = "UPDATE cliente SET nome='$nome_cliente', cognome='$cognome_cliente ', data_nascita='$nascita_cliente', regione_residenza='$regione_cliente' WHERE id = '$idUser'";
    if ($mysqli->query($query)) {
        echo "<script type='text/javascript'>
            alert('UTENTƎ [" . $nome_cliente . " " . $cognome_cliente . "] AGGIORNAƎ CON SUCCESSƎ');
            window.location='../index.php';
        </script>";
    } else {
        echo "ERRORƎ NELL' AGGIUNTA DELL' UTENTE" . $mysqli->error;
    }
    $mysqli->close();
}

if (isset($_POST['updateInvoice'])) {
    require 'dbconnection.php';

    //SANIFICAZIONE VALORI DEL CLIENTE
    $idInvoice = htmlspecialchars($_POST['idOBJ']);
    $tipo_fattura = htmlspecialchars($_POST['invoice_type']);
    $importo_fattura = htmlspecialchars($_POST['invoice_amount']);
    $iva_fattura = htmlspecialchars($_POST['invoice_vat']);
    $nomecliente_fattura = htmlspecialchars($_POST['invoice_customer']);
    $data_fattura = htmlspecialchars($_POST['invoice_date']);
    $nomeazienda_fattura = htmlspecialchars($_POST['invoice_supplier']);
    //PREVENZIONE MYSQL INJECTION
    $idInvoice = $mysqli->real_escape_string($idInvoice);
    $tipo_fattura = $mysqli->real_escape_string($tipo_fattura);
    $importo_fattura = $mysqli->real_escape_string($importo_fattura);
    $iva_fattura = $mysqli->real_escape_string($iva_fattura);
    $nomecliente_fattura = $mysqli->real_escape_string($nomecliente_fattura);
    $data_fattura = $mysqli->real_escape_string($data_fattura);
    $nomeazienda_fattura = $mysqli->real_escape_string($nomeazienda_fattura);
    //QUERY
    $query = "UPDATE fattura SET tipologia='$tipo_fattura', importo=$importo_fattura , iva='$iva_fattura', 
    id_cliente='$nomecliente_fattura', data_fattura ='$data_fattura', id_fornitore='$nomeazienda_fattura' 
    WHERE id = '$idInvoice'";
    if ($mysqli->query($query)) {
        echo "<script type='text/javascript'>
            alert('FATTURA MODIFICATA CON SUCCESSO');
            window.location='../page/print.php?function_print=fattura';
        </script>";
    } else {
        echo "ERRORE NELL' MODIFICA DELLA FATTURA" . $mysqli->error;
    }
    $mysqli->close();
}

if (isset($_POST['updateProduct'])) {
    require 'dbconnection.php';
    //SANIFICAZIONE VALORI DEL CLIENTE
    $idProduct = htmlspecialchars($_POST['idOBJ']);
    $descrizione_prodotto = htmlspecialchars($_POST['product_desc']);
    $inProduzione = htmlspecialchars($_POST['inProduction']);
    $inVendita = htmlspecialchars($_POST['inSell']);
    $data_attivazione_prodotto = htmlspecialchars($_POST['product_dateActivation']);
    $data_disattivazione_prodotto = htmlspecialchars($_POST['product_dateUnActivation']);
    //PREVENZIONE MYSQL INJECTION
    $idProduct = $mysqli->real_escape_string($idProduct);
    $descrizione_prodotto = $mysqli->real_escape_string($descrizione_prodotto);
    $inProduzione = $mysqli->real_escape_string($inProduzione);
    $inVendita = $mysqli->real_escape_string($inVendita);
    $data_attivazione_prodotto = $mysqli->real_escape_string($data_attivazione_prodotto);
    $data_disattivazione_prodotto = $mysqli->real_escape_string($data_disattivazione_prodotto);
    //QUERY
    $query = "UPDATE prodotto SET descrizione='$descrizione_prodotto', in_produzione='$inProduzione ', in_commercio='$inVendita', 
    data_attivazione='$data_attivazione_prodotto', data_disattivazione='$data_disattivazione_prodotto' WHERE id_prodotto = '$idProduct'";
    if ($mysqli->query($query)) {
        echo "<script type='text/javascript'>
            alert('PRODOTTO AGGIORNATO CON SUCCESSO');
            window.location='../page/print.php?function_print=prodotto';
        </script>";
    } else {
        echo "ERRORE NELLA MODIFICA DELL' PRODOTTO" . $mysqli->error;
    }
    $mysqli->close();
}

if (isset($_POST['updateSupplier'])) {
    require 'dbconnection.php';

    //SANIFICAZIONE VALORI DEL CLIENTE
    $idSupplier = htmlspecialchars($_POST['idOBJ']);
    $nome_azienda = htmlspecialchars($_POST['supplier_name']);
    $residenza_azienda = htmlspecialchars($_POST['supplier_residance']);
    //PREVENZIONE MYSQL INJECTION
    $idSupplier = $mysqli->real_escape_string($idSupplier);
    $nome_azienda = $mysqli->real_escape_string($nome_azienda);
    $residenza_azienda = $mysqli->real_escape_string($residenza_azienda);
    //QUERY
    $query = "UPDATE fornitore SET denominazione='$nome_azienda', regione_residenza='$residenza_azienda ' WHERE id_fornitore = '$idSupplier'";
    if ($mysqli->query($query)) {
        echo "<script type='text/javascript'>
            alert('AZIENDA [" . $nome_azienda . "] MODIFICATA CON SUCCESSO');
            window.location='../page/print.php?function_print=fornitore';
        </script>";
    } else {
        echo "ERRORE NELLA MODIFICA DELL' AZIENDA" . $mysqli->error;
    }
    $mysqli->close();
}
