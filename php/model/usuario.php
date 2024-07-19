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
    }



?>