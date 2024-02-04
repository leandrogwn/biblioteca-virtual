<?php
	session_start();
	
	if($_SESSION['logado'] = 'logado'){
		
		include("../conexao/conecta_db.php");
		
		$nome = $_POST['nome_usuario'];
        $telefone = $_POST['telefone_usuario'];
        $login = $_POST['login_usuario'];
		$senha = $_POST['senha_usuario'];
		$cod_biblioteca = $_POST['cad_usuario_biblioteca'];
		
		$busca_usuario = mysql_query("select * from bb_usuario where usuario = '$login' ") or die("Não foi possível carregar os dados do banco. ".mysql_error());
	
	$reg_usuario = mysql_num_rows($busca_usuario);
	
	if($reg_usuario == 0){
		
		$insere_usuario = "insert into bb_usuario(nome, telefone, usuario, senha, cod_biblioteca) values('$nome','$telefone','$login','$senha','$cod_biblioteca')";
		
		mysql_select_db($db, $con);
		$resultado_usuario = mysql_query($insere_usuario,$con) or die(mysql_error());
		if($resultado_usuario){
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
	alert('Já existe uma usuário cadastrado com este nome. Tente outro!')
				location.replace("../pages/principal.php");
</script>
<?php
	}
	}else{
?>
<script>
	alert('Você não se encontra logado. Favor realizar login');
				location.replace("../index.html");
</script>
<?php
	}
?>
