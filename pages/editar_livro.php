<?php
session_start();
	
	if($_SESSION['logado'] == 'logado'){
?>
<!DOCTYPE html >

<head>
<meta charset="utf-8">
<title>Edição</title>
<!-- Bootstrap -->
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/style.css" rel="stylesheet" media="screen">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/getCep.js"></script>
</head>
<body>
<div id="topo">
<div id="sair">
<a href="logout.php"><h4>Sair</h4></a>
</div>
</div>
<div id="logo_topo">
	
</div>

<section id="navegacao">
  <?php
  	include("../conexao/conecta_db.php");
	
	$editar = $_GET['e'];
	
	$busca_livro = mysql_query("select * from bb_livro where cod_livro = '$editar' ") or die ("Não foi possivel encontrar os dados no banco. ". mysql_error());
		
		$reg_livro = mysql_fetch_assoc($busca_livro);
		?>
        <div class="tab-content" align="center">
    <div class="tab-pane active" id="edt_livro">
      <div id="lista_cem">
        <ul id="titulo">
          <li>Informe os dados do Livro</li>
        </ul>
      </div>
  <form action="../controle/alt_livro.php" method="post">
   	<ul>
          <li>
            <label>Nome do Livro</label>
            <input type="text" name="nome_livro" id="nome_livro" value="<?php echo $res_busca['nome']; ?>" required>
          </li>
          <li>
            <label>Autor do Livro</label>
            <input type="text" name="autor_livro" id="autor_livro" value="<?php echo $res_busca['autor']; ?>" required>
          </li>
          <li>
            <label>Título do Livro</label>
            <input type="text" name="titulo_livro" name="titulo_livro" value="<?php echo $res_busca['titulo']; ?>" required>
          </li>
          <li>
            <label>Volume do Livro</label>
            <input type="text" name="volume_livro" id="volume_livro" value="<?php echo $res_busca['volume']; ?>" required>
          </li>
          <li>
            <label>Gênero do Livro</label>
            <?php
				$busca_genero = mysql_query("select * from bb_genero order by genero") or die ("Não foi possível localizar os dados no banco. ".mysql_error());
				$reg_genero_selecionado =  mysql_fetch_assoc($busca_genero);
			?>
            <select name="genero_livro" id="genero_livro" required>
            <?php
			$cod_renero_selecionado = $reg_genero_selecionado['cod_genero'];
				$busca_selecionado = mysql_query("select * from bb_genero where cod_genero =  $cod_genero_selecionado") or die ("Não foi possivel localizar o genero selecionado. ".mysql_error());
				$reg_descricao_genero = mysql_fetch_assoc($busca_selecionado);
			?>
             <option value="<?php echo $reg_descricao_genero['cod_genero']; ?>" selected><?php echo $reg_descricao_genero['genero'];?></option>
              <?php
			  
					while($reg_genero = mysql_fetch_assoc($busca_genero)){
						?>
                        
                       
              <option value="<?php echo $reg_genero['cod_genero']; ?>"><?php echo $reg_genero['genero'];?></option>
              <?php
					}
					mysql_free_result($busca_genero);
					mysql_free_result($busca_livro);
					mysql_free_result($busca_selecionado);
				?>
            </select>
          </li>
        </ul>
        <ul>
          <li>
            <input type="submit" value="Alterar" class="btn btn-primary">
          </li>
        </ul>
  </form>
  </div>
  </div>
</section>
</body>
</html><?php
mysql_close($con);
	}else{
		?>
<script>
				alert('Você não encontra-se logado na sessão. Por vafor digite seu login e senha para entra no sistema!');
				location.replace("../index.html");
			</script>
<?php	
	}
	
	
?>