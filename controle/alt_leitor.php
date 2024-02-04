<?php
	session_start();
	
	if($_SESSION['logado'] == 'logado'){
		
		include("../conexao/conecta_db.php");
		
		$cod = $_POST['cod_leitor'];    
		$nome = $_POST['nome_leitor'];
		$fone = $_POST['fone_leitor'];
		$tipo = $_POST['tipo_leitor'];
		$cod_bibli = $_SESSION['cod_bi'];


		$atualiza_leitor = ("update bb_leitor set nome = '$nome', telefone = '$fone', cod_tipo = '$tipo', cod_biblioteca = '$cod_bibli' where cod_leitor = '$cod' ");
		
		mysql_select_db($db, $con);
		$resultado_atualiza_leitor = mysql_query($atualiza_leitor,$con) or die(mysql_error());
		if($resultado_atualiza_leitor){
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