<script>
function funcao1()
{
  
alert("Sucesso! Comentário cadastrado para o material.");
}
</script>
<?php # INDEX.PHP
require_once "include/header.php";

if (isset($_POST['c_comentario'])) { 

    // variavel para gravar o usuario
    $nome = $_SESSION['nome'];
 // receber dados
 $comentario = $_POST['comentario'];
 $material = $_POST['material'];

     // insert comentario 
    $sql = "INSERT INTO comentario (comentario, material, usuario, data) VALUES ('$comentario','$material', '$nome', now());";

	// deu certo, renderizar para pagina, senão mostre o erro 
if (mysqli_query($conecta, $sql)) {
    
    header("Location: index.php");
    
       } else { 
        echo 'Erro'.$sql;
       }

}

?>
<h2>Efetue cadastro de comentario:</h2>
<br>
<div class="borda">
<form enctype="multipart/form-data" action="#" method="post">
<div><input class="input100" name="comentario" type="text" placeholder="Descreva seu comentario"/></div>
<label for="exampleFormControlInput1" class="form-label">Selecione o produto:</label>
        <select type="number" class="form-control" id="codigo" name="material">
        <option></option>
<?php 
                // Listar nome do material diretamente no formulario
				$query = "SELECT material_p FROM material";
				$sql = mysqli_query($conecta, $query);
				$row = mysqli_fetch_assoc($sql);
				if (mysqli_affected_rows($conecta) > 0) {
					echo "<option value="  . $row['material_p'] . ">" . $row['material_p'] . "</option>";
					while ($row = mysqli_fetch_array($sql)) {
						echo "<option value="  . $row['material_p'] . ">" . $row['material_p'] . "</option>";
					}
				}
				?>
        </select>            
    <div class="container-login100-form-btn m-t-32">
			<button class="login100-form-btn" name="c_comentario" onclick="funcao1()">
							Cadastrar
			</button>
	</div>
</form>
</div>

<?php
require_once 	"include/footer.php";
?>
