
<?php # INDEX.PHP
require_once "include/header.php";

  if (isset($_POST['c_material'])) { 
    
  
      // receber dados
      $material_p = $_POST['material_p'];
      $imagem = $_FILES['imagens'];
      $tmp = $imagem['tmp_name'];
      $arquivo = $imagem['name'];
      $descricao = $_POST['descricao'];
      
      $statu = "ativo";
      $pasta = "images/";
      // Gerar um ID unico para o arquivo imagem 
      $newnomeArquivo = uniqid();
      // Extensão do arquivo
      $extencao = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
      // Declarar a pasta com o novo arquivo
      $path = $pasta . $newnomeArquivo . "." . $extencao;
  
      // mover o arquivo para a pasta 
    $certo = move_uploaded_file($tmp, $path);
    //pegar o tamanho da imagem
    $tamanhoImg = filesize($path);
    $mysqlImg = addslashes(fread(fopen($path, "r"), $tamanhoImg));

    if ($certo) { 
      // inseri no banco
      $sql = "INSERT INTO material (material_p, imagens, descricao, data, statu, path) VALUES ('$material_p','$mysqlImg','$descricao', now(),'$statu','$path')";
    // echo "<p>Deu certo<a href=\"$path\">Clique aqui<a/></p>";
    if (mysqli_query($conecta, $sql)) {
      // redirect pra index.php
      echo '<script type="text/javascript"> alert("Acesso permitido!!!");</script>';
      header("Location: index.php");
        } else { 
          echo 'Erro'.$sql;
        }

    } else {  
      echo "deu errado";
    }

      
      }     
  
?>

<h2>Efetue cadastro do material novo:</h2>

<div class="borda">
<form enctype="multipart/form-data" action="#" method="post">
    <div><input class="input100" name="material_p" type="text" placeholder="Nome do material"/></div>
    <div><input class="input100" name="imagens" type="file" placeholder="Imagem"/></div>
    <div><input class="input100" name="descricao" type="textarea" placeholder="Descrição"/></div>

    <div class="container-login100-form-btn m-t-32">
			<button class="login100-form-btn" name="c_material" id="c_material">
							Cadastrar
			</button>
	</div>
</form>
</div>

<?php
require_once 	"include/footer.php";
?>
