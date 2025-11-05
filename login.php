<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BabyConect</title>
    <link rel="stylesheet" href="estiloCSS/login.css">
</head>
<body>
    <main>
        <h1 class="logo">Baby<span>Connect</span></h1>
        <form action="/login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Entrar</button>
        </form>
        <p>Não tem uma conta? <a href="cadastro.php">Registre-se aqui</a></p>
    </main>
</body>
</html>