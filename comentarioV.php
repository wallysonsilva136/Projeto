<?php # INDEX.PHP
require_once "include/header.php";

// select na tabela comentario e material onde nome de material das tabelas comentario e material são iguais
// and listar somente produtos ativos
$sql = "SELECT comentario.comentario, comentario.material, comentario.usuario, comentario.data, material.material_p, material.path FROM comentario INNER JOIN material ON comentario.material=material.material_p and material.statu = 'ativo' ORDER BY comentario.data DESC;";

			$prepara = mysqli_query($conecta,$sql);
			$registro= mysqli_fetch_array($prepara);
            // calcula quantos dados retornaram
            $total = mysqli_num_rows($prepara);	 

            // se existir 0 linhas no retorno da consulta acima atualize o produto para status inativo
    if ($total <= 0) {
            $sqlup = "UPDATE material SET statu = 'inativo' where statu = 'ativo'";
        }    

?>

<div class="coluna1" >
       <a href="../Projeto/comentario.php" class="btn btn-primary btn-lg" tabindex="-1" role="button">Cadastrar meu comentario</a>
   
<br>
   <h2>Listagem de comentarios:</h2> 
   </div>
<?php
	// se o número de resultados for maior que zero, mostra os dados
	if($total > 0) {
			// inicia o loop que vai mostrar todos os dados
            do {
         

        ?>
      
<!-- Pego um registro imagem -->

    <div class="w3-col l1" style="margin: 30px;">
      <div class="card" >
      <img height="150" width="150" src="<?php echo $registro['path'];?>">
      <br>
      <p> Usuário: <?php echo "<td>". $registro['usuario']."</td>"?></p>
      <p style="width: 75%">Comentario: <?php echo "<td>".$registro['comentario']."</td>"?> </p>
      <p> Data: <?php echo "<td>".$registro['data']."</td>"?></p>
      <p> Nome do produto: <?php echo "<td>".$registro['material']."</td>"?></p>
      </div>
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