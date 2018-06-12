import { Multiselect } from 'vue-multiselect';

//Vista: inmobiliaria/create
if (document.querySelector('#ubicacion_inmo')) {

new Vue({
    el: '#ubicacion_inmo',
   
    created: function() {
	  this.getcountries();
	},

	data:{
		paises:[],
		departamentos:[],
		municipios:[],
		colombia:false
	},

	methods:{

		getcountries:function(){

		this.$http.get('/geo/paises')
			.then(function(respuesta){
				this.paises=respuesta.body;
			});
		},

		getdepartamentos:function(){
		this.municipios=[];
		var pais = document.getElementById("pais_inmo");
		var id_pais = pais.options[pais.selectedIndex].value;	

		if(id_pais=='52'){
			this.colombia=true;
		}else{
			this.colombia=false;
		}

		this.$http.get('/geo/departamentos/'+id_pais)
			.then(function(respuesta){
				this.departamentos=respuesta.body;
			});
		},

		getmunicipios:function(){
		var departamento = document.getElementById("departamento_inmo");
		var id_dep = departamento.options[departamento.selectedIndex].value;	
		
		this.$http.get('/geo/municipios/'+id_dep)
			.then(function(respuesta){
				this.municipios=respuesta.body;
			});
		},

	}      
})
}
//Fin Vista: inmobiliaria/create