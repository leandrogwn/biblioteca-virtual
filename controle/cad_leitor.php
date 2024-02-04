<?php
	session_start();
	
	if($_SESSION['logado'] == "logado"){
		
			
		include("../conexao/conecta_db.php");
		 
		$nome = $_POST['nome_leitor'];
        $fone = $_POST['telefone_leitor'];
		$cod_leitor = $_POST['cad_leitor_tipo'];
		$cod_biblioteca = $_SESSION['cod_bi'];
		
		$busca_leitor = mysql_query("select * from bb_leitor where nome = '$nome' ") or die("Não foi possível carregar os dados do leitor. ".mysql_error());
	
	$reg_leitor = mysql_num_rows($busca_leitor);
	
	if($reg_leitor == 0){
		$insere_leitor = "insert into bb_leitor(nome, telefone, cod_tipo, cod_biblioteca) values('$nome','$fone','$cod_leitor','$cod_biblioteca')";
		
		mysql_select_db($db, $con);
		$resultado_leitor = mysql_query($insere_leitor,$con) or die(mysql_error());
		
		if($resultado_leitor){
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
	alert('Já existe um leitor cadastrado com este nome. Tente outro!')
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