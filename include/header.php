<?php
// inicializar sessao
session_start();

require_once "include/config.php";
require_once "include/connect.php";


// VERIFICAR SE NÃO ESTA NA PÁGINA LOGIN
	// retornar endereço da página
	$url 		= $_SERVER['PHP_SELF'];
	// transforma o endereço em vetor, usando / como
	// criterio de separação
	$vetor_url  = explode('/', $url);
	// pegar ultimo dado do vetor
	$pagina 	= end($vetor_url);

// verifica se esta em qualquer página que não
	// seja a login.php e cadastrar.php
	if ($pagina != 'login.php' && $pagina != 'cadastrar.php')  {

		// verifica se NAO esta autenticado
    if (!isset($_SESSION['autenticado'])) {
			// redireciona pra login.php
			header("Location: login.php");
	}
  }

  // LOGOUT
  if (isset($_GET['sair'])) {
      // destruir sessao ativa
      session_destroy();
      // criar sessao nova
      session_start();
      // redirecionar pra pagina de login
      header("Location: login.php");
  
      
  }

  if (isset($_POST['cadastrar'])) { 

 // receber dados
 $nome = $_POST['nome'];
 $senha = $_POST['senha'];
 // criptografar senha
			$senha_crypt = hash('sha512', $senha);

            $sql = "INSERT INTO loge (nome, senha) VALUES ('$nome','$senha_crypt')";

            if (mysqli_query($conecta, $sql)) {
              
				// autenticar / criar sessao
                $sqls = "SELECT id, nome, senha FROM loge WHERE 
        nome = '$nome'";
            
            //pegar os registros da tabela
            $prepara = mysqli_query($conecta,$sqls);
            $registro= mysqli_fetch_array($prepara);	  	
            $total   = mysqli_num_rows($prepara);
          // SENHA | usuário e senha conferem
			if ($total > 0) {

				# SESSION
				// autenticar / criar sessao
				$_SESSION['autenticado']= 'sim';
				$_SESSION['id'] 		= $registro['id'];
				$_SESSION['nome'] 		= $registro['nome'];
				// redirect pra index.php
				header("Location: index.php");

				} else { 
                  echo '<div class="boxErro">login invalido</div>';
                }

 	 }
 }

	// se o botao login recebeu click, valide o login  
	elseif (isset($_POST['usuario'])) {
        
        // receber dados
	    $nome = $_POST['nome'];
	    $senha = $_POST['senha'];

        // criptografar senha
			$senha_crypt = hash('sha512', $senha);

        $sql = "SELECT id, nome, senha FROM loge WHERE 
        nome = '$nome' and senha = '$senha_crypt'";
          
            $prepara = mysqli_query($conecta,$sql);
			$registro= mysqli_fetch_array($prepara);	  	
			$total   = mysqli_num_rows($prepara);
             

			// SENHA | usuário e senha conferem
			if ($total > 0) {

				# SESSION
				// autenticar / criar sessao
				$_SESSION['autenticado']= 'sim';
				$_SESSION['id'] 		= $registro['id'];
				$_SESSION['nome'] 		= $registro['nome'];
				// redirect pra index.php
				header("Location: index.php");

				} else { 
					echo '<div class="boxErro">login invalido</div>';
                   
                }

 } 
 
?>
<script>



</script>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="/js/main.js"></script>
<!--===============================================================================================-->
   
</head>
<body>
 
<header class="cabeca"> 

  <h1>Bem vindo</h1>
<ul>
 
  <li><a class="nav-item nav-link" href="index.php">Listagem de material</a></li>
  <li><a class="nav-item nav-link" href="material.php">Novo material</a></li>
  <li><a class="nav-item nav-link disabled" href="?sair">SAIr</a></li>
</ul>
</header>