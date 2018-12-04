$(document).ready(() => {

	var selectedId = 0;
	var selectedIdPregunta = 0;
	var numCrit = 0;
	var numDiv = 0;

	$('#editarFormato').click(function(){
		if (selectedId != 0){
			location.replace('index.php?controller=Preguntas&action=index&parametro=' + selectedId);
		}
	});

	$('#descargarArchivo').click(function(){
		if (selectedId != 0){
			$.get('index.php', {id: selectedId, controller: 'Importar', action: 'getArchivo'}).done(function(data,status){
				var string = data;
				var strings = string.split(',');
				//console.log(data);
				//console.log(strings[1]);
				window.location.href = 'baseDatos/excel/' + strings[1];
			});
		}
	});

	$('#editarPregunta').click(function(){
		if (selectedId != 0){
			var id = document.getElementById('idFormato').value;
			location.replace('index.php?controller=Consultas&action=index&parametro=' + selectedId + '&id=' + id);
		}
	});

	$('#backButtonPreguntas').click(function(){
		location.replace('index.php?controller=Formatos&action=index');
	});

	$('#backButtonConsultas').click(function(){

		var parametro = document.getElementById('idFormato').value;
		console.log(parametro);
		location.replace('index.php?controller=Preguntas&action=index&parametro=' + parametro);
	});

	$('tr').click(function(){
		if (document.getElementById('rowColor').value == 1){
			$(this).addClass('selected').siblings().removeClass('selected');
    		selectedId = $(this).attr('id');
		}
	});

	$('#borrar').click(function(){
		if (selectedId != 0){
			$.post('index.php', {id: selectedId, controller: 'Importar', action: 'borrar'}).done(function(data,status) {
				location.reload();
			});
		}				
	});

	$('#visualizarPregunta').click(function(){
		if (selectedId != 0){
			$.get('index.php', {id:selectedId, controller: 'Consultas', action: 'visualizarPregunta'}).done(function(data,status){
				document.getElementById('tablePregunta').innerHTML = data;
				$('#visualizarPreguntaModal').modal('show');
			
			});
		}
	});

	$('#visualizarFormato').click(function(){
		if (selectedId != 0){
			location.replace('index.php?controller=Consultas&action=visualizarFormato&id=' + selectedId);
			/*$.get('index.php', {id:selectedId, controller:'Consultas', action: 'visualizarFormato'}).done(function(data,status){
				console.log()
			});*/
		}
	});

	$('#borrarPregunta').click(function(){
		if (selectedId != 0){
			$.post('index.php', {id: selectedId, controller: 'Preguntas', action: 'borrar'}).done(function(data,status){
				location.reload();
				//console.log(data);
			});
		}
	});

	$('#borrarFormato').click(function(){
		if (selectedId != 0){
			$.post('index.php', {id: selectedId, controller: 'Formatos', action: 'borrar'}).done(function(data,status){
				location.reload();
			});
		}
	});

	$('#borrarConsulta').click(function(){
		//var idPregunta = document.getElementById('idPregunta').value;
		//var idFormato = document.getElementById('idFormato').value;
		if (selectedId != 0){
			$.post('index.php', {controller: 'Consultas', action: 'borrar', id: selectedId}).done(function(data,status){
				location.reload();
			});
		}
	});

	$('#cargarBaseDatos').click(function(){
		if (selectedId != 0){
			$('#loaderModal').modal('show');
			$.post('index.php', {id: selectedId, controller: 'Importar', action: 'cargarBaseDatos'}).done(function(data,status){
				var string = data;
				var strings = string.split(",");
				if (strings[1] == "success"){
					document.getElementById("loader").style.display = "none";
 					document.getElementById("myDiv").style.display = "block";
 					document.getElementById('status').innerHTML = "Se ha cargado la base de datos exitosamente.";
				}
				else {
					document.getElementById("loader").style.display = "none";
  					document.getElementById("myDiv").style.display = "block";
  					document.getElementById('status').innerHTML = "Ocurrió un error al cargar la base de datos.";
				}
			});
		}
	});

	$('#editarConsulta').click(function(){
		if (selectedId != 0){
			$.post('index.php', {controller:'Consultas', action: 'getConsulta', id: selectedId}).done(function(data,status){
				var string = data;
				var strings = string.split(',');
				var total = strings[3];
				console.log(strings);
				addDiv(total - 1);
				document.getElementById('descripcion').value = strings[1];
				document.getElementById('ordenarSelect').value = strings[2];
				var operadores = document.getElementsByName('operador[]');
				var criterios = document.getElementsByName('criteria[]');
				var valores = document.getElementsByName('valor[]');
				if (total > 1) {
					var conjuntos = document.getElementsByName('conjunto[]');
				}
				for (var i = 0; i < total; i++){
					criterios[i].value = strings[i*4 + 4];
					operadores[i].value = strings[i*4 + 4 + 1];
					valores[i].value = strings[i*4 + 4 + 2];
					if (i != 0){
						conjuntos[i - 1].value = strings[i*4 + 4 + 3];
					}	
				}
				//console.log(criterios[0].value);
				//console.log(operadores[0].value);
				//console.log(valores[0].value);
				document.getElementById('editando').value = 1;
				document.getElementById('idConsulta').value = selectedId;
				$('#modal').modal('show');
			});
		}
	});

	$('#visualizarConsulta').click(function(){
		if (selectedId != 0){
			$.post('index.php', {controller: 'Consultas', action: 'consulta', id: selectedId}).done(function(data,status){
				console.log(data);
				document.getElementById('tableConsulta').innerHTML = data;
				$('#visualizarCon').modal('show');
			});
		}
	});

	$('#modal').on('hidden.bs.modal', function () {
		var string = "";
		var string1 = "";
					/*string += "<div class='form-group row'>"
						string += "<div class='col-3'>"
            				string += "<label class='col-sm-2 col-form-label'>Campo</label>"
            			string += "</div>"
            			string += "<div class='col-9'>"
							string += "<select class='form-control' name='criteria[]'>"
    							string += "<option selected value='0'></option>"
    							string += "<option value='Total'> Total</option>"
    							string += "<option value='Sexo'> Sexo</option>"
    							string += "<option value='calificacionTotal'> Calificacion</option>"
    							string += "<option value='Carrera'> Carrera</option>"
    						string += "</select>"
    					string += "</div>"
    				string += "</div>"
					string += "<div class='form-group row'>"
    					string += "<div class='col-3'>"
            				string += "<label class='col-sm-2 col-form-label'>Operador</label>"
            			string += "</div>"
     					string += "<div class='col-9'>"
    						string += "<select class='form-control' name='operador[]'>"
    							string += "<option selected value='0'></option>"
    							string += "<option value='>'> ></option>"
    							string += "<option value='<'> <</option>"
    							string +="<option value='='> =</option>"
    						string += "</select>"
    					string += "</div>"
    				string += "</div>"
					string += "<div class='form-group row'>"
						string += "<div class='col-3'>"
    						string += "<label for='inputPassword' class='col-sm-2 col-form-label'>Valor</label>"
    					string += "</div>"
    					string += "<div class='col-9'>"
     						string += "<input type='text' class='form-control' id='inputPassword' name='valor[]'>"
    					string += "</div>"
  					string += "</div>"
					string1 += "<select class='form-control' name='ordenar' id='ordenarSelect'>"
    					string1 += "<option selected value='0'></option>"
    					string1 += "<option value='Semestre'> Semestre</option>"
    					string1 += "<option value='Sexo'> Sexo</option>"
    				string1 += "</select>"*/
    	/*document.getElementById('criteria').innerHTML = string;*/
    	document.getElementById('descripcion').value = "";
    	document.getElementById('ordenarSelect').value = 0;
    	document.getElementById('nuevo0').innerHTML = "";
    	var operadores = document.getElementsByName('operador[]');
		var criterios = document.getElementsByName('criteria[]');
		var valores = document.getElementsByName('valor[]');
    	operadores[0].value = 0;
    	criterios[0].value = 0;
    	valores[0].value = "";
    	numDiv = 0;
    	document.getElementById('editando').value = 0;
	});


	/*$('#descargar').click(function(){

	});*/

	$( '#add' ).unbind( 'click' );



	$('#add').click(function(){
		var string = "";
						string += "<hr>"
						string += "<div class='form-group row'>";
						string += "<div class='col-3'>";
            				string += "<label class='col-sm-2 col-form-label'>Conector</label>";
            			string += "</div>";
            			string += "<div class='col-9'>";
							string += "<select class='form-control' name='conjunto[]'>";
    							string += "<option selected value='0'></option>";
    							string += "<option value='1'> AND</option>";
    							string += "<option value='2'> OR</option>";
    						string += "</select>";
    					string += "</div>";
    				string += "</div>";							
       				string += "<div class='form-group row'>";
						string += "<div class='col-3'>";
            				string += "<label class='col-sm-2 col-form-label'>Campo</label>";
            			string += "</div>";
            			string += "<div class='col-9'>";
							string += "<select class='form-control' name='criteria[]'>";
    							string += "<option selected value='0'></option>";
    							string += "<option value='1'> Sexo</option>";
    							string += "<option value='2'> Carrera</option>";
    							string += "<option value='3'> Turno</option>";
    							string += "<option value='4'> Materias Aprobadas</option>"
                                string += "<option value='5'> Materias Reprobadas</option>"
                                string += "<option value='6'> Nacido en el Extranjero</option>"
    						string += "</select>";
    					string += "</div>";
    				string += "</div>";
					string += "<div class='form-group row'>";
    					string += "<div class='col-3'>";
            				string += "<label class='col-sm-2 col-form-label'>Operador</label>";
            			string += "</div>";
     					string += "<div class='col-9'>";
    						string += "<select class='form-control' name='operador[]'>";
    							string += "<option selected value='0'></option>";
    							string += "<option value='1'> ></option>";
    							string += "<option value='2'> <</option>";
    							string +="<option value='3'> =</option>";
    						string += "</select>";
    					string += "</div>";
    				string += "</div>";
					string += "<div class='form-group row'>";
						string += "<div class='col-3'>";
    						string += "<label for='inputPassword' class='col-sm-2 col-form-label'>Valor</label>";
    					string += "</div>";
    					string += "<div class='col-9'>";
     						string += "<input type='text' class='form-control' id='inputPassword' name='valor[]'>";
    					string += "</div>";
  					string += "</div>";
  					numDiv++;
  					string += "<div id='nuevo" + numDiv + "'></div>";
  					numDiv--;
  		document.getElementById('nuevo' + numDiv).innerHTML += string;
  		numDiv++;
	});



	function addDiv (times){
		numDiv = times;
		for (var i = 0; i < times; i++){
			var string = "";
						string += "<hr>"
						string += "<div class='form-group row'>";
						string += "<div class='col-3'>";
            				string += "<label class='col-sm-2 col-form-label'>Conector</label>";
            			string += "</div>";
            			string += "<div class='col-9'>";
							string += "<select class='form-control' name='conjunto[]'>";
    							string += "<option selected value='0'></option>";
    							string += "<option value='1'> AND</option>";
    							string += "<option value='2'> OR</option>";
    						string += "</select>";
    					string += "</div>";
    				string += "</div>";							
       				string += "<div class='form-group row'>";
						string += "<div class='col-3'>";
            				string += "<label class='col-sm-2 col-form-label'>Campo</label>";
            			string += "</div>";
            			string += "<div class='col-9'>";
							string += "<select class='form-control' name='criteria[]'>";
								string += "<option selected value='0'></option>";
    							string += "<option value='1'> Sexo</option>";
    							string += "<option value='2'> Carrera</option>";
                                string += "<option value='3'> Turno</option>";
                                string += "<option value='4'> Materias Aprobadas</option>";
                                string += "<option value='5'> Materias Reprobadas</option>";
                                string += "<option value='6'> Nacido en el Extranjero</option>";
    						string += "</select>";
    					string += "</div>";
    				string += "</div>";
					string += "<div class='form-group row'>";
    					string += "<div class='col-3'>";
            				string += "<label class='col-sm-2 col-form-label'>Operador</label>";
            			string += "</div>";
     					string += "<div class='col-9'>";
    						string += "<select class='form-control' name='operador[]'>";
    							string += "<option selected value='0'></option>";
    							string += "<option value='1'> ></option>";
    							string += "<option value='2'> <</option>";
    							string +="<option value='3'> =</option>";
    						string += "</select>";
    					string += "</div>";
    				string += "</div>";
					string += "<div class='form-group row'>";
						string += "<div class='col-3'>";
    						string += "<label for='inputPassword' class='col-sm-2 col-form-label'>Valor</label>";
    					string += "</div>";
    					string += "<div class='col-9'>";
     						string += "<input type='text' class='form-control' id='inputPassword' name='valor[]'>";
    					string += "</div>";
  					string += "</div>";
  					i++;
  					string += "<div id='nuevo" + i + "'></div>";
  					i--;
  		document.getElementById('nuevo' + i).innerHTML += string;
		}
	}


	function reset () {
		numCrit = 0;
	}
	
});


    				


    					
    					
    					
    					
    					
    				
    				
    					
    					
    					
    					
    				
					
    					
    					
     						
    					
  					