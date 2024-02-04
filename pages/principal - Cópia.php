<?php
session_start();
	//conexão com o banco
	include("../conexao/conecta_db.php");
	
	$usuario = preg_replace('/[^[:alnum:]_]/', '',$_POST['usuario']);
	$senha =  preg_replace('/[^[:alnum:]_]/', '',$_POST['senha']);
	
	$busca = mysql_query("select * from bb_usuario where usuario = '$usuario'") or die ("Não foi possivel carregar os dados admin. ".mysql_error());
	
	$res_busca = mysql_fetch_assoc($busca);
	$coddb = $res_busca['cod_usuario'];
	$logindb = $res_busca['usuario'];
	$senhadb = $res_busca['senha'];
	$cod_bi = 1;
	if($_SESSION['logado'] != "logado"){ 
	if($usuario == "" or $senha == ""){
		?>
<script>
				alert('Os campos Usuário e Senha não devem ser vazio, complete os campos para realizar login.')
				location.replace("../index.html");
			</script>
<?php 
	}
	}
	
		
	if($usuario == $logindb && $senha == $senhadb){
		if($_SESSION['logado'] != "logado"){
			$_SESSION['logado'] = "logado";
			$_SESSION['cod'] = $coddb;
			$_SESSION['cod_bi'] = $cod_bi;
		}
?>
<!DOCTYPE html >

<head>
<meta charset="utf-8">
<title>Biblioteca Virtual</title>
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
  <div id="sair"> <a href="logout.php">
    <h4>Sair</h4>
    </a> </div>
</div>
<div id="logo_topo"> </div>
<section id="navegacao">
  <ul class="nav nav-tabs">
    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Bibliotéca <b class="caret"></b> </a>
      <ul class="dropdown-menu">
        <!-- links -->
        <li><a href="#emp_livro" data-toggle="tab">Empréstimo</a></li>
        <li><a href="#dev_livro" data-toggle="tab">Devolução</a></li>
      </ul>
    </li>
    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Livros <b class="caret"></b> </a>
      <ul class="dropdown-menu">
        <!-- links -->
        <li><a href="#listar_livro" data-toggle="tab">Listar Livro</a></li>
        <li><a href="#cad_genero" data-toggle="tab">Cadastrar Gênero</a></li>
        <li><a href="#cad_livro" data-toggle="tab">Cadastrar Livro</a></li>
      </ul>
    </li>
    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Leitor <b class="caret"></b> </a>
      <ul class="dropdown-menu">
        <!-- links -->
        <li><a href="#tipo_leitor" data-toggle="tab">Cadastrar Tipo Leitor</a></li>
        <li><a href="#cad_leitor" data-toggle="tab">Cadastrar Leitor</a></li>
      </ul>
    </li>
    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Configurações <b class="caret"></b> </a>
      <ul class="dropdown-menu">
        <!-- links -->
        <li><a href="#alt_senha" data-toggle="tab">Alterar Senha</a></li>
        <li><a href="#cad_biblioteca" data-toggle="tab">Cadastrar Bibliotéca</a></li>
        <li><a href="#cad_usuario" data-toggle="tab">Cadastrar Usuário</a></li>
      </ul>
    </li>
  </ul>
  <div class="tab-content" align="center">
    <div class="tab-pane active" id="emp_livro">
      <div id="lista_cem">
        <ul id="titulo">
          <li>Informe os dados do Empréstimo</li>
        </ul>
      </div>
      <form action="../controle/cad_emprestimo.php" method="post">
        <ul>
          <li>
            <label>Leitor:</label>
            <select id="leitor" name="leitor">
            </select>
          </li>
          <li>
            <label>Livro:</label>
            <select id="livro" name="livro">
            </select>
          </li>
        </ul>
        <ul>
          <li>
            <label>Data Empréstimo:</label>
            <input type="text" name="data_emprestimo" id="data_emprestimo" data-provide="typehead" required>
          </li>
          <li>
            <label>Data Devolução:</label>
            <input type="text" name="data_devolucao" id="data_devolucao" data-provide="typehead" required>
          </li>
        </ul>
        <ul>
          <li>
            <label>Observação:</label>
            <textarea name="obs" id="obs" data-provide="typehead"></textarea>
          </li>
        </ul>
        <ul>
          <li>
            <input type="submit" id="btn_entrar" value="Gravar" class="btn btn-primary">
          </li>
        </ul>
      </form>
    </div>
    <div class="tab-pane" id="dev_livro">
      <div id="lista_cem">
        <ul id="titulo">
          <li>Informe os dados para devolução</li>
        </ul>
      </div>
      <form action="../controle/devolucao.php" method="post">
        <ul>
          <li>
            <label>Código do Empréstimo</label>
            <input type="text" name="cod_emprestimo" id="cod_emprestimo">
          </li>
          <li>
            <label>Observações</label>
            <textarea name="obs" id="obs"></textarea>
          </li>
        </ul>
        <ul>
          <li>
            <input type="submit" value="Confirmar Devolução" class="btn btn-primary">
          </li>
        </ul>
      </form>
    </div>
    <div class="tab-pane" id="listar_livro">
      <div id="lista_cem">
        <ul id="titulo">
          <li>Lista de livros na biblioteca</li>
        </ul>
      </div>
      <?php
	  	$busca_livro = mysql_query("select * from bb_livro order by nome") or die("Não foi possível carregar os livros do banco. ".mysql_error());
			?>
      <div id="lista">
        <ul id="titulo">
          <li>Nome</li>
          <li>Autor</li>
          <li>Titulo</li>
          <li>Ações</li>
        </ul>
        <?php
		while ($reg_livro = mysql_fetch_assoc($busca_livro)){
		?>
        <ul>
          <li> <?php echo $reg_livro['nome'];?> </li>
          <li><?php echo $reg_livro['autor'];?></li>
          <li><?php echo $reg_livro['titulo'];?></li>
          <li><a href="editar_livro.php?e=<?php echo $reg_livro['cod_livro'];?>">Alterar</a> - <a href="../controle/remover_livro.php?r=<?php echo $reg_livro['cod_livro'];?>" onclick="javascript:return confirm('Atenção!  Deseja excluir esse registro?')">Excluir</a></li>
          <hr>
        </ul>
        <?php
		}
	  ?>
      </div>
    </div>
    <div class="tab-pane" id="cad_genero">
      <div id="lista_cem">
        <ul id="titulo">
          <li>Cadastrar gênero</li>
        </ul>
      </div>
      <form action="../controle/cad_genero.php" method="post">
        <ul>
          <li>
            <label>Nome do gênero</label>
            <input type="text" name="nome_genero" id="nome_genero" required>
          </li>
        </ul>
        <ul>
          <li>
            <input type="submit" value="Gravar" class="btn btn-primary">
          </li>
        </ul>
      </form>
    </div>
    <div class="tab-pane" id="cad_livro">
      <div id="lista_cem">
        <ul id="titulo">
          <li>Cadastrar livro</li>
        </ul>
      </div>
      <form action="../controle/cad_livro.php" method="post">
        <ul>
          <li>
            <label>Nome do Livro</label>
            <input type="text" name="nome_livro" id="nome_livro" required>
          </li>
          <li>
            <label>Autor do Livro</label>
            <input type="text" name="autor_livro" id="autor_livro" required>
          </li>
          <li>
            <label>Título do Livro</label>
            <input type="text" name="titulo_livro" name="titulo_livro" required>
          </li>
          <li>
            <label>Volume do Livro</label>
            <input type="text" name="volume_livro" id="volume_livro" required>
          </li>
          <li>
            <label>Gênero do Livro</label>
            <?php
				$busca_genero = mysql_query("select * from bb_genero order by genero") or die ("Não foi possível localizar os dados no banco. ".mysql_error());
			?>
            <select name="genero_livro" id="genero_livro" required>
              <?php
					while($reg_genero = mysql_fetch_assoc($busca_genero)){
						?>
              <option value="<?php echo $reg_genero['cod_genero']; ?>"><?php echo $reg_genero['genero'];?></option>
              <?php
					}
					mysql_free_result($busca_genero);
				?>
            </select>
          </li>
        </ul>
        <ul>
          <li>
            <input type="submit" value="Gravar" class="btn btn-primary">
          </li>
        </ul>
      </form>
    </div>
    <div class="tab-pane" id="tipo_leitor">
      <div id="lista_cem">
        <ul id="titulo">
          <li>Informe os dados do tipo do leitor</li>
        </ul>
      </div>
      <form action="../controle/cad_tipo_leitor.php" method="post">
        <ul>
          <li>
            <label>Tipo do Leitor</label>
            <input type="text" name="tipo_leitor" id="tipo_leitor">
          </li>
          <li>
            <label>Dias de Empréstimo</label>
            <input type="number" name="dias_emprestimo" id="dias_emprestimo">
          </li>
        </ul>
        <ul>
          <li>
            <input type="submit" value="Gravar" class="btn btn-primary">
          </li>
        </ul>
      </form>
    </div>
    <div class="tab-pane" id="cad_leitor">
      <div id="lista_cem">
        <ul id="titulo">
          <li>Informe os dados do Leitor</li>
        </ul>
      </div>
      <form action="../controle/cad_leitor.php" method="post">
        <ul>
          <li>
            <label>Nome do Leitor</label>
            <input type="text" name="nome_leitor" id="nome_leitor">
          </li>
        </ul>
        <ul>
          <li>
            <label>Telefone</label>
            <input type="text" name="telefone_leitor" id="telefone_leitor">
          </li>
        </ul>
        <ul>
          <li>
            <label>Tipo do leitor</label>
            <?php
				$busca_tipo_leitor = mysql_query("select * from bb_tipo_leitor order by tipo") or die ("Não foi possível localizar os dados no banco. ".mysql_error());
			?>
            <select name="cad_leitor_tipo" id="cad_leitor_tipo">
              <?php
					while($reg_leitor_tipo = mysql_fetch_assoc($busca_tipo_leitor)){
						?>
              <option value="<?php echo $reg_leitor_tipo['cod_tipo']; ?>"><?php echo $reg_leitor_tipo['tipo'];?></option>
              <?php
					}
					mysql_free_result($busca_tipo_leitor);
				?>
            </select>
            <?php /*?><input type="hidden" name="cod_biblioteca" id="cod_biblioteca" value="<?php echo $reg_usuario_biblioteca['cod_biblioteca']; ?>"><?php */?>
          </li>
        </ul>
        <ul>
          <li>
            <input type="submit" value="Gravar"  class="btn btn-primary">
          </li>
        </ul>
      </form>
    </div>
    <div class="tab-pane" id="alt_senha">
      <div id="lista_cem">
        <ul id="titulo">
          <li>Alterar Senha</li>
        </ul>
      </div>
      <form action="../controle/alt_senha.php" method="post">
        <ul>
          <li>
            <label>Digite sua senha atual</label>
            <input type="password" name="senha_atual" id="senha_atual">
          </li>
          <li>
            <label>Digite sua nova senha</label>
            <input type="password" name="nova_senha" id="nova_senha">
          </li>
          <li>
            <label>Repita a nova senha</label>
            <input type="password" name="rep_nova_senha" id="rep_nova_senha">
          </li>
        </ul>
        <ul>
          <li>
            <input type="submit" value="Gravar" class="btn btn-primary" >
          </li>
        </ul>
      </form>
    </div>
    <div class="tab-pane" id="cad_biblioteca">
      <div id="lista_cem">
        <ul id="titulo">
          <li>Informe os dados da Bibliotéca</li>
        </ul>
      </div>
      <form action="../controle/cad_biblioteca.php" method="post">
        <ul>
          <li>
            <label>Nome de Identificação</label>
            <input type="text" name="nome_biblioteca" id="nome_biblioteca">
          </li>
          <li>
            <label>Telefone</label>
            <input type="text" name="telefone_biblioteca" id="telefone_biblioteca">
          </li>
          <li>
            <label>Responsável</label>
            <input type="text" name="responsavel_biblioteca" id="responsavel_biblioteca">
          </li>
        </ul>
        <ul>
          <li>
            <input type="submit" value="Gravar" class="btn btn-primary">
          </li>
        </ul>
      </form>
    </div>
    <div class="tab-pane" id="cad_usuario">
      <div id="lista_cem">
        <ul id="titulo">
          <li>Informe os dados do Usuário</li>
        </ul>
      </div>
      <form action="../controle/cad_usuario.php" method="post">
        <ul>
          <li>
            <label>Nome do usuário</label>
            <input type="text" name="nome_usuario" id="nome_usuario">
          </li>
          <li>
            <label>Telefone do usuário</label>
            <input type="text" name="telefone_usuario" id="telefone_usuario">
          </li>
          <li>
            <label>Login do usuário</label>
            <input type="text" name="login_usuario" id="login_usuario">
          </li>
          <li>
            <label>Senha do usuário</label>
            <input type="password" name="senha_usuario" id="senha_usuario">
          </li>
          <li>
            <label>Biblioteca do usuário</label>
            <?php
				$busca_cod_biblioteca = mysql_query("select * from bb_biblioteca order by nome") or die ("Não foi possível localizar os dados no banco. ".mysql_error());
			?>
            <select name="cad_usuario_biblioteca" id="cad_usuario_biblioteca">
              <?php
					while($reg_usuario_biblioteca = mysql_fetch_assoc($busca_cod_biblioteca)){
						?>
              <option value="<?php echo $reg_usuario_biblioteca['cod_biblioteca']; ?>"><?php echo $reg_usuario_biblioteca['nome'];?></option>
              <?php
					}
					mysql_free_result($busca_cod_biblioteca);
				?>
            </select>
          </li>
        </ul>
        <ul>
          <li>
            <input type="submit" value="Gravar" class="btn btn-primary">
          </li>
        </ul>
      </form>
    </div>
  </div>
</section>
</div>
</body>
</html><?php
	}else{
		?>
<script>
				alert('Usuário ou senhas não conferem! Tente novamente.')
				location.replace("../index.html");
			</script>
<?php 
	}
?>