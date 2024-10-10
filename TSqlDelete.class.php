<?php

/*classe delete
*essa classe provê maios para manipulação de uma instrução de DELETE no BD
*/

final class TSqlDelete extends TSqlInstruction{

    /*Método getInstruction()
    *retorna a instrução de Delete em forma de string
    */

    public function getInstruction(){
        //monta a string do DELETE
        $this->sql = "DELETE FROM {$this->entity}";

        //retorna a clausula WHERE do objeto $this->criteria
        if($this->criteria){
            
            $expression = $this->criteria->dump();

            if($expression){
                $this->sql .= 'WHERE' . $expression;
            }

            return $this->sql;
        }
    }
}

?>