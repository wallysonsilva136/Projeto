<?php # INDEX.PHP
require_once "include/header.php";
?>

  <div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
				 Login
				</span>
               
				<form class="login100-form validate-form p-b-33 p-t-5" method="POST" action="#">

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="nome" placeholder="Usuário">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="senha" placeholder="Senha">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn" name="usuario">
							Login
						</button>
					</div>
                    <div class="wrap-teste ">
						
					</div>      
<p>Cadastre-se abaixo:</p>
                    <div class="container-login100-form-btn m-t-32">
                    <a class="login100-form-btn" href="cadastrar.php">Cadastrar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
<?php # INDEX.PHP
require_once "include/footer.php";
?>
