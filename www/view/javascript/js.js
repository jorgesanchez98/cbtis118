$(document).ready(() => {

	var selectedId = 0;
	var numCrit = 0;

	$('tr').click(function(){
    	$(this).addClass('selected').siblings().removeClass('selected');
    	selectedId = $(this).attr('id');
	});

	$('#borrar').click(function(){
		$.post('index.php', {id: selectedId, controller: 'Importar', action: 'borrar'}).done(function(data,status) {
			
		});
	});

	/*$('#descargar').click(function(){

	});*/

	$( '#add' ).unbind( 'click' );


	$('#add').click(function(){
		//document.getElementById('nuevo').innerHTML += "<div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' id='OR' name = 'OR[]' value='OR'><label class='form-check-label' for='inlineCheckbox1'>OR</label></div><div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' id='AND' name = 'AND[]' value='AND'><label class='form-check-label' for='inlineCheckbox2'>AND</label></div><select class = 'form-control' name='criteria[]'> <option selected value='0'></option> <option value='Total'> Total</option><option value='Sexo'> Sexo</option> <option value='Calificacion'> Calificacion</option> <option value='Carrera'> Carrera</option> </select> <div class='form-check form-check-inline'> <input class='form-check-input' type='checkbox' name = 'mayor[]' value='>'> <label class='form-check-label' for='inlineCheckbox1'>></label> </div> <div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' name = 'menor[]' value='<'><label class='form-check-label' for='inlineCheckbox2'><</label></div><div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' name = 'igual[]' value='='><label class='form-check-label' for='inlineCheckbox3'>=</label></div><div class='form-group row'><label for='inputPassword' class='col-sm-2 col-form-label'>Valor</label><div class='col-sm-10'><input type='text' class='form-control' id='inputPassword' name = 'valor[]'></div></div>"												
		//document.getElementById('nuevo').innerHTML -= '<div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' id='inlineCheckbox1' value='option1'><label class='form-check-label' for='inlineCheckbox1'>OR</label></div><div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' id='inlineCheckbox2' value='option2'><label class='form-check-label' for='inlineCheckbox2'>AND</label></div><select class = 'form-control' name = name='tipoArchivo'> <option selected value='0'></option> <option value='1'> Total</option><option value='1'> Sexo</option> <option value='1'> Calificacion</option> <option value='1'> Carrera</option> </select> <div class='form-check form-check-inline'> <input class='form-check-input' type='checkbox' id='inlineCheckbox1' value='option1'> <label class='form-check-label' for='inlineCheckbox1'>></label> </div> <div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' id='inlineCheckbox2' value='option2'><label class='form-check-label' for='inlineCheckbox2'><</label></div><div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' id='inlineCheckbox3' value='option3'><label class='form-check-label' for='inlineCheckbox3'>=</label></div><div class='form-group row'><label for='inputPassword' class='col-sm-2 col-form-label'>Valor</label><div class='col-sm-10'><input type='text' class='form-control' id='inputPassword'></div></div>'													
		document.getElementById('nuevo').innerHTML +=  "<label class='col-sm-2 col-form-label'>Conector</label><select class='form-control' name='conjunto[]'> <option selected value='0'></option> <option value='AND'> AND</option> <option value='OR'> OR</option> </select><label class='col-sm-2 col-form-label'>Criterio</label> <select class='form-control' name='criteria[]'> <option selected value='0'></option> <option value='Total'> Total</option> <option value='Sexo'> Sexo</option><option value='calificacionTotal'> Calificacion</option><option value='Carrera'> Carrera</option></select><label class='col-sm-2 col-form-label'>Operador</label>	 <select class='form-control' name='operador[]'> <option selected value='0'></option><option value='>'> ></option> <option value='<'> <</option><option value='='> =</option> </select>	<div class='form-group row'> <label for='inputPassword' class='col-sm-2 col-form-label'>Valor</label> <div class='col-sm-10'> <input type='text' class='form-control' id='inputPassword' name='valor[]'> </div>	</div>"				
				
	


	});


	function reset () {
		numCrit = 0;
	}
	
});


    				


    					
    					
    					
    					
    					
    				
    				
    					
    					
    					
    					
    				
					
    					
    					
     						
    					
  					