<?php
        include_once("conecta.php");//Conexao banco de dados.
        //Inicio importacao da biblioteca PHPmailer
        require_once "src/PHPMailer.php";
        require_once "src/SMTP.php";
        require_once "src/Exception.php";

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
        //Fim importacao da biblioteca PHPmailer

        $link = $_POST["link"];
        if ($link == $link){
        $select = $con->query("select * from registros where autorizado = 'S';");
        while ($tuplas = $select->fetch_assoc()){
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
                //Fim atributos responsaveis por logar a conta de email

                //Inicio atributos responsaveis por definir as informacoes de DE: PARA: e CC:
                $email -> setFrom('eppacoelho@gmail.com');//Recebe como parametro um email e mostrar no campo DE: no email.
                $email -> addAddress($tuplas['email']);//Aqui vai entrar o email cadastrado no  banco de dados.
                //Fim atributos responsaveis por definir as informacoes de DE: PARA: e CC:
                
                //Inicio atributos que definem parametros do email, assunto e corpo
                $email -> isHTML(true);
                $email -> Subject = 'Mensagem de teste banco';
                $email -> Body = "<img src="."$link".">";//Possibilita usar tags HTML
                //$email -> AltBody = 'E-mail:'.$mail.'<br>'.$msg.'<br>'.'Att.'.'<br>'.$nome;//Utilizado pelo client quando não possui suporte para tags HTML no corpo do email

                if ($email -> send()){
                    continue;
                }
                else {
                    echo 'Email não enviado';
                }
            }
            catch (Exception $e) {
                echo "Erro ao enviar mensagem: {$email -> ErrorInfo}";
            }
            //print_r($tuplas['email']);
            }
            echo '<script>alert("Emails enviados!")</script>';
        }
    ?>  