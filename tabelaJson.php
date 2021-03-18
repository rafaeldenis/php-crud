<?php
include 'functions.php';

?>
<?=template_header('Read')?>
<div class="content read">
<table id="minhaTabela" name="minhaTabela">
        <thead>
            <tr>
                <td>#</td>
                <td>Nome</td>
                <td>apelido</td>
                
              
            </tr>
        </thead>
        <tbody>
        <tr>
                <td>#</td>
                <td>Nome</td>
                <td>apelido</td>
                
              
            </tr>
           
        </tbody>
    </table>
</div>



<?=template_footer()?>
<script>

jQuery(function($) {
    
    
    alert("retornaaa dados Json  testando um servioce php");
   
    var itens = "", url = "dadosJson.php";

    //Capturar Dados Usando Método AJAX do jQuery
    $.ajax({
	    url: url,
	    cache: false,
	    dataType: "json",
	    beforeSend: function() {
		    $("h2").html("Carregando..."); //Carregando
	    },
	    error: function() {
		    $("h2").html("Há algum problema com a fonte de dados");
	    },
	    success: function(retorno) {
            
		    if(retorno[0].erro){
			    $("h2").html(retorno[0].erro);
		    }
		    else{
			    //Laço para criar linhas da tabela
			    for(var i = 0; i<retorno.length; i++){
				    itens += "<tr>";
				    itens += "<td>" + retorno[i].id + "</td>";
				    itens += "<td>" + retorno[i].nome + "</td>";
				    itens += "<td>" + retorno[i].apelido + "</td>";

				    itens += "</tr>";
			    }
			    //Preencher a Tabela
			    $("#minhaTabela tbody").html(itens);
			    
			    //Limpar Status de Carregando
			    $("h2").html("Carregado");
		    }
	    }
    });

     $("#myModal").show();
 $("#deletebtn").click(function(){
  // Your ajax call for controller to delete
 });
    
    });


</script>




