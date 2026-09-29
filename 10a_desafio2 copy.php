<!-- Digite sua solução para o desafio (AQUI) -->
 <!DOCTYPE html>
 <html lang="pt-br">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validação de Produtos</title>
 </head>
 <body>
    <h2>Preencha o formulário abaixo:</h2>
     <form action="" method="post">
        <label for="nome">Nome do Produto:</label>
        <input type="text" name="nome" required> <br>

        <label for="preco">Preço do Produto:</label>
        <input type="number" step="0.01" name="preco" required><br><br>

        <button type="submit">Cadastrar</button><br>
</form>

<!-- Transição pro PHP  -->

<?php



 // Verificar se os dados foram enviados 
 if ($_SERVER['REQUEST_METHOD'] =='POST') {


 //Recebe os valores enviados pelo preenchimento do formulário
 $nome= $_POST['nome'];
 $preco= $_POST['preco'];

 //Verifica se o preço é menor q 0

 if (!empty($nome) && is_numeric($preco) && $preco >0) {

 //Inicia a conexão com o banco de dados exercicio

 $servername= "localhost";
 $username= "root";
 $password = "Senai@118";
 $dbname = "exercicio";

 //A variável conn serve para fazer a conexão em si com o banco de dados

 $conn = new mysqli($servername, $username, $password, $dbname);

 //Verifica a conexão
if($conn->connect_error) {
        die("Falha na conexão: " .  $conn->connect_error);
}

//Insere dados no banco de dados exercicio

$sql = "INSERT INTO produtos (nome, preco) VALUES ('$nome', '$preco')";


//Verifica se os dados foram cadastrados 
if ($conn->query($sql) === true) {
  

 // Redireciona para a própria página função header
                header('Location: ' . $_SERVER['PHP_SELF'] . '?sucesso=1');
                exit;
            

            } else { 
                echo "<p style='color: red;'>Erro ao cadastrar o produto.</p>"; 
            } 
    

} else {
   echo "<p id='msg' style='color: red;'>Erro ao cadastrar produto!</p>";
 }
 
}

//Aparece a mensagem de sucesso
if (isset($_GET['sucesso'])) {

        echo "<p style='color: Darkgreen;'>Produto cadastrado com sucesso!</p>";

        // Atualiza a página depois de 3 segundos
        header('Refresh: 3; url=' . $_SERVER['PHP_SELF']);
    }
?>
    
 </body>
 </html>