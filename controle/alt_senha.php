<?php
	session_start();
	
	if($_SESSION['logado'] = 'logado'){
		$coddb = $_SESSION['cod'];
		include("../conexao/conecta_db.php");
		
		$senha_atual = $_POST['senha_atual'];
        $nova_senha = $_POST['nova_senha'];
        $rep_nova_senha = $_POST['rep_nova_senha'];
		
		$busca_usuario = mysql_query("select * from bb_usuario where cod_usuario = '$coddb' ") or die("Não foi possível carregar os dados do banco. ".mysql_error());
	
		$reg_usuario = mysql_fetch_assoc($busca_usuario);
			
		$senhadb = $reg_usuario['senha'];
		if($senha_atual == $senhadb){
			if($nova_senha == $rep_nova_senha){
				
				$atualiza_usuario = ("update bb_usuario set senha = '$nova_senha' where cod_usuario = '$coddb'");
	
	mysql_select_db($db, $con);
		$resultado_edt_usuario = mysql_query($atualiza_usuario,$con) or die(mysql_error());
		if($resultado_edt_usuario){
		?>
<script type="text/javascript">
				alert ("Nova senha salva com sucesso.");
				location. replace ("../pages/logout.php");
				
			</script>
<?php
	}else{
		?>
<script type="text/javascript">
            alert ("Algo deu errado ao alterar sua senha, tente novamente.");
            location. replace ("../pages/principal.php");
        </script>
<?php
	}	
			}else{
				?>
<script type="text/javascript">
                    alert ("Campos Nova senha e Repita a nova senha, não são identicos. Digite novamente.");
                    location.replace ("../pages/principal.php");
                </script>
<?php
			}
		}else{
			?>
<script type="text/javascript">
				alert ("A senha atual não confere digite novamente.");
				location.replace ("../pages/principal.php");
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