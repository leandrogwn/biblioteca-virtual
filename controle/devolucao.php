<?php
	session_start();
	
	if($_SESSION['logado'] = 'logado'){
		
		


	}else{
?>
<script>
	alert('Você não se encontra logado. Favor realizar login')
				location.replace("../index.html");
</script>
<?php
	}
?>