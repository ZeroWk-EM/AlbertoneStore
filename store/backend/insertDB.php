<?php

if (isset($_POST['addCustomer'])) {
    require 'dbconnection.php';
    //SANIFICAZIONE VALORI DEL CLIENTE
    $nome_cliente = htmlspecialchars($_POST['customer_name']);
    $cognome_cliente = htmlspecialchars($_POST['customer_lastname']);
    $nascita_cliente = htmlspecialchars($_POST['customer_birth']);
    $regione_cliente = htmlspecialchars($_POST['customer_residance']);
    //PREVENZIONE MYSQL INJECTION
    $nome_cliente = $mysqli->real_escape_string($nome_cliente);
    $cognome_cliente = $mysqli->real_escape_string($cognome_cliente);
    $nascita_cliente = $mysqli->real_escape_string($nascita_cliente);
    $regione_cliente = $mysqli->real_escape_string($regione_cliente);
    //QUERY
    $query = "INSERT INTO cliente (nome,cognome,data_nascita,regione_residenza) VALUES ('$nome_cliente','$cognome_cliente','$nascita_cliente','$regione_cliente')";
    if ($mysqli->query($query)) {
        echo "<script type='text/javascript'>
            alert('UTENTƎ [" . $nome_cliente . " " . $cognome_cliente . "] AGGIUNTƎ CON SUCCESSO AL DATABASE');
            window.location='../index.php';
        </script>";
    } else {
        echo "ERRORƎ NELL' AGGIUNTA DELL' UTENTE" . $mysqli->error;
    }
    $mysqli->close();
}

if (isset($_POST['addInvoice'])) {
    require 'dbconnection.php';

    //SANIFICAZIONE VALORI DEL CLIENTE
    $tipo_fattura = htmlspecialchars($_POST['invoice_type']);
    $importo_fattura = htmlspecialchars($_POST['invoice_amount']);
    $iva_fattura = htmlspecialchars($_POST['invoice_vat']);
    $nomecliente_fattura = htmlspecialchars($_POST['invoice_customer']);
    $data_fattura = htmlspecialchars($_POST['invoice_date']);
    $nomeazienda_fattura = htmlspecialchars($_POST['invoice_supplier']);
    //PREVENZIONE MYSQL INJECTION
    $tipo_fattura = $mysqli->real_escape_string($tipo_fattura);
    $importo_fattura = $mysqli->real_escape_string($importo_fattura);
    $iva_fattura = $mysqli->real_escape_string($iva_fattura);
    $nomecliente_fattura = $mysqli->real_escape_string($nomecliente_fattura);
    $data_fattura = $mysqli->real_escape_string($data_fattura);
    $nomeazienda_fattura = $mysqli->real_escape_string($nomeazienda_fattura);
    //QUERY
    $query = "INSERT INTO fattura (tipologia,importo,iva,id_cliente,data_fattura,id_fornitore) VALUES ('$tipo_fattura',$importo_fattura,$iva_fattura,$nomecliente_fattura,'$data_fattura',$nomeazienda_fattura)";
    if ($mysqli->query($query)) {
        echo "<script type='text/javascript'>
            alert('FATTURA AGGIUNTƎ CON SUCCESSO AL DATABASE');
            window.location='../index.php';
        </script>";
    } else {
        echo "ERRORE NELL' AGGIUNTA DELLA FATTURA" . $mysqli->error;
    }
    $mysqli->close();
}

if (isset($_POST['addProduct'])) {
    require 'dbconnection.php';
    //SANIFICAZIONE VALORI DEL CLIENTE
    $descrizione_prodotto = htmlspecialchars($_POST['product_desc']);
    $inProduzione = htmlspecialchars($_POST['inProduction']);
    $inVendita = htmlspecialchars($_POST['inSell']);
    $data_attivazione_prodotto = htmlspecialchars($_POST['product_dateActivation']);
    $data_disattivazione_prodotto = htmlspecialchars($_POST['product_dateUnActivation']);
    //PREVENZIONE MYSQL INJECTION
    $descrizione_prodotto = $mysqli->real_escape_string($descrizione_prodotto);
    $inProduzione = $mysqli->real_escape_string($inProduzione);
    $inVendita = $mysqli->real_escape_string($inVendita);
    $data_attivazione_prodotto = $mysqli->real_escape_string($data_attivazione_prodotto);
    $data_disattivazione_prodotto = $mysqli->real_escape_string($data_disattivazione_prodotto);
    //QUERY
    $query = "INSERT INTO prodotto (descrizione,in_produzione,in_commercio,data_attivazione,data_disattivazione) VALUES ('$descrizione_prodotto',$inProduzione,$inVendita,'$data_attivazione_prodotto','$data_disattivazione_prodotto')";
    if ($mysqli->query($query)) {
        echo "<script type='text/javascript'>
            alert('PRODOTTO AGGIUNTO CON SUCCESSO AL DATABASE');
            window.location='../index.php';
        </script>";
    } else {
        echo "ERRORE NELL' AGGIUNTA DEL PRODOTTO" . $mysqli->error;
    }
    $mysqli->close();
}

if (isset($_POST['addSupplier'])) {
    require 'dbconnection.php';

    //SANIFICAZIONE VALORI DEL CLIENTE
    $nome_azienda = htmlspecialchars($_POST['supplier_name']);
    $residenza_azienda = htmlspecialchars($_POST['supplier_residance']);
    //PREVENZIONE MYSQL INJECTION
    $nome_azienda = $mysqli->real_escape_string($nome_azienda);
    $residenza_azienda = $mysqli->real_escape_string($residenza_azienda);
    //QUERY
    $query = "INSERT INTO fornitore (denominazione,regione_residenza) VALUES ('$nome_azienda','$residenza_azienda')";
    if ($mysqli->query($query)) {
        echo "<script type='text/javascript'>
            alert('AZIENDA [" . $nome_azienda . "] AGGIUNTA CON SUCCESSO AL DATABASE');
            window.location='../index.php';
        </script>";
    } else {
        echo "ERRORE NELL' AGGIUNTA DEL FORNITORE" . $mysqli->error;
    }
    $mysqli->close();
}
