<?php
session_start();
	
	if($_SESSION['logado'] == 'logado'){
		
	include ('../conexao/conecta_db.php');
	$cod = $_GET['r'];
	$busca = mysql_query("DELETE FROM bb_tipo_leitor WHERE cod_tipo = '$cod' ") or die ("Não foi possivel realizar a exclusão do tipo do leitor".mysql_error());
	echo '<script>
			location.replace("../pages/principal.php");
</script>';

mysql_close($con);
	}else{
		?>
<script>
				alert('Você não encontra-se logado na sessão. Por vafor digite seu login e senha para entra no sistema!');
				location.replace("../index.html");
			</script>
<?php	
	}
?>