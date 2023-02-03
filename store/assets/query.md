# ESERCITAZIONE ESAME SQL

## QUERY PER LA CREAZIONE DELLE TABELLE

---

#### TABELLA CLIENTI

    CREATE TABLE `albertone_store`.`cliente` ( `id` INT NOT NULL AUTO_INCREMENT , `nome` VARCHAR(50) NOT NULL , `cognome` VARCHAR(50) NOT NULL , `data_nascita` DATE NOT NULL , `regione_residenza` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

---

#### TABELLA FATTURE

    CREATE TABLE `albertone_store`.`fattura` ( `id` INT NOT NULL AUTO_INCREMENT , `tipologia` VARCHAR(50) NOT NULL , `importo` DOUBLE NOT NULL , `iva` INT NOT NULL , `id_cliente` INT NOT NULL , `data_fattura` DATE NOT NULL , `id_fornitore` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

---

#### TABELLA PRODOTTI

    CREATE TABLE `albertone_store`.`prodotto` ( `id_prodotto` INT NOT NULL , `descrizione` VARCHAR(300) NOT NULL , `in_produzione` BOOLEAN NOT NULL , `in_commercio` BOOLEAN NOT NULL , `data_attivazione` DATE NOT NULL , `data_disattivazione` DATE NOT NULL ) ENGINE = InnoDB;

---

#### TABELLA FORNITORI

    CREATE TABLE `albertone_store`.`fornitore` ( `id_fornitore` INT NOT NULL AUTO_INCREMENT , `denominazione` VARCHAR(50) NOT NULL , `regione_residenza` VARCHAR(50) NOT NULL , PRIMARY KEY (`id_fornitore`)) ENGINE = InnoDB;

---

## QUERY IN CUI SI RICERCANO NOME E COGNOME DEI CLIENTI NATI NEL 1982

    SELECT nome,cognome
    FROM cliente
    WHERE YEAR(data_nascita)=1982;

## QUERY DOVE VENGONO RICERCATI CLIENTI RESIDENTI IN LOMBARDIA CON ESTRAZIONE DI UNA COL "DENOMINAZIONE" CONTENTENTE " NOME - COGNOME"

    SELECT CONCAT(cliente.nome," - ",cliente.cognome) AS denominazione,regione.nome as regione
    FROM cliente
    INNER JOIN regione
    ON cliente.regione_residenza=regione.id_regione
    WHERE regione.nome="Lombardia";

## QUERY IN CUI SI RICERCA IL TOTALE DELLE FATTURE EMESSE E LA SOMMA DEGLI IMPORTI DIVISI PER ANNO DI FATTURAZIONE

    SELECT count(iva) as iva_22
    FROM fattura
    WHERE iva = 22;

## QUERY IN CUI SI RIPORTA IL NUMERO DI FATTURE E LA RELATIVA SOMMA DEGLI IMPORTO DIVISI PER ANNO

    SELECT YEAR(data_fattura) as anno_fatturazione,SUM(importo) as totale
    FROM fattura
    GROUP BY anno_fatturazione;

## QUERY IN CUI SI RICERCANO I PRODOTTI ATTIVATI NEL 2017 E CHE SONO IN PRODUZIONE OPPURE IN COMMERCIO

    SELECT prodotto.descrizione, YEAR(data_attivazione) AS anno_attivazione
    FROM prodotto
    WHERE YEAR(data_attivazione) = 2017 AND
    (in_produzione=1 OR in_commercio = 1) AND
    !(in_produzione=1 AND in_commercio=1);

## QUERY IN CUI SI RICERCA IL TOTALE DI FATTURE CON L'IVA AL 22% OGNI ANNO

    SELECT YEAR(data_fattura), COUNT(iva)
    FROM fattura
    WHERE iva=22
    GROUP BY YEAR(data_fattura);

## RIPORTARE L'ELENCO DELLE FATTURE (numero, importo, iva e data) CON IN AGGIUNTA IL NOME DEL FORNITORE

    SELECT fornitore.denominazione as nome_fornitore,fattura.id as numero_fattura, fattura.importo, fattura.iva, fattura.data_fattura
    FROM fattura
    INNER JOIN fornitore
    ON fattura.id_fornitore=fornitore.id_fornitore;
