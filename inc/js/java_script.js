	function sem_conteudo(ss)
	{
		if(ss.length > 0) { return false; }
		return true;
	}

	//Fila de conex�es
	fila=[]
	ifila=0

	//Carrega via XMLHTTP a url recebida e coloca seu valor
	//no objeto com o id recebido
	function ajaxHTML(id,url)
	{
		//Carregando...
		document.getElementById(id).innerHTML="<span>Carregando...</span>"
		//Adiciona � fila
		fila[fila.length]=[id,url]
		//Se n�o h� conex�es pendentes, executa
		if((ifila+1)==fila.length)
		{
			ajaxRun();
		}
	}

	//Executa a pr�xima conex�o da fila
	function ajaxRun()
	{
		//Tenta criar o objeto xmlHTTP
		try{
			xmlhttp = new XMLHttpRequest();
		}catch(ee){
			try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			}catch(e){
				try{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}catch(E){
					xmlhttp = false;
				}
			}
		}

		//Abre a conex�o
		xmlhttp.open("GET",fila[ifila][1],true);
		//Fun��o para tratamento do retorno
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4)
			{
				//Mostra o HTML recebido
				retorno=unescape(xmlhttp.responseText.replace(/\+/g," "))
				document.getElementById(fila[ifila][0]).innerHTML=retorno
				//Roda o pr�ximo
				ifila++
				if(ifila<fila.length)setTimeout("ajaxRun()",20)
			}
		}
		//Executa
		xmlhttp.send(null)
	}

	function passa_valor_01(valor,campo)
	{
	window.opener.document.getElementById(campo).value = valor;
	}

	function confirma(pagina_deleta,registro)
	{
		if (confirm("Tem certeza de que deseja deletar :\n"+registro+" ?"))
		location.href = pagina_deleta;
	}

	function confirma_02(pagina_deleta,registro)
	{
		if (confirm("Tem certeza de que deseja realizar esta a��o?"))
		location.href = pagina_deleta;
	}

	//gestor de conteudo
	function confirmar(mensagem) 
	{
		var agree=confirm(mensagem);
		if (agree)
			return true ;
		else
			return false ;
	}

	function abre_janela(theURL,winName,features) 
	{
		window.open(theURL,winName,features);
	}

	function abre_janela_02(theURL,winName,features)
	{
		window.open(theURL,winName,features);
	}
	//termina gestor de conte�do

	var timer;

	function clickButtonBarra(id)
	{
		if (timer != undefined) return;
		var tamanhoC = document.getElementById("container").offsetHeight;
		elem = document.getElementsByTagName("A");
		for(i=0;i<elem.length;i++)
		{
			if (elem[i].className == "botaoBarraAtiva")
				elem[i].className = "botaoBarra";
			if (elem[i].className == "botaoBarra")
				tamanhoC -= elem[i].offsetHeight;
		}

		var inc = Math.round(tamanhoC / 10);

		itemClicado = document.getElementById(id);
		itemClicado.className = "botaoBarraAtiva";

		barra = "";
		elem = document.getElementsByTagName("DIV");
		for(i=0;i<elem.length;i++)
		{
			if ((elem[i].id.substring(0,8) == "Conteudo") && (elem[i].style.display == "block"))
				barra = elem[i].id;
		}

		if(barra!="" && barra == ("Conteudo" + id)) return;
		timer = setTimeout("timerResizeBarra('"+"Conteudo" + id +"','"+barra+"',0,"+tamanhoC+","+tamanhoC+",10,"+inc+")",10);
	}

	function timerResizeBarra(barraAtiva, barraInativa, alturaAtiva, alturaInativa, tamanhoC, tempo, inc)
	{
		b1 = document.getElementById(barraAtiva);

		if ((alturaAtiva + inc) <= tamanhoC)
		{
			b1.style.height = alturaAtiva + inc;

			if (barraInativa != ""){
				b2 = document.getElementById(barraInativa);
				b2.style.height = alturaInativa - inc;
			}

			if (tamanhoC == alturaInativa){
				if (b1.style.display != "block")
					b1.style.display = "block";
				if ((barraInativa != "") && (b2.style.overflow != "hidden"))
					b2.style.overflow = "hidden";
			}
			timer = setTimeout("timerResizeBarra('"+barraAtiva+"','"+barraInativa+"',"+(alturaAtiva + inc)+","+(alturaInativa - inc)+","+tamanhoC+","+tempo+","+inc+")",tempo);
		}
		else
		{
			b1.style.height = tamanhoC;
			if (barraInativa != ""){
				b2 = document.getElementById(barraInativa);
				b2.style.height = 0;
				b2.style.display = "none";
			}

			b1.style.overflow = "auto";

			clearTimeout(timer);
			timer = undefined;
		}
	}

	window.onload = function()
	{
		elem = document.getElementsByTagName("A");
		for(i=0;i<elem.length;i++){
			if (elem[i].className == "botaoBarra"){
				clickButtonBarra(elem[i].id);
				return;
			}
		}
		// Preloading de imagens
		preloader();
	}

	/*window.onresize = function()
	{
		if (navigator.appName.indexOf("Microsoft") != -1){
			tamanhoC = document.body.offsetHeight-4;
		}else{
			tamanhoC = window.innerHeight;
		}

		elem = document.getElementsByTagName("A");
		for(i=0;i<elem.length;i++){
			if ((elem[i].className == "botaoBarra") || (elem[i].className == "botaoBarraAtiva"))
				tamanhoC -= elem[i].offsetHeight;
		}

		elem = document.getElementsByTagName("DIV");
		for(i=0;i<elem.length;i++){
			if ((elem[i].id.substring(0,8) == "Conteudo") && (elem[i].style.display == "block")){
				elem[i].style.height = tamanhoC;
				return;
			}
		}
	}*/

	function preloader()
	{
		/*img1 = new Image();
		img1.src = "bnt_01.jpg";
		img2 = new Image();
		img2.src = "bnt_02.jpg";
		img3 = new Image();
		img3.src = "bnt_03.jpg";
		img4 = new Image();
		img4.src = "bnt_04.jpg";
		img5 = new Image();
		img5.src = "fundo.jpg";*/
	} 

///////////////////////////////TROCA DE IMAGENS////////////////////////////////////////////

var fadeimages=new Array()
fadeimages[0]=["http://heroi.ig.com.br//images/stories/imgs/fullmetal_hqheroi_capaprinc.jpg", "http://heroi.ig.com.br/index.php?option=com_content&amp;task=view&amp;id=2198&amp;Itemid=20&amp;catid=75",""]
fadeimages[1]=["http://heroi.ig.com.br//images/stories/imgs/comunidades-capa.jpg", "http://heroi.ig.com.br/index.php?option=com_content&amp;task=view&amp;id=2181&amp;Itemid=20&amp;catid=75",""]
fadeimages[2]=["http://heroi.ig.com.br//images/stories/imgs/star-wars-force-unleashed_capa.jpg", "http://heroi.ig.com.br/index.php?option=com_content&amp;task=view&amp;id=2175&amp;Itemid=20&amp;catid=75",""]
fadeimages[3]=["http://heroi.ig.com.br//images/stories/imgs/halo3-capa.jpg", "http://heroi.ig.com.br/index.php?option=com_content&amp;task=view&amp;id=2168&amp;Itemid=20&amp;catid=75",""]

var fadebgcolor="white"

var fadearray=new Array()
var fadeclear=new Array()

var dom=(document.getElementById)
var iebrowser=document.all

function fadeshow(theimages, fadewidth, fadeheight, borderwidth, delay, pause, displayorder)
{
this.pausecheck=pause
this.mouseovercheck=0
this.delay=delay
this.degree=20
this.curimageindex=0
this.nextimageindex=1
fadearray[fadearray.length]=this
this.slideshowid=fadearray.length-1
this.canvasbase="canvas"+this.slideshowid
this.curcanvas=this.canvasbase+"_0"
if (typeof displayorder!="undefined")
theimages.sort(function() {return 0.5 - Math.random();})
this.theimages=theimages
this.imageborder=parseInt(borderwidth)
this.postimages=new Array()
for (p=0;p<theimages.length;p++){
this.postimages[p]=new Image()
this.postimages[p].src=theimages[p][0]
}

var fadewidth=fadewidth+this.imageborder*2
var fadeheight=fadeheight+this.imageborder*2

if (iebrowser&&dom||dom) //if IE5+ or modern browsers (ie: Firefox)
document.write('<div id="master'+this.slideshowid+'" style="position:relative;width:'+fadewidth+'px;height:'+fadeheight+'px;overflow:hidden;"><div id="'+this.canvasbase+'_0" style="position:absolute;width:'+fadewidth+'px;height:'+fadeheight+'px;top:0;left:0;filter:progid:DXImageTransform.Microsoft.alpha(opacity=10);-moz-opacity:10;-khtml-opacity:10;background-color:'+fadebgcolor+'"></div><div id="'+this.canvasbase+'_1" style="position:absolute;width:'+fadewidth+'px;height:'+fadeheight+'px;top:0;left:0;filter:progid:DXImageTransform.Microsoft.alpha(opacity=10);-moz-opacity:10;background-color:'+fadebgcolor+'"></div></div>')
else
document.write('<div><img name="defaultslide'+this.slideshowid+'" src="'+this.postimages[0].src+'"></div>')

if (iebrowser&&dom||dom) //if IE5+ or modern browsers such as Firefox
this.startit()
else{
this.curimageindex++
setInterval("fadearray["+this.slideshowid+"].rotateimage()", this.delay)
}
}

function fadepic(obj){
if (obj.degree<100){
obj.degree+=10
if (obj.tempobj.filters&&obj.tempobj.filters[0]){
if (typeof obj.tempobj.filters[0].opacity=="number") //if IE6+
obj.tempobj.filters[0].opacity=obj.degree
else //else if IE5.5-
obj.tempobj.style.filter="alpha(opacity="+obj.degree+")"
}
else if (obj.tempobj.style.MozOpacity)
obj.tempobj.style.MozOpacity=obj.degree/101
else if (obj.tempobj.style.KhtmlOpacity)
obj.tempobj.style.KhtmlOpacity=obj.degree/100
}
else{
clearInterval(fadeclear[obj.slideshowid])
obj.nextcanvas=(obj.curcanvas==obj.canvasbase+"_0")? obj.canvasbase+"_0" : obj.canvasbase+"_1"
obj.tempobj=iebrowser? iebrowser[obj.nextcanvas] : document.getElementById(obj.nextcanvas)
obj.populateslide(obj.tempobj, obj.nextimageindex)
obj.nextimageindex=(obj.nextimageindex<obj.postimages.length-1)? obj.nextimageindex+1 : 0
setTimeout("fadearray["+obj.slideshowid+"].rotateimage()", obj.delay)
}
}

fadeshow.prototype.populateslide=function(picobj, picindex){
var slideHTML=""
if (this.theimages[picindex][1]!="") //if associated link exists for image
slideHTML='<a href="'+this.theimages[picindex][1]+'" target="'+this.theimages[picindex][2]+'">'
slideHTML+='<img src="'+this.postimages[picindex].src+'" border="'+this.imageborder+'px">'
if (this.theimages[picindex][1]!="") //if associated link exists for image
slideHTML+='</a>'
picobj.innerHTML=slideHTML
}


