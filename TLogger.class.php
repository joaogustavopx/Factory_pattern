<?php

/*Classe TLogger   
*clsse que provê uma interface para definição do algoritmo log
*/

abstract class TLogger{

    protected $filename; //local do arquivo de LOG

    /*método cronstrutor __construct()
    *instancia um logger
    *@param $filename - local do arquivo de LOG
    */

    public function __construct($filename){
    $this->filename = $filename;
    //reseta o conteudp do arquivo
    file_put_contents($this->filename,'');
    }

    //define o método write como obrigatorio
    abstract function write($message);
}

?>