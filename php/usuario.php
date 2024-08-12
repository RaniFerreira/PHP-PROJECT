<?php

    class Usuario{

        public function addUsuario($email, $nome, $senha){

            try{
                $sql = "INSERT INTO usuario values (?,?,?,?,?,?)";
                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt -> bindValue(1,$email);
                $stmt -> bindValue(2,md5($email));
                $stmt -> bindValue(3,$nome);
                $stmt -> bindValue(4,$senha);
                $stmt -> bindValue(5,date('y-m-d'));
                $stmt -> bindValue(6,'padrao.jpg');
                $stmt -> execute();

                return 'Usuario cadastrado com sucesso!';
            }catch (PDOException $ex){
                if($ex->errorInfo[1] == 1062){
                    return 'Usuario já existente';
                }else{
                    return 'Erro ao cadastrar usuário';
                }
            }
        }

        public function validarUsuario($email, $senha){

            try{
                $sql = "SELECT * FROM usuario WHERE email=? AND senha=?";
                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt -> bindValue(1,$email);
                $stmt -> bindValue(2,$senha);
                $stmt -> execute();
                $result = $stmt->rowCount();

                return $result;
            }catch (PDOException $ex){
                return false;
            }
        }

        public function recebeUsuario($email) {
            try {
                $sql = "SELECT * FROM usuario WHERE email = ?";
                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt->bindValue(1, $email, PDO::PARAM_STR); // associa o valor ao primeiro placeholder
        
                $stmt->execute();
        
                if ($stmt->rowCount() > 0) {
                    $result = $stmt->fetch(PDO::FETCH_BOTH);
                    return $result;
                }
                return false;
            } catch (PDOException $ex) {
                // Aqui você pode registrar o erro para fins de depuração
                error_log("Erro ao buscar usuário: " . $ex->getMessage());
                return false;
            }
        }

        public function recebeUsuarioPorCampo($campo, $valor) {
            try {
                $sql = "SELECT * FROM usuario WHERE $campo like  '%$valor'";
                $stmt = Conexao::getConexao()->prepare($sql);
        
                $stmt->execute();
        
                if ($stmt->rowCount() > 0) {
                    $result = $stmt->fetchAll(PDO::FETCH_BOTH);
                    return $result;
                }
                return false;
            } catch (PDOException $ex) {
                return false;
            }
        }

        public function recebeUsuarios() {
            try {
                $sql = "SELECT * FROM usuario";
                $stmt = Conexao::getConexao()->prepare($sql);
        
                $stmt->execute();
        
                if ($stmt->rowCount() > 0) {
                    $result = $stmt->fetch(PDO::FETCH_BOTH);
                    return $result;
                }
                return false;
            } catch (PDOException $ex) {
                // Aqui você pode registrar o erro para fins de depuração
                error_log("Erro ao buscar usuário: " . $ex->getMessage());
                return false;
            }
        }
        
    }

   




?>