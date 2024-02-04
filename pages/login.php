<?php
session_start();

    Header('Cache-Control: no-cache');
    Header('Pragma: no-cache');
	//conexão com o banco
	include("../conexao/conecta_db.php");
	
	$usuario = preg_replace('/[^[:alnum:]_]/', '',$_POST['usuario']);
	$senha =  preg_replace('/[^[:alnum:]_]/', '',$_POST['senha']);
	
	$busca = mysql_query("select * from bb_usuario where usuario = '$usuario'") or die ("Não foi possivel carregar os dados admin. ".mysql_error());
	
	$res_busca = mysql_fetch_assoc($busca);
	$coddb = $res_busca['cod_usuario'];
	$logindb = $res_busca['usuario'];
	$senhadb = $res_busca['senha'];
	$cod_bi = $res_busca['cod_biblioteca'];

	if($usuario == "" or $senha == ""){
		?>
<script>

				alert('Os campos Usuário e Senha não devem ser vazio, complete os campos para realizar login.')
				location.replace("../index.html");
			</script>
<?php 
	}
	
		
	if($usuario == $logindb && $senha == $senhadb){
			$_SESSION['logado'] = "logado";
			$_SESSION['cod'] = $coddb;
			$_SESSION['cod_bi'] = $cod_bi;
	?>
    	<script>
			location.replace("principal.php");
		</script>
    <?php
	}else{
		?>
<script>
				alert('Usuário ou senha incorreta, tente novamente!');
				location.replace("../../publicar/indexr.php");
			</script>
<?php	
	}
?>