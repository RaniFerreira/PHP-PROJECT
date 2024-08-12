<?php

    class Lista {

        public function addLista ($email, $descricao){

            try{
                $sql = "INSERT INTO lista VALUES  (?,?,?)";
                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt -> bindValue(1, '0');
                $stmt -> bindValue(2, $descricao);
                $stmt -> bindValue(3, $email);

                $stmt->execute();

                return true;
            }
            catch (PDOException $ex){
                return false;
            }
        }

        public function removeLista ($email){

            try{
                $sql = "DELETE FROM lista WHERE usuario= ?";
                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt -> bindValue(1, $email);

                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return 'LISTA EXCLUÍDA';    
                }
                else{
                    return 'NENHUMA LISTA EXCLUIDA';
                }
            }
            catch (PDOException $ex){
                return 'ERRO AO EXCLUIR LISTA';
            }
        }

        public function getLista ($email){

            try{
                $sql = "SELECT * FROM lista WHERE usuario= ?";
                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt -> bindValue(1, $email);

                $stmt->execute();

                if($stmt->rowCount() > 0){
                    $result = $stmt -> fetch(PDO::FETCH_BOTH);
                    return $result;    
                }
                
                    return false;
                
            }
            catch (PDOException $ex){
                return false;
            }
        }
    }


?>