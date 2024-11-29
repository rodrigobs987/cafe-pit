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
                    <a href="pedidos.php">MEUS PEDIDOS</a> | <a href="logout.php">SAIR</a>
                </p>
            </div>
            
            <img src="imagens/sacola.svg" alt="">            
        </div>
    </header>

    <main class="container">

        <div>
     
        <?php 

            $items = array(['imagem'=>'imagens/item1.svg','produto'=>'Café Constantino em grãos 500g','preco'=>'46.70'],
                        ['imagem'=>'imagens/item2.svg','produto'=>'Café Ninho da Águia em grãos 250g','preco'=>'51.90'],
                        ['imagem'=>'imagens/item3.svg','produto'=>'Café Fazenda em grãos 500g','preco'=>'56.70']);
                        
            foreach ($items as $key => $value){

        ?>

        <div  class="produto text-center">

            <img src="<?php echo $value['imagem']?>">
            <h5 class="card-subtitle"><?php echo $value['produto']?></h5>
            <a class="btn btn-danger" href="?remover=<?php echo $key ?>">-</a>
            <a class="btn btn-success" href="?adicionar=<?php echo $key ?>">+</a>

        </div>
        
        <?php 
            }
        ?>

        <?php

        if (isset($_GET['adicionar'])) {
            $idProduto = (int)$_GET['adicionar'];
            if (isset($items[$idProduto])) {
                if (isset($_SESSION['carrinho'][$idProduto])) {
                    $_SESSION['carrinho'][$idProduto]['quantidade']++;
                } else {
                    $_SESSION['carrinho'][$idProduto] = array('quantidade' => 1, 'produto' => $items[$idProduto]['produto'], 'preco' => $items[$idProduto]['preco']);
                }
            } else {
                die('Você não pode adicionar um item que não existe');
            }
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }

        if (isset($_GET['remover'])) {
            $idProduto = (int)$_GET['remover'];
            if (isset($items[$idProduto])) {
                if (isset($_SESSION['carrinho'][$idProduto])) {
                    $_SESSION['carrinho'][$idProduto]['quantidade']--;
                    // Remove o item do carrinho se a quantidade for zero ou menos
                    if ($_SESSION['carrinho'][$idProduto]['quantidade'] <= 0) {
                        unset($_SESSION['carrinho'][$idProduto]);
                    }
                } else {
                    $_SESSION['carrinho'][$idProduto] = array('quantidade' => 1, 'produto' => $items[$idProduto]['produto'], 'preco' => $items[$idProduto]['preco']);
                }
            } else {
                die('Você não pode remover um item que não existe');
            }
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }

        ?>


        </div>

        <div >

            <h2 class="produto">Carrinho</h2>

            <?php 
                $total = 0;
                foreach($_SESSION['carrinho'] as $key => $value){

                    echo "<p>".$value['quantidade']."x ".$value['produto']." valor: R$".($value['preco']*$value['quantidade'])."</p>";

                    $total += $value['preco'] * $value['quantidade'] ?? 0;

                    
                }

            ?>

            <form action="compra.php" method="get">
                <input type="hidden" name="total" value="<?php echo $total?>">
                Total: R$<?php echo number_format($total,2,',','.')?>
                <br>
                <input class="btn btn-danger btn-sm" type="submit" value="Comprar">
            </form>

        </div>

    </main>

    

</body>
</html>