fadeshow.prototype.rotateimage=function(){
if (this.pausecheck==1)
var cacheobj=this
if (this.mouseovercheck==1)
setTimeout(function(){cacheobj.rotateimage()}, 100)
else if (iebrowser&&dom||dom){
this.resetit()
var crossobj=this.tempobj=iebrowser? iebrowser[this.curcanvas] : document.getElementById(this.curcanvas)
crossobj.style.zIndex++
fadeclear[this.slideshowid]=setInterval("fadepic(fadearray["+this.slideshowid+"])",50)
this.curcanvas=(this.curcanvas==this.canvasbase+"_0")? this.canvasbase+"_1" : this.canvasbase+"_0"
}
else{
var ns4imgobj=document.images['defaultslide'+this.slideshowid]
ns4imgobj.src=this.postimages[this.curimageindex].src
}
this.curimageindex=(this.curimageindex<this.postimages.length-1)? this.curimageindex+1 : 0
}

fadeshow.prototype.resetit=function(){
this.degree=10
var crossobj=iebrowser? iebrowser[this.curcanvas] : document.getElementById(this.curcanvas)
if (crossobj.filters&&crossobj.filters[0]){
if (typeof crossobj.filters[0].opacity=="number") //if IE6+
crossobj.filters(0).opacity=this.degree
else //else if IE5.5-
crossobj.style.filter="alpha(opacity="+this.degree+")"
}
else if (crossobj.style.MozOpacity)
crossobj.style.MozOpacity=this.degree/101
else if (crossobj.style.KhtmlOpacity)
crossobj.style.KhtmlOpacity=obj.degree/100
}


fadeshow.prototype.startit=function(){
var crossobj=iebrowser? iebrowser[this.curcanvas] : document.getElementById(this.curcanvas)
this.populateslide(crossobj, this.curimageindex)
if (this.pausecheck==1){ //IF SLIDESHOW SHOULD PAUSE ONMOUSEOVER
var cacheobj=this
var crossobjcontainer=iebrowser? iebrowser["master"+this.slideshowid] : document.getElementById("master"+this.slideshowid)
crossobjcontainer.onmouseover=function(){cacheobj.mouseovercheck=1}
crossobjcontainer.onmouseout=function(){cacheobj.mouseovercheck=0}
}
this.rotateimage()
}


////////////////////////////////////LINK IMG//////////////////////////////////


function high(which2){
theobject=which2
highlighting=setInterval("highlightit(theobject)",50)
}
function low(which2){
clearInterval(highlighting)
which2.filters.alpha.opacity=20
}
function highlightit(cur2){
if (cur2.filters.alpha.opacity<100)
cur2.filters.alpha.opacity+=5
else if (window.highlighting)
clearInterval(highlighting)
}

	function abre_info()
	{
		window.open('../utilitarios/utilitario_informativo.php?_info_email='+document.informativo._info_email.value+'&info='+document.informativo.info.value,'newsletter','width=350,height=350');
	}

	function abre_janela(nome_janela,alvo_janela)
	{
	window.open(nome_janela,alvo_janela,'width=500,height=500');
	}

	function checa_campos(pagina)
	{
		var mensagem_erro = new String();
		switch(pagina)
		{
			case "formulario_galeria_":
				
				if(sem_conteudo(document.formulario_galeria.titulo.value)){ mensagem_erro += "\n\n- Por favor digite o titulo.";}
				if(document.formulario_galeria.cmp_categoria_id.value == "vazio"){ mensagem_erro += "\n\n- Por favor escolha o tipo de material.";}
				
			break;
			
			//==================================================CONTATO==================================================
			case "envia_senha":
				if(sem_conteudo(document.form_senha_perdida.email.value) || document.form_senha_perdida.email.value == 'Insira seu e-mail'){ mensagem_erro += "\n\n- Por favor digite seu e-mail de cadastro.";}
			break;

			//==================================================CATEGORIA==================================================
			case "categoria":
				if(sem_conteudo(document.formulario_categoria._nome.value)){ mensagem_erro += "\n\n- Por favor digite o nome da categoria.";}
				if(NoneWithCheck(document.formulario_categoria._estado)){ mensagem_erro += "\n\n- Por favor selecione um estado."; }
			break;

			case "produto_empresas":
				
				if(sem_conteudo(document.form._nome.value)){ mensagem_erro += "\n\n- Por favor digite um nome.";} 
				
				//if (cmp_categoria.length == 0) { mensagem_erro += "\n\n- Por favor selecione pelo menos uma categoria do produto."; }

				
				if(NoneWithCheck(document.form._estado)){ mensagem_erro += "\n\n- Por favor selecione um estado."; }
			break;
			
			case "menu_site":
			
				if(sem_conteudo(document.form._id_menu_ambiente.value)){ mensagem_erro += "\n\n- Por favor selecione o ambiente."; }
				if(sem_conteudo(document.form._nome.value)){ mensagem_erro += "\n\n- Por favor digite um nome."; }
				if(NoneWithCheck(document.form._pagina_interna)){ mensagem_erro += "\n\n- Por favor selecione o tipo de menu."; }
				if(NoneWithCheck(document.form._estado)){ mensagem_erro += "\n\n- Por favor selecione um estado."; }
			break;
			
			//==================================================EDITA ALBUM==================================================
			case "edita_album":
				if(sem_conteudo(document.form_album._nome.value)){ mensagem_erro += "\n\n- Por favor digite um nome.";} 
			break;
			
			//==================================================BLOG ALBUM==================================================
			case "blog_album":
				if(sem_conteudo(document.form._nome.value)){ mensagem_erro += "\n\n- Por favor digite um nome.";} 
			break;
			
			case "conteudo_pagina":
				if(sem_conteudo(document.form._nome.value)){ mensagem_erro += "\n\n- Por favor digite um nome.";}				
				if(sem_conteudo(document.form._corpo.value)) { mensagem_erro += "\n\n- Por favor digite o texto da p�gina."; }				
				if(WithoutCheck(document.form.estado.value)) { mensagem_erro += "\n\n- Por favor selecione um estado."; }
			 break;
			 
			//==================================================ILUSTRAR==================================================
			case "ilustrar_imagem":
				if(sem_conteudo(document.formulario_imagem._nome.value)){ mensagem_erro += "\n\n- Por favor selecione uma imagem."; }
				if(sem_conteudo(document.formulario_imagem._descricao.value)){ mensagem_erro += "\n\n- Por favor digite uma descri��o.";}
			break;

			case "ilustrar_album":
				if(sem_conteudo(document.form._id_album_tipo.value)){ mensagem_erro += "\n\n- Por favor selecione o tipo de �lbum."; }
				if(sem_conteudo(document.form._nome.value)){ mensagem_erro += "\n\n- Por favor digite um nome.";}
			break;

			//==================================================SISTEMA==================================================
			case "sistema_permissao":
				if(sem_conteudo(document.formulario_usuarios_permissoes.cmp_usuario_nome.value)){ mensagem_erro += "\n\n- Por favor selecione um usu�rio."; }
			break;

			case "sistema_ambiente":
				if(sem_conteudo(document.formularios._nome.value)){ mensagem_erro += "\n\n- Por favor digite o nome completo do ambiente.";}
				if(sem_conteudo(document.formularios._botao.value)) { mensagem_erro += "\n\n- Por favor digite um nome."; }
				if(sem_conteudo(document.formularios._url.value)) { mensagem_erro += "\n\n- Por favor digite um endere�o."; }
			break;

			case "sistema_usuario":
				if(sem_conteudo(document.form_usuario._nome.value)){ mensagem_erro += "\n\n- Por favor digite um nome."; }
				if(sem_conteudo(document.form_usuario._sobrenome.value)){ mensagem_erro += "\n\n- Por favor digite um sobrenome."; }
				if(sem_conteudo(document.form_usuario._email.value)){ mensagem_erro += "\n\n- Por favor digite um e-mail.";}
				if(sem_conteudo(document.form_usuario._cep.value)){ mensagem_erro += "\n\n- Por favor digite um CEP.";}
				if(sem_conteudo(document.form_usuario._endereco.value)){ mensagem_erro += "\n\n- Por favor digite um endere�o.";}
				if(sem_conteudo(document.form_usuario._bairro.value)){ mensagem_erro += "\n\n- Por favor digite um bairro.";}
				if(sem_conteudo(document.form_usuario._telefone.value)){ mensagem_erro += "\n\n- Por favor digite um telefone.";}
				if(document.form_usuario._usuario_tipo_id.value == ""){ mensagem_erro += "\n\n- Por favor selecione o perfil do usuario.";}
				if(sem_conteudo(document.form_usuario._senha.value)){ mensagem_erro += "\n\n- Por favor digite uma senha.";}
				if(sem_conteudo(document.form_usuario._senha_re.value)){ mensagem_erro += "\n\n- Por favor digite a senha novamente.";}
				if(NoneWithCheck(document.form_usuario._estado)) { mensagem_erro += "\n\n- Por favor selecione um estado."; }
				if((document.form_usuario._email.value)!='')
				{
					if(!checkMail(document.form_usuario._email.value)){ mensagem_erro += "\n\n- Por favor digite um e-mail v�lido!";};
				}
				if(((document.form_usuario._senha_re.value)!='')&&((document.form_usuario._senha.value)!=''))
				{
					if(ChecaSenha(document.form_usuario._senha.value,document.form_usuario._senha_re.value)){ mensagem_erro += "\n\n- Senhas diferentes! Por favor confirme sua senha corretamente."; }
				}
			break;
			
			case "sistema_apoiadores":
				if(sem_conteudo(document.form_usuario._nome.value)){ mensagem_erro += "\n\n- Por favor digite um nome."; }
			break;

			case "sistema_usuario_tipo":
				if(sem_conteudo(document.formulario._nome.value)){ mensagem_erro += "\n\n- Por favor digite um tipo.";}
			break;
			
			case "valida_contato":
				if(sem_conteudo(document.formulario_contato._nome.value) || document.formulario_contato._nome.value == "nome"){ mensagem_erro += "\n\n- Por favor digite um nome.";}
				if(sem_conteudo(document.formulario_contato._email.value) || document.formulario_contato._email.value == "email"){ mensagem_erro += "\n\n- Por favor digite um email.";}
			break;

			//==================================================GC==================================================
			//n�o esta funcionando?
			case "login":
				if(sem_conteudo(document.formulario_de_logar.nome_usuario.value)){ mensagem_erro += "\n\n- Por favor digite o nome do usu�rio."; }
				if(sem_conteudo(document.formulario_de_logar.senha_usuario.value)){ mensagem_erro += "\n\n- Por favor digite a senha do usu�rio."; }
			break;

			case "ambiente":
				if(sem_conteudo(document.formulario.cmp_ambiente_nome.value)){ mensagem_erro += "\n\n- Por favor digite o nome do ambiente."; }
			break;

			case "permissoes":
				if(sem_conteudo(document.formulario.cmp_usuario_id.value)){ mensagem_erro += "\n\n- Por favor digite o nome do ambiente."; }
			break;

			//-----------------------------------------------------------------
			case "login_recupera":
				if(sem_conteudo(document.form_senha_perdida.usuario_senha_perdida.value)){ mensagem_erro += "\n\n- Por favor digite o nome do usu�rio."; }
			break;

			//-----------------------------------------------------------------------------
			default:
				alert('falta valida��o');
		} 

		// Junta mensagens de erro.
		if(mensagem_erro.length > 2)
		{
			alert('AVISO:' + mensagem_erro);
			return false;
		}
		return true;

	} // fim da fun��o de checar campos


