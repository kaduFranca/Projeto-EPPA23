<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviando email</title>
</head>
    <body>
        <?php
            //Inicio pegando email, nome e mensagem do usuario.
            $nome = $_POST["nome"];
            $mail = $_POST["mail"];
            $msg = $_POST["comentario"];
            //Fim pegando email, nome e mensagem do usuario.
            
            //Inicio importacao da biblioteca
            require_once "src/PHPMailer.php";
            require_once "src/SMTP.php";
            require_once "src/Exception.php";

            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\SMTP;
            use PHPMailer\PHPMailer\Exception;
            //Fim importacao da biblioteca
            
            $email = new PHPMailer();//Criando objeto email

            //Definindo atributos do objeto email
            try {
                //$email -> SMTPDebug = SMTP::DEBUG_SERVER; //linha de código para mostrar informacoes de debug, retirar comentario e definir parametro do objeto email como true e retirar o comando de retornar pagina principal, caso necessário visualizar log.
                
                //Inicio atributos responsaveis por logar a conta de email
                $email -> isSMTP();
                $email -> Host = 'smtp.gmail.com';
                $email -> SMTPAuth = true;
                $email -> Username = 'eppacoelho@gmail.com';
                $email -> Password = 'kpfdxwzlcsdfdioh';
                $email -> Port = 587;
                //Inicio atributos responsaveis por logar a conta de email

                //Inicio atributos responsaveis por definir as informacoes de DE: PARA: e CC:
                $email -> setFrom($mail);//Deveria receber como parametro o email do formulario e mostrar como DE:, mas não funcionou
                $email -> addAddress('giovanisousa@outlook.com.br');//Aqui será inserido o email do EPPA que ainda será criado
                $email -> addReplyTo($mail, $nome);
                $email -> addCC($mail);
                //Fim atributos responsaveis por definir as informacoes de DE: PARA: e CC:
                
                //Inicio atributos que definem parametros do email, assunto e corpo
                $email -> isHTML(true);
                $email -> Subject = 'Mensagem de '.$nome;
                $email -> Body = 'E-mail:'.$mail.'<br>'.$msg.'<br>'.'Att.'.'<br>'.$nome;//Possibilita usar tags HTML
                $email -> AltBody = 'E-mail:'.$mail.'<br>'.$msg.'<br>'.'Att.'.'<br>'.$nome;//Utilizado pelo client quando não possui suporte para tags HTML no corpo do email

                if ($email -> send()){
                    header("location: ../index.html");//Retorna para a página principal, após enviar o e-mail. 
                }
                else {
                    echo 'Email não enviado';
                }
            }
            catch (Exception $e) {
                echo "Erro ao enviar mensagem: {$email -> ErrorInfo}";
            }
        ?>
    </body>
</html>