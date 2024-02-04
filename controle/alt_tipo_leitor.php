<?php
	session_start();
	
	if($_SESSION['logado'] == 'logado'){
		
		include("../conexao/conecta_db.php");
		
		$cod = $_POST['cod_tipo'];    
		$tipo = $_POST['tipo_leitor'];
		$dias = $_POST['dias_emprestimo'];
		$qtd_livros = $_POST['qtd_livros'];
		
		$atualiza_tipo = ("update bb_tipo_leitor set tipo = '$tipo', emprestimo_dias = '$dias', qtd_livros = '$qtd_livros' where cod_tipo = '$cod'") ;
		
		mysql_select_db($db, $con);
		$resultado_atualiza_tipo = mysql_query($atualiza_tipo,$con) or die(mysql_error());
		if($resultado_atualiza_tipo){
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