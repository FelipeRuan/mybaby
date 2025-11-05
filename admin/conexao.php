<?php
    $tipo_banco = "mysql";
    $servidor= "localhost";
    $porta = 3306;
    $usuario = "admin";
    $senha = "admin";
    $banco = "babyconect";

    $dsn = "$tipo_banco:host=$servidor;dbname=$banco;port=$porta";

    try{
        $pdo = new PDO($dsn, $usuario, $senha);
    } catch (PDOException $erro){
        throw new PDOException($erro->getMessage(),$erro->getCode());
    }   
?>