<?php
$dbHost='localhost';
$dbUsername='root';
$dbPassword='alunolab';
$dbName='concessionaria';
$conexao=new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

if ($conexao->connect_errno) {
    die("Erro na conexão: " . $conexao->connect_error);
}

if (isset($_POST['submit'])) {

    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $cor = $_POST['cor'];
    $quilometragem = $_POST['quilometragem'];
    $preco = $_POST['preco'];
   
    $sql = "INSERT INTO carros
            (marca,modelo,ano,cor,quilometragem,preco)
            VALUES
            ('$marca','$modelo','$ano','$cor','$quilometragem','$preco')";

    $result = mysqli_query($conexao, $sql);
    if ($result) {
        echo "Carro cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }
}
/* VOLTAR  */

if (isset($_POST["voltar"])) {
    $id = $_POST["idcarro"];
    if ($id == "") {

    $sql = "SELECT * FROM carros ORDER BY idcarro DESC LIMIT 1";
    } else {
    $sql = "SELECT * FROM carros WHERE idcarro < $id ORDER BY idcarro DESC LIMIT 1";
    }

    $resultado = $conexao->query($sql);
    if ($resultado->num_rows > 0) {

        $carro = $resultado->fetch_assoc();
        $idcarro = $carro["idcarro"];
        $marca = $carro["marca"];
        $modelo = $carro["modelo"];
        $ano = $carro["ano"];
        $cor = $carro["cor"];
        $quilometragem = $carro["quilometragem"];
        $preco = $carro["preco"];

    } else {
        echo "Não existe cadastro de carro anterior.";
    }
}

/* PRIMEIRO ACESSO */

if (!isset($idcarro)) {

    $idcarro = "";
    $marca = "";
    $modelo = "";
    $ano = "";
    $cor = "";
    $quilometragem = "";
    $preco = "";
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carros 🏎️</title>
</head>
<body>
     <div id="geral">
        <header>
            <h1>Concessionária 🏎️</h1>
            <p>Os melhores carros te esperam aqui!</p>
        </header>
        <main>
        <div id="cadastro">
            <h1>Cadastro de carros</h1>
            <p>Insira as informações necessárias</p>
            <form action="carros.php" method="post">
            <input type="hidden" name="idcarro" value="<?php echo $idcarro; ?>">
            <div id="campo">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" placeholder="Digite aqui a marca do carro" name="marca" value="<?php echo $marca; ?>">
            </div>
            <div id="campo">
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" placeholder="Digite aqui o modelo do carro" name="modelo" value="<?php echo $modelo; ?>">
            </div>
            <div id="campo">
                <label for="ano">Ano:</label>
                <input type="text" id="ano" placeholder="Digite aqui o ano do carro" name="ano" value="<?php echo $ano; ?>">
            </div>
            <div id="campo">
                <label for="cor">Cor:</label>
                <input type="text" id="cor" placeholder="Digite aqui a cor do carro" name="cor" value="<?php echo $cor; ?>">
            </div>
            <div id="campo">
                <label for="quilometragem">Quilometragem:</label>
                <input type="text" id="quilometragem" placeholder="Digite aqui a quilometragem do carro" name="quilometragem" value="<?php echo $quilometragem; ?>">
            </div>
            <div id="campo">
                <label for="preco">Preço:</label>
                <input type="text" id="preco" placeholder="Digite aqui o preço do carro" name="preco" value="<?php echo $preco; ?>">
            </div>
            <input type="submit" name="submit" value="Cadastrar">
            <button type="reset">Limpar 🧹</button>
            <button type="submit"name="voltar"> ◀️ Voltar </button>
            <a href="index.html">Voltar para o ínicio 🏠</a>
            <footer>Concessionária &copy; 2026 - Todos os direitos reservados</footer>
        </div>
        </form>
        </main>
</body>
</html>
<?php
$conexao->close();
?>
