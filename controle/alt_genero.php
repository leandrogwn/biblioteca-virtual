<?php
	session_start();
	
	if($_SESSION['logado'] == 'logado'){
		
		include("../conexao/conecta_db.php");
		
		$cod_genero = $_POST['cod_genero'];    
		$nome_genero = $_POST['nome_genero'];
		
		$atualiza_genero = ("update bb_genero set genero = '$nome_genero' where cod_genero = '$cod_genero'") ;
		
		mysql_select_db($db, $con);
		$resultado_atualiza_genero = mysql_query($atualiza_genero,$con) or die(mysql_error());
		if($resultado_atualiza_genero){
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