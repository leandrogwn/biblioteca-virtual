<?php
session_start();
	
	if($_SESSION['logado'] == 'logado'){
		
	include ('../conexao/conecta_db.php');
	$cod = $_GET['r'];
	$busca = mysql_query("DELETE FROM bb_leitor WHERE cod_leitor = '$cod' ") or die ("Não foi possivel conectar ao banco para realizar a exclusão do leitor".mysql_error());
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