<?php

// Função para o autoload das classes
spl_autoload_register(function ($classe) {
    if (file_exists("{$classe}.class.php")) {
        include_once "{$classe}.class.php";
    }
});

// Cria a instrução de SELECT 
$sql = new TSqlSelect;

// Define o nome da entidade
$sql->setEntity('famosos');

// Acrescenta colunas à consulta
$sql->addColumn('codigo');
$sql->addColumn('nome');

// Crio o critério de seleção 
$criteria = new TCriteria;

// Obtém a pessoa código '1'
$criteria->add(new TFilter('codigo', '=', '1'));

// Atribui o critério de seleção
$sql->setCriteria($criteria);

try {
    // Abre conexão com o banco de dados my_livro
    $conn = TConnection::open('my_livro');
    
    // Executa a instrução SQL
    $result = $conn->query($sql->getInstruction());

    if ($result) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        // Exibe os resultados
        echo $row['codigo'].' - '.$row['nome']."<br>\n";
    }

    // Fecha a conexão 
    $conn = null;
} catch (PDOException $e) {
    // Exibe a mensagem de erro
    print "ERRO!: " . $e->getMessage() . "<br>\n";
    die();
}

try {
    // Abre conexão com a base pg_livro
    $conn = TConnection::open('pg_livro');

    // Executa a instrução SQL
    $result = $conn->query($sql->getInstruction());

    if ($result) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        // Exibe os resultados
        echo $row['codigo'].' - '.$row['nome']."<br>\n";
    }

    // Fecha a conexão
    $conn = null; 
} catch (PDOException $e) {
    // Exibe a mensagem de erro
    print "ERRO!: ". $e->getMessage() . "<br>\n";
    die();
}
?>