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

        public function getLista($email){

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

        public function addItem($email, $produto){
            try{
                $lista = $this->getLista($email);
                if(!$lista){
                    return 'Lista não encontrada';
                }

                $sql = "INSERT INTO item VALUES (?,?";
                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt ->bindValue(1, $lista['codigo']);
                $stmt ->bindValue(2, $produto);
                $stmt -> execute();

                return 'produto adicionado á lista';
                
            }
            catch(PDOException $ex){
                if($ex->errorInfo[1] == 1062){
                    return 'produto já adicionado á lista';
                }else{
                    return 'Produto não adicionado';
                }
            }
        }

        public function removeItem($lista,$produto){
            try{
                $sql = "DELETE FROM item WHERE lista_codigo = ? AND produto_codigo = ?";
                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt -> bindValue(1, $lista);
                $stmt -> bindValue(2, $produto);

                $stmt->execute();

                if($stmt->rowCount() > 0){
                    return "Item excluido!";
                }
                else{
                    return "Nenhum item removido!";
                }
            }
            catch(PDOException $ex){
                return "Erro ao excluir item!";
            }
        }

        public function getItens($lista){
            try{
                $sql = "SELECT produto.codigo, produto.nome 
                FROM produto 
                INNER JOIN item ON item.produto_codigo = produto.codigo 
                INNER JOIN lista ON item.lista_codigo = lista.codigo 
                WHERE lista.codigo = ?";

                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt -> bindValue(1, $lista);

                $stmt->execute();

                if($stmt->rowCount()>0){
                    $result = $stmt->fetchAll(PDO::FETCH_BOTH);
                    return $result;
                }
                return false;
        
            }
            catch(PDOException $ex){
                return false;
            }
        }

        public function getItensUsuario($email){
            try{
                $sql = "SELECT produto.produto, produto.nome, lista.descricao 
                FROM produto 
                INNER JOIN item ON item.produto_codigo = produto.codigo 
                INNER JOIN lista ON lista.codigo = item.lista_codigo 
                WHERE usuario.email = ?";

                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt -> bindValue(1, $email);

                $stmt->execute();

                if($stmt->rowCount()>0){
                    $result = $stmt->fetchAll(PDO::FETCH_BOTH);
                    return $result;
                }
                return false;
            }
            catch(PDOException $ex){
                return false;
            }
        }
    }


?>