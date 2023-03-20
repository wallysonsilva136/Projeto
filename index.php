<?php # INDEX.PHP
require_once "include/header.php";

// liste da tabela material todos os campos especificados
// liste apenas produtos com status ativo
// ordene campo data em ordem decrescente
$sql = "SELECT id, material_p, statu, descricao, path 
FROM material WHERE statu = 'ativo'
ORDER BY data DESC";

			$prepara = mysqli_query($conecta,$sql);
			$registro= mysqli_fetch_array($prepara);
            // calcula quantos dados retornaram
            $total = mysqli_num_rows($prepara);	 


# excluir
if (isset($_GET['deletar'])) {
  $id = $_GET['id'];

  //	$sql = "DELETE FROM material WHERE id = " . $id;
	$sqld = "DELETE FROM material WHERE id = " . $id;

	if (mysqli_query($conecta, $sqld)) {
		echo '<div class="boxSucesso">Excluido com sucesso</div>';
    header("Location: index.php");
	} else {
		echo '<div class="boxErro">Deu pau na kombi ' . $sqld . ' </div>';
	}
	
}
               
?>

<div class="clear"></div>
<div class="corpo">
<h1>Usuário:<?php echo ' '.$_SESSION['nome']?></h1>
</div>

<?php
	// se o número de resultados for maior que zero, mostra os dados
	if($total > 0) {
   
		// inicia o loop que vai mostrar todos os dados
		do {

        ?>
      
<!-- Pego um registro imagem -->

    <div class="w3-col l1" style="padding: 12px;">
    <form method="GET" action="#">
      <div class="card" >
      <img height="200" width="200" src="<?php echo $registro['path'];?>">
      <br>
       <p style="width: 75%">Produto: <?php echo "<td>".$registro['material_p']."</td>"?> </p><br><p> Descrição: <?php echo "<td>".$registro['descricao']."</td>"?></p>
       <div class="col-11" style="padding: 10px;">
       <a href="../Projeto/comentarioV.php" class="btn btn-primary btn-lg" tabindex="-1" id="vcoment" role="button">Visualizar comentarios</a>
       
							<input type="hidden" name="id" value="<?=$registro['id']?>">
              <button type="submit" class="btn btn-danger" name="deletar">Deletar</button>
    </div>
      </div>
      </form> 
    </div>  
<?php
		// finaliza o loop que vai mostrar os dados
		}while($registro = mysqli_fetch_assoc($prepara));
	// fim do if
        
	}
?>  
 
      
    
<?php # INDEX.PHP
require_once 	"include/footer.php";
?>

