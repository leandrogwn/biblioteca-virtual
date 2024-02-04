<?php
	session_start();
	
	if($_SESSION['logado'] == 'logado'){
		
		include("../conexao/conecta_db.php");
		
		$cod_livro = $_POST['cod_livro'];    
		$nome = $_POST['nome_livro'];
        $autor = $_POST['autor_livro'];
        $titulo = $_POST['titulo_livro'];
		$volume = $_POST['volume_livro'];
		$qtd = $_POST['quantidade'];
		$genero = $_POST['genero_livro'];
		
		$atualiza_livro = ("update bb_livro set nome = '$nome', autor = '$autor', titulo = '$titulo', volume = '$volume', qtd = '$qtd', cod_genero = '$genero' where cod_livro = '$cod_livro'") ;
		
		mysql_select_db($db, $con);
		$resultado_atualiza_livro = mysql_query($atualiza_livro,$con) or die(mysql_error());
		if($resultado_atualiza_livro){
		?>
<script type="text/javascript">
				alert ("Os dados foram atualizados com sucesso.");
				location. replace ("../pages/principal.php");
				
			</script>
<?php
	}else{
		?>
<script type="text/javascript">
				alert ("Algo deu errado na alteração, tente novamente.");
				location. replace ("../pages/principal.php");
			</script>
<?php
	}
mysql_close($con);
	}else{
	
?>
<script>
	alert('Você não se encontra logado. Favor realizar login')
				location.replace("../index.html");
</script>
<?php
	}
?>