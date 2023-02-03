<?php
//CLIENTE
if (isset($_POST['removeCustomer'])) {
    require 'dbconnection.php';
    //SANIFICAZIONE VALORI DEL CLIENTE
    $id_user = htmlspecialchars($_POST['customer_id']);
    //PREVENZIONE MYSQL INJECTION
    $id_user = $mysqli->real_escape_string($id_user);
    //QUERY
    $query = "DELETE FROM fattura WHERE id_cliente ='$id_user'";
    if ($mysqli->query($query)) {
        echo "<script type='text/javascript'>
            alert('FATTURE ELIMINARE CON SUCCESSO');
        </script>";
        $query2 = "DELETE FROM cliente WHERE id='$id_user'";
        if ($mysqli->query($query2)) {
            echo "<script type='text/javascript'>
            alert('CLIENTE ELIMINATO CON SUCCESSO');
        window.location = '../index.php';
        </script>";
        }
    } else {
        echo "ERRORƎ NELLA RIMOZIONE DELL' UTENTE" . $mysqli->error;
    }
    $mysqli->close();
}

//FATTURA
if (isset($_POST['removeInvoice'])) {
    require 'dbconnection.php';
    //SANIFICAZIONE VALORI DEL CLIENTE
    $id_invoice = htmlspecialchars($_POST['invoice_id']);
    //PREVENZIONE MYSQL INJECTION
    $id_invoice = $mysqli->real_escape_string($id_invoice);
    //QUERY
    $query = "DELETE FROM fattura where id='$id_invoice'";
    if ($mysqli->query($query)) {
        echo "<script type='text/javascript'>
            alert('FATTURA RIMOSSA CON SUCCESSO');
            window.location='../index.php';
        </script>";
    } else {
        echo "ERRORE NELLA RIMOZIONE DELLA FATTURA" . $mysqli->error;
    }
    $mysqli->close();
} else if (isset($_POST['abortRemoveInvoice'])) {
    echo "<script type='text/javascript'>
            window.location='../page/print.php?function_print=fattura';
        </script>";
}

//PRODOTTO
if (isset($_POST['removeProduct'])) {
    require 'dbconnection.php';
    //SANIFICAZIONE VALORI DEL CLIENTE
    $id_product = htmlspecialchars($_POST['product_id']);
    //PREVENZIONE MYSQL INJECTION
    $id_product = $mysqli->real_escape_string($id_product);
    //QUERY
    $query = "DELETE FROM prodotto WHERE id_prodotto='$id_product'";
    if ($mysqli->query($query)) {
        echo "<script type='text/javascript'>
            alert('PRODOTTO RIMOSSO CON SUCCESSO DAL DATABASE');
            window.location='../index.php';
        </script>";
    } else {
        echo "ERRORE NELLA RIMOZIONE DEL PRODOTTO" . $mysqli->error;
    }
    $mysqli->close();
} else if (isset($_POST['abortRemoveProduct'])) {
    echo "<script type='text/javascript'>
            window.location='../page/print.php?function_print=prodotto';
        </script>";
}

//FORNITORE
if (isset($_POST['removeSupplier'])) {
    require 'dbconnection.php';

    //SANIFICAZIONE VALORI DEL CLIENTE
    $id_supplier = htmlspecialchars($_POST['supplier_id']);
    //PREVENZIONE MYSQL INJECTION
    $id_supplier = $mysqli->real_escape_string($id_supplier);
    //QUERY
    $query = "DELETE FROM fattura WHERE id_fornitore ='$id_supplier'";
    if ($mysqli->query($query)) {
        echo "<script type='text/javascript'>
            alert('FATTURE ELIMINATE CON SUCCESSO');
        </script>";
        $query2 = "DELETE FROM fornitore WHERE id_fornitore='$id_supplier'";
        if ($mysqli->query($query2)) {
            echo "<script type='text/javascript'>
            alert('FORNITORE ELIMINATO CON SUCCESSO');
        window.location = '../index.php';
        </script>";
        }
    } else {
        echo "ERRORƎ NELLA RIMOZIONE DEL FORNITORE  " . $mysqli->error;
    }
    $mysqli->close();
}
