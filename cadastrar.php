<?php
// Conexão com o banco de dados
$conexao = mysqli_connect("localhost", "root", "", "login");

if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = mysqli_real_escape_string($conexao, $_POST["nome"]);
    $email = mysqli_real_escape_string($conexao, $_POST["email"]);
    $senha = mysqli_real_escape_string($conexao, $_POST["senha"]);

     // Verifica se o e-mail já está cadastrado
     $verifica_email = "SELECT * FROM usuarios WHERE email='$email'";
     $resultado_email = mysqli_query($conexao, $verifica_email);
 
     if (mysqli_num_rows($resultado_email) > 0) {
         echo "<script> alert(\"E-mail já está em uso. Escolha outro e-mail.\")</script>";
     } else {
         // Insere o usuário no banco de dados
         $query = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
 
         if (mysqli_query($conexao, $query)) {
             echo "Usuário registrado com sucesso!";
             header("Location: index.php");
         } else {
             echo "Erro ao registrar o usuário: " . mysqli_error($conexao);
         }
     }

}

mysqli_close($conexao);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Café Online - Faça seu login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos/login.css">

</head>
<body>
    
    <header class="text-center">
        <h1>Café Online</h1>
    </header>

    <main class="container text-center" id="principal">

        <form action="" method="post">
            <h2>Criar Conta</h2>
            <div class="form-floating">
                <input type="text" name="nome" class="form-control" id="floatingInputValue" required>
                <label for="floatingInputValue">Nome Completo*</label>
            </div>
            
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInputValue" required>
                <label for="floatingInputValue">E-mail*</label>
            </div>
            
            <div class="form-floating">
                <input type="password" name="senha" class="form-control" id="floatingInputValue" required>
                <label for="floatingInputValue">Senha*</label>
            </div>


            <input type="submit" value="Cadastrar" class="btn btn-outline-light" id="logar">
        </form>
        <span>voltar para a página de <a href="index.php">LOGIN</a></span>

    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>