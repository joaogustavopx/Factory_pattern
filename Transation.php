<?php

//Carrega a classe para dentro da função
spl_autoload_register(function ($classe) {
    $filename = "{$classe}.class.php";
    if (file_exists($filename)) {
        include_once $filename;
    } else {
        throw new Exception("Classe {$classe} não encontrada.");
    }
});

try{
    //abre uma transação 
    TTransaction::open('my_livro');

    //cria uma instrução de INSERT 
    $sql = new TSqlInsert;

    //define o nome da entidade
    $sql->setEntity('famosos');

    //atribui o valor de cada coluna
    $sql->setRowData('codigo', 8);
    $sql->setRowData('nome', 'Galileu');

    //obtem conexão ativa 
    $conn = TTransaction::get();

    //excuta a instrução SQL
    $result = $conn->query($sql->getInstruction());

    //cria uma instrução UPDATE
    $sql = new TSqlUpdate;
    
    //define o valor da entidade
    $sql->setEntity('famosos');

    //atribui o valor a cada coluna
    $sql->setRowData('nome','Galileu Galilei');

    //cria um criterio de seleção de dados
    $criteria = new TCriteria;

    //obtem um codigo de seleção
    $criteria->add(new TFilter('codigo', '=', '8'));
    //atribui o criterio de seleção
    $sql-> setCriteria($criteria);

    //obtem a conexão ativa 
    $conn = TTransaction::get();

    //executa a instrução SQL
    $result = $conn->query($sql->getInstruction());
    
    //fecha a transação aplicando todas as operações
    TTransaction::close();

}
catch(Exception $e){
    //exibe a mensagem de erro
    echo $e->getMessage();
    //desfaz operações realizadas durante a transação
    TTransaction::rollback();
}

?>