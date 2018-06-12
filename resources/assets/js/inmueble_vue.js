import { Multiselect } from 'vue-multiselect';

//Vista: /inmueble/create
if (document.querySelector('#ubicacion_dueno')) {

new Vue({
    el: '#ubicacion_dueno',
   
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
		var pais = document.getElementById("pais_dueno");
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
		var departamento = document.getElementById("departamento_dueno");
		var id_dep = departamento.options[departamento.selectedIndex].value;	
		
		this.$http.get('/geo/municipios/'+id_dep)
			.then(function(respuesta){
				this.municipios=respuesta.body;
			});
		},

	}      
})
}


if (document.querySelector('#ubicacion')) {

new Vue({
    el: '#ubicacion',
   
    created: function() {
	  this.getcountries();
	},

	data:{
		paises:[],
		departamentos:[],
		municipios:[],
		colombia:false,
		comunas:true,
		localidads:false
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
		var pais = document.getElementById("pais");
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
		var departamento = document.getElementById("departamento");
		var id_dep = departamento.options[departamento.selectedIndex].value;	
		
		this.$http.get('/geo/municipios/'+id_dep)
			.then(function(respuesta){
				this.municipios=respuesta.body;
			});
		},

		askbogota:function(){

			
			var ciudad = document.getElementById("municipio");
			var ciudad_id = ciudad.options[ciudad.selectedIndex].value;

			if(ciudad_id=='525'){
			this.comunas=false;
			this.localidads=true;
		}else{
			this.comunas=true;
			this.localidads=false;
		}

		}

	}      
})
}