//////////////// FUN��ES GERAIS DE VALIDA��O ///////////////////////////////////
	function sem_conteudo(ss)
	{
		if(ss.length > 0) { return false; }
		return true;
	}

	function checa_nome(ss)
	{
		var quebra = ss.split(" ");
		if(quebra.length > 1) { return false; }
		return true;
	}

	function checa_cep(ss)
	{
		var quebra = ss.split("");
		if(quebra.length > 7) { return false; }
		return true;
	}

	function nivel_senha()
	{
		senha = document.getElementById("_senha").value;
		forca = 0;
		mostra = document.getElementById("mostra");
		if((senha.length >= 4) && (senha.length <= 7)){
			forca += 10;
		}else if(senha.length>7){
			forca += 25;
		}
		if(senha.match(/[a-z]+/)){
			forca += 10;
		}
		if(senha.match(/[A-Z]+/)){
			forca += 20;
		}
		if(senha.match(/\d+/)){
			forca += 20;
		}
		if(senha.match(/\W+/)){
			forca += 25;
		}
		return mostra_res();
	}

	function mostra_res(){
		if(forca < 30){
			mostra.innerHTML = '<tr><td bgcolor="yellow" width="'+forca+'"></td><td>Fraca </td></tr>';;
		}else if((forca >= 30) && (forca < 60)){
			mostra.innerHTML = '<tr><td bgcolor="yellow" width="'+forca+'"></td><td>Justa </td></tr>';;
		}else if((forca >= 60) && (forca < 85)){
			mostra.innerHTML = '<tr><td bgcolor="blue" width="'+forca+'"></td><td>Forte </td></tr>';
		}else{
			mostra.innerHTML = '<tr><td bgcolor="green" width="'+forca+'"></td><td>Excelente </td></tr>';
		}
	}

	function valida_email(ss)
	{  
	  if ((ss.length > 0) && ((ss.indexOf("@") > 1) && (ss.indexOf('.') > 1)))
	  {
		return false;
	  }
	  return true;
	}

	function ChecaSenha(ss,sss)
	{
		if(ss == sss) { return false; }
		return true;
	}

	function NoneWithContent(ss)
	{
		for(var i = 0; i < ss.length; i++)
		{
			if(ss[i].value.length > 0) { return false; }
		}
		return true;
	}

	function NoneWithCheck(ss)
	{
		for(var i = 0; i < ss.length; i++)
		{
			if(ss[i].checked)
			{ 
				return false;
			}
		}
		return true;
	}

	//fun��o que valida se o check do produto foi clicado em produto.php
	function NoneWithCheck_02(ss)
	{
		var contador = ss.length;
		if(contador > 1)
		{
			for(var i = 0; i < ss.length; i++)
			{
				if(ss[i].checked)
				{ 
					return false;
				}
			}
		return true;
		}
		else
		{
			if(ss.checked)
			{
				return false;
			}
			return true;
		}
	}

	function WithoutCheck(ss)
	{
		if(ss.checked)
		{
			return false;
		}
		
		return true;
	}

	function WithoutSelectionValue(ss) 
	{
		for(var i = 0; i < ss.length; i++) 
		{
			if(ss[i].selected) 
			{
				if(ss[i].value.length) { return false; }
			}
		}
		return true;
	}

//////////////// FUN��ES POPUP ///////////////////////////////////

	function fancy_img(obj)
	{
		$.fancybox({
			'href'          	: obj,    
			'overlayShow'		: false,
			'transitionIn'		: 'elastic',
			'transitionOut'		: 'elastic'
		});
	}

	function popup_()
	{
		classe = 1;
		fancy_function("popup.php?acao_popup=seleciona_endereco&classe="+classe);
	}
	
	function popup_geral(acao_adm, acao)
	{
		var url_virtual = $("#url_virtual").val();
		
		x_popup_pagina = 981;
		y_popup_pagina = 755;
		switch (acao_adm)
		{
			case "produtos":
				switch(acao)
				{
					case  "busca":
						//fancy_function("../utilitarios/busca_produtos.php?acao_busca_produto=buscado");
						fancy_function("popup.php?acao_popup=seleciona_endereco&classe=1");
					break;
				}
			break;
			
			case "menu_rodape":
				//fancy_function("../utilitarios/busca_produtos.php?acao_busca_produto=buscado");
				fancy_function("popup.php?acao_popup="+acao_adm+"&acao="+acao+"");
			break;
			
			case "outros":
				fancy_function("../gc/modulos/ajax_adm.php?acao="+acao+"",400,300,"iframe");
			break;
			
			case "album":
				fancy_function("../gc/modulos/ajax_adm.php?acao="+acao+"",800,600,"iframe");
			break;
			
			case "projeto":
				fancy_function("../gc/modulos/ajax_adm.php?acao="+acao+"",400,300,"iframe");
			break;
			
			case "blog":
				fancy_function("../gc/modulos/ajax_adm.php?acao="+acao+"",800,600,"iframe");			
			break;
			
			case "galeria":
				fancy_function(url_virtual+"templates/popup.html",800,600,"iframe");	
			break;
		}
	}

	function popup_url(endereco)
	{
		fancy_function(endereco);
	}

	function fancy_function(url,largura,altura,tipo,slide,imagem_fundo,ext)
	{	
					
		
		$.fancybox({		
			hideOnContentClick : false,
			'href'              :url,   
			'autoScale'         :false,	
			'autoDimensions	'	:true,
			'centerOnScroll'    :false,
			'transitionIn'		:'fade',
			'transitionOut'		:'fade',
			'easingIn'          :'swing',
			'easingOut'         :'swing',
			'speedIn'			:1500,
			//'speedOut'			:2500,
			'type'				: tipo,
			'width'             :largura,
			'height'		    :altura,
			'overlayColor'      :'#000',
			'overlayOpacity': 0	,
			onStart:function () {
			
				
		        
				time = 2000;

				/*
				$("#fancybox-wrap").css({                      
		        	 'top':'550px'
		        }).animate({           
		            top: '200px',
		        }, time, 'swing');*/
		       
		       
		       
				//$("#fancybox-wrap").hide();
				
				/*$("#fancybox-wrap").stop().css({                      
		        	 'top':'-2050px'
		        }).animate({           
		            top: '0',
		        }, time, 'swing');*/
		        
		       /* $("#fancybox-wrap").animate({           
		            top: '0',
		        }, time, 'swing');*/
				
				

				blur(slide,imagem_fundo,ext);
				
				setTimeout(function(){
					fecha_lateral_direita(slide);
					fecha_menu_site();
					$('#contatos_redes2').animate({
						bottom: "-100px"
					});
					$.fancybox.center(true);	
					
				},time);

				$('#control_div').fadeOut('slow');
            },
            
            onComplete:function () {
				
				$.fancybox.center(true);
            },
            
            onCleanup:function () {
            	time = 2000;
				/*$("#fancybox-wrap").animate({
				    top: $(document).height()+'px'
				}, time);*/

				 offblur(slide,imagem_fundo,ext);

				  
				  setTimeout(function(){
					  abre_lateral_direita(slide);
					  menu_site();
					  $('#contatos_redes2').animate({
					 	bottom: "10px"
					 });
				  },time);

				  $('#control_div').fadeIn(3000);
            }
			
		});
		
		$.fancybox.center;
		
		
	}
	
	function blur(id,imagem_fundo,ext)
 � �{
 		var url_virtual = $('#url_virtual').val();
 		$('#bg_blur').hide();
 		var img = $('#supersized .activeslide a img');
 		img.clone().appendTo('#bg_blur');
 		setTimeout(function(){
 		img.hide();
 		img.remove();
		},1500);
		
		$('#bg_blur').find('img').attr('src',''+url_virtual+'imagens/produtos/'+imagem_fundo+'_blur.'+ext+'');
		$('#bg_blur img').clone().appendTo('#supersized .activeslide a');
		$('#bg_blur img').remove();
 � �	
 	}

 � �function offblur(id,imagem_fundo,ext)
 � �{
 		var url_virtual = $('#url_virtual').val();
 		$('#bg_blur').hide();
 		var img = $('#supersized .activeslide a img');
 		img.clone().appendTo('#bg_blur');
 		setTimeout(function(){
 		img.hide();
 		img.remove();
		},1000);
		
		$('#bg_blur').find('img').attr('src',''+url_virtual+'imagens/produtos/'+imagem_fundo+'.'+ext+'');
		$('#bg_blur img').clone().appendTo('#supersized .activeslide a');
		$('#bg_blur img').remove();
 � �}

	function fecha_popup(pag)
	{
		parent.$.fancybox.close();
		window.location = pag;
	}

	function passa(campo1, campo2){ 

		if(campo1.value.length >= 5){
			campo2.focus();
		}
	}
//-->

