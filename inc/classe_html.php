<?php

class Html
{
	private $home;
	private $title_face_fb;
	private $url_face_fb;
	private $description_face_fb;
	private $image_face_fb;
	private $formatacao;
    
    function set($prop, $value)
	{
		$this->$prop = $value;
	}

	function __construct()
	{
	}

	function __destruct()
	{
	}

	function codigo_html()
	{
		$o_ajudante = new Ajudante;
		$o_template = new Template;
		$o_configuracao = new Configuracao;
		
		$url_virtual = $o_configuracao->url_virtual();
		$url_fisico = $o_configuracao->url_fisico();
		
		$o_css = new Css;
		$o_css->set('id', '1');
		if($rs = $o_css->selecionar())
		{
			foreach($rs as $l)
			{
				$logo_teste = $l['logo'];
				$logo_online = $l['logo_online'];
			}
		}
		
		
		if((isset($_REQUEST['acao_adm']) && $_REQUEST['acao_adm'] == "ts_css") || (isset($_REQUEST['id']) && $_REQUEST['id'] == "ts_css") || (isset($_REQUEST['acao']) && $_REQUEST['acao'] == "ts_css"))
		{
			$css_teste = "s";
			$formatacao_custom = "formatacao_test.css";
			if(trim($logo_teste) != "" || $logo_teste != "null")
			{
				$logo = "site_gc/".$logo_teste;
			}
			else
			{
				$logo = "site/".$logo_online;
			}
		}
		else
		{
			$css_teste = "n";
			$formatacao_custom = "formatacao_custom.css";
			$logo = "site/".$logo_online;
		}
		
		if(file_exists(($url_virtual."imagens/".$logo)))
		{
			$l = getimagesize("".$url_virtual."imagens/".$logo."");
		}
		
		$logo =  "<a href=\"".$url_virtual."\"><img width=\"".$l[0]."\" height=\"".$l[1]."\" src=\"".$url_virtual."imagens/".$logo."\" title=\"Logo ".$o_configuracao->site_titulo()."\" alt=\"Logo ".$o_configuracao->site_titulo()."\"></a>";
		
		//Monta o Menu Direito
			$o_menu = new Menu;
			$o_menu->set("css_teste", $css_teste);
			$o_menu->set("id_menu_ambiente", "3");
			if(isset($_SESSION["menu__"]))
			{
				$menu = $_SESSION["menu"];
			}
			else
			{
				$pag_atual = basename($_SERVER['SCRIPT_NAME']);			
				$o_menu->set("pag_atual",$pag_atual);
				$menu = $o_menu->menu_principal();			
				$_SESSION["menu"] = $menu;
			}
			unset($o_menu);
		
		//Monta o Menu Ezquerdo
			if($_SESSION["acesso"] == "sim")
			{
				$excessao = "login";
			}
			else
			{
				$excessao = "sair";
			}
			
			$o_menu = new Menu;
			$o_menu->set("css_teste", $css_teste);
			$o_menu->set("id_menu_ambiente", "2");
			$o_menu->set("excessao",$excessao);
			$menu_direito = $o_menu->menu_direito();			
			
			$o_menu_produto = new Menu_produto;			
			$o_menu_produto->set("css_teste", $css_teste);
			
			if(isset($this->home))
			{
				$o_menu_produto->set('home','s');
			}
			$sub_menu = $o_menu_produto->menu_produto();
		//FIM Monta os Menus
		
		/*METATAGS DO FACEBOOK*/
		if(isset($this->title_face_fb))
		{
			$title_face_fb = $this->title_face_fb;
		}
		else
		{
			$title_face_fb = $o_configuracao->site_nome();
		}
		if(isset($this->url_face_fb))
		{
			$url_face_fb = $this->url_face_fb;
		}
		else
		{
			$url_face_fb = $url_virtual;
		}
		if(isset($this->image_face_fb))
		{
			$image_face_fb = $this->image_face_fb;
		}
		else
		{
			$image_face_fb = $url_virtual."imagens/site/logo.png";
		}
		
		if(isset($this->fb_admins))
		{
			$fb_admins = $this->fb_admins;
		}
		else
		{
			//$fb_admins = "381815101891640";//id_app
			$fb_admins = "100002249361850";//id_admin
		}
		
		if(isset($this->description_face_fb))
		{
			$description_face_fb = $this->description_face_fb;
		}
		else
		{
			$description_face_fb = "";
		}

		if(isset($this->type_fb))
		{
			$type_fb = $this->type_fb;
		}
		else
		{
			$type_fb = "company";
		}

		$facebook_compartilhar = '
		<meta property="og:title" content="'.$title_face_fb.'" />
		<meta property="og:type" content="'.$type_fb.'" />
		<meta property="og:url" content="'.$url_face_fb.'" />
		<meta property="og:image" content="'.$image_face_fb.'" />
		<meta property="og:site_name" content="'.$title_face_fb.'" />
		<meta property="fb:admins" content="'.$fb_admins.'" />
		<!--<meta property="fb:app_id" content="'.$fb_admins.'" />-->
		<meta property="og:description" content="'.$description_face_fb.'" />';
		
		//Monta os 5 ultimos trabalhos da agencia guapa
		$o_produto = new Produto;
		$o_produto->set('limite', 5);
		$o_produto->set('estado','a');
		$o_produto->set('id_produto_tipo','1');
		$o_produto->set('ordenador','ordem');
		if($rs_p = $o_produto->selecionar())
		{
			$sliderbgs = "";
			$empresas_descricao = "";
			$cont = 0;
			foreach($rs_p as $l_p)
			{
				if(file_exists(($url_fisico."imagens/produtos/".$l_p['logo_imagem'])))
				{
					$l_i = getimagesize($url_virtual."imagens/produtos/".$l_p['logo_imagem']);
				}
				
				$imagem =  "<img width=\"165\" height=\"".$l_i[1]."\" src=\"".$url_virtual."imagens/produtos/".$l_p['logo_imagem']."\" title=\"\" alt=\"\">";
				
				//$imagem = <img src="[url_virtual]imagens/produtos/logo_king55.png" width="165" height="112" />
				
				//pega no da imagem sem extensao
				$img_nome = explode(".",$l_p['nome_imagem']);
				
				$lista = array(
					"[id]" => $l_p['id']
					,"[cont]" => $cont
					,"[url_virtual]" => $url_virtual
					,"[imagem]" => $imagem
					,"[corpo]" => $l_p['corpo']
					,"[imagem_fundo]" => $img_nome[0]
					,"[ext]" => $img_nome[1]
				);
			
				$template = $o_ajudante->template("templates/descricao_empresa.html");
				$empresas_descricao .= strtr($template,$lista);
				
				$sliderbgs .= "{image : '".$url_virtual."imagens/produtos/".$l_p['nome_imagem']."', title : '',  thumb : '', url : ''},";
				$cont++;
			}
			
			$slider_bgs = $sliderbgs;
			
		}
		else {
			$slider_bgs = "";		
		}
		
		
		$lista = array(
			
			"[site_autor]" => "".$o_configuracao->site_autor()."",
			"[site_slogan]" => "".$o_configuracao->site_slogan()."",
			"[site_titulo]" => "".$o_configuracao->site_titulo()."",
			"[site_descricao]" => "".$o_configuracao->site_descricao()."",
			"[site_palavra_chave]" => "".$o_configuracao->site_palavra_chave()."",
			"[facebook_compartilhar]" => "".$facebook_compartilhar."",
			"[formatacao_custom]" => "".$formatacao_custom."",
			"[logo]" => "".$logo."",
			"[menu]" => "".$menu."",
			"[menu_direito]" => "".$menu_direito."",
			"[sub_menu]" => "".$sub_menu."",
			"[corpo]" => "".$this->corpo."",
			"[slider_bgs]" => "".$slider_bgs."",
			"[empresas_descricao]" => $empresas_descricao,
			"[url_virtual]" => "".$o_configuracao->url_virtual()."",
		);
		
		$o_template->set('nome_aquivo','templates/index.html');
		$template = $o_template->template_resultado();
		
		$resultado = strtr($template,$lista);

		unset($o_template);
		unset($o_ajudante);
		unset($o_configuracao);
		unset($lista);
		unset($o_css);
		return $resultado;
	}
	