if (document.querySelector('#caracteristicas')) {

new Vue({
	el: '#caracteristicas',

	data:{
		opciones_tipo_propiedad:[],
		label_precio:"Precio*",
		v_propiedad_horizontal:true,
		v_edad:true,
		v_piso:false,
		v_niveles:false,
		v_amoblado:false,
		v_habitaciones:false,
		v_banos:false,
		v_estudios:false,
		v_garajes:false,
		v_pisos:false,
		v_depositos:false,
		v_internas:false,
		v_terreno:false,
		v_construida:true,
		v_privada:true,
		v_uso_lote:false,
		v_entrega:false,
		value_internas: '',
		internas:[],
      	horizontal:'',
      	value_externas: '',
      	externas: [
		{name: 'Asensor'},
		{name: 'Canchas deportivas'},
		{name: 'Circuito cerrado'},
		{name: 'Club House'},
		{name: 'Conjunto cerrado/condominio'},
		{name: 'Gimnasio'},
		{name: 'Jardines'},
		{name: 'Lago'},
		{name: 'Parque infantil'},
		{name: 'Parqueadero cubierto'},
		{name: 'Parqueadero de visitantes'},
		{name: 'Parqueadero descubierto'},
		{name: 'Parqueadero en semisotano'},
		{name: 'Parqueadero en sotano'},
		{name: 'Parques cercanos'},
		{name: 'Piscina'},
		{name: 'Portería / Lobby'},
		{name: 'Pozo de agua natural'},
		{name: 'Reserva forestal'},
		{name: 'Sala de cine'},
		{name: 'Sala de conductores y escoltas'},
		{name: 'Sala de juegos'},
		{name: 'Sala de juntas'},
		{name: 'Sala de negocios'},
		{name: 'Salones comunales'},
		{name: 'Shut de basuras con ducto'},
		{name: 'Solar / Deck'},
		{name: 'Teatro'},
		{name: 'Vigilancia'},
		{name: 'Zona BBQ'},
		{name: 'Zonas Húmedas'}
      ]
		},
		components: { Multiselect },

		methods:{

		arriendocheck:function(){
			var tipo_negocio= document.getElementById("negocio");
			var negocio=tipo_negocio.options[tipo_negocio.selectedIndex].value;

			if(negocio=="arriendo"){
				this.label_precio="Canon de arrendamiento*";
			}else{
				this.label_precio="Precio*";
			}

		},		

		validarcategoria:function(){

			var tipo_negocio= document.getElementById("negocio");
			var negocio=tipo_negocio.options[tipo_negocio.selectedIndex].value;

			var tipo_propiedad = document.getElementById("categoria");
			var valor_tipo_propiedad = tipo_propiedad.options[tipo_propiedad.selectedIndex].value;

			if(valor_tipo_propiedad=="vivienda"&negocio=="venta"){

				this.opciones_tipo_propiedad=[];

				this.opciones_tipo_propiedad.push(
					{text: 'Apartamento', value: 'apartamento'},
					{text: 'Apartaestudio', value: 'apartaestudio'},
					{text: 'Casa', value: 'casa'},
					{text: 'Casa campestre', value: 'campestre'},
					{text: 'Edificio de apartamentos', value: 'edificio'},
					{text: 'Lote', value: 'lote'},
					{text: 'Penthouse', value: 'penthouse'},
					{text: 'Sobre Plano', value:'plano'},
					{text: 'Otros', value:'otros'}
				);		
			}

			if(valor_tipo_propiedad=="vivienda"&negocio!="venta"){

				this.opciones_tipo_propiedad=[];

				this.opciones_tipo_propiedad.push(
					{text: 'Apartamento', value: 'apartamento'},
					{text: 'Apartaestudio', value: 'apartaestudio'},
					{text: 'Casa', value: 'casa'},
					{text: 'Casa campestre', value: 'campestre'},
					{text: 'Edificio de apartamentos', value: 'edificio'},
					{text: 'Habitación', value: 'habitacion'},	
					{text: 'Lote', value: 'lote'},
					{text: 'Penthouse', value: 'penthouse'},
					{text: 'Sobre Plano', value:'plano'},
					{text: 'Otros', value:'otros'}
				);		
			}


			if(valor_tipo_propiedad=="comercial"){

				this.opciones_tipo_propiedad=[];

				this.opciones_tipo_propiedad.push(
					{text:'Bodega',value:'bodega'},
					{text:'Consultorio',value:'consultorio'},
					{text:'Edificio de oficinas',value:'edificio'},
					{text:'Finca',value:'finca'},
					{text:'Oficina',value:'oficina'},
					{text:'Local',value:'local'},
					{text:'Lote',value:'lote'},
					{text:'Storage',value:'storage'},
					{text:'Sobre Plano',value:'plano'},
					{text:'Otros',value:'otros'}
				);

			}

			if(valor_tipo_propiedad=="turismo"&negocio!="venta"){

				this.opciones_tipo_propiedad=[];

				this.opciones_tipo_propiedad.push(
					{text:'Apartamento',value:'apartamento'},
					{text:'Casa',value:'casa'},
					{text:'Casa campestre',value:'campestre'},
					{text:'Finca',value:'finca'},					
					{text:'Habitación',value:'habitacion'},
					{text:'Hotel',value:'hotel'},
					{text:'Penthouse',value:'penthouse'},			
					{text:'Sobre Plano',value:'plano'},
					{text:'Otros',value:'otros'}
				);
			}

			if(valor_tipo_propiedad=="turismo"&negocio=="venta"){

				this.opciones_tipo_propiedad=[];

				this.opciones_tipo_propiedad.push(
					{text:'Apartamento',value:'apartamento'},
					{text:'Casa',value:'casa'},
					{text:'Casa campestre',value:'campestre'},
					{text:'Finca',value:'finca'},					
					{text:'Hotel',value:'hotel'},
					{text:'Penthouse',value:'penthouse'},			
					{text:'Sobre Plano',value:'plano'},
					{text:'Otros',value:'otros'}
				);
			}
		},

		validartipopropiedad:function(){
			var tipo_propiedad_detalle = document.getElementById("tipo_propiedad_detalle");
			var valor_tipo_propiedad_detalle = tipo_propiedad_detalle.options[tipo_propiedad_detalle.selectedIndex].value;
			console.log(valor_tipo_propiedad_detalle);
		switch(valor_tipo_propiedad_detalle) {
    		case "apartamento":
    		this.v_propiedad_horizontal=true,
    			this.v_pisos=false;
    			this.v_uso_lote=false;
    		    this.v_privada=true;
        		this.v_piso=true;
				this.v_niveles=true;
				this.v_amoblado=true;
				this.v_habitaciones=true;
				this.v_banos=true;
				this.v_estudios=true;
				this.v_garajes=true;
				this.v_depositos=true;
				this.v_internas=true;
				this.v_terreno=false;
				this.v_entrega=false;
				this.internas=[];
				this.internas.push(
			      	{name: 'Aire acondicionado'},
					{name: 'Balcón'},
					{name: 'Baño privado'},
					{name: 'Baño social'},
					{name: 'Calentador'},
					{name: 'Citófono'},
					{name: 'Chimenea'},
					{name: 'Closet'},
					{name: 'Cocina a gas'},
					{name: 'Cocina eléctrica'},
					{name: 'Cocina Integral'},
					{name: 'Cocina tipo Americano '},
					{name: 'Gas'},
					{name: 'Patio'},
					{name: 'Piso de granito'},
					{name: 'Piso de madera'},
					{name: 'Piso de marmol'},
					{name: 'Piso en cerámica'},
					{name: 'Sistema de sonido'},
					{name: 'Terraza'},
					{name: 'Vestier/ Walking closet'},
					{name: 'Zona de ropas'}
				);




        	break;
    		case "habitacion":
    		this.v_propiedad_horizontal=true,
    			this.v_pisos=false;
        		this.v_piso=true;
        		this.v_uso_lote=false;
				this.v_niveles=false;
				this.v_amoblado=true;
				this.v_habitaciones=false;
				this.v_banos=true;
				this.v_estudios=true;
				this.v_garajes=true;
				this.v_depositos=true;
				this.v_internas=true;
				this.v_terreno=false;
				this.v_entrega=false;
				this.internas=[];
				this.internas.push(
			      	{name: 'Aire acondicionado'},
					{name: 'Balcón'},
					{name: 'Baño privado'},
					{name: 'Baño social'},
					{name: 'Calentador'},
					{name: 'Citófono'},
					{name: 'Chimenea'},
					{name: 'Closet'},
					{name: 'Cocina a gas'},
					{name: 'Cocina eléctrica'},
					{name: 'Cocina Integral'},
					{name: 'Cocina tipo Americano '},
					{name: 'Gas'},
					{name: 'Patio'},
					{name: 'Piso de granito'},
					{name: 'Piso de madera'},
					{name: 'Piso de marmol'},
					{name: 'Piso en cerámica'},
					{name: 'Sistema de sonido'},
					{name: 'Terraza'},
					{name: 'Vestier/ Walking closet'},
					{name: 'Zona de ropas'}
				);

        	break;
        	case "apartaestudio":
        	this.v_propiedad_horizontal=true,
        		this.v_pisos=false;
        		this.v_uso_lote=false;
        	    this.v_privada=true;
        		this.v_piso=true;
				this.v_niveles=false;
				this.v_amoblado=true;
				this.v_habitaciones=false;
				this.v_banos=true;
				this.v_estudios=true;
				this.v_garajes=true;
				this.v_depositos=true;
				this.v_internas=true;
				this.v_terreno=false;
				this.v_entrega=false;
				this.internas=[];
				this.internas.push(
			      	{name: 'Aire acondicionado'},
					{name: 'Balcón'},
					{name: 'Baño privado'},
					{name: 'Baño social'},
					{name: 'Calentador'},
					{name: 'Citófono'},
					{name: 'Chimenea'},
					{name: 'Closet'},
					{name: 'Cocina a gas'},
					{name: 'Cocina eléctrica'},
					{name: 'Cocina Integral'},
					{name: 'Cocina tipo Americano '},
					{name: 'Gas'},
					{name: 'Patio'},
					{name: 'Piso de granito'},
					{name: 'Piso de madera'},
					{name: 'Piso de marmol'},
					{name: 'Piso en cerámica'},
					{name: 'Sistema de sonido'},
					{name: 'Terraza'},
					{name: 'Vestier/ Walking closet'},
					{name: 'Zona de ropas'}
				);

        	break;
        	case "penthouse":
        	this.v_propiedad_horizontal=true,
        		this.v_pisos=false;
        		this.v_uso_lote=false;
        		this.v_privada=true;
        		this.v_piso=true;
				this.v_niveles=true;
				this.v_amoblado=true;
				this.v_habitaciones=true;
				this.v_banos=true;
				this.v_estudios=true;
				this.v_garajes=true;
				this.v_depositos=true;
				this.v_internas=true;
				this.v_terreno=false;
				this.v_entrega=false;
				this.internas=[];
				this.internas.push(
			      	{name: 'Aire acondicionado'},
					{name: 'Balcón'},
					{name: 'Baño privado'},
					{name: 'Baño social'},
					{name: 'Calentador'},
					{name: 'Citófono'},
					{name: 'Chimenea'},
					{name: 'Closet'},
					{name: 'Cocina a gas'},
					{name: 'Cocina eléctrica'},
					{name: 'Cocina Integral'},
					{name: 'Cocina tipo Americano '},
					{name: 'Gas'},
					{name: 'Patio'},
					{name: 'Piso de granito'},
					{name: 'Piso de madera'},
					{name: 'Piso de marmol'},
					{name: 'Piso en cerámica'},
					{name: 'Sistema de sonido'},
					{name: 'Terraza'},
					{name: 'Vestier/ Walking closet'},
					{name: 'Zona de ropas'}
				);

        	break;
        	case "casa":
        	this.v_propiedad_horizontal=true,
        		this.v_pisos=false;
        		this.v_privada=true;
        		this.v_uso_lote=false;
        		this.v_piso=false;
				this.v_niveles=true;
				this.v_amoblado=true;
				this.v_habitaciones=true;
				this.v_banos=true;
				this.v_estudios=true;
				this.v_garajes=true;
				this.v_depositos=true;
				this.v_internas=true;
				this.v_terreno=true;
				this.v_entrega=false;
				this.internas=[];
				this.internas.push(
			      	{name: 'Aire acondicionado'},
					{name: 'Balcón'},
					{name: 'Baño privado'},
					{name: 'Baño social'},
					{name: 'Calentador'},
					{name: 'Citófono'},
					{name: 'Chimenea'},
					{name: 'Closet'},
					{name: 'Cocina a gas'},
					{name: 'Cocina eléctrica'},
					{name: 'Cocina Integral'},
					{name: 'Cocina tipo Americano '},
					{name: 'Gas'},
					{name: 'Jacuzzi'},
					{name: 'Patio'},
					{name: 'Pesebrera'},
					{name: 'Piscina'},
					{name: 'Piso de granito'},
					{name: 'Piso de madera'},
					{name: 'Piso de marmol'},
					{name: 'Piso en cerámica'},
					{name: 'Sauna'},
					{name: 'Sistema de sonido'},
					{name: 'Terraza'},
					{name: 'Turco'},
					{name: 'Vestier/ Walking closet'},
					{name: 'Zona de ropas'}
				);
				
				
        	break;
        	case "campestre":
        	this.v_propiedad_horizontal=true,
        		this.v_privada=true;
        		this.v_uso_lote=false;
        		this.v_piso=false;
        		this.v_pisos=false;
				this.v_niveles=true;
				this.v_amoblado=true;
				this.v_habitaciones=true;
				this.v_banos=true;
				this.v_estudios=true;
				this.v_garajes=true;
				this.v_depositos=true;
				this.v_internas=true;
				this.v_terreno=true;
				this.v_entrega=false;
				this.internas=[];
				this.internas.push(
			      	{name: 'Aire acondicionado'},
					{name: 'Balcón'},
					{name: 'Baño privado'},
					{name: 'Baño social'},
					{name: 'Calentador'},
					{name: 'Citófono'},
					{name: 'Chimenea'},
					{name: 'Closet'},
					{name: 'Cocina a gas'},
					{name: 'Cocina eléctrica'},
					{name: 'Cocina Integral'},
					{name: 'Cocina tipo Americano '},
					{name: 'Gas'},
					{name: 'Jacuzzi'},
					{name: 'Patio'},
					{name: 'Pesebrera'},
					{name: 'Piscina'},
					{name: 'Piso de granito'},
					{name: 'Piso de madera'},
					{name: 'Piso de marmol'},
					{name: 'Piso en cerámica'},
					{name: 'Sauna'},
					{name: 'Sistema de sonido'},
					{name: 'Terraza'},
					{name: 'Turco'},
					{name: 'Vestier/ Walking closet'},
					{name: 'Zona de ropas'}
				);

        	break;
        	case "plano":
        	this.v_propiedad_horizontal=true,
        	    this.v_privada=true;
        	    this.v_entrega=true;
        	    this.v_pisos=false;
        	    this.v_uso_lote=false;
        		this.v_edad=false;
        		this.v_piso=true;
				this.v_niveles=true;
				this.v_amoblado=true;
				this.v_habitaciones=true;
				this.v_banos=true;
				this.v_estudios=true;
				this.v_garajes=true;
				this.v_depositos=true;
				this.v_internas=true;
				this.internas=[];
				this.internas.push(
			      	{name: 'Aire acondicionado'},
					{name: 'Balcón'},
					{name: 'Baño privado'},
					{name: 'Baño social'},
					{name: 'Calentador'},
					{name: 'Citófono'},
					{name: 'Chimenea'},
					{name: 'Closet'},
					{name: 'Cocina a gas'},
					{name: 'Cocina eléctrica'},
					{name: 'Cocina Integral'},
					{name: 'Cocina tipo Americano '},
					{name: 'Gas'},
					{name: 'Jacuzzi'},
					{name: 'Patio'},
					{name: 'Pesebrera'},
					{name: 'Piscina'},
					{name: 'Piso de granito'},
					{name: 'Piso de madera'},
					{name: 'Piso de marmol'},
					{name: 'Piso en cerámica'},
					{name: 'Sauna'},
					{name: 'Sistema de sonido'},
					{name: 'Terraza'},
					{name: 'Turco'},
					{name: 'Vestier/ Walking closet'},
					{name: 'Zona de ropas'}
				);


        	break;
        	case "local":
        		this.v_piso=true;
        		this.v_propiedad_horizontal=true,
        		this.v_uso_lote=false;
        		this.v_pisos=false;
				this.v_niveles=true;
				this.v_amoblado=false;
				this.v_habitaciones=false;
				this.v_banos=true;
				this.v_estudios=false;
				this.v_garajes=true;
				this.v_depositos=true;
				this.v_entrega=false;
        	break;
        	case "oficina":
        		this.v_piso=true;
        		this.v_propiedad_horizontal=true,
        		this.v_pisos=false;
        		this.v_uso_lote=false;
				this.v_niveles=true;
				this.v_amoblado=true;
				this.v_habitaciones=false;
				this.v_banos=true;
				this.v_estudios=false;
				this.v_garajes=true;
				this.v_depositos=true;
				this.v_entrega=false;
				this.v_internas=true;
				this.internas=[];
				this.internas.push(
			      	{name: 'Sala de juntas'}, 
			      	{name: 'Cableado interno'},
			      	{name: 'Mobiliario'},
			      	{name: 'Comunicaciones'},
			      	{name: 'Vigilancia privada'}
				);


        	break;
        	case "consultorio":
        	this.v_propiedad_horizontal=true,

        		this.v_piso=true;
        		this.v_pisos=false;
        		this.v_uso_lote=false;
				this.v_niveles=true;
				this.v_amoblado=true;
				this.v_habitaciones=false;
				this.v_banos=true;
				this.v_estudios=false;
				this.v_garajes=true;
				this.v_depositos=true;
				this.v_entrega=false;
        	break;
        	case "hotel":
        		this.v_propiedad_horizontal=false,
        		this.v_uso_lote=false;
        		this.v_entrega=false;
        		this.v_privada=false;
        		this.v_edad=true;
        		this.v_piso=false;
				this.v_niveles=false;
				this.v_amoblado=false;
				this.v_habitaciones=false;
				this.v_banos=false;
				this.v_estudios=false;
				this.v_garajes=true;
				this.v_pisos=true;
				this.v_depositos=false;
				this.v_internas=true;
				this.v_terreno=false;
				this.v_construida=true;
				this.internas=[];
				this.internas.push(
					{name: 'Playa cercana'},
					{name: 'Playa Privada'}, 
					{name: 'Planta eléctrica'},  
			      	{name: 'Planta eléctrica'}, 
			      	{name: 'Tanque de reserva'},
			      	{name: 'Parqueadero de visitantes'},
			      	{name: 'Portería'},
			      	{name: 'Lobby'},
			      	{name: 'Asensor'},
			      	{name: 'Ciurcuito CCTV '},
			      	{name: 'Monitoreo'}
				);
        	break;
        	case "finca":
        	this.v_propiedad_horizontal=true,
        		this.v_privada=true;
        		this.v_pisos=false;
        		this.v_uso_lote=false;
        		this.v_piso=false;
				this.v_niveles=false;
				this.v_amoblado=true;
				this.v_habitaciones=true;
				this.v_banos=true;
				this.v_estudios=true;
				this.v_garajes=true;
				this.v_depositos=true;
				this.v_internas=true;
				this.v_terreno=true;
				this.v_entrega=false;
				this.internas=[];
				this.internas.push(
			      	{name: 'Aire acondicionado'},
					{name: 'Balcón'},
					{name: 'Baño privado'},
					{name: 'Baño social'},
					{name: 'Calentador'},
					{name: 'Citófono'},
					{name: 'Chimenea'},
					{name: 'Closet'},
					{name: 'Cocina a gas'},
					{name: 'Cocina eléctrica'},
					{name: 'Cocina Integral'},
					{name: 'Cocina tipo Americano '},
					{name: 'Gas'},
					{name: 'Jacuzzi'},
					{name: 'Patio'},
					{name: 'Pesebrera'},
					{name: 'Piscina'},
					{name: 'Piso de granito'},
					{name: 'Piso de madera'},
					{name: 'Piso de marmol'},
					{name: 'Piso en cerámica'},
					{name: 'Sauna'},
					{name: 'Sistema de sonido'},
					{name: 'Terraza'},
					{name: 'Turco'},
					{name: 'Vestier/ Walking closet'},
					{name: 'Zona de ropas'}
				);


        	break;
        	case "lote":
        	this.v_propiedad_horizontal=true,
        		this.v_terreno=true;
        		this.v_entrega=false;
        		this.v_pisos=false;
        		this.v_construida=false;
        		this.v_privada=false;
        		this.v_piso=false;
				this.v_niveles=false;
				this.v_amoblado=false;
				this.v_habitaciones=false;
				this.v_banos=false;
				this.v_estudios=false;
				this.v_garajes=false;
				this.v_depositos=false;
				this.v_uso_lote=true;
				this.v_internas=false;
        	break;

        	case "edificio":
        		this.v_uso_lote=false;
        		this.v_propiedad_horizontal=true,
        		this.v_entrega=false;
        		this.v_privada=false;
        		this.v_edad=true;
        		this.v_piso=false;
				this.v_niveles=false;
				this.v_amoblado=false;
				this.v_habitaciones=false;
				this.v_banos=false;
				this.v_estudios=false;
				this.v_garajes=true;
				this.v_pisos=true;
				this.v_depositos=false;
				this.v_internas=true;
				this.v_terreno=false;
				this.v_construida=true;
				this.internas=[];
				this.internas.push(
			      	{name: 'Planta eléctrica'}, 
			      	{name: 'Tanque de reserva'},
			      	{name: 'Parqueadero de visitantes'},
			      	{name: 'Portería'},
			      	{name: 'Lobby'},
			      	{name: 'Asensor'},
			      	{name: 'Ciurcuito CCTV '},
			      	{name: 'Monitoreo'}
				);

        	break;

        	case "bodega":
        	this.v_propiedad_horizontal=true,
        		this.v_internas=true;
        		this.v_garajes=true;
        		this.v_banos=true;
        		this.internas=[];
				this.internas.push(
					{name: 'Descarga de tracto camiones'},
					{name: 'Acceso despavimentado'},
			      	{name: 'Acceso pavimentado'},
			      	{name: 'Electricidad trifasica'},
			      	{name: 'Electricidad monofasica'},
			      	{name: 'Electricidad otro'},
			      	{name: 'Mezzanina'},	
			      	{name: 'Oficinas'},
			      	{name: 'Parque Industrial'},
			      	{name: 'Vestiers '},
			      	{name: 'Zona franca'}
				);

        	break;

        	case "storage":
        		this.v_propiedad_horizontal=false,
        		this.v_privada=false;
        		this.label_precio="Canon de arrendamiento*";
        	break;


    	default: 
    			this.v_propiedad_horizontal=true,
    			this.v_edad=true;
        		this.v_piso=false;
        		this.v_pisos=false;
				this.v_niveles=false;
				this.v_amoblado=false;
				this.v_habitaciones=false;
				this.v_banos=false;
				this.v_estudios=false;
				this.v_garajes=false;
				this.v_depositos=false;
				this.v_internas=false;
				this.v_terreno=false;
				this.v_construida=true;
				this.v_privada=false;
				this.v_uso_lote=false;
		}
	  }
	}
})
}

if(document.querySelector('#adicionales')){

	new Vue({
		el:'#adicionales',
		data:{
			
			compartida:'',
		},
		components: { Multiselect }
	})
}
//Fin Vista: inmueble/create