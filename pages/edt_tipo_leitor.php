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
          <li>Informe os dados do tipo do leitor</li>
        </ul>
      </div>
<?php
	$editar = $_GET['e'];
	
	$busca_tipo_leitor = mysql_query("select * from bb_tipo_leitor where cod_tipo = '$editar' ") or die ("Não foi possivel encontrar os dados no banco. ". mysql_error());
		
		$res_tipo_leitor = mysql_fetch_assoc($busca_tipo_leitor);
?>
  <form action="../controle/alt_tipo_leitor.php" method="post">
  <input type="hidden" name="cod_tipo" id="cod_tipo" value="<?php echo $editar; ?>">
   	<ul>
          <li>
            <label>Tipo do leitor</label>
            <input type="text" name="tipo_leitor" id="tipo_leitor" value="<?php echo $res_tipo_leitor['tipo']; ?>" required>
          </li>
          <li>
            <label>Dias de empréstimo</label>
            <input type="number" name="dias_emprestimo" id="dias_emprestimo" value="<?php echo $res_tipo_leitor['emprestimo_dias']; ?>" required>
          </li>
          <li>
            <label>Quantidade de livros</label>
            <input type="number" name="qtd_livros" id="qtd_livros" value="<?php echo $res_tipo_leitor['qtd_livros']; ?>" required>
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