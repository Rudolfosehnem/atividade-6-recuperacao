<?php

include 'db.php';

$id = $_GET['id'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $sql = "UPDATE clientes SET nome ='$nome', email = '$email', telefone = '$telefone' WHERE id = $id";

    if ($conn->query($sql) == true) {
        echo "Novo registro no Banco!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->$error;
    };

    $conn -> close();
    header("Location: create_usuarios.php");
    exit();

};

$sql = "SELECT * FROM clientes WHERE id=$id";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE Clientes</title>
</head>

<body>

    <form method="POST" action="update_clientes.php?id=<?php echo $row['id'];?>">

        <label for="Nome">Nome:</label>
        <input type="text" name="nome" required value="<?php echo htmlspecialchars($row['nome']); ?>">
        <br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required value="<?php echo htmlspecialchars($row['email']); ?>">
        <br><br>
        <label for="telefone">Telefone:</label>
        <input type="number" name="telefone" required value="<?php echo htmlspecialchars($row['telefone']); ?>">
        <br><br>

        <input type="submit" name="create" value="Atualizar"><br><br>

    </form>

    <div id="tabela-de-consulta">

    <?php

        include 'read_clientes.php';

    ?>  

    </div>

</body>

</html>