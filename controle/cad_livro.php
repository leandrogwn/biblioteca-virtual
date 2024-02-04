<?php
	session_start();
	
	if($_SESSION['logado'] == 'logado'){
		
		include("../conexao/conecta_db.php");
		    
		$nome = $_POST['nome_livro'];
        $autor = $_POST['autor_livro'];
        $titulo = $_POST['titulo_livro'];
		$volume = $_POST['volume_livro'];
		$qtd = $_post['quantidade'];
		$genero = $_POST['genero_livro'];
		$cod_bi = $_SESSION['cod_bi'];
		echo 'cod'. $cod_bi. 'cod';
		$busca_livro = mysql_query("select * from bb_livro where nome = '$nome' and volume = '$volume' ") or die("Não foi possível carregar os dados do livro. ".mysql_error());
	$reg_livro = mysql_num_rows($busca_livro);
	
	if($reg_livro == 0){
		
		$insere_livro = "insert into bb_livro(nome, autor, titulo, volume, qtd, cod_genero, cod_biblioteca) values('$nome','$autor','$titulo','$volume','$qtd','$genero','$cod_bi')";
		
		mysql_select_db($db, $con);
		$resultado_livro = mysql_query($insere_livro,$con) or die(mysql_error());
		echo $cod_bi;
		if($resultado_livro){
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
				location. replace ("../pages/principal.php");
			</script>
<?php
	}
mysql_close($con);
	}else{
		?>
<script>
	alert('Já existe um livro cadastrada com este nome e volume. Tente outro!')
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