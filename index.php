

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

    <main class="container text-center">

        <div class="row">
            <div class="col">
                <img src="imagens/bg-cafe.png" alt="xicara de café">
            </div>
            <div class="col" id="principal">
                <form action="" method="post">
                    <h2>Login</h2>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Usuário</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="senha" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Senha</label>
                    </div>

                    <?php 

                        include('conexao.php');

                        if(isset($_POST['email']) || isset($_POST['senha'])){

                            if(strlen($_POST['email']) == 0){
                                echo "Preencha seu e-mail";
                            }else if(strlen($_POST['senha']) == 0){
                                echo "Preencha sua senha";
                            }else{

                                $email = $mysqli->real_escape_string($_POST['email']);
                                $senha = $mysqli->real_escape_string($_POST['senha']);

                                $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
                                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ".$mysqli->error);

                                $quantidade = $sql_query->num_rows;

                                if($quantidade == 1){

                                    $usuario = $sql_query->fetch_assoc();

                                    if(!isset($_SESSION)){
                                        session_start();
                                    }

                                    $_SESSION['id'] = $usuario['id'];
                                    $_SESSION['nome'] = $usuario['nome'];

                                    header("Location: loja.php");
                                    
                                }else{
                                    echo "<p style=\"color:white;\">Falha ao logar! E-mail ou senha incorretos</p>";
                                }

                            }

                        }

                    ?>

                    <input type="submit" value="Entrar" class="btn btn-outline-light" id="logar">
                </form>
                <span>Novo Cliente? <a href="cadastrar.php">CADASTRE-SE</a></span>
            </div>
            <div class="col">
                <img src="imagens/bg-cafe.png" alt="xicara de café">
            </div>
        </div>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

