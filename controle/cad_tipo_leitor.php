<?php
	session_start();
	
	if($_SESSION['logado'] = 'logado'){
		
		include("../conexao/conecta_db.php");
		
		$tipo = $_POST['tipo_leitor'];
        $dias = $_POST['dias_emprestimo'];
		$qtd_livros = $_POST['qtd_livros'];
		
		$busca_tipo_leitor = mysql_query("select * from bb_tipo_leitor where tipo = '$tipo' ") or die("Não foi possível carregar os dados do tipo do leitor. ".mysql_error());
	
	$reg_tipo = mysql_num_rows($busca_tipo_leitor);
	
	if($reg_tipo == 0){
		
		$insere_tipo = "insert into bb_tipo_leitor(tipo, emprestimo_dias, qtd_livros) values('$tipo','$dias','$qtd_livros')";
		
		mysql_select_db($db, $con);
		$resultado_tipo = mysql_query($insere_tipo,$con) or die(mysql_error());
		
		if($resultado_tipo){
		?>
<script type="text/javascript">
				alert ("Os dados foram gravados com sucesso.");
				location. replace ("../pages/principal.php");
				
			</script>
<?php
	}else{
		?>
<script type="text/javascript">
				alert ("Algo deu errado na inserção, tente novamente.");
				location. replace ("../pages/principal.ph");
			</script>
<?php
	}
mysql_close($con);
	}else{
		?>
<script>
	alert('Já existe um tipo de leitor cadastrado com este nome. Tente outro!')
				location.replace("../pages/principal.php");
</script>
<?php
	}
	}else{
?>
<script>
	alert('Você não se encontra logado. Favor realizar login')
				location.replace("../index.html");
</script>
<?php
	}
?>