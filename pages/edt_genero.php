<?php
session_start();
if($_SESSION['logado'] == 'logado'){
	include("../conexao/conecta_db.php");
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
        <div class="tab-content" align="center">
    <div class="tab-pane active" id="edt_livro">
      <div id="lista_cem">
        <ul id="titulo">
          <li>Informe os dados do gênero</li>
        </ul>
      </div>
<?php
	$editar = $_GET['e'];
	
	$busca_genero = mysql_query("select * from bb_genero where cod_genero = '$editar' ") or die ("Não foi possivel encontrar os dados no banco. ". mysql_error());
		
		$res_genero = mysql_fetch_assoc($busca_genero);
?>
  <form action="../controle/alt_genero.php" method="post">
  <input type="hidden" name="cod_genero" id="cod_genero" value="<?php echo $editar; ?>">
   	<ul>
          <li>
            <label>Descrição do gênero</label>
            <input type="text" name="nome_genero" id="nome_genero" value="<?php echo $res_genero['genero']; ?>" required>
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
mysql_free_result($busca_genero);
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