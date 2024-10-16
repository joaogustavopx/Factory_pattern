<?php

spl_autoload_register(function ($classe) {
    $filename = "{$classe}.class.php";
    if (file_exists($filename)) {
        include_once $filename;
    } else {
        throw new Exception("Classe {$classe} não encontrada.");
    }
});

try{
    //abre uma conexão
    TTransaction::open('pg_livro');

    //define a estrategia de LOG
    TTransaction::setLogger(new LoggerHTML('tmp/arquivo.html'));
    //escreve a mensagem de log
    TTransaction::log("Inserido registro de William Wallace");

    //cria uma instrução SQL
    $sql = new TSqlInsert;
    //define o nome da entidade 
    $sql->setEntity('famosos');
    //atribui o valor da coluna
    $sql->setRowData('codigo', 9);
    $sql->setRowData('nome', 'William Wallace');

    //obtem a conexão ativa
    $conn = TTransaction::get();
    //executa a instrução sql
    $result = $conn->Query($sql->getInstruction());
    //escreve a mensagem de log
    TTransaction::log($sql->getInstruction());

}


?>