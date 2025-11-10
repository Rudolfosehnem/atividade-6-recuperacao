<?php
session_start();
include 'db.php';

$erro = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);

    
    $stmt = $conn->prepare("SELECT * FROM clientes WHERE nome = ? AND email = ? AND telefone = ?");
    $stmt->bind_param("sss", $nome, $email, $telefone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['telefone'] = $row['telefone'];
        header('Location: index.php');
        exit();
    } else {
        $erro = "Nome, email ou telefone estão incorretos";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Usuário</title>
</head>
<body>
<?php if (!isset($_SESSION['nome'])): ?>
    <h2>Login</h2>
    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" required><br><br>

        <input type="submit" value="Entrar">
    </form>

    <?php if ($erro): ?>
        <p style="color:red;"><?php echo htmlspecialchars($erro); ?></p>
    <?php endif; ?>

<?php else: ?>
    <h2>Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</h2>
    <p>Telefone: <?php echo htmlspecialchars($_SESSION['telefone']); ?></p>

    <a href="create_produtos.php"><button>Cliente</button></a>
    <a href="create_usuarios.php"><button>Usuários</button></a>

    <form method="POST" action="logout.php" style="display:inline;">
        <button type="submit">Sair</button>
    </form>
<?php endif; ?>
</body>
</html>
