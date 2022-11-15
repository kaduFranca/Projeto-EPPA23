<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar email no banco de dados</title>
</head>
<body>
    <?php
        include_once("conecta.php");//Conexao banco de dados.
        $post = filter_input_array(INPUT_POST,FILTER_DEFAULT);//Pegando nome e email do interessado e guardando em um vetor.
        if (!empty($post['nome'] and $post['email'])){//Verifica se email e nome foram preenchidos.
            $nome = $post['nome'];//Pegando nome salvo no vetor e salvando em uma variavel.
            $email = $post['email'];//Pegando email salvo no vetor e salvando em uma variavel.
            $sql = "insert into registros (nome, email) values ('$nome','$email');";//Criando comando sql.
            $con->query($sql);//Usando comando sql para salvar os dados no banco atraves do metodo query() da classe sqli.
            header("location: ../index.html");//Retorna para a página principal, após enviar o e-mail.
        }
    ?>
</body>
</html>