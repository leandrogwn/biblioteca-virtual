<?php
	session_start();
	
	if($_SESSION['logado'] == 'logado'){
		
		include("../conexao/conecta_db.php");
		
		$cod = $_POST['cod_usuario'];    
		$nome = $_POST['nome_usuario'];
		$fone = $_POST['fone_usuario'];
		$user = $_POST['usuario_usuario'];
		$senha = $_POST['senha_usuario'];
		$cod_bibli = $_POST['cod_usuario_biblioteca'];

		$atualiza_usuario = ("update bb_usuario set nome = '$nome', telefone = '$fone', usuario = '$user', senha = '$senha', cod_biblioteca = '$cod_bibli' where cod_usuario = '$cod' ");
		
		mysql_select_db($db, $con);
		$resultado_atualiza_usuario = mysql_query($atualiza_usuario,$con) or die(mysql_error());
		if($resultado_atualiza_usuario){
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