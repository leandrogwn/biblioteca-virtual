<?php
	session_start();
	
	if($_SESSION['logado'] = 'logado'){
		
		include("../conexao/conecta_db.php");
		
		$nome = $_POST['nome_biblioteca'];
        $telefone = $_POST['telefone_biblioteca'];
        $responsavel = $_POST['responsavel_biblioteca'];
		
		$busca_biblioteca = mysql_query("select * from bb_biblioteca where nome = '$nome' ") or die("Não foi possível carregar os dados do banco. ".mysql_error());
	
	$reg_biblioteca = mysql_num_rows($busca_biblioteca);
	
	if($reg_biblioteca == 0){
		
		$insere_biblioteca = "insert into bb_biblioteca(nome, telefone, responsavel) values('$nome','$telefone','$responsavel')";
		
		mysql_select_db($db, $con);
		$resultado_biblioteca = mysql_query($insere_biblioteca,$con) or die(mysql_error());
		
		if($resultado_biblioteca){
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
	alert('Já existe uma biblioteca cadastrada com este nome. Tente outro!')
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