////////////////////// FUN��ES DE MASCARA E BLOQUEIO////////////////////////////////////
	//Fun��es de Valida��o
	function checkMail(mail)
	{
		var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
		if(typeof(mail) == "string")
		{
			if(er.test(mail))
			{
				return true;
			}
		}
		else if(typeof(mail) == "object")
		{
			if(er.test(mail.value))
			{
				return true; 
			}
		}
		else
		{
			return false;
		}
	}

	function createUploader(album, diretorio, div)
	{
		var uploader = new qq.FileUploader({
			element: document.getElementById(diretorio),
			action: 'componentes/uploads.php?album='+album,
			params: {},

			// validation    
			// ex. ['jpg', 'jpeg', 'png', 'gif'] or []
			allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],        
			sizeLimit: 1024003434, // max size   
			minSizeLimit: 1, // min size

			debug: true,

			// events
			// you can return false to abort submit
			onSubmit: function(id, fileName){},
			onProgress: function(id, fileName, loaded, total){},
			onComplete: function(id, fileName, responseJSON){
				ajax_pagina('upload_imagens','lista', album, '', '', '', '', '', '', '', div, 'ajax_gc_adm', 'false');
			},
			onCancel: function(id, fileName){},

			messages: {
				// error messages, see qq.FileUploaderBasic for content            
			},
			showMessage: function(message){ alert(message); }  
		});
	}
	
	
	function createUploader_onlyone(nome_campo, diretorio, div)
	{
		var uploader = new qq.FileUploader({
			element: document.getElementById(diretorio),
			action: 'componentes/uploads_onlyone.php',
			params: {},
			multiple: false,

			// validation    
			// ex. ['jpg', 'jpeg', 'png', 'gif'] or []
			allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],        
			sizeLimit: 1024003434, // max size   
			minSizeLimit: 1, // min size

			debug: true,

			// events
			// you can return false to abort submit
			onSubmit: function(id, fileName){},
			onProgress: function(id, fileName, loaded, total){},
			onComplete: function(id, fileName, responseJSON){
				//ajax_pagina('upload_imagens','lista', album, '', '', '', '', '', '', '', div, 'ajax_gc_adm', 'false');
				$("#"+nome_campo).val(fileName);
				$("#"+div).html("<img src=\"../imagens/galeria_thumbnail/"+fileName+" \" width=\"100\" />");
			},
			onCancel: function(id, fileName){},

			messages: {
				// error messages, see qq.FileUploaderBasic for content            
			},
			showMessage: function(message){ alert(message); }  
		});
	}
	
	function createUploader_onlytwo(nome_campo, diretorio, div)
	{
		var uploader = new qq.FileUploader({
			element: document.getElementById(diretorio),
			action: 'componentes/uploads_onlytwo.php',
			params: {},
			multiple: false,

			// validation    
			// ex. ['jpg', 'jpeg', 'png', 'gif'] or []
			allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],        
			sizeLimit: 1024003434, // max size   
			minSizeLimit: 1, // min size

			debug: true,

			// events
			// you can return false to abort submit
			onSubmit: function(id, fileName){},
			onProgress: function(id, fileName, loaded, total){},
			onComplete: function(id, fileName, responseJSON){
				//ajax_pagina('upload_imagens','lista', album, '', '', '', '', '', '', '', div, 'ajax_gc_adm', 'false');
				$("#"+nome_campo).val(fileName);
				$("#"+div).html("<img src=\"../imagens/galeria_thumbnail/"+fileName+" \" width=\"100\" />");
			},
			onCancel: function(id, fileName){},

			messages: {
				// error messages, see qq.FileUploaderBasic for content            
			},
			showMessage: function(message){ alert(message); }  
		});
	}
	
	function createUploader_galeria(album, diretorio, div, id_album)
	{
		var uploader = new qq.FileUploader({
			element: document.getElementById(diretorio),
			action: '../gc/componentes/uploads_galeria.php?album='+album,
			params: {},

			// validation    
			// ex. ['jpg', 'jpeg', 'png', 'gif'] or []
			allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],        
			sizeLimit: 1024003434, // max size   
			minSizeLimit: 1, // min size

			debug: true,

			// events
			// you can return false to abort submit
			onSubmit: function(id, fileName){},
			onProgress: function(id, fileName, loaded, total){},
			onComplete: function(id, fileName, responseJSON){
				ajax_pagina('upload_imagens','lista', album, id_album, '', '', '', '', '', '', div, '../ajax/ajax_site', 'false');
			},
			onCancel: function(id, fileName){},

			messages: {
				// error messages, see qq.FileUploaderBasic for content            
			},
			showMessage: function(message){ alert(message); }  
		});
	}

	function createUploader_02(album, diretorio, div)
	{
		var uploader = new qq.FileUploader({
			element: document.getElementById(diretorio),
			action: '../componentes/uploads.php?album='+album,
			params: {},

			// validation    
			// ex. ['jpg', 'jpeg', 'png', 'gif'] or []
			allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],        
			sizeLimit: 1024003434, // max size   
			minSizeLimit: 1, // min size

			debug: true,

			// events
			// you can return false to abort submit
			onSubmit: function(id, fileName){},
			onProgress: function(id, fileName, loaded, total){},
			onComplete: function(id, fileName, responseJSON){
				ajax_pagina('upload_imagens','lista_iframe', album, '', '', '', '', '', '', '', div,'ajax_gc_adm', 'false');
			},
			onCancel: function(id, fileName){},

			messages: {
				// error messages, see qq.FileUploaderBasic for content            
			},
			showMessage: function(message){ alert(message); }  
		});
	}
	
	function createUploader_frond(diretorio, nome_bg, div)
	{
		
		var uploader = new qq.FileUploader({
			element: document.getElementById(diretorio),
			action: 'componentes/uploads_bg.php?nome_bg='+nome_bg,
			params: {},

			// validation    
			// ex. ['jpg', 'jpeg', 'png', 'gif'] or []
			allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],        
			sizeLimit: 1024003434, // max size   
			minSizeLimit: 1, // min size
			multiple: false,
			debug: true,

			// events
			// you can return false to abort submit
			onSubmit: function(id, fileName){},
			onProgress: function(id, fileName, loaded, total){},
			onComplete: function(id, fileName, responseJSON){
				ajax_pagina('upload_bgs', 'editar', nome_bg, '', '', '', '', '', '', '', div,'ajax_gc_adm', 'false');
			},
			onCancel: function(id, fileName){},

			messages: {
				// error messages, see qq.FileUploaderBasic for content            
			},
			showMessage: function(message){ alert(message); }  
		});
	}

	function compara_campos(nome_campo, nome_color, campo_numero)
	{
		var valida = true;

		var arr_nome = document.getElementsByName(nome_campo);
		if(arr_nome.length > 0)
		{
			for(var i=0; i<$('#'+campo_numero).val(); i++)
			{
				if(arr_nome[i].value)
				{
					if(arr_nome[i].value == nome_color)
					{
						valida = false;
						break;
					}
				}
			}
		}

		return valida;
	}

	function adicionaCampo_Resposta()
	{
		if($.trim($('#_nome').val()) != "")
		{
			var cont_campos = parseInt($('#_numero_campos_resposta').val());
			var resposta = $.trim($('#_resposta').val());
			//var tipo = $.trim($('#_tipo').val());
			var tipo = $("input[name='_tipo']:checked").val();

			if($.trim($('#_resposta').val()) != "")
			{
				if(compara_campos('_resposta_f[]', resposta, '_numero_campos_resposta'))
				{
					if(tipo == "1")
					{
						tipo_resposta = "Sele��o";
					}
					else
					{
						tipo_resposta = "Descri��o";
					}
					cont_campos = cont_campos + 1;
					var input = '';
					input += '<div class="itens">';
					input += '<label>'+resposta+' </label>';
					input += '<label> ('+tipo_resposta+')</label>';
					input += '<input name="_resposta_f[]" type="hidden" value="'+resposta+'" size="30" maxlength="50"/>';
					input += '<input name="_tipo_f[]" type="hidden" value="'+tipo+'" size="30" maxlength="50"/>';
					input += '<a href="#" class="del" onclick="javascript:removeCampo(\'_numero_campos_resposta\');"><img src="../imagens/site/resp-errada.png" align="absmiddle" ></a>';
					input += '</div>';

					$('#_numero_campos_resposta').val(cont_campos);
					$("#div_respostas").append(input);
					$('#_resposta').val("");
				}
				else
				{
					alert("A resposta "+resposta+" j� foi inserido, por favor digite outra resposta.");
					$('#_resposta').val("");
					$('#_resposta').focus();
				}
			}
			else
			{
			}
		}
		else
		{
			alert("Por favor digite a Pergunta");
		}
	}


var mask = 
{
	money: function() 
	{
		var el = this
		,exec = function(v)
		{
			v = v.replace(/\D/g,"");
			v = new String(Number(v));
			var len = v.length;
			if (1== len)
			v = v.replace(/(\d)/,"0.0$1");
			else if (2 == len)
			v = v.replace(/(\d)/,"0.$1");
			else if (len > 2) 
			{
				v = v.replace(/(\d{2})$/,'.$1');
			}
		return v;
		};

		setTimeout(function(){
		el.value = exec(el.value);
		},1);
	}
}

	function data_picker(data)
	{
		$("#"+data).datepicker({
		dateFormat: 'dd/mm/yy',
		dayNames: [
		'Domingo','Segunda','Ter�a','Quarta','Quinta','Sexta','S�bado','Domingo'
		],
		dayNamesMin: [
		'D','S','T','Q','Q','S','S','D'
		],
		dayNamesShort: [
		'Dom','Seg','Ter','Qua','Qui','Sex','S�b','Dom'
		],
		monthNames: [
		'Janeiro','Fevereiro','Mar�o','Abril','Maio','Junho','Julho','Agosto','Setembro',
		'Outubro','Novembro','Dezembro'
		],
		monthNamesShort: [
		'Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set',
		'Out','Nov','Dez'
		],
		nextText: 'Pr�ximo',
		prevText: 'Anterior'

		});
	}

	function jav()
	{
		var date = new Date();
		//var newDate = new Date( date.getFullYear(), date.getMonth(1), 0 );
		var newDate = new Date( date.getFullYear(), 1, 0 );
		alert( newDate.getDate() );
	}

	function mensagens()
	{
		$.growlUI('Notifica��o', 'Tem pedidos pendentes para dar baixa!', 10000);
	}

	function ajax_pagina(acao_adm, acao, parametro, parametro_02, parametro_03, parametro_04, parametro_05, parametro_06, parametro_07, parametro_08, div, ambiente, animar) //13
	{
		var url_virtual = $("#url_virtual").val();
		var msg_confirma = true;
		url=ambiente+".php?acao_adm="+acao_adm+"&acao="+acao+"&parametro="+parametro+"&parametro_02="+parametro_02+"&_div="+div;//url da p�gina
		var nivel = ""; 
		switch (acao_adm)
		{
			case "seleciona_enquete":
			
				url = url_virtual+url+"&_id_pergunta="+parametro_02+"&_id_enquete="+parametro_03+"&_div="+div;

			break;
			
			case "valida_campo":
				url = url+"&_categoria="+parametro_02+"&_div="+div;
			break;
			
			case "respostas":
				switch(acao)
				{
					case "excluir":
						if(!confirmar("Tem certeza de que deseja excluir este item?")){
							msg_confirma = false;
						}
						
						url = url+"&id_pergunta="+parametro_02+"&_div="+div;
					break;
				}
			break;
			
			case "upload_bgs":
			{
				switch(acao)
				{
					case "editar":
						url = url+"&_div="+div;
					break;
					
					case "excluir":
						if(!confirmar("Tem certeza de que deseja excluir esta imagem?")){
							msg_confirma = false;
						}
						url = url+"&_div="+div;
					break;
				}
				
			}
			break;
			
			case "upload_imagens":
				switch(acao)
				{
					case "lista":
						url = url+"&id_album="+parametro_02+"&_div="+div;
					break;
					case "lista_iframe":
						url = url_virtual+"gc/"+url+"&_div="+div;
						//url = url+"&_div="+div;
					break;
				}
			break;

			case "play_musica":
				switch(acao)
				{
					case "play":
						url = url+"&_div="+div;
					break;
				}
			break;

			case "lista_fotos":
				switch (acao)
				{
					case "excluir":
						if(!confirmar("Tem certeza de que deseja excluir esta imagem?")){
							msg_confirma = false;
						}
						url = url+"&_id_album="+parametro_02+"&_album="+parametro_03+"&_div="+div;
					break;
					
					case "excluir_grupo":
						if(!confirmar("Tem certeza de que deseja excluir esta(s) imagem(ns)?")){
							msg_confirma = false;
						}
						url = url+"&_id_album="+parametro_02+"&_album="+parametro_03+"&_div="+div;
					break;
				}
			break;
			
			case "lista_fotos_iframe":
				switch (acao)
				{
					case "lista":
						url = url_virtual+"gc/"+url+"&_div="+div;
						//nivel = "../";
					break;
					
					case "excluir":
						if(!confirmar("Tem certeza de que deseja excluir esta imagem?")){
							msg_confirma = false;
						}
						url = url_virtual+"gc/"+url+"&_id_album="+parametro_02+"&_div="+div;
					break;
				}
			break;
			
			case "materia_blog":
			switch(acao)
			{
				case "excluir":
					if(!confirmar("Tem certeza de que deseja excluir este item?")){
						msg_confirma = false;
					}
					url = url+"&_id_produto="+parametro_02+"&_div="+div;
				break;
			}
			
			case "empresa_contato":
			
				url = url+"&parametro="+parametro+"&parametro_02="+parametro_02+"&parametro_03="+parametro_03;
				
			break;
		break;
		}

		if(msg_confirma)
		{
			cont=document.getElementById(div);
			if(cont)
			{
				ajax_msg_site_adm(url,cont,"<img src=\""+url_virtual+"imagens/site/loading_02.gif\" />", animar);
			}
			//else{alert('no_div')}
		}
		else{
			//alert('hubo um erro na consulta');
		}
	}

	function ajax_msg_site_adm(url,cont,loading, animar)
	{
		function obterObjRequisicao()
		{
			if(window.XMLHttpRequest)
			{
				return new XMLHttpRequest();
			}
			else if(window.ActiveXObject)
			{
			  return new ActiveXObject("Microsoft.XMLHTTP");
			}
			return null;
		}

		var http = obterObjRequisicao();
		if(loading)
		{
			if(animar == "true")
			{
				$.blockUI({ css: { 
					message: 'just',
					border: 'none', 
					padding: '15px', 
					backgroundColor: '#000', 
					'-webkit-border-radius': '10px', 
					'-moz-border-radius': '10px', 
					opacity: .4, 
					color: '#fff' 
				} }); 
			}
			else
			{
				//$.blockUI({ message: '<h1><img src="busy.gif" /> Just a moment...</h1>' });
				cont.innerHTML=loading;
			}
			
		}
		if(http)
		{
			http.onreadystatechange = processar;
			http.open("GET", url, true);
			http.send(null);
		}
		function processar()
		{
			/*if(loading==1)
			{
				cont.innerHTML="Loading |readst="+http.readyState+" | status "+http.status;
			}*/
			var mostra_cont = true;
			if(http.readyState == 4)
			{ 
				if(http.status == 200)
				{
			
					var text = http.responseText;
					if(text.match(/.*sucesso_resposta.*/i))
					{
						alert('Voto registrado com sucesso!');
						//location.reload();
					}
					if(text.match(/.*atualizado.*/i))
					{
						refresh_carrinho(text);
					}
					if(text.match(/.*email_enviado_sucesso.*/i))
					{
						alert("Email enviado com sucesso!");
						mostra_cont = false;
					}
					if(text.match(/.*data_modificado.*/i))
					{
						alert("Data modificado com sucesso!");
						mostra_cont = false;
					}
					if(text.match(/.*campo_valida.*/i))
					{
						var campo_data = text.split(" ");
						mostra_cont = false;
						$("#div_valida").html('<b style=\"color:#A41000;\">Nome n�o disponivel.</b> Por favor digite outro nome.'); 
						$("#_nome").focus();
						
					}
					if(animar == "true")
					{
						setTimeout($.unblockUI, 0);
					}

					if(mostra_cont)
					{
						cont.innerHTML=http.responseText;
					}
				}
			}
		}
		return false;
	}

