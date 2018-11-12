$(document).ready(() => {

	var selectedId = 0;

	$("tr").click(function(){
    	$(this).addClass("selected").siblings().removeClass("selected");
    	this.selectedId = $(this).attr('id');
	});

	$("#borrar").click(function(){
		$.post("index.php?controller=Importar&action=borrar", {id: this.selectedId}).done();
	});
	
});

