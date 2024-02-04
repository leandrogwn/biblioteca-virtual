<?php
	session_start();
	
	if($_SESSION['logado'] = 'logado'){
		include("../conexao/conecta_db.php");
		
		$leitor = $_POST['leitor'];
		
		$qtd_livro_perm = mysql_query("select bb_tipo_leitor.qtd_livros from bb_tipo_leitor inner join bb_leitor on bb_tipo_leitor.cod_tipo = bb_leitor.cod_tipo where bb_leitor.cod_leitor = '$leitor'") or die ("Não foi possivel localizar a quantidade de livros permetidos para o leitor. ".mysql_error());
					
					$qtd_livro_emp = mysql_query("select count(*) as cont from bb_emprestimo where cod_leitor = '$leitor' and situacao_emprestimo = 0") or die ("Não foi possivel localizar a quantidade de livros emprestado pelo leitor. ".mysql_error());
					
					$reg_l_p = mysql_fetch_assoc($qtd_livro_perm);
						$qtd_l_p = $reg_l_p['qtd_livros'];
					$reg_l_e = mysql_fetch_assoc($qtd_livro_emp);
						$qtd_l_e = $reg_l_e['cont'];
					 if($qtd_l_p - $qtd_l_e == 0){
						 ?>
							<script>
							location.replace("../pages/principal.php");
                                alert('Leitor excedeu o limite de livros emprestados. [BLOQUEADO]')
                                            
                            </script>
                        <?php
						 };
		
		$livro = $_POST['livro'];
		
		$qtd_exemplares = mysql_query("select * from bb_livro where cod_livro = '$livro'") or die ("Não foi possivel localizar a quantidade de exemplares do livro. ".mysql_error());
					
					$qtd_exemplares_emp = mysql_query("select count(*) as contlivro from bb_emprestimo where cod_livro = '$livro'") or die ("Não foi possivel contar a quantidade de livros emprestados. ".mysql_error());
					
					$reg_qtd_exem = mysql_fetch_assoc($qtd_exemplares);
						$qtd_e = $reg_qtd_exem['qtd'];
					
					$reg_qtd_exem_emp = mysql_fetch_assoc($qtd_exemplares_emp);
						$qtd_e_e = $reg_qtd_exem_emp['contlivro'];
						
						if($qtd_e - $qtd_e_e == 0){
							 ?>
								<script>
									location.replace("../pages/principal.php");
                                    alert('O Livro escolhido esta esgotado. [BLOQUEADO]');											
                                </script>
                            <?php
							};
		
		$cod_bibli = $_SESSION['cod_bi'];
		$data_emprestimo = $_POST['data_emprestimo'];
		
		$busca_dias_emp = mysql_query("select bb_tipo_leitor.emprestimo_dias from bb_tipo_leitor inner join bb_leitor on bb_tipo_leitor.cod_tipo = bb_leitor.cod_tipo where bb_leitor.cod_leitor = '$leitor' ") or die ("Não foi possivel localizar os dias de emprestimo. ".mysql_error());
		$qtd_dias = mysql_fetch_assoc($busca_dias_emp);
		$reg_qtd_dias = $qtd_dias['emprestimo_dias'];
		
		$data_devolucao = date('Y-m-d', strtotime("+$reg_qtd_dias days"));
		$obs = $_POST['obs'];
		$situacao = 0;
		
		if($qtd_l_p - $qtd_l_e != 0 and $qtd_e - $qtd_e_e != 0){
			$insere_emprestimo = "insert into bb_emprestimo(cod_leitor, cod_livro, cod_biblioteca, data_emprestimo, data_devolucao, obs, situacao_emprestimo) values('$leitor','$livro','$cod_bibli','$data_emprestimo','$data_devolucao','$obs','$situacao')";
				
				mysql_select_db($db, $con);
				$resultado_emprestimo = mysql_query($insere_emprestimo,$con) or die(mysql_error());
				
				if($resultado_emprestimo){
					$busca_leitor = mysql_query("select * from bb_leitor where cod_leitor = '$leitor'" ) or die ("Não foi possivel localizar o leitor. ".mysql_error());
					$reg_leitor = mysql_fetch_assoc($busca_leitor);
					
				$busca_cod_emp = mysql_query("select cod_emprestimo from bb_emprestimo where cod_leitor = '$leitor' and cod_livro = '$livro' and cod_biblioteca = '$cod_bibli' and data_emprestimo = '$data_emprestimo' ") or die ("Não foi possivel localizar o ultimo código pesquisado. ".mysql_error());
				
				$reg_cod = mysql_fetch_assoc($busca_cod_emp);
				?>
				<script type="text/javascript">
						alert ("Os dados foram gravados com sucesso.");
				</script>
						<!-- começo da ficha -->
						
							<style type="text/css">
								body, td, th {
									font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
									font-style: normal;
									font-weight: bold;
									font-size: 10px;
								}
								</style>
								<div style="text-transform:uppercase;">
                                 <table border="1">
                                 	<tr>
                                    	<td>
                                			Código do empréstimo: 
										</td>
                                       	<td>
											<?php echo $reg_cod['cod_emprestimo'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>
                                			Autor: 
										</td>
										<td>
											<?php echo $reg_qtd_exem['autor'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>
                                    		Título:
										</td>
										<td>
											<?php echo $reg_qtd_exem['titulo'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>
                                        	Data do empréstimo:
                                        </td>
                                        <td>
                                            <input readonly type="date" value="<?php echo $data_emprestimo;?>">
                                        </td>
                                    </tr>
                                    	<tr>
                                        	<td bgcolor="#CCCCCC">
                                            	DEVOLVER EM
                                            </td>
                                            <td bgcolor="#CCCCCC">
                                            	NOME DO LEITOR
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<input type="date" readonly value="<?php echo $data_devolucao;?>">
                                            </td>
                                            <td>
                                            	<input type="text" readonly value="<?php echo $reg_leitor['nome'];?>">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <script>
									function funcaoImprimir(){
										window.print();
									}
								</script>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <input type="button" value="Imprimir" onclick="javascript:document.title = ''; funcaoImprimir()" />
                               
						
						<!-- fim da ficha -->
						
				
			<?php
		}
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
	alert('Você não se encontra logado. Favor realizar login')
				location.replace("../index.html");
</script>
<?php
	}
?>