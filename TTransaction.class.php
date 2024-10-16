<?php

/*Classe TTransaction
*Essa classe provê métodos necessarios para manipular transações
*/

final class TTransaction{
    private static $conn; //conexão ativa
    private static $logger;
/*método __construct()
*Está declarado como private para impedor que se crie instancias de TTransaction
*/

private function __construct(){}
    /*Método open()
    *Abre uma transação e conexão com o BD
    *@param $database = nome do banco de dados
    */

    public static function open($database){
        //abre uma conexão no banco de dados e armazena na propriedade estatica $conn
        if(empty(self::$conn)){
            self::$conn = TConnection::open($database);
            //desliga o log do SQL
            self::$logger = NULL;
        }
    }

    /*Método get()
    *retorna a conexão ativa transação
    */

    public static function get(){
    //retorna a conexão ativa
    return self::$conn;
    }

    /*Método rollback
    *Desfaz as operações realizadas na transação
    */

    public static function rollback(){
    if(self::$conn){
        //desfaz as operações durante a transação

        self::$conn->rollback();
        self::$conn = null;
        }
    }
    /*método setLogger()
    *define a estrategia (algoritmo do log a ser utilizado)
    */

    public static function setLogger(TLogger $logger){
        self::$logger = $logger;
    }
    /*Método Log
    *armazena uma mensagem no arquivo de LOG
    *baseada na estrategia ($logger) atual
    */

    public static function log($message){
    //verifica se existe um Logger
    if(self::$logger){
        self::$logger->write($message);
    }
    }

    /*Método close()
    *aplica todas as operações realizadas e fecha a transação
    */
    public static function close(){
        if(self::$conn){
        //aplica as operações realizadas duranante a transação
        self::$conn->commit();
        self::$conn = null;
        }
    }
}

?>