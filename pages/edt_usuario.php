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
          <li>Informe os dados do usuário</li>
        </ul>
      </div>
<?php
	$editar = $_GET['e'];
	
	$busca_usuario = mysql_query("select * from bb_usuario where cod_usuario = '$editar' ") or die ("Não foi possivel encontrar os dados no banco. ". mysql_error());
		
		$res_usuario = mysql_fetch_assoc($busca_usuario);
?>
  <form action="../controle/alt_usuario.php" method="post">
  <input type="hidden" name="cod_usuario" id="cod_usuario" value="<?php echo $editar; ?>">
   	<ul>
          <li>
            <label>Nome</label>
            <input type="text" name="nome_usuario" id="nome_usuario" value="<?php echo $res_usuario['nome']; ?>" required>
          </li>
          <li>
          	<label>Telefone</label>
            <input type="text" name="fone_usuario" id="fone_usuario" value="<?php echo $res_usuario['telefone']; ?>" required>
          </li>
          <li>
          	<label>Usuário</label>
            <input type="text" name="usuario_usuario" id="usuario_usuario" value="<?php echo $res_usuario['usuario']; ?>" required>
          </li>
          <li>
          	<label>Senha</label>
            <input type="text" name="senha_usuario" id="senha_usuario" value="<?php echo $res_usuario['senha']; ?>" required>
          </li>
          <li>
          
          <?php
		  	$cod_biblioteca = $res_usuario['cod_biblioteca'];
			$busca_bibli_sele = mysql_query("select * from bb_biblioteca where cod_biblioteca = '$cod_biblioteca' ") or die ("Nâo foi possivel carregar a bibliotéca selecionada. ".mysql_error());
			$reg_bibli_sele = mysql_fetch_assoc($busca_bibli_sele);
			
			$busca_biblioteca = mysql_query("select * from bb_biblioteca where cod_biblioteca != '$cod_biblioteca' ") or die ("Não foi possivel carregar as bibliotecas. ". mysql_error());
			
		  ?>
          
          	<label>Bibliotéca</label>
            <select name="cod_usuario_biblioteca" id="cod_usuario_biblioteca">
            <option value="<?php echo $reg_bibli_sele['cod_biblioteca']; ?>"><?php echo $reg_bibli_sele['nome'];?></option>
              <?php
					while($reg_usuario_biblioteca = mysql_fetch_assoc($busca_biblioteca)){
						?>
              <option value="<?php echo $reg_usuario_biblioteca['cod_biblioteca']; ?>"><?php echo $reg_usuario_biblioteca['nome'];?></option>
              <?php
					}
					mysql_free_result($busca_bibli_sele);
					mysql_free_result($busca_usuario);
					mysql_free_result($busca_cod_biblioteca);
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