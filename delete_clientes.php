<?php

    include 'db.php';

    $id = $_GET['id'];

    $sql = "DELETE FROM clientes WHERE id=$id";
  
    
        if ($conn->query($sql) == true) {
        echo "Registro deletado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->$error;
    };

    $conn -> close();
    header("Location: create_usuarios.php");
    exit();

?>