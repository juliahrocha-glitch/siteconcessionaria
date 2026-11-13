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

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cidade = $_POST['cidade'];
    $endereco = $_POST['endereco'];
   
    $sql = "INSERT INTO clientes
            (nome,cpf,email,telefone,cidade,endereco)
            VALUES
            ('$nome','$cpf','$email','$telefone','$cidade','$endereco')";

    $result = mysqli_query($conexao, $sql);
    if ($result) {
        echo "Cliente cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }
}
/* VOLTAR  */

if (isset($_POST["voltar"])) {
    $id = $_POST["idcliente"];
    if ($id == "") {

    $sql = "SELECT * FROM clientes ORDER BY idcliente DESC LIMIT 1";
    } else {
    $sql = "SELECT * FROM clientes WHERE idcliente < $id ORDER BY idcliente DESC LIMIT 1";
    }

    $resultado = $conexao->query($sql);
    if ($resultado->num_rows > 0) {

        $cliente = $resultado->fetch_assoc();
        $idcliente = $cliente["idcliente"];
        $nome = $cliente["nome"];
        $cpf = $cliente["cpf"];
        $email = $cliente["email"];
        $telefone = $cliente["telefone"];
        $cidade = $cliente["cidade"];
        $endereco = $cliente["endereco"];

    } else {
        echo "Não existe cadastro de cliente anterior.";
    }
}

/* PRIMEIRO ACESSO */

if (!isset($idcliente)) {

    $idcliente = "";
    $nome = "";
    $cpf = "";
    $email = "";
    $telefone = "";
    $cidade = "";
    $endereco = "";
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes 😉</title>
</head>
<body>
        <div id="geral">
        <header>
            <h1>Concessionária 🏎️</h1>
            <p>Os melhores carros te esperam aqui!</p>
        </header>
        <main>
        <div id="cadastro">
            <h1>Cadastro de clientes 😀</h1>
            <p>Insira as informações necessárias</p>
            <form action="clientes.php" method="post">
            <input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">
            <div id="campo">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" placeholder="Digite aqui o nome do cliente" name="nome" value="<?php echo $nome; ?>">
            </div>
            <div id="campo">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" placeholder="Ex: 000.000.000-00" name="cpf" value="<?php echo $cpf; ?>">
            </div>
            <div id="campo">
                <label for="email">E-mail:</label>
                <input type="email" id="email" placeholder="Digite aqui o e-mail do cliente" name="email" value="<?php echo $email; ?>">
            </div>
            <div id="campo">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" placeholder="Ex: (00) 00000-0000" name="telefone" value="<?php echo $telefone; ?>">
            </div>
            <div id="campo">
                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" placeholder="Digite aqui a cidade do cliente" name="cidade" value="<?php echo $cidade; ?>">
            </div>
            <div id="campo">
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" placeholder="Digite aqui o endereço do cliente" name="endereco" value="<?php echo $endereco; ?>">
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