
<?php
 
/* apenas dispara o envio do formulário caso exista $_POST['enviarFormulario']*/
 
if (isset($_POST['enviarFormulario'])){
 
 
/*** INÍCIO - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/
 
$enviaFormularioParaNome = 'Atendimento';
$enviaFormularioParaEmail = 'contato@bsgomes.com.br';
 
$caixaPostalServidorNome = 'Mensagem do Site';
$caixaPostalServidorEmail = 'valehipe@valehipe.com.br';
$caixaPostalServidorSenha = '';
 
/*** FIM - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/ 
 
 
/* abaixo as veriaveis principais, que devem conter em seu formulario*/
 
$remetenteNome  = $_POST['name'];
$remetenteEmail = $_POST['email'];
$assunto  = $_POST['subject'];
$mensagem = $_POST['message'];
 
$mensagemConcatenada = 'Formulário gerado via website'.'<br/>'; 
$mensagemConcatenada .= '-------------------------------<br/><br/>'; 
$mensagemConcatenada .= 'Name: '.$remetenteNome.'<br/>'; 
$mensagemConcatenada .= 'email: '.$remetenteEmail.'<br/>'; 
$mensagemConcatenada .= 'subject: '.$assunto.'<br/>';
$mensagemConcatenada .= '-------------------------------<br/><br/>'; 
$mensagemConcatenada .= 'message: "'.$mensagem.'"<br/>';
 
 
/*********************************** A PARTIR DAQUI NAO ALTERAR ************************************/ 
 
require_once('PHPMailer/PHPMailerAutoload.php');
 
$mail = new PHPMailer();
 
$mail->IsSMTP();
$mail->SMTPAuth  = true;
$mail->Charset   = 'utf8_decode()';
$mail->Host  = 'smtp.'.substr(strstr($caixaPostalServidorEmail, '@'), 1);
$mail->Port  = '587';
$mail->Username  = $caixaPostalServidorEmail;
$mail->Password  = $caixaPostalServidorSenha;
$mail->From  = $caixaPostalServidorEmail;
$mail->FromName  = utf8_decode($caixaPostalServidorNome);
$mail->IsHTML(true);
$mail->Subject  = utf8_decode($assunto);
$mail->Body  = utf8_decode($mensagemConcatenada);
 
 
$mail->AddAddress($enviaFormularioParaEmail,utf8_decode($enviaFormularioParaNome));
 
if(!$mail->Send()){
echo "<div class='alert alert-danger'><p style='padding: 0; margin: 0;'>Email não enviado.</p></div>"; 
  } else {
echo "<div class='alert alert-success'><p style='padding: 0; margin: 0;'>
Sua mensagem foi enviado com sucesso, em breve retornaremos e obrigado pelo contato !</p></div>";  

}
header("Refresh: 8; index.html");
}
?>