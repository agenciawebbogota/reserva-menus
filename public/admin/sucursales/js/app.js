// Inicialización Vue.js
new Vue({
	el: '#sucursal',
	data:{
		sucursal:{
            nombre:'',
            url:'',
			email:'',
            clave:'',
            clave_confirmacion:'',
            user_id:'',
            color1:'',
            color2:'',
            color3:''
		},
		noti:{
			nombre:'',
			email:'',
            clave:'',
            clave_confirmacion:'',
		}
	},
	created:function(){
		
	},
	methods:{
		validarCorreo:function(texto) {
			emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
		    if (emailRegex.test(texto)) {
		      return true;
		    } else {
		      return false;
		    }
		},
        urlLug: function(){
            var letras = this.sucursal.nombre.split('')
			var arrayLetras = [];
			letras.map(function(letra){
				if(letra.toLowerCase()=='á'){
				  arrayLetras.push('a')
				}else if(letra.toLowerCase()=='é'){
				  arrayLetras.push('e')
				}else if(letra.toLowerCase()=='í'){
				  arrayLetras.push('i')
				}else if(letra.toLowerCase()=='ó'){
				  arrayLetras.push('o')
				}else if(letra.toLowerCase()=='.'){
			      arrayLetras.push('')
			  }else if(letra.toLowerCase()=='ú'){
				  arrayLetras.push('u')
				}else if(letra.toLowerCase()=='ñ'){
				  arrayLetras.push('n')
				}else{
				  arrayLetras.push(letra.toLowerCase())
				}
			})
			this.sucursal.url = arrayLetras.toString().replace(/,/g,'').replace(/ /g,'-');
        },
        compararClave:function(){


            if (this.sucursal.clave != this.sucursal.clave_confirmacion) {
                this.noti.clave = 'Las contraseñas no cohiciden.'
                this.noti.clave_confirmacion = 'Las contraseñas no cohiciden.'
            }else{
                this.noti.clave = ''
                this.noti.clave_confirmacion = ''                
            }
        }
    },
})