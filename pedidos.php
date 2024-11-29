<?php 

    include('protect.php');
    include('conexao.php');

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
        
        section div{
            border: 1px solid black;
            margin: 10px;
            padding: 5px;
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

        <!-- Seção para exibir pedidos -->
        <section>
            <h2>Meus Pedidos</h2>
            <?php

                $usuario_id = $_SESSION['id'];

                // Consulta para obter os pedidos do usuário
                $sqlSelecionarPedidos = "SELECT * FROM pedidos WHERE usuario_id = '$usuario_id'";
                $resultPedidos = $mysqli->query($sqlSelecionarPedidos);
                
                // Verificar se houve erro na execução da consulta
                if (!$resultPedidos) {
                    echo "Erro na consulta: " . $mysqli->error;
                } else {
                    // Verificar se há pedidos
                    if ($resultPedidos->num_rows > 0) {
                        while ($row = $resultPedidos->fetch_assoc()) {
                            // Exibir os detalhes do pedido
                            echo "<div>";
                            echo "<p>ID do Pedido: " . $row['id'] . " | ";
                            echo "Endereço: " . $row['endereco'] . " | ";
                            echo "Número: " . $row['numero'] . " | ";
                            echo "CEP: " . $row['cep'] . "|";
                            echo "Cidade: " . $row['cidade'] . " | ";
                            echo "UF: " . $row['uf'] . " | ";
                            echo "Bairro: " . $row['bairro'] . " | ";
                            echo "Valor Total: R$ " . number_format($row['valor_total'], 2, ',', '.') . "</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>Nenhum pedido encontrado.</p>";
                    }
                }
                
                // Fechar a conexão
                $mysqli->close();
                
            ?>
        </section>

        <a class="btn btn-dark" href="loja.php">Voltar para pagina inicial</a>

    </main>

</body>    
</html>