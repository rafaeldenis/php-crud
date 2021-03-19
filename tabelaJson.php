<style>

    .modal-dialog:target {
        opacity:1;
        pointer-events: auto;
    }
    .modal-dialog > div {
        width: 800px;
        position: relative;
        margin: 10% auto;
        padding: 5px 20px 13px 20px;
        border-radius: 10px;
        background: #fff;
        background: -moz-linear-gradient(#fff, #999);
        background: -webkit-linear-gradient(#fff, #999);
        background: -o-linear-gradient(#fff, #999);
        overflow-y: initial !important
}

   
.modal-body{
    height: 250px;
    overflow-y: auto;
}
    .close {
        background: #606061;
        color: #FFFFFF;
        line-height: 25px;
        position: absolute;
        right: -12px;
        text-align: center;
        top: -10px;
        width: 24px;
        text-decoration: none;
        font-weight: bold;
        -webkit-border-radius: 12px;
        -moz-border-radius: 12px;
        border-radius: 12px;
        -moz-box-shadow: 1px 1px 3px #000;
        -webkit-box-shadow: 1px 1px 3px #000;
        box-shadow: 1px 1px 3px #000;
    }
    .close:hover {
        background: #00d9ff;
    }

</style>


<?php
include 'functions.php';
?>
<?=template_header('Read')?>
<div class="content read">
<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">LISTA DE CLIENTES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Detalahmento Produto com json e retorno em div dialog</p>
        <table id="minhaTabela" name="minhaTabela" class="table-responsive">
        <thead>
            <tr>
                <td>#</td>
                <td>Nome</td>
                <td>apelido</td>
                <td>apelido</td>
                <td>apelido</td>
                
              
            </tr>
        </thead>
        <tbody>
       
           
        </tbody>
        </table>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" id="fecharModal" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</div>



<?=template_footer()?>
<script>
$(".close").click(function(){
    $("#myModal").hide();
 });
 $("#fecharModal").click(function(){
    $("#myModal").hide();
 }); 
jQuery(function($) {
    
      $("#myModal").modal({
        show: true
        });
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
				    itens += "<td>" + retorno[i].apelido + "</td>";
				    itens += "<td>" + retorno[i].apelido + "</td>";
                 
				    itens += "</tr>";
                    itens += "<tr>";
				    itens += "<td>" + retorno[i].id + "</td>";
				    itens += "<td>" + retorno[i].nome + "</td>";
				    itens += "<td>" + retorno[i].apelido + "</td>";
				    itens += "<td>" + retorno[i].apelido + "</td>";
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