function refresh_carrinho(row)
{
	var quebra=row.split("-");
	var num_rows = parseInt($('#table_carrinho tr').length) - 3;
	
	var peso_row = parseInt(quebra[1]);
	var custo_row = parseFloat(quebra[2]);
	var row = quebra[3];
	
	var peso_total = 0;
	var custo_total = 0;
	
	var bb = false;
	
	for(var i=1; i<=num_rows ; i++)
	{
		if(i != row)
		{
			for(var j=4; j<7; j++)
			{
				if(j == 4)
				{
					peso_total = peso_total + parseInt($("tr:eq("+i+") td:eq("+j+")").html());
				}
				else
				{
					custo_total = custo_total + moeda2float($.trim($("tr:eq("+i+") td:eq("+j+")").html()));
				}
				//alert($("tr:eq("+i+") td:eq("+j+")").html());
				j++;
			}
		}
		else
		{
			$("tr:eq("+row+") td:eq(4)").html(peso_row);
			$("tr:eq("+row+") td:eq(6)").html(float2moeda(custo_row));
		}
		bb = true;
	}
	
	if(bb)
	{
		peso_total = (peso_total + peso_row)/1000;
		custo_total = custo_total + custo_row;
		$('#peso_total').val(peso_total);
		$('#preco_total').val(custo_total);
		num_rows = num_rows + 1;
		$("tr:eq("+num_rows+") td:eq(2)").html('0');
		num_rows = num_rows + 1;
		$("tr:eq("+num_rows+") td:eq(2)").html(float2moeda(custo_total));
		
	}
	
	//alert($('#table_carrinho tr').length);
	/*$("tr:eq(2) td:eq(2)").css("color", "red");
	alert($("tr:eq(2) td:eq(2)").html());*/
	return false;

}

	function refresh_frete(row)
	{
		var quebra=row.split("-");
		var num_rows = parseInt($('#table_carrinho tr').length) - 3;
		var custo_frete = parseFloat(quebra[1]);
		var custo_total = 0;
		var bb = false;

		for(var i=1; i<=num_rows ; i++)
		{
			custo_total = custo_total + moeda2float($.trim($("tr:eq("+i+") td:eq(6)").html()));
			bb = true;
		}

		if(bb)
		{
			custo_total = custo_total + custo_frete;
			$('#preco_total').val(custo_total);
			num_rows = num_rows + 1;
			$("tr:eq("+num_rows+") td:eq(2)").html(float2moeda(custo_frete));
			num_rows = num_rows + 1;
			$("tr:eq("+num_rows+") td:eq(2)").html(float2moeda(custo_total));
			$("#cep_01").val('');
			$("#cep_02").val('');
		}
		return false;
	}

	function moeda2float(moeda)
	{
		moeda = moeda.replace(".","");
		moeda = moeda.replace(",",".");
		return parseFloat(moeda);
	}

	function float2moeda(num) 
	{
		x = 0;
		if(num<0) {
		  num = Math.abs(num);
		  x = 1;
		}
		if(isNaN(num)) num = "0";
		  cents = Math.floor((num*100+0.5)%100);

		num = Math.floor((num*100+0.5)/100).toString();

		if(cents < 10) cents = "0" + cents;
			for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
				num = num.substring(0,num.length-(4*i+3))+'.'+num.substring(num.length-(4*i+3));
				ret = num + ',' + cents;
		if (x == 1) ret = ' - ' + ret;return ret;
	}

	function ver_enquete(id_projeto, id_quiz, id_email)
	{
		fancy_function("../gc/modulos/ajax_adm.php?acao=ver_enquete&dados="+id_projeto+"_"+id_quiz+"_"+id_email+"",600,450,"iframe");
	}

	function produto_agrupa()
	{
		ajaxHTML(document.getElementById('div_produto_agrupa').id,'../inc/busca_ajax.php?tipo=produto_agrupa&parametro='+$("#_id_sub_categoria").val());
	}

	//Verifica se a URL � valida
	function checkWeb(web)
	{
		var er = new RegExp(/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/);
		if(typeof(web) == "string")
		{
			if(er.test(web))
			{
				return true;
			}
		}
		else if(typeof(web) == "object")
		{
			if(er.test(web.value))
			{
				return true; 
			}
		}
		else
		{
			return false;
		}
	}
	
	function for_radio(id)
	{
		if(id != "")
		{
			$('#check_'+id).attr('checked', true); 
		}
	}
	
	function jqCheckAll(name, flag)
	{ 
		if (flag == 0)
		{
			//$("form#" + id + " INPUT[name=" + name + "][type='checkbox']").attr('checked', false);
			$('[name='+name+']').attr('checked', false);
		}
		else
		{
			//$("form#" + id + " INPUT[name=" + name + "][type='checkbox']").attr('checked', true);		
			$('[name='+name+']').attr('checked', true);
		}
	}

	function apagar_imagens(id_album, name, div) {         
		var ids_imgs = [];
		var cont = 0;
		$('[name='+name+']:checked').each(function() {
			ids_imgs.push($(this).val());
			cont++;
		});
		
		if($.trim(ids_imgs) != "")
		{
			ajax_pagina('lista_fotos','excluir_grupo', ''+ids_imgs+'', ''+id_album+'', '', '', '', '', '', '', ''+div+'', 'ajax_gc_adm', 'false');
		}
		else
		{
			alert('Por favor, selecione pelo menos um item')
		}
	}

	function valida_nome(novo_nome, nome_atual, tabela)
	{
		if(novo_nome.length > 2 && novo_nome.length < 300)
		{
			if(novo_nome != nome_atual)
			{
				ajax_pagina('valida_campo', ''+tabela+'', ''+novo_nome+'', '', '', '', '', '', '', '', 'div_valida', 'ajax_gc_adm', 'false');
			}
		}
	}
	
	function adiciona_blog()
	{
		var mensagem = "";
		var campos_validados = true;
		var cont_campos = parseInt($('#_numero_campos_blog').val());
		
		/*if($("#_nome_blog").val() == "")
		{
			var mensagem = "Por favor digite o T�tulo.";
			campos_validados = false;
		}*/
		
		if($("#_id_album_blog").val() == "")
		{
			var mensagem = "Por favor selecione um Album.";
			campos_validados = false;
		}
		
		if(!campos_validados)
		{
			alert(mensagem);
		}
		else
		{
			var url_virtual = $("#url_virtual").val();
			
			cont_campos = cont_campos + 1;
			
			var id_album = $("#_id_album_blog").val();		
			var nome_album = $("#_id_album_blog option:selected").text();
			var title = $("#_nome_blog").val();
			//var descricao = $("textarea#_corpo_blog").val();
			var descricao = tinyMCE.get('_corpo_blog').getContent();
			
			var input = '';
			input += '<div class="blog_materia">';
			
			//input += '<b>T�tulo: </b><input name="_nome_blog_js[]" type="text" value="'+title+'" size="30" maxlength="50" />';
			input += '<a href="#" class="del materia_del" onclick="javascript:removeCampo(\'_numero_campos_blog\');"><img src="'+url_virtual+'imagens/site/resp-errada.png" align="absmiddle" ></a><br><br>';
			input += '<b>�lbum: '+nome_album+'&nbsp;</b>';
			input += '<input type="hidden" name="_id_album_blog_js[]" value="'+id_album+'">';
			input += '<a id="add" class="ajuda" href="javascript:popup_geral_02(\'album_popup\',\'editar_album\', \''+id_album+'_'+nome_album+'\');"><img src="'+url_virtual+'imagens/gc/btn_editor.gif" align="absmiddle" ><span>Clique aqui para editar o Album.</span></a><br>';		
			input += '<b>Descri��o: </b><textarea name="_corpo_blog_js[]" cols="80" rows="4">'+descricao+'</textarea><br/><br/>';
			
			input += '<br/></div>';
			
			
			
			$("#div_blog_novo").append(input);
			$('#_numero_campos_blog').val(cont_campos);	
			$("#_nome_blog").val("");
			$("textarea#_corpo_blog").val("");
			
			$('#_id_album_blog option:eq(0)').attr('selected', 'selected')
			
		}
	}
	
	function url_blog(url, id_imagem)
	{
		if($.trim(url) != "")
		{	
			var url_virtual = $("#url_virtual").val();
			//ajax_pagina('edita_imagem_url', 'edita', ''+id_imagem+'', ''+url+'', '', '', '', '', '', '', 'div_valida', 'ajax_gc_adm', 'false');
			$.ajax({
			url: url_virtual+"gc/ajax_gc_adm.php",
			data: {acao_adm: "edita_imagem_url", acao: "edita", id: id_imagem, url: url},
			cache: false,
			success: function(html)
			{
				if(html.match(/.*sem_registros.*/i))
				{
					
				}
				else
				{	
					
				}
			}
			});		
		}
	}
	
	function popup_geral_02(acao_adm, acao, parametro)
	{
		var url_virtual = $("#url_virtual").val();
		
		x_popup_pagina = 981;
		y_popup_pagina = 755;
		switch (acao_adm)
		{		
			case "blog":
				fancy_function("../gc/modulos/ajax_adm.php?acao="+acao+"",800,600,"iframe");			
			break;
			
			case "newsletter":
				fancy_function(""+url_virtual+"ajax/popup_pagina.php?acao_adm="+acao_adm+"",x_popup_pagina,y_popup_pagina,"iframe");
			break;
			
			case "album_popup":
				fancy_function(""+url_virtual+"gc/modulos/ajax_adm.php?acao_adm="+acao_adm+"&acao="+acao+"&parametro="+parametro+"",x_popup_pagina,y_popup_pagina,"iframe");
			break;
			
			case "site_teste":
				fancy_function(""+url_virtual+"ts_css",1300,800,"iframe");
			break;
		}
	}
	
	function removeCampo(campo_numero) 
	{
		var cont_campos = $('#'+campo_numero).val();
		$('.del').live('click', function(){
			$(this).parent().remove();
			cont_campos = cont_campos - 1;
			calcula_valores();
			$('#'+campo_numero).val(cont_campos);
			return false;
		});
	}

	function removeCampo_popup() 
	{
		$('.del').live('click', function(){
			$(this).parent().remove();
			return false;
		});
	}
	
	function plugin_masonry(div)
	{
		$('#'+div).masonry({
				itemSelector: '.box',
				columnWidth: 2,
				isAnimated: !Modernizr.csstransitions,
				isFitWidth: true
		});
		
	}
	
	function filtro_menu(value) 
	{

		$("div.element").hide();
		$("div.element").removeClass('box');
		if(value == "*" || $.trim(value) == "")
		{
			$("div.element").addClass('box');
			
			//$("div.element").fadeIn(100);
			$("div.element").show();
			
		}
		else
		{
			value += " fixo";			
			var value_array = value.split(' ');
			var tamanhio_array = value_array.length;
			
				for(i=0; i<tamanhio_array; i++)
				{
					if($.trim(value_array[i]) != "")
					{
						$("div.element"+"."+value_array[i]).addClass('box');
						$("div.element"+"."+value_array[i]).show();
					}
				}
			
			
			//$("div."+value).fadeIn(100);
			
			/*value = $.trim(value);
			value = "."+value;*/
			//$("div.element"+value).show();
		}
			
			setInterval(function() {
				$('#scroll_infinito').masonry( 'reloadItems' );
				plugin_masonry('scroll_infinito');
			}, 1000);  
			
			return false;
		}

	
	function popup_menu(acao_adm)
	{
		x_popup_pagina = 600;
		y_popup_pagina = 400;
		
		var url_virtual = $("#url_virtual").val();
		
		switch (acao_adm)
		{					
			case "newsletter":
				x_popup_pagina = 499;
				y_popup_pagina = 282;
				fancy_function(""+url_virtual+"ajax/popup_pagina.php?acao_adm="+acao_adm+"",x_popup_pagina,y_popup_pagina,"iframe");
			break;			
		}
		
	}
	 
	function mouse_leave_menu()
	{
		var move_left;
		
		if($("#frame1").hasClass('frame_selected'))
		{
			//move_left = "-7px";
			move_left = "108px";
			time_left = 500;
			
		}
		else if($("#frame2").hasClass('frame_selected'))
		{
			//move_left = "89px";
			move_left = "203px";
			time_left = 800;
		}
		else
		{
			//move_left = "186px";
			move_left = "302px";
			time_left = 500;
		}
		
		
		$("#lavaLamp").animate({
		    left: move_left
		  }, time_left, function() {
		    // Animation complete.
		});
	}
	
	function mouse_enter_menu(move_left)
	{
		if($("#frame1").hasClass('frame_selected'))
		{
			time_left = 800;	
		}
		else if($("#frame2").hasClass('frame_selected'))
		{
			//move_left = "89px";
			//move_left = "-7px";
			time_left = 800;
		}
		else
		{
			//move_left = "186px";
			//move_left = "-7px";
			time_left = 500;
		}
		
		$('#lavaLamp').animate({
			    left: move_left
			  }, time_left, function() {
			    // Animation complete.
			  });	
	}
	
	function fadeInOut_puntero()
	{
		var ambiente_slider_gc = $("#ambiente_slider_gc").val();

		if(ambiente_slider_gc == 1 && !$('#m_contato').hasClass('selecionado'))
		{
			$("#control_div").fadeIn();	
			$("#control_div").removeClass();	
		}
		
	}


	$(document).ready(function ()
	{
		var url_virtual = $('#url_virtual').val();

		var mouseX = $(document).width()/2, mouseY = -100;
		$(document).mousemove(function(e){
		   mouseX = e.pageX-25;
		   mouseY = e.pageY-25; 
		});

		// cache the selector
		var follower = $("#control_div");
		var xp = 50, yp = -100;

		var loop = setInterval(function(){
		    // change 12 to alter damping higher is slower
		    xp += (mouseX - xp) / 6;
		    yp += (mouseY - yp) / 6;
		    follower.css({left:xp, top:yp});
		    
		}, 20);
		
		$('#control_div').click(function(){
			var mouse_class = $(this).attr('class');
			var current_slider_gc = $('#current_slider_gc').val();

			switch(mouse_class)
			{
				case 'view_case':
					$('.info_'+current_slider_gc).find('a').trigger('click');
				break;

				case 'prev_mouse':
					$('#prevslide').trigger('click');
				break;

				case 'next_mouse':
					$('#nextslide').trigger('click');
				break;
			}
		
		});


		if($('.frame').length > 0)
		{
			var go_to = "";
			$('.frame').click(function() {
				go_to = $(this).attr('data-option-value');
				api.goTo(go_to);
			});
		}
		
		
		if($('#menu_line').length > 0)
		{
			var move_left;
			var time_left;
			
			$("#frame1").mouseenter(function(i) {
				mouse_enter_menu("108px");
			}).mouseleave(function() {
				//mouse_leave_menu();
			});
			
			$("#frame2").mouseenter(function(i) {
				mouse_enter_menu("203px");
			}).mouseleave(function() {
				//mouse_leave_menu();
			});
			
			$("#frame3").mouseenter(function(i) {
				mouse_enter_menu("302px");
			}).mouseleave(function() {
				//mouse_leave_menu();
			});
			
			$('#frame1').click(function(){
				$('.frame').removeClass('frame_selected');
				$(this).addClass('frame_selected');
				$('#frame2').find('img').attr('src', url_virtual+'imagens/site/interrogacao_preto.png');
				$('#frame3').find('img').attr('src', url_virtual+'imagens/site/usuario_preto.png');
				$(this).find('img').attr('src', url_virtual+'imagens/site/ideia_branco.png');
			});
			
			$('#frame2').click(function(){
				$('.frame').removeClass('frame_selected');
				$(this).addClass('frame_selected');
				$('#frame3').find('img').attr('src', url_virtual+'imagens/site/usuario_preto.png');
				$('#frame1').find('img').attr('src', url_virtual+'imagens/site/ideia_preto.png');
				$('#frame2').find('img').attr('src', url_virtual+'imagens/site/interrogacao_branco.png');
			});
			
			$('#frame3').click(function(){
				$('.frame').removeClass('frame_selected');
				$(this).addClass('frame_selected');
				$('#frame2').find('img').attr('src', url_virtual+'imagens/site/interrogacao_preto.png');
				$('#frame1').find('img').attr('src', url_virtual+'imagens/site/ideia_preto.png');
				$(this).find('img').attr('src', url_virtual+'imagens/site/usuario_branco.png');
			});
			
			$('#menu_guapa').mouseleave(function() {
				mouse_leave_menu();
			});
		}
		
		if($('#div_cases').length > 0)
		{
			atualiza_slide('1','home');
		}
	
		/*if($('#bussola').length > 0)
		{
			atualiza_slide('1','home');
		}*/
		
		// SETAS DO SLIDER

		if($('.control_mouse').length > 0)
		{
			$(".control_mouse").mouseenter(function(i) {
				$("#control_div").fadeOut();

			}).mouseleave(function() {
				//$("#control_div").fadeIn();				
			});
		}

		if($('#supersized').length > 0)
		{
			$("#supersized").mouseenter(function(i) {
				
				fadeInOut_puntero();
				$("#control_div").addClass('view_case');

			}).mouseleave(function() {
				
			});
		}

		if($('#lateral_esquerda').length > 0)
		{
			$("#lateral_esquerda").mouseenter(function(i) {
				//alert('as');
				$(this).animate({
				    opacity: 1
				  }, 500, function() {
				    // Animation complete.
				  });
				// $("#lateral_esquerda").show();
				
				fadeInOut_puntero();
				$("#control_div").addClass('prev_mouse');

			}).mouseleave(function() {
				$(this).animate({
				    opacity: 0
				  }, 200, function() {
				    // Animation complete.
				  });
				 // $("#lateral_esquerda").hide();
			});
		}

		if($('#lateral_direita').length > 0)
		{
			$("#lateral_direita").mouseenter(function(i) {
				//alert('as');
				$(this).animate({
				    opacity: 1
				  }, 500, function() {
				    // Animation complete.
				  });
				
				fadeInOut_puntero();
				$("#control_div").addClass('next_mouse');

			}).mouseleave(function() {
				$(this).animate({
				    opacity: 0
				  }, 200, function() {
				    // Animation complete.
				  });
			});
		}
		//FIM SETAS DO SLIDER
		
		//Efeitos das Zetas
		var time_bounce = 500;
		if($("#prevslide").length)
		{
			$("#prevslide").mouseenter(function(i) {
				
				var block = $('#id_prevslide').css({opacity:'1',left: "20px"});
				
				var fallDist = 20;
				
				//let the block fall
				$(block).stop().animate({
					left: "-10px"
					//opacity:0.60,
				}, {
					duration: time_bounce*2,
					easing: "easeOutBounce"
				});
				
				setTimeout(function(){
					$(block).stop().animate({
						left: "10px"
						//opacity:0.60,
					}, {
						duration: time_bounce
						//easing: "easeOutBounce"
					});
				},time_bounce*2)
				
			});
		}
		
		if($("#prevslide").length)
		{
			$("#nextslide").mouseenter(function(i) {
				
				var block_2 = $('#id_nextslide').css({opacity:'1',right: "20px"});
				
				
				var fallDist = 20;
				
				//let the block fall
				$(block_2).stop().animate({
					right:"-10px"
					//opacity:0.60,
				}, {
					duration: time_bounce*2,
					easing: "easeOutBounce"
				});
				
				setTimeout(function(){
					$(block_2).stop().animate({
						right: "10px"
						//opacity:0.60,
					}, {
						duration: time_bounce
						//easing: "easeOutBounce"
					});
				},time_bounce*2)
			});
		}
		//FIM Efeito das Zetas
		
		
		$("#m_a_guapa").mouseenter(function(i) {
			if(!$(this).hasClass('selecionado'))
			{
				$(this).stop().animate({           
		            left: '60px'
		        }, 250,  function() {
	    			$(this).css({                      
			        	 'z-index':'110'
			        }).animate({           
			            left: '122px'
			        }, 250, 'swing');
				  });
				  
				              
		   
		       /* $('#m_cases').stop().css({                      
		        	 'z-index':'50'
		        }).animate({           
		            left: '200px',
		        }, 250, 'swing');*/
			}
		}).mouseleave(function() {
			if(!$(this).hasClass('selecionado'))
			{
	    		$(this).stop().animate({           
		            left: '60px'
		        }, 250,  function() {
	    			$(this).css({                      
			        	 'z-index':'10'
			        }).animate({           
			            left: '122px'
			        }, 250, 'swing');
			         
				 });
				 
				 /*
				 $('#m_cases').stop().css({                      
		        
				        }).animate({           
				            left: '212px',
				            top: '45px'
				        }, 100, 'swing');*/
			}

  		});
		
		$("#m_cases").mouseenter(function(i) {
			
			if(!$(this).hasClass('selecionado'))
			{
				if($("#m_a_guapa").hasClass('selecionado'))
				{
					$(this).stop().animate({           
			            left: '260px'
			            
			        }, 250,  function() {
		    			$(this).css({                      
				        	 'z-index':'110'
				        }).animate({           
				            left: '212px'
				        }, 250, 'swing');
					 });
				}
				else 
				if($("#m_contato").hasClass('selecionado'))
				{
					$(this).stop().animate({           
			            left: '180px'
			            
			        }, 250,  function() {
		    			$(this).css({                      
				        	 'z-index':'110'
				        }).animate({           
				            left: '212px'
				        }, 250, 'swing');
					 });
				}				
				else
				{
					$(this).stop().animate({           
			            top: '30px'
			            
			        }, 250,  function() {
		    			$(this).css({                      
				        	 'z-index':'100'
				        }).animate({           
				            //left: '212px',
				        }, 250, 'swing');
					 });
				}
			}
			
		}).mouseleave(function() {
	    	if(!$(this).hasClass('selecionado'))
			{
				if($("#m_a_guapa").hasClass('selecionado'))
				{
					$(this).stop().animate({           
			            left: '260px'
			            
			        }, 250,  function() {
		    			$(this).css({                      
				        	 'z-index':'50'
				        }).animate({           
				            left: '212px'
				        }, 250, 'swing');
					 });
				}
				else 
				if($("#m_contato").hasClass('selecionado'))
				{
					$(this).stop().animate({           
			            left: '180px'
			            
			        }, 250,  function() {
		    			$(this).css({                      
				        	 'z-index':'50'
				        }).animate({           
				            left: '212px'
				        }, 250, 'swing');
					 });
				}
				else
				{
		    		$(this).stop().animate({           
			            top: '45px'
			           
			        }, 250,  function() {
		    			$(this).css({                      
				        	 'z-index':'50'
				        }).animate({           
				            //left: '222px',
				        }, 250, 'swing');
				    
					 });
				}
			}
  		});
		
		$("#m_contato").mouseenter(function(i) {
			if(!$(this).hasClass('selecionado'))
			{
				var lef = 350;
				var time_contato = 300;
				if($("#m_a_guapa").hasClass('selecionado'))
				{
					lef = 360;
				}
				
				$(this).stop().animate({           
		            left: lef+'px'
		        }, time_contato,  function() {
	    			$(this).css({                      
			        	 'z-index':'100'
			        }).animate({           
			            left: '304px'
			        }, 250, 'swing');
				  });
		        
		        
		       /*  $('#m_cases').stop().css({                      
		        	 'z-index':'50'
		        }).animate({           
		            left: '222px',
		        }, 150, 'swing');*/
	        }
	        
		}).mouseleave(function() {
			if(!$(this).hasClass('selecionado'))
			{
				$(this).stop().animate({           
		            left: '350px'
		        }, 250,  function() {
	    			$(this).css({                      
			        	 'z-index':'20'
			        }).animate({           
			            left: '304px'
			        }, 250, 'swing');
			         /*
			         $('#m_cases').stop().css({                      
		        
				        }).animate({           
				            left: '212px',
				            top: '45px'
				        }, 100, 'swing');*/
				 });
			}
		});
		
		$('#m_a_guapa').click(function(){
			
			if(!$(this).hasClass('selecionado'))
			{
				var ambiente_slider_gc = $("#ambiente_slider_gc").val();
				var time_contato_selecionado = 0;
				
				if($('#m_contato').hasClass('selecionado'))
				{
					fecha_contato();
					$('.menu_guapa').removeClass('selecionado');
					$(this).addClass('selecionado');
					$(this).css({'z-index':'100' });
					$('#m_a_guapa').css({'z-index':'10' });
					$('#m_contato').css({'z-index':'20' });

					time_contato_selecionado = 1000;
				}
		
				if(ambiente_slider_gc != 2)
				{
					//Movimenta os bg na vertical
					$("#supersized2").empty();
					$('#div_a_guapa2 ul li').clone().appendTo('#supersized2');
						
					$('#div_a_guapa').css({'display': 'block'});
					$('#div_cases').css({'display': 'block'});
					setTimeout(function(){
						atualiza_slide('2', 'down');
					},time_contato_selecionado);
						
					//Fim Movimenta os bg na vertical					
				}	
				if($("#m_contato").hasClass('selecionado'))
				{
					$('#m_cases').css({'z-index':'50' });
					$('#m_contato').css({'z-index':'110' });
				}
				else
				{
					$('#m_cases').css({'z-index':'50' });
					$('#m_contato').css({'z-index':'20' });
				}
				$('.menu_guapa').removeClass('selecionado');
				$(this).addClass('selecionado');
				
				$('#m_logo').css({'z-index':'10' });

				$(this).css({'z-index':'100' });
			}
		});
		
		$('#m_cases').click(function(){
			
			
			if(!$(this).hasClass('selecionado'))
			{
				var ambiente_slider_gc = $("#ambiente_slider_gc").val();
				var time_contato_selecionado = 0;
				
				if($('#m_contato').hasClass('selecionado'))
				{
					fecha_contato();
					$('.menu_guapa').removeClass('selecionado');
					$(this).addClass('selecionado');
					$(this).css({'z-index':'100' });
					$('#m_a_guapa').css({'z-index':'10' });
					$('#m_contato').css({'z-index':'20' });
					time_contato_selecionado = 1000;
				}
				
				if(ambiente_slider_gc != 1)
				{
					//Movimenta os bg na vertical
					$("#supersized2").empty();
					$('#div_a_guapa2 ul li').clone().appendTo('#supersized2');
						
					$('#div_a_guapa').css({'display': 'block'});
					$('#div_cases').css({'display': 'block'});
	
					setTimeout(function(){
						atualiza_slide('1', 'up');
					},time_contato_selecionado);
					
					
					
					$('.info_e').css({                      
						 'top': '315px',
						 'display':'none'
					});
					
					//display: none; top: -315px;
					
					if($(".info_0").length > 0)
					{
					 	setTimeout(function(){
						 	$(".info_0").css({ 
						 		'display':'block',                     
								'top':'325px'
								 // 'display':'none'
							}).animate({           
							    top: '0px'
							}, 550, 'swing');
						},2500);
							    
					}
					
					$('.menu_guapa').removeClass('selecionado');
					$(this).addClass('selecionado');
					$(this).css({'z-index':'100' });
					$('#m_a_guapa').css({'z-index':'10' });
					$('#m_contato').css({'z-index':'20' });
					$('#m_logo').css({'z-index':'200' });
				}
			}
		});
		
		$('#m_contato').click(function(){
			
			if(!$(this).hasClass('selecionado'))
			{
				var ambiente_slider_gc = $("#ambiente_slider_gc").val();
				
				$('#lateral_esquerda').css({                      
					'display':'none'
				});
				
				$('#lateral_direita').css({                      
					'display':'none'
				});
				
				$('.menu_guapa').removeClass('selecionado');
				$(this).addClass('selecionado');
				
				$(this).css({'z-index':'100' });
				$('#m_a_guapa').css({'z-index':'10' });
				$('#m_cases').css({'z-index':'50' });
				$('#m_logo').css({'z-index':'200' });
				
				var id_slide = $('#supersized3').find('img').attr('id');
				id = id_slide.split('_');
				if(ambiente_slider_gc == 1)
		    	{
					//$(".info_e").animate({ � � � � �
					$(".info_"+id[1]).animate({ � �  
	 � � � � � � � � � �top: '-330px'
	 � � � � � � � �}, 1500, function(){
	 � � � � � � � � � �
	 					var imagem_blur = $('#supersized3').find('img').attr('src');
						var id_slide = $('#supersized3').find('img').attr('id');
							
	 � � � � � � � � � �$("#sombra_info").animate({
	 � � � � � � � � � � � �right: '-239px'
	 � � � � � � � � � �},1500, function(){
							abre_contato(imagem_blur, id_slide);
							$("#div_asignatura").css('display','none');
	 					});
	 � � � � � � � � � �
	 � � � � � � � �});
			    }
			    else
			    {
			    	$('#menu_guapa').animate({           
			            'bottom' : -71+'px'
			        }, 1500, function(){
				    	var imagem_blur = $('#supersized3').find('img').attr('src');
						var id_slide = $('#supersized3').find('img').attr('id');
				    	abre_contato(imagem_blur, id_slide);
			    	});
			    }	

			    $("#control_div").hide();
			}
		});///Fecha m_contato
		
	});
	
	function abre_contato(imagem_blur, id_slide)
	{
		$("#contato_conteiner").css("display","block");
		$("#google_maps").css("display","block");

		//alert($(document).height() );
		var time_menu = 1200;
		$('#google_maps').show();
		$('#google_maps').css({'height' : $(document).height() }).animate({
			'margin-right' : '0'
		},time_menu);
		
		$('#contatos_redes2').animate({
			'bottom' : '-200px'
		//},time_menu);
		},{duration: time_menu,easing: "easeInBounce"});
		

		/*Controla o blur da imagem...caso usuario clic novamente em contato*/
		if($('#menu').find('#m_contato').attr('class') == "menu_guapa selecionado")
		{
			
		}
		else
		{
			setTimeout(function(){
				blur(id_slide[1],img_blur[0],img_blur[1]);
			},1200);
		}

		
		$("#contato_conteiner").css("display","block");
		$("#google_maps").css("display","block");
		
		//v = imagem_blur;
		/*img_blur = imagem_blur.replace(/^http:\/\/([A-Za-z-_]+)?[\/]?([A-Za-z-_]+)\/imagens\/produtos\//,"");
		img_blur = img_blur.split(".");*/
		
		id_slide = id_slide.split("_");

		var img_blur = imagem_blur.split("/");
		var cont = img_blur.length;
		var cont = cont - 1;
		img_blur = img_blur[cont].split(".");
	
		var time_menu = 1200;
		$('#google_maps').css({'height' : $(document).height() }).animate({
			'margin-right' : '0'
		},time_menu);
		
		/*Controla o blur da imagem...caso usuario clic novamente em contato*/
		if($('#menu').find('#m_contato').attr('class') == "menu_guapa")
		{
			
		}
		else
		{
			blur(id_slide[1],img_blur[0],img_blur[1]);
		}
		
		$('#contatos_redes').show();
		$('#contatos_redes').css({'bottom' : -($(document).height()) }).animate({
			'bottom' : '0'
		},2000);

		setTimeout(function(){
	
	    	$('#contato_conteiner').css({'height': $(document).height() }).animate({
				'margin-right' : '458px'
			}, time_menu, function(){
						
						$('#endereco_guapa').css({'height':'167px'}).animate({'margin-top' : '0'},{duration: time_menu,easing: "easeOutBounce"});
						$('#contato_conteiner').css({'z-index':'200'});
					}
			);
		
		},400);
	}
	
	function fecha_contato()
	{
		var ambiente_slider_gc = $("#ambiente_slider_gc").val();
		
		//Controla  contato
		var imagem_blur = $('#supersized3').find('img').attr('src');
		var id_slide = $('#supersized3').find('img').attr('id');
		
		/*img_blur = imagem_blur.replace(/^http:\/\/([A-Za-z-_]+)?[\/]?([A-Za-z-_]+)\/imagens\/produtos\//,"");
		img_blur1 = img_blur.split(".");
		img_blur2 = img_blur.split("_blur");*/	
		
		id_slide = id_slide.split("_");

		var img_blur = imagem_blur.split("/");
		var cont = img_blur.length;
		var cont = cont - 1;
		img_blur1 = img_blur[cont].split(".");
		img_blur2 = img_blur[cont].split("_blur");
		//alert(img_blur1[0]);
		
		var time_menu1 = 1200;
		var time_menu2 = 1700;
		
		$('#contatos_redes').animate({
			'bottom' : -($(document).height()/2) 
		//},time_menu2,function(){
		},{duration: time_menu2, easing: "easeInBounce"},function(){
			$('#contatos_redes').hide();

		});

		setTimeout(function(){
			$('#contatos_redes2').animate({
					'bottom' : '20px'
				},time_menu2);
		},1000);
		//$('#contato_conteiner').animate({'margin-right' : '-458px'}, 'slow');
		
		$('#endereco_guapa').animate({
			'margin-top' : '-240px'
		},{duration: time_menu1,easing: "easeInBounce"});
		
		

		setTimeout(function(){
			$('#contato_conteiner').css({'z-index':'-200'});
			$('#contato_conteiner').animate({'margin-right' : '-458px'}, time_menu2, function(){
				if(ambiente_slider_gc == 1)
				{
					abre_lateral_direita(id_slide[1]);
				}
				else
				{
					$('#menu_guapa').animate({           
			            'bottom' : '0px'
			        }, 1500, function(){
				    	
			    	});
				}			
			});
		},1200);
		
		setTimeout(function(){

    	$('#google_maps').animate({
			'margin-right' : '-460px'
		}, time_menu2);
		
		},1600);
		
		setTimeout(function(){
					
			$("#contato_conteiner").css("display","none");
			$("#google_maps").css("display","none");

			$('#lateral_esquerda').css({'display':'block'});
			$('#lateral_direita').css({'display':'block'});
			$('#msg_contato').text('');
			//abre_lateral_direita(id_slide[1]);
			$('#google_maps').hide();
		},3100);

		offblur(id_slide[1],img_blur1[0],img_blur1[1]);
		
	}
	
	function resize_contato()
	{
		$('#google_maps').css({'height' : $(document).height() });
		$('#contato_conteiner').css({'height': $(document).height() });
		
		//var margin = parseInt($(document).height()) - 490;
		//$('#formulario_contato').css("margin-top", $(document).height()));

	}
	
	function atualiza_css()
	{
	    var msg_confirma = true;
	    if(!confirmar("Tem certeza que deseja trocar o template?")){
		    msg_confirma = false;
		}
	    return msg_confirma;
	}
	
	function filtra_noticias()
	{
		$('.link_submit').click(function (){
			
			var value = $('#nome_filtro').val(); 
			filtro_menu(value);
		});
		
		return false;
		
	}
	
	function zetas_correspondente(value)
	{
		
	      if ($(".div_hid_"+value).is(":hidden")){
	      	$(".div_hid_"+value).slideToggle("slow", function () {
		      	 $(".div_hid_"+value).show();
		      
		      	$('.class_zeta_'+value).removeClass('zeta_cima');
		      	$('.class_zeta_'+value).addClass('zeta_baixo');
		      	// $this.find('span').addClass("zeta_baixo");
	      	});
	      }
	      else
	      {
		     $(".div_hid_"+value).slideUp("slow", function () {
		     	$(".div_hid_"+value).hide("slow");
		     	
		      	 $('.class_zeta_'+value).removeClass('zeta_baixo');
		      	 $('.class_zeta_'+value).addClass('zeta_cima');
		     });
	      }
	     setInterval(function() {
			$('#scroll_infinito').masonry( 'reloadItems' );
			plugin_masonry('scroll_infinito');
		}, 500);  
		    
		//});
	}
	
	function zetas_enquete(value)
	{
		      
		      if ($(".ul_hid_"+value).is(":hidden")){
		      	$(".ul_hid_"+value).slideToggle("slow", function () {
			      	 $(".ul_hid_"+value).show();
			      	
			      	$('.class_ver_r'+value).removeClass('resp_cima');
			      	$('.class_ver_r'+value).addClass('resp_baixo');
			      	
		      	});
		      }
		      else
		      {
			     $(".ul_hid_"+value).slideUp("slow", function () {
			     	$(".ul_hid_"+value).hide("slow");
			     	
			      	
			      	 $('.class_ver_r'+value).removeClass('resp_baixo');
			      	 $('.class_ver_r'+value).addClass('resp_cima');
			     });
		      }
		     setInterval(function() {
				$('#scroll_infinito').masonry( 'reloadItems' );
				plugin_masonry('scroll_infinito');
			}, 500);  
		    
		
	}
	
	function formulario_contato_envia()
	{
		var nome = $.trim($('#_nome').val());
		var email = $.trim($('#_email').val());
		var telefone = $.trim($('#_telefone').val());
		var mensagem = $.trim($('#_mensagem').val());
		var url_virtual = $('#url_virtual').val();
		
		if(nome == ""){alert('Preencha o campo nome.');return false;}
		if(email == ""){alert('Preencha o campo e-mail.');return false;}
		if(telefone == ""){alert('Preencha o campo telefone.');return false;}
		if(mensagem == ""){alert('Preencha o campo Mensagem.');return false;}
		
		$.ajax({
		url: url_virtual + "ajax/ajax_site.php",
		data: {acao_adm: "envia_contato", nome: nome, email: email, telefone: telefone, mensagem: mensagem},
		cache: false,
		success: function(html)
		{
			if(html.match(/.*nao_enviou.*/i))
			{
				$("#msg_contato").text('N�o foi possivel enviar sua mensagem');
			}
			else
			{
				$("#msg_contato").text('Mensagem enviada com sucesso!');
				
				$.trim($('#_nome').val('Nome'));
				$.trim($('#_email').val('E-mail'));
				$.trim($('#_telefone').val('Telefone'));
				$.trim($('#_mensagem').val('Mensagem'));
			}
		}
		});

	}
	
	function modifica_ordem_home(id_produto, ordem)
	{
		if (id_produto > 0)
		{
			$.ajax({
			url: "../ajax/ajax_site.php",
			data: {acao_adm: "modifica_ordem_home", _id_produto: id_produto, _ordem: ordem},
			cache: false,
			success: function(html)
			{
				if(html.match(/.*nao_modificou.*/i))
				{
					alert('N�o foi poss�vel realizar a modifica��o. Por favor tente novamente!');
				}
				else
				{
					alert('Ordem do produto modificada com sucesso!');
				}
			}
			});
		}
	}
	
	function modifica_estado_home(id_produto, estado)
	{
		if (id_produto > 0)
		{
			$.ajax({
			url: "../ajax/ajax_site.php",
			data: {acao_adm: "modifica_estado_home", _id_produto: id_produto, _estado: estado},
			cache: false,
			success: function(html)
			{
				if(html.match(/.*nao_modificou.*/i))
				{
					alert('N�o foi poss�vel realizar a modifica��o. Por favor tente novamente!');
				}
				else
				{
					alert('Estado do produto modificado com sucesso!');
				}
			}
			});
		}
	}
	
	
	function mostra_prevslide(id)
	{
		
		$('#'+id).animate({
		    opacity: 1
		  }, "fast" );
		
		$('#'+id).css('display', 'block');
	}
	
	function esconde_prevslide(id)
	{
		
		$('#'+id).animate({
		    opacity: 1
		  }, "fast" );
		
		$('#'+id).css('display', 'none');
	}
	
	function fecha_lateral_direita(id)
 � �{
 � � � � � �$(".info_"+id).animate({ � � � � � 
 � � � � � � � � � �top: '340px'
 � � � � � � � �}, 1500, function(){
 � � � � � � � � � �
 � � � � � � � � � �$("#sombra_info").animate({
 � � � � � � � � � � � �right: '-239px'
 � � � � � � � � � �},1500);
 � � � � � � � � � �$("#div_asignatura").css('display','none');
 � � � � � � � �});
 � �}
	
	function abre_lateral_direita(id)
 � �{
 � � � � � �$("#sombra_info").animate({ � � � � � 
 � � � � � � � � � �right: '0px'
 � � � � � � � �}, 1500, function(){
 � � � � � � � � � �
 � � � � � � � � � �$(".info_"+id).animate({
 � � � � � � � � � � � �top: '0px'
 � � � � � � � � � �},1500);
 � � � � � � � � � �$("#div_asignatura").css('display','block');
 � � � � � � � �});
 � �}