	function codigo_html_02()
	{
		$o_configuracao = new Configuracao;
		$o_ajudante = new Ajudante;
		$o_template = new Template;		
		$o_menu = new Menu;
		
		$url_virtual = $o_configuracao->url_virtual();
		$o_template->set('nome_aquivo',''.$url_virtual.'templates/index_02.html');
		
		$o_menu_produto = new Menu_produto;
		$template = $o_template->template_resultado();
		$template = $o_ajudante->template("../templates/index_02.html");
		
		$lista = array(
			"[url_virtual]" => "".$url_virtual."",
			"[site_slogan]" => "".$o_configuracao->site_slogan()."",
			"[site_titulo]" => "".$o_configuracao->site_titulo()."",
			"[site_autor]" => "".$o_configuracao->site_autor()."",
			"[site_descricao]" => "".$o_configuracao->site_descricao()."",
			"[site_palavra_chave]" => "".$o_configuracao->site_palavra_chave()."",
			"[index]" => "".$this->index."",
			"[formatacao]" => "".$this->formatacao."",
			"[corpo]" => "".$this->corpo.""
		);
		
		$resultado = strtr($template,$lista);

		unset($o_template);
		unset($o_ajudante);
		unset($o_configuracao);
		unset($lista);
		return $resultado;
	}
}
?>