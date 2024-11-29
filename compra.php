<?php 

    include('protect.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Café Online - Compre seu café aqui</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos/loja.css">
    <style>
        .produto{
            width: 200px;
            margin: 20px;
        }
        .container{
            display: flex;
            justify-content: space-between;
        }
        form input {
            margin: 10px;
        }
        #container{
            display: flex;
            justify-content: space-around;
        }
        #pagamento,#endereco {
            background-color: #380707;
            color: white;
            width: 450px;
            margin: 20px;
            padding: 30px;
        }
        #endereco p{
            margin: 0;
            text-align: right;
        }
        input{
            border-radius: 10px;
            width: 200px;
            margin: 0;
        }
    </style>
</head>
<body>

    <header id="nav">
        <div>
            <h1>Café online</h1>
        </div>
        <div id="nav-usuario">
            <div>
                <p>Olá, <?php echo $_SESSION['nome'] ?> </p>
                
                <p>
                    <a href="pedidos.php">MEUS PEDIDOS </a> | <a href="logout.php">SAIR</a>
                </p>
            </div>
            
            <img src="imagens/sacola.svg" alt="">            
        </div>
    </header>

    <main>
        <?php 
            $valorTotal = number_format($_GET['total'],2,'.',',') ?? 0;
        ?>    
            
        <form id="container" action="" method="post">

            <section class="text-center" id="pagamento">

                <h2>Forma de pagamento</h2>
                <hr>
                <h3>PIX</h3>
                <div id="pix">
                    <p>Valor total: <?php echo $valorTotal?></p>
                    <img src="imagens/qrcode.png" width="150">
                </div>


            </section>

            <section class="text-center" id="endereco">

                <h2>Adicionar endereço</h2>
                <hr>

                <div class="">
    
                <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['id']; ?>">
                <input type="hidden" name="valor_total" value="<?php echo $valorTotal; ?>">

                <p>Endereço: <input type="text" name="endereco" id="" required></p>
                <p>Numero:<input type="number" name="numero" id="" required></p>
                <p>CEP: <input type="text" name="cep" id="" required></p>
                <p>Cidade: <input type="text" name="cidade" id="" required></p> 
                <p>UF: <input type="text" name="uf" id="" required></p>
                <p>Bairro: <input type="text" name="bairro" id="" required></p>
                </div>

            </section>

            <input class="btn btn-danger btn" type="submit" value="FINALIZAR COMPRA">

        </form>

        
        <?php 
        
            include('conexao.php');

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $usuario_id = $_POST["usuario_id"];
                $endereco = $_POST["endereco"];
                $numero = $_POST["numero"] ?? '';
                $cep = $_POST["cep"];
                $cidade = $_POST["cidade"];
                $uf = $_POST["uf"];
                $bairro = $_POST["bairro"];
                $valor_total = $_POST["valor_total"];
            
                include('conexao.php');
            
                $sqlInserirPedido = "INSERT INTO pedidos (usuario_id, endereco, numero, cep, cidade, uf, bairro, valor_total) VALUES ('$usuario_id', '$endereco', '$numero', '$cep', '$cidade', '$uf', '$bairro', '$valor_total')";
            
                if ($mysqli->query($sqlInserirPedido) === TRUE) {
                    header("Location: pedidos.php");
                } else {
                    echo "Erro ao cadastrar o pedido: " . $mysqli->error;
                }
            
                $mysqli->close();
            }
            ?>

        ?>

        


    </main>

</body>
</html>