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
          <li>Informe os dados do leitor</li>
        </ul>
      </div>
<?php
	$editar = $_GET['e'];
	
	$busca_leitor = mysql_query("select * from bb_leitor where cod_leitor = '$editar' ") or die ("Não foi possivel encontrar os dados no banco. ". mysql_error());
		
		$res_leitor = mysql_fetch_assoc($busca_leitor);
?>
  <form action="../controle/alt_leitor.php" method="post">
  <input type="hidden" name="cod_leitor" id="cod_leitor" value="<?php echo $editar; ?>">
   	<ul>
          <li>
            <label>Nome</label>
            <input type="text" name="nome_leitor" id="nome_leitor" value="<?php echo $res_leitor['nome']; ?>" required>
          </li>
          <li>
          	<label>Telefone</label>
            <input type="text" name="fone_leitor" id="fone_leitor" value="<?php echo $res_leitor['telefone']; ?>" required>
          </li>
          <li>
          <?php
		  	$cod_tipo = $res_leitor['cod_tipo'];
			
			$busca_tipo_sele = mysql_query("select * from bb_tipo_leitor where cod_tipo = '$cod_tipo' ") or die ("Não foi possivel localizar o tipo do leitor selecionado. ".mysql_error());
			$reg_tipo_sele = mysql_fetch_assoc($busca_tipo_sele);
			
			$busca_tipo = mysql_query("select * from bb_tipo_leitor where cod_tipo != '$cod_tipo' order by tipo") or die ("Não foi possivel localizar todos os tipo do leitor. ".mysql_error());
		  ?>
          	<label>Tipo do leitor</label>
            <select name="tipo_leitor" id="tipo_leitor">
            <option value="<?php echo $reg_tipo_sele['cod_tipo']; ?>"><?php echo $reg_tipo_sele['tipo'];?></option>
              <?php
					while($reg_tipo = mysql_fetch_assoc($busca_tipo)){
						?>
              <option value="<?php echo $reg_tipo['cod_tipo']; ?>"><?php echo $reg_tipo['tipo'];?></option>
              <?php
					}
					mysql_free_result($busca_leitor);
					mysql_free_result($busca_tipo);
					mysql_free_result($busca_tipo_sele);
				?>
            </select>
          </li>
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