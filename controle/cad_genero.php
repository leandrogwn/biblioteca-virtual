<?php
	session_start();
	
	if($_SESSION['logado'] = 'logado'){
		
		include("../conexao/conecta_db.php");
		
		$genero = $_POST['nome_genero'];
		
		$busca_genero = mysql_query("select * from bb_genero where genero = '$genero' ") or die("Não foi possível carregar o genero. ".mysql_error());
	
	$reg_genero = mysql_num_rows($busca_genero);
	
	if($reg_genero == 0){
		
		$insere_genero = "insert into bb_genero(genero) values('$genero')";
		
		mysql_select_db($db, $con);
		$resultado_genero = mysql_query($insere_genero,$con) or die(mysql_error());
		
		if($resultado_genero){
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
	alert('Já existe um gênero cadastrado com este nome. Tente outro!')
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