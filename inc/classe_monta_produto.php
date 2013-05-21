<?php
class Monta_produto
{
	private $limite;
	private $limite_inicio;
	private $termo_busca;
	private $categoria_id;
	private $produto_id;
	private $estado;
	private $desc_asc;
	private $pagina_ajax;
	private $busca_produto;
	private $botao_home;
	private $tipo_botao_home;
	private $tipo_botao_home_value;
	private $altura;
	private $in_busca;
	private $player_mp3;
	private $id_musica;
	private $pagina;
	private $chamada_pai;
	private $chamada_usuario;
	private $ajax;
	private $id_produto_tipo;
	private $home;

	function __constructor()
	{
		//
	}

	function set($prop, $value)
	{
		$this->$prop = $value;
	}

	function lista()
	{

		$o_produto = new Produto;
		$o_ajudante = new Ajudante;
		$o_configuracao = new Configuracao;

		$url_virtual = $o_configuracao->url_virtual();
		$url_fisico = $o_configuracao->url_fisico();
		
		$o_produto->set('limite', $this->limite);
		$o_produto->set('limite_inicio', $this->limite_inicio);
		$o_produto->set('estado', 'a');
		$o_produto->set('termo_busca',$this->termo_busca);
		$o_produto->set('ordenador', $this->ordenador);
		$o_produto->set('DESC_ASC', $this->desc_asc);
		if($rs = $o_produto->selecionar_produto_complemento())
		{
			$total_produtos = $rs->rowCount();
			$limite_palabras_p = 10;	// Materia pequena
			$limite_palabras_m = 15;	// Materia mediana
			$limite_palabras_g = 20;	// Materia grande
			$limite_palabras_c = 25;	// Materia completa
			$cont = 0;

			foreach($rs as $l)
			{
				$o_ilustra = new Ilustra;
				$corpo_tratado = "";

				if($cont == 0)
				{
					if(!isset($this->home))
					{
						$resultado .= '
							<div class="element_box_home box col2">
								<div class="element_filtro2 fixo col2 box_filtro">
									<div class="element_contenedor_filtro class_filtro ">
										
										<div class="[class_element]">
										
											<input type="text" id="nome_filtro" name="nome_filtro" value="">
											<a href="#" class = "link_submit" ><img src="'.$url_virtual.'imagens/site/btn_busca.png" width="77" height="39" /></a>
										
										</div>
									</div>
									
								</div>
							</div>
						';
					}
				}

				if($l['estilo'] == 'p')
				{
					$tipo_col = "col2";
					$span = "span_inf_p";
					$largura = 203;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_p)
					{
						for($i=0;$i<$limite_palabras_p ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}
				elseif($l['estilo'] == 'm')
				{
					$tipo_col = "col3";
					$span = "span_inf_m";
					$largura = 222;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_m)
					{
						for($i=0;$i<$limite_palabras_m ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}
				elseif($l['estilo'] == 'g')
				{
					$tipo_col = "col4";
					$span = "span_inf_g";
					$largura = 330;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_g)
					{
						for($i=0;$i<$limite_palabras_g ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}
				
				elseif($l['estilo'] == 'c')
				{
					$tipo_col = "col5";
					$span = "span_inf_c";
					$largura = 455;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_c)
					{
						for($i=0;$i<$limite_palabras_c ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}
				
				elseif($l['estilo'] == 'i')
				{
					$tipo_col = "col6";
					$span = "span_inf_i";
					$largura = 1130;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_c)
					{
						for($i=0;$i<$limite_palabras_c ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}

				if($l['estilo_retrato'] == 'r')
				{
					$class_element = "class_element";
					$largura = "125";
				}
				else
				{
					$class_element = "";
				}
				
				/* Monta as categorias(tags) nos produtos(materias)*/
				$tag_categoria = "";
				$o_categoria_produto = new Categoria_produto;
				$o_categoria_produto->set('id_produto', $l['id']);
				if($rs_01 = $o_categoria_produto->selecionar_categoria_produto_02())
				{
					foreach($rs_01 as $l_01)
					{
						$data_option_value = $o_ajudante->trata_texto_01($l_01['nome']);
						$tag_categoria .= "".$data_option_value." ";
					}
					$tag_categoria = substr($tag_categoria, 0, -1);
				}
				else
				{
					$tag_categoria = "";
				}
				unset($o_categoria_produto);
				/*Fim tags*/

				$acao_click = "5";
				$link_img = "";
				$nome_imagem = "";
				$img = "";
				
				
				//$url_detalhe = $url_virtual."site/materia.php?acao_materia=detalhe&id=".$l['id']."";

				/*Verifica se produto tem categoria
					Somente o produto_tipo Galeria Virtual possui categorias de produto
				*/
				if($l['produto_tipo'] != "galeria_virtual")
				{
					$url_detalhe = $url_virtual."interna/".$l['produto_tipo']."/".$l['chamada_produto']."";
				}
				else
				{
					$url_detalhe = $url_virtual."interna/".$l['chamada_categoria']."/".$l['chamada_produto']."";
				}

				
				$o_ilustra->set('limite',1);				
								
				if($l["id_album"] == 0 || $l["id_album"] == "")
				{
					$l["id_album"] = 1;
				}
				$o_ilustra->set('album_id',$l["id_album"]);
				$o_ilustra->set('largura',$largura);
				$o_ilustra->set('pasta','produtos');				
				$o_ilustra->set('separador','');				
				$o_ilustra->set('acao_click',$acao_click);
				$o_ilustra->set('url',$url_detalhe);
				$o_ilustra->set('div_ilustra','div_mostra_imagem');				
				$img = $o_ilustra->galeria();				
				
				//seleciona o nome da imagem
				$o_imagem = new Imagem;
				$o_imagem->set('id_album',$l['id_album']);
				$o_imagem->set('limite',1);
				if($res_imagem = $o_imagem->selecionar())
				{
					foreach($res_imagem as $l_imagem)
					{
						$nome_imagem = $l_imagem['nome'];
					}
				}
				unset($o_imagem);
				//unset($o_ilustra);
			

				//Pega Template
				$conteudo = $o_ajudante->template("".$url_fisico."templates/produto_destaque.html");
				if($l["preco"] != 0)
				{
					if($l["desconto"] != 0)
					{
						$preco = " 
						De <b class=\"cortado\">R$ ".number_format($l['preco'], 2, ',', ' ')."</b><br />
						Por R$ ".number_format($o_ajudante->desconto($l['preco'],$l["desconto"]), 2,',',' ');
					}
					else
					{
						$preco = "<b>R$ ".number_format($l['preco'], 2,',',' ')."</b>";
					}
				}
				
				
				$lista = array(
				"[url_virtual]" => $url_virtual,
				"[class_element]" => $class_element,
				"[class]" => "element ".$tag_assunto." ".$tag_categoria." box ".$l['palavra_chave']." ".$tipo_col."  ",
				"[span]" => $span,
				"[imagem]" => $img,
				"[nome]" => $l["nome"],
				"[descricao]" => strip_tags($corpo_tratado),
				"[tipo]" => $l["tipo"],
				"[preco]" => $preco,
				"[categoria_id]" => $_REQUEST["_categoria_id"],
				"[id]" => $l["id"],
				"[complemento_id]" => $l["complemento_id"],
				"[nome]" => $l["nome"],
				"[url]" => $url_detalhe,
				"[imagem_url]" => $url_virtual."imagens/galeria/".$nome_imagem,
				);
				$resultado .= strtr($conteudo,$lista);
				unset($lista);
				unset($o_ilustra);
				$cont++;
			}//fecha foreach

		}
		else
		{
			//$resultado = $o_ajudante->mensagem(14);
			$resultado = false;
		}//fecha busca por produto
		// PAGINAÇÃO PARTE 2 FIM 

		return $resultado;
		unset($o_produto);
		unset($o_menu_produto);
		unset($o_ajudante);
		unset($o_configuracao);
	}

	function lista_02()
	{
		$o_produto = new Produto;
		$o_ajudante = new Ajudante;
		$o_configuracao = new Configuracao;

		$url_virtual = $o_configuracao->url_virtual();
		$url_fisico = $o_configuracao->url_fisico();
		
		$limite_palabras_p = 20;	// Materia pequena
		$limite_palabras_g = 20;	// Materia grande
		$acao_click = 5;

		$o_produto->set('limite', $this->total_registros_pagina);
		$o_produto->set('estado', 'a');
		$o_produto->set('limite_inicio', $array_paginacao['limite_inicio']);
		$o_produto->set('termo_busca',$this->termo_busca);
		$o_produto->set('categoria_id', $this->categoria_id);
		$o_produto->set('ordenador', $this->ordenador);
		$o_produto->set('DESC_ASC', $this->desc_asc);
		if($rs = $o_produto->selecionar_produto_complemento_04())
		{
			$total_produtos = $rs->rowCount();

			foreach($rs as $l)
			{
				$o_ilustra = new Ilustra;

				$class = "element Comportamento   box col2";
				
				$conteudo = $o_ajudante->template("".$url_fisico."templates/produto_destaque_02.html");				
				
				$url_detalhe = $url_virtual."materia/".$l["chamada_categoria"]."/".$l['chamada_produto']."";
				
				$o_ilustra->set('album_id',$l["id_album"]);
				$o_ilustra->set('largura','256');
				//$o_ilustra->set('altura','146');
				$o_ilustra->set('separador','');
				$o_ilustra->set('limite','1');
				$o_ilustra->set('pasta','produtos');
				$o_ilustra->set('acao_click',$acao_click);
				$o_ilustra->set('url',$url_detalhe);
				$o_ilustra->set('div_ilustra','div_mostra_imagem');

				//seleciona o nome da imagem
				$o_imagem = new Imagem;
				$o_imagem->set('id_album',$l['id_album']);
				$o_imagem->set('limite',1);
				if($res_imagem = $o_imagem->selecionar())
				{
					foreach($res_imagem as $l_imagem)
					{
						$nome_imagem = $l_imagem['nome'];
					}
				}
				unset($o_imagem);
				
				if($l["preco"] != 0)
				{
					if($l["desconto"] != 0)
					{
						$preco = " 
						De <b class=\"cortado\">R$ ".number_format($l['preco'], 2, ',', ' ')."</b><br />
						Por R$ ".number_format($o_ajudante->desconto($l['preco'],$l["desconto"]), 2,',',' ');
					}
					else
					{
						$preco = "<b>R$ ".number_format($l['preco'], 2,',',' ')."</b>";
					}
				}
				
				//Limita tamanho do texto
				$nome = strlen($l["nome"]);
				if($nome > 20)
				{
					$nome = substr($l["nome"],0,20) . " ..";
				}
				else
				{
					$nome = $l['nome'];
				}
				
				$link_detalhes = $url_virtual."materia/".$l["chamada_categoria"]."/".$l["chamada_produto"]."";
				$lista = array(
					"[url_virtual]" => $url_virtual,
					"[class]" => $class,
					"[imagem]" => $o_ilustra->galeria(),
					"[tipo]" => $l["tipo"],
					"[preco]" => $preco,
					"[categoria_id]" => $_REQUEST["_categoria_id"],
					"[id]" => $l["id"],
					"[complemento_id]" => $l["complemento_id"],
					"[nome]" => $l["nome"],
					"[descricao]" => strip_tags($l['corpo']),
					"[url]" => $url_detalhe,
					"[imagem_url]" => $url_virtual."imagens/galeria/".$nome_imagem,
					"[link_detalhes]" => $link_detalhes,
				);
				$resultado .= strtr($conteudo,$lista);
				unset($o_ilustra);
				unset($lista);
					
			
			}//fecha foreach
		}
		else
		{
			$resultado .= $o_ajudante->mensagem(14);
			$resultado = false;
		}//fecha busca por produto

		// PAGINAÇÃO PARTE 2 FIM 
		
		return $resultado;
		unset($o_produto);
		unset($o_menu_produto);
		unset($o_ilustra);
		unset($o_ajudante);
		unset($o_configuracao);
	}
	
	function monta_lista_noticias()
	{

		$o_produto = new Produto;
		$o_ajudante = new Ajudante;
		$o_configuracao = new Configuracao;

		$url_virtual = $o_configuracao->url_virtual();
		$url_fisico = $o_configuracao->url_fisico();
		
		//pega o id dono da noticia da pagina correspondentes
		if(isset($this->chamada_usuario) && trim($this->chamada_usuario) != "")
		{
			$o_usuario = new Usuario;
			$o_usuario->set('chamada_usuario', $this->chamada_usuario);
			$o_usuario->set('estado', 'a');
			if($rs_usr = $o_usuario->selecionar())
			{
				foreach($rs_usr as $l_usr)
				{
					$id_usuario = $l_usr['id'];
					$o_produto->set('id_usuario', $id_usuario);
				}
			}
			
		}
		
		$o_produto->set('limite', $this->limite);
		$o_produto->set('limite_inicio', $this->limite_inicio);
		$o_produto->set('estado', 'a');
		$o_produto->set('id_produto_tipo', 1); //1->Noticias
		$o_produto->set('termo_busca',$this->termo_busca);
		$o_produto->set('ordenador', $this->ordenador);
		$o_produto->set('DESC_ASC', $this->desc_asc);
		if($rs = $o_produto->selecionar_produto_complemento())
		{
			$total_produtos = $rs->rowCount();
			$limite_palabras_p = 10;	// Materia pequena
			$limite_palabras_m = 15;	// Materia mediana
			$limite_palabras_g = 20;	// Materia grande
			$limite_palabras_c = 25;	// Materia completa
			$cont = 0;
			foreach($rs as $l)
			{
				if($cont == 0)
				{
					
					if(!isset($this->id_produto_tipo))
					{
						$resultado .= "
							<div class=\"element_contenedor_2_divs box col2\">
								<div class=\"element_filtro menu_fixo col2 box_filtro\">
									<div class=\"element_contenedor_filtro class_filtro \">
										
										<div class=\"[class_element]\">
										
											<input type=\"text\" id=\"nome_filtro\" name=\"nome_filtro\" value=\"\">
											<a href=\"#\" class = \"link_submit\" ><img src=\"".$url_virtual."imagens/site/btn_busca.png\" width=\"77\" height=\"39\" /></a>
										
										</div>
									</div>
									
								</div>
								
								<div class=\"element_destaque col2 box_filtro\">
									<div class=\"element_contenedor_destaque\">
										<img class=\"img_rigth\" src=\"".$url_virtual."imagens/site/logo_destaque.png\" width=\"95\" height=\"104\"/>
										<p>Dividir conte&uacute;dos<br/>  interessantes tamb&eacute;m <br/> &eacute; uma forma de aprendizado.</p>
														<p>Viu algo legal por a&iacute;?<br/>
														No Facebook, Twitter, sites <br/>ou em qualquer outro lugar?.</p>
														<h3 class=\"h_cero\"><a href=\"#\" onclick=\"fancy_function('".$url_virtual."componentes/popup_formularios.php?acao=correspondentes&subacao=',700,620,'iframe')\">Ent&atilde;o divida conosco.</a></h3>
									</div>
									
								</div>
							</div>
						";
					}
				}

				$o_ilustra = new Ilustra;
				$corpo_tratado = "";

				if($l['estilo'] == 'p')
				{
					$tipo_col = "col2";
					$span = "span_inf_p";
					$largura = 203;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_p)
					{
						for($i=0;$i<$limite_palabras_p ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}
				elseif($l['estilo'] == 'm')
				{
					$tipo_col = "col3";
					$span = "span_inf_m";
					$largura = 222;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_m)
					{
						for($i=0;$i<$limite_palabras_m ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}
				elseif($l['estilo'] == 'g')
				{
					$tipo_col = "col4";
					$span = "span_inf_g";
					$largura = 330;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_g)
					{
						for($i=0;$i<$limite_palabras_g ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}
				
				elseif($l['estilo'] == 'c')
				{
					$tipo_col = "col5";
					$span = "span_inf_c";
					$largura = 455;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_c)
					{
						for($i=0;$i<$limite_palabras_c ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}
				
				elseif($l['estilo'] == 'i')
				{
					$tipo_col = "col6";
					$span = "span_inf_i";
					$largura = 1130;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_c)
					{
						for($i=0;$i<$limite_palabras_c ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}

				if($l['estilo_retrato'] == 'r')
				{
					$class_element = "class_element";
					$largura = "125";
				}
				else
				{
					$class_element = "";
				}
				
				/* Monta as categorias(tags) nos produtos(materias)*/
				$tag_categoria = "";
				$o_categoria_produto = new Categoria_produto;
				$o_categoria_produto->set('id_produto', $l['id']);
				if($rs_01 = $o_categoria_produto->selecionar_categoria_produto_02())
				{
					foreach($rs_01 as $l_01)
					{
						$data_option_value = $o_ajudante->trata_texto_01($l_01['nome']);
						$tag_categoria .= "".$data_option_value." ";
					}
					$tag_categoria = substr($tag_categoria, 0, -1);
				}
				else
				{
					$tag_categoria = "";
				}
				unset($o_categoria_produto);
				/*Fim tags*/

				$acao_click = "5";
				$link_img = "";
				$nome_imagem = "";
				$img = "";
				
				
				//$url_detalhe = $url_virtual."site/materia.php?acao_materia=detalhe&id=".$l['id']."";

				
				$url_detalhe = $url_virtual."interna/noticias/".$l['chamada_produto']."";
				$o_ilustra->set('limite',1);				
								
				if($l["id_album"] == 0 || $l["id_album"] == "")
				{
					$l["id_album"] = 1;
				}
				$o_ilustra->set('album_id',$l["id_album"]);
				$o_ilustra->set('largura',$largura);
				$o_ilustra->set('pasta','produtos');				
				$o_ilustra->set('separador','');				
				$o_ilustra->set('acao_click',$acao_click);
				$o_ilustra->set('url',$url_detalhe);
				$o_ilustra->set('div_ilustra','div_mostra_imagem');				
				$img = $o_ilustra->galeria();				
				
				//seleciona o nome da imagem
				$o_imagem = new Imagem;
				$o_imagem->set('id_album',$l['id_album']);
				$o_imagem->set('limite',1);
				if($res_imagem = $o_imagem->selecionar())
				{
					foreach($res_imagem as $l_imagem)
					{
						$nome_imagem = $l_imagem['nome'];
					}
				}
				unset($o_imagem);
				//unset($o_ilustra);
			

				//Pega Template
				$conteudo = $o_ajudante->template("".$url_fisico."templates/noticias_destaque.html");
				if($l["preco"] != 0)
				{
					if($l["desconto"] != 0)
					{
						$preco = " 
						De <b class=\"cortado\">R$ ".number_format($l['preco'], 2, ',', ' ')."</b><br />
						Por R$ ".number_format($o_ajudante->desconto($l['preco'],$l["desconto"]), 2,',',' ');
					}
					else
					{
						$preco = "<b>R$ ".number_format($l['preco'], 2,',',' ')."</b>";
					}
				}
				
				//Trata a data da Noticia
				$data_noticia = substr($l['data_tratada'], 0, -4). substr($l['data_tratada'], -2);
				
				
				$lista = array(
				"[url_virtual]" => $url_virtual,
				"[data_noticia]" => $data_noticia,
				"[class_element]" => $class_element,
				"[class]" => "element ".$tag_assunto." ".$l['palavra_chave']." box ".$tipo_col."  ",
				"[span]" => $span,
				"[imagem]" => $img,
				"[nome]" => $l["nome"],
				"[descricao]" => strip_tags($corpo_tratado),
				"[tipo]" => $l["tipo"],
				"[preco]" => $preco,
				"[categoria_id]" => $_REQUEST["_categoria_id"],
				"[id]" => $l["id"],
				"[complemento_id]" => $l["complemento_id"],
				"[url]" => $url_detalhe,
				"[imagem_url]" => $url_virtual."imagens/galeria/".$nome_imagem,
				);
				$resultado .= strtr($conteudo,$lista);
				unset($lista);
				unset($o_ilustra);
				$cont++;
			}//fecha foreach
		}
		else
		{
			//$resultado = $o_ajudante->mensagem(14);
			$resultado = false;
		}//fecha busca por produto
		// PAGINAÇÃO PARTE 2 FIM 

		return $resultado;
		unset($o_produto);
		unset($o_menu_produto);
		unset($o_ajudante);
		unset($o_configuracao);

	}
	
	function monta_lista_enquete()
	{

		$o_pergunta = new Pergunta;
		$o_ajudante = new Ajudante;
		$o_configuracao = new Configuracao;

		$url_virtual = $o_configuracao->url_virtual();
		$url_fisico = $o_configuracao->url_fisico();
		
		//pega o id dono da noticia da pagina correspondentes
		if(isset($this->chamada_usuario) && trim($this->chamada_usuario) != "")
		{
			$o_usuario = new Usuario;
			$o_usuario->set('chamada_usuario', $this->chamada_usuario);
			$o_usuario->set('estado', 'a');
			if($rs_usr = $o_usuario->selecionar())
			{
				foreach($rs_usr as $l_usr)
				{
					$id_usuario = $l_usr['id'];
					$o_produto->set('id_usuario', $id_usuario);
				}
			}
			
		}
		
		$o_pergunta->set('limite', $this->limite);
		$o_pergunta->set('limite_inicio', $this->limite_inicio);
		$o_pergunta->set('id_produto_tipo', 1); //1->Noticias
		$o_pergunta->set('ordenador', $this->ordenador);
		$o_pergunta->set('DESC_ASC', $this->desc_asc);
		if($rs = $o_pergunta->selecionar_enquete_complemento())
		{
			$total_produtos = $rs->rowCount();
			$limite_palabras_p = 10;	// Materia pequena
			$limite_palabras_m = 15;	// Materia mediana
			$limite_palabras_g = 20;	// Materia grande
			$limite_palabras_c = 25;	// Materia completa
			$cont = 0;
			foreach($rs as $l)
			{
		
				$tipo_col = "col4";
				$span = "span_inf_g";
				
				$pergunta_questao = "";
				
				if($l['estado'] == 'a')
				{
					$class_element = "element_pergunta";
					
					
					//Pega as Questoes
					$o_pergunta_questao = new Pergunta_questao;
					$o_pergunta_questao->set('id_pergunta', $l['id']);
					if($rs_pq = $o_pergunta_questao->selecionar())
					{
						$pergunta_questao .= "<ul class=\"enquete_respostas\">";
						foreach($rs_pq as $l_pq)
						{
							//$pergunta_questao .= "<li class=\"pr_".$l['id']." resp_user resp_".$l_pq['id']."\" >".$l_pq['corpo']."</li>";
							$pergunta_questao .= "<li class=\"pr_".$l['id']." resp_user resp_".$l_pq['id']."\" ><input type=\"radio\" name=\"group_".$l['id']."\" id=\"group_".$l['id']."_".$l_pq['id']."\" class=\"regular-radio big-radio\" value=\"".$l_pq['id']."\"> <label for=\"group_".$l['id']."_".$l_pq['id']."\">  </label> <span class=\"tamanhio_span_enq\">".$l_pq['corpo']."</span></li>";
						}
						$pergunta_questao .= "</ul>";
						$pergunta_questao .= "<a href=\"#\" class=\"click_enquete\" data-option-value=\"".$l[id]."\" >Enviar</a>";
					}
					else
					{
						
					}
					$show_div = "";
					$style = "";
				}
				else
				{
					$class_element = "";
					
					$o_pergunta_questao = new Pergunta_questao;
					$o_pergunta_questao->set('id_pergunta', $l['id']);
					if($rs_pq = $o_pergunta_questao->suma_pergunta_enquete())
					{
						
						foreach($rs_pq as $l_pq)
						{
							if($l_pq['suma_votos'] == null)
							{
								$l_pq['quantidade_votos'] = 0;
							}
							//$pergunta_questao .= "<li class=\"pr_".$l['id']." resp_user resp_".$l_pq['id']."\" >".$l_pq['corpo']."</li>";
							$suma_quantidade_votos = $l_pq['suma_votos'];
						}
						
						
					}
					else
					{
						
					}
					
					$o_pergunta_questao = new Pergunta_questao;
					$o_pergunta_questao->set('id_pergunta', $l['id']);
					if($rs_pq = $o_pergunta_questao->selecionar_pergunta_enquete())
					{
						$pergunta_questao .= "<ul class=\"enquete_respostas div_hidden ul_hid_".$l['id']."\">";
						foreach($rs_pq as $l_pq)
						{
							if($l_pq['quantidade_votos'] == null)
							{
								$l_pq['quantidade_votos'] = 0;
							}
							//$pergunta_questao .= "<li class=\"pr_".$l['id']." resp_user resp_".$l_pq['id']."\" >".$l_pq['corpo']."</li>";
							$pergunta_questao .= "<li class=\"pr_".$l['id']." resp_user resp_".$l_pq['id']."\" > <span>".$l_pq['corpo']." - ".$l_pq['quantidade_votos']."</span></li>";
							
							$pergunta_questao .= '<input type="hidden" class="hidden_votos" data-option-value="'.$l_pq['id'].'-'.$suma_quantidade_votos.'" id="" value="'.$l_pq['quantidade_votos'].'" >';
							$barra_porcentagem = $l_pq['quantidade_votos']/$suma_quantidade_votos;
							$pergunta_questao .= "<div class=\"barra_enquete\"><span class='class_p_votos p_votos_".$l_pq['id']."'></span></div>";
						}
						$pergunta_questao .= "</ul>";
						
					}
					else
					{
						//class=\" div_hidden div_hid_".$l['id']."
					}
				
					
					$show_div = '<div class="demo-show2">
		<h3 class="a_enquete" data-option-value="[id]" onclick="javascript: zetas_enquete('.$l['id'].')"><span class="class_ver_r'.$l['id'].' resp_cima"></span></h3>
		</div>';					
					
					
				}			

				//Pega Template
				$conteudo = $o_ajudante->template("".$url_fisico."templates/enquete_destaque.html");
			
				
				//Trata a data da Noticia
				$data_noticia = substr($l['data_tratada'], 0, -4). substr($l['data_tratada'], -2);
				
				
				$lista = array(
				"[url_virtual]" => $url_virtual,
				"[data_noticia]" => $data_noticia,
				"[class_element]" => $class_element,
				"[class]" => "element ".$tag_assunto." ".$l['palavra_chave']." box ".$tipo_col."  ",
				"[span]" => $span,
				"[titulo]" => $l["titulo"],
				"[pergunta_questao]" => $pergunta_questao,
				"[show_div]" => $show_div,
				"[id]" => $l["id"],
				);
				$resultado .= strtr($conteudo,$lista);
				unset($lista);
				unset($o_ilustra);
				$cont++;
			}//fecha foreach
		}
		else
		{
			//$resultado = $o_ajudante->mensagem(14);
			$resultado = false;
		}//fecha busca por produto
		// PAGINAÇÃO PARTE 2 FIM 

		return $resultado;
		unset($o_produto);
		unset($o_menu_produto);
		unset($o_ajudante);
		unset($o_configuracao);

	}
	
	function monta_lista_correspondentes()
	{

		$o_usuario = new Usuario;
		$o_ajudante = new Ajudante;
		$o_configuracao = new Configuracao;

		$url_virtual = $o_configuracao->url_virtual();
		$url_fisico = $o_configuracao->url_fisico();
		
		$o_usuario->set('limite', $this->limite);
		$o_usuario->set('limite_inicio', $this->limite_inicio);
		$o_usuario->set('estado', 'a');
		$o_usuario->set('termo_busca',$this->termo_busca);
		$o_usuario->set('ordenador', $this->ordenador);
		$o_usuario->set('DESC_ASC', $this->desc_asc);
		$o_usuario->set('id_usuario_tipo', 4);
		if($rs = $o_usuario->selecionar_usuario_complemento())
		{
			$total_produtos = $rs->rowCount();
			$limite_palabras_p = 1000;	// Materia pequena
			$limite_palabras_m = 1000;	// Materia mediana
			$limite_palabras_g = 20;	// Materia grande
			$limite_palabras_c = 25;	// Materia completa
			$cont = 0;
			foreach($rs as $l)
			{

				$o_ilustra = new Ilustra;
				$corpo_tratado = "";
			
				if($cont == 0)
				{
					
					if(!isset($this->id_produto_tipo))
					{
						$resultado .= "
							<div class=\"element_contenedor_2_divs_c box col3\">
								
								
								<div class=\"element_destaque col3 box_filtro\">
									<div class=\"element_contenedor_destaque_c\">
										<p class=\"p_destaque\">Seja um canal para mostrar<br/>
										para o mundo tudo que est&aacute;<br/>
										rolando na sua cidade, estado<br/>
										ou &aacute;rea de atua&ccedil;&atilde;o.</p>
										<img class=\"img_rigth\" src=\"".$url_virtual."imagens/site/logo_destaque.png\" width=\"74\" height=\"81\"/>
										<h2 class=\"h_cero\">Seja nosso correspondente!</h2>
										<h3 class=\"h_cero\"><a href=\"#\" onclick=\"fancy_function('".$url_virtual."componentes/popup_formularios.php?acao=correspondentes&subacao=',700,620,'iframe')\">Clique e saiba mais.</a></h3>
										
										
									</div>
									
								</div>
							</div>
						";
					}
				}
				
				$tipo_col = "col3";
				$span = "span_inf_m";
				$largura = 222;
				$corpo = $l['descricao'];
				$corpo_array = explode(" ", $corpo);
				$count_palabras = count($corpo_array);
				$bb = false;
				
				for($i=0;$i<$count_palabras ; $i++)
				{
					
					if(strlen($corpo_tratado) > 90 && !$bb)
					{
						$corpo_tratado .= "...<br/><br/><div class=\" div_hidden div_hid_".$l['id']."\" style=\"display: none;\">";
						$bb = true;
					}
					else
					{}
					$corpo_tratado .= $corpo_array[$i]." ";
				}
				if($bb)
				{
					$corpo_tratado .= "</div>";
				}
				$corpo_tratado = $corpo_tratado;


				//tipo retrato
				//$class_element = "class_element";
				$class_element = "";
				$largura = "100";
				
				
				/* Monta as categorias(tags) nos produtos(materias)*/
				$tag_categoria = "";
				$o_categoria_produto = new Categoria_produto;
				$o_categoria_produto->set('id_produto', $l['id']);
				if($rs_01 = $o_categoria_produto->selecionar_categoria_produto_02())
				{
					foreach($rs_01 as $l_01)
					{
						$data_option_value = $o_ajudante->trata_texto_01($l_01['nome']);
						$tag_categoria .= "".$data_option_value." ";
					}
					$tag_categoria = substr($tag_categoria, 0, -1);
				}
				else
				{
					$tag_categoria = "";
				}
				unset($o_categoria_produto);
				/*Fim tags*/

				$acao_click = "correspondente";
				$link_img = "";
				$nome_imagem = "";
				$img = "";
				
		
				
				//$url_detalhe = $url_virtual."interna/".$l['chamada_categoria']."/".$l['chamada_produto']."";
				$url_chamada_usuario = $url_virtual."noticias/".$l['chamada_usuario'];
								
				$img = "<div class=\"div_retrato_img\">
						<a href=\"".$url_chamada_usuario."\" >
						<img alt=\"".$li["usuario_foto"]."\" src=\"".$url_virtual."imagens/galeria/".$l["usuario_foto"]."\" width=\"110px\" height=\"80px\" /></a>
						</div>";			
				
				//seleciona o nome da imagem
				$o_imagem = new Imagem;
				$o_imagem->set('id_album',$l['id_album']);
				$o_imagem->set('limite',1);
				if($res_imagem = $o_imagem->selecionar())
				{
					foreach($res_imagem as $l_imagem)
					{
						$nome_imagem = $l_imagem['nome'];
					}
				}
				unset($o_imagem);
				//unset($o_ilustra);
			

				//Pega Template
				$conteudo = $o_ajudante->template("".$url_fisico."templates/usuario_destaque.html");
				if($l["preco"] != 0)
				{
					if($l["desconto"] != 0)
					{
						$preco = " 
						De <b class=\"cortado\">R$ ".number_format($l['preco'], 2, ',', ' ')."</b><br />
						Por R$ ".number_format($o_ajudante->desconto($l['preco'],$l["desconto"]), 2,',',' ');
					}
					else
					{
						$preco = "<b>R$ ".number_format($l['preco'], 2,',',' ')."</b>";
					}
				}
				
				
				$lista = array(
				"[id]" => $l['id'],
				"[url_virtual]" => $url_virtual,
				"[class_element]" => $class_element,
				"[class]" => "element ".$tag_assunto." ".$tag_categoria." box ".$tipo_col."  ",
				"[span]" => $span,
				"[imagem]" => $img,
				"[nome]" => $l["nome"],
				"[url_chamada_usuario]" => $url_chamada_usuario,
				"[descricao]" => $corpo_tratado,
				"[tipo]" => $l["tipo"],
				"[preco]" => $preco,
				"[categoria_id]" => $_REQUEST["_categoria_id"],
				"[id]" => $l["id"],
				"[complemento_id]" => $l["complemento_id"],
				"[nome]" => $l["nome"],
				"[url]" => $url_detalhe,
				"[imagem_url]" => $url_virtual."imagens/galeria/".$nome_imagem,
				);
				$resultado .= strtr($conteudo,$lista);
				unset($lista);
				unset($o_ilustra);
				$cont++;
			}//fecha foreach
		}
		else
		{
			//$resultado = $o_ajudante->mensagem(14);
			$resultado = false;
		}//fecha busca por produto
		// PAGINAÇÃO PARTE 2 FIM 

		return $resultado;
		unset($o_usuario);
		unset($o_menu_produto);
		unset($o_ajudante);
		unset($o_configuracao);

	}
	
	function monta_lista_oportunidade()
	{

		$o_produto = new Produto;
		$o_ajudante = new Ajudante;
		$o_configuracao = new Configuracao;

		$url_virtual = $o_configuracao->url_virtual();
		$url_fisico = $o_configuracao->url_fisico();
		
		$o_produto->set('limite', $this->limite);
		$o_produto->set('limite_inicio', $this->limite_inicio);
		$o_produto->set('estado', 'a');
		$o_produto->set('id_produto_tipo', 2); //2->Oportunidade
		$o_produto->set('termo_busca',$this->termo_busca);
		$o_produto->set('ordenador', $this->ordenador);
		$o_produto->set('DESC_ASC', $this->desc_asc);
		if($rs = $o_produto->selecionar_produto_complemento())
		{
			$total_produtos = $rs->rowCount();
			$limite_palabras_p = 10;	// Materia pequena
			$limite_palabras_m = 15;	// Materia mediana
			$limite_palabras_g = 20;	// Materia grande
			$limite_palabras_c = 25;	// Materia completa
			$cont = 0;
			foreach($rs as $l)
			{

				$o_ilustra = new Ilustra;
				$corpo_tratado = "";

				if($cont == 0)
				{
					
					if(!isset($this->id_produto_tipo))
					{
						$resultado .= "
							<div class=\"element_contenedor_2_divs box col2\">
								
								
								<div class=\"element_destaque col2 box_filtro\">
									<div class=\"element_contenedor_destaque\">
										<h3 class=\"h3_padding\">Aqui &eacute; o lugar para quem <br/>
										quer encontrar ou dar<br/>
										uma oportunidade.</h3>
										<img class=\"img_rigth\" src=\"".$url_virtual."imagens/site/logo_destaque.png\" width=\"95\" height=\"104\"/>
										<h2>Toda a sua experi&ecirc;ncia conta.</h2>
										<p>Troque ideias, experi&ecirc;ncias<br/> de trabalho e tudo mais que <br/>voc&ecirc; achar que pode ser bacana <br/>para dividir.</p>
										<h3 class=\"h_cero\"><a href=\"#\" onclick=\"fancy_function('".$url_virtual."componentes/popup_formularios.php?acao=correspondentes&subacao=',700,620,'iframe')\">Ent&atilde;o divida conosco.</a></h3>
									</div>
									
								</div>
							</div>
						";
					}
				}
				
				if($l['estilo'] == 'p')
				{
					$tipo_col = "col2";
					$span = "span_inf_p";
					$largura = 203;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_p)
					{
						for($i=0;$i<$limite_palabras_p ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}
				elseif($l['estilo'] == 'm')
				{
					$tipo_col = "col3";
					$span = "span_inf_m";
					$largura = 222;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_m)
					{
						for($i=0;$i<$limite_palabras_m ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}
				elseif($l['estilo'] == 'g')
				{
					$tipo_col = "col4";
					$span = "span_inf_g";
					$largura = 330;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_g)
					{
						for($i=0;$i<$limite_palabras_g ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}
				
				elseif($l['estilo'] == 'c')
				{
					$tipo_col = "col5";
					$span = "span_inf_c";
					$largura = 455;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_c)
					{
						for($i=0;$i<$limite_palabras_c ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}
				
				elseif($l['estilo'] == 'i')
				{
					$tipo_col = "col6";
					$span = "span_inf_i";
					$largura = 1130;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_c)
					{
						for($i=0;$i<$limite_palabras_c ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}

				if($l['estilo_retrato'] == 'r')
				{
					$class_element = "class_element";
					$largura = "125";
				}
				else
				{
					$class_element = "";
				}
				
				/* Monta as categorias(tags) nos produtos(materias)*/
				$tag_categoria = "";
				$o_categoria_produto = new Categoria_produto;
				$o_categoria_produto->set('id_produto', $l['id']);
				if($rs_01 = $o_categoria_produto->selecionar_categoria_produto_02())
				{
					foreach($rs_01 as $l_01)
					{
						$data_option_value = $o_ajudante->trata_texto_01($l_01['nome']);
						$tag_categoria .= "".$data_option_value." ";
					}
					$tag_categoria = substr($tag_categoria, 0, -1);
				}
				else
				{
					$tag_categoria = "";
				}
				unset($o_categoria_produto);
				/*Fim tags*/

				$acao_click = "5";
				$link_img = "";
				$nome_imagem = "";
				$img = "";
				
				
				//$url_detalhe = $url_virtual."site/materia.php?acao_materia=detalhe&id=".$l['id']."";
				$url_detalhe = $url_virtual."interna/oportunidades/".$l['chamada_produto']."";
				$o_ilustra->set('limite',1);				
								
				if($l["id_album"] == 0 || $l["id_album"] == "")
				{
					$l["id_album"] = 1;
				}
				$o_ilustra->set('album_id',$l["id_album"]);
				$o_ilustra->set('largura',$largura);
				$o_ilustra->set('pasta','produtos');				
				$o_ilustra->set('separador','');				
				$o_ilustra->set('acao_click',$acao_click);
				$o_ilustra->set('url',$url_detalhe);
				$o_ilustra->set('div_ilustra','div_mostra_imagem');				
				$img = $o_ilustra->galeria();				
				
				//seleciona o nome da imagem
				$o_imagem = new Imagem;
				$o_imagem->set('id_album',$l['id_album']);
				$o_imagem->set('limite',1);
				if($res_imagem = $o_imagem->selecionar())
				{
					foreach($res_imagem as $l_imagem)
					{
						$nome_imagem = $l_imagem['nome'];
					}
				}
				unset($o_imagem);
				//unset($o_ilustra);
			

				//Pega Template
				$conteudo = $o_ajudante->template("".$url_fisico."templates/produto_destaque.html");
				if($l["preco"] != 0)
				{
					if($l["desconto"] != 0)
					{
						$preco = " 
						De <b class=\"cortado\">R$ ".number_format($l['preco'], 2, ',', ' ')."</b><br />
						Por R$ ".number_format($o_ajudante->desconto($l['preco'],$l["desconto"]), 2,',',' ');
					}
					else
					{
						$preco = "<b>R$ ".number_format($l['preco'], 2,',',' ')."</b>";
					}
				}
				
				
				$lista = array(
				"[url_virtual]" => $url_virtual,
				"[class_element]" => $class_element,
				"[class]" => "element ".$tag_assunto." ".$tag_categoria." box ".$tipo_col."  ",
				"[span]" => $span,
				"[imagem]" => $img,
				"[nome]" => $l["nome"],
				"[descricao]" => strip_tags($corpo_tratado),
				"[tipo]" => $l["tipo"],
				"[preco]" => $preco,
				"[categoria_id]" => $_REQUEST["_categoria_id"],
				"[id]" => $l["id"],
				"[complemento_id]" => $l["complemento_id"],
				"[nome]" => $l["nome"],
				"[url]" => $url_detalhe,
				"[imagem_url]" => $url_virtual."imagens/galeria/".$nome_imagem,
				);
				$resultado .= strtr($conteudo,$lista);
				unset($lista);
				unset($o_ilustra);
				$cont++;
			}//fecha foreach
		}
		else
		{
			//$resultado = $o_ajudante->mensagem(14);
			$resultado = false;
		}//fecha busca por produto
		// PAGINAÇÃO PARTE 2 FIM 

		return $resultado;
		unset($o_produto);
		unset($o_menu_produto);
		unset($o_ajudante);
		unset($o_configuracao);

	}

	function monta_lista_galeria()
	{

		$o_produto = new Produto;
		$o_ajudante = new Ajudante;
		$o_configuracao = new Configuracao;

		$url_virtual = $o_configuracao->url_virtual();
		$url_fisico = $o_configuracao->url_fisico();
		
		$o_produto->set('limite', $this->limite);
		$o_produto->set('limite_inicio', $this->limite_inicio);
		$o_produto->set('estado', 'a');
		$o_produto->set('id_produto_tipo', 3); //1->Galeria_virtual
		$o_produto->set('termo_busca',$this->termo_busca);
		$o_produto->set('ordenador', $this->ordenador);
		$o_produto->set('DESC_ASC', $this->desc_asc);
		if($rs = $o_produto->selecionar_produto_complemento())
		{
			$total_produtos = $rs->rowCount();
			$limite_palabras_p = 10;	// Materia pequena
			$limite_palabras_m = 15;	// Materia mediana
			$limite_palabras_g = 20;	// Materia grande
			$limite_palabras_c = 25;	// Materia completa
			$cont = 0;
			
			if($this->acesso == "sim")
			{
				$header = "<a href=\"#\" onclick=\"fancy_function('".$url_virtual."componentes/popup_galeria.php',700,675,'iframe')\">";
			}
			else
			{
				$header = "<a href=\"".$url_virtual."login\">";
			}
			
			foreach($rs as $l)
			{
				if($cont == 0)
				{
					$resultado .= '
						<div class="element_contenedor_2_divs box col2">';
					
					
					$resultado .= '
							
							<div id="menu_galeria">
								<ul id="menubv">';
									$o_categoria = new Categoria;
									$o_categoria->set('estado', 'a');
									$o_categoria->set('ordenador', 'ordem');
									if($rs_categoria = $o_categoria->selecionar())
									{
										foreach($rs_categoria as $l_categoria)
										{
											$filtro_categoria = strtolower($o_ajudante->trata_texto_01($l_categoria['nome']));
											$resultado .= '<li><a href="#" class="link_categoria" data-option-value="'.$filtro_categoria.'">'.$l_categoria['nome'].'</a></li>';
										}
									}
													
									$resultado .="
								</ul>
							</div>
						
						
							<div class=\"element_destaque col2 box_filtro\">
								<div class=\"element_contenedor_destaque\">
									<img class=\"img_rigth\" src='".$url_virtual."imagens/site/logo_destaque.png' width=\"95\" height=\"104\"/>
									<p style=\"margin-top: -23px; font-size:12px;\">Aqui &eacute; o lugar certo para <br>
										os jovens criativos <br>
										mostrarem seu talento.</p>
													<p>Fa&ccedil;a parte da Galeria Virtual.</p>
													<h3>".$header."Clique e descubra como.</a></h3>
								</div>
								
							</div>
						</div>
					";
				}

				$o_ilustra = new Ilustra;
				$corpo_tratado = "";

				if($l['estilo'] == 'p')
				{
					$tipo_col = "col2";
					$span = "span_inf_p";
					$largura = 203;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_p)
					{
						for($i=0;$i<$limite_palabras_p ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}
				elseif($l['estilo'] == 'm')
				{
					$tipo_col = "col3";
					$span = "span_inf_m";
					$largura = 222;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_m)
					{
						for($i=0;$i<$limite_palabras_m ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}
				elseif($l['estilo'] == 'g')
				{
					$tipo_col = "col4";
					$span = "span_inf_g";
					$largura = 330;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_g)
					{
						for($i=0;$i<$limite_palabras_g ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}
				
				elseif($l['estilo'] == 'c')
				{
					$tipo_col = "col5";
					$span = "span_inf_c";
					$largura = 455;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_c)
					{
						for($i=0;$i<$limite_palabras_c ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}
				
				elseif($l['estilo'] == 'i')
				{
					$tipo_col = "col6";
					$span = "span_inf_i";
					$largura = 1130;
					$corpo = $l['corpo'];
					$corpo_array = explode(" ", $corpo);
					$count_palabras = count($corpo_array);
					if($count_palabras > $limite_palabras_c)
					{
						for($i=0;$i<$limite_palabras_c ; $i++)
						{
							$corpo_tratado .= $corpo_array[$i]." ";
						}
						$corpo_tratado = $corpo_tratado;
					}
					else
					{
						$corpo_tratado = $corpo;
					}
				}

				if($l['estilo_retrato'] == 'r')
				{
					$class_element = "class_element";
					$largura = "125";
				}
				else
				{
					$class_element = "";
				}
				
				/* Monta as categorias(tags) nos produtos(materias)*/
				$tag_categoria = "";
				$o_categoria_produto = new Categoria_produto;
				$o_categoria_produto->set('id_produto', $l['id']);
				if($rs_01 = $o_categoria_produto->selecionar_categoria_produto_02())
				{
					foreach($rs_01 as $l_01)
					{
						$data_option_value = strtolower($o_ajudante->trata_texto_01($l_01['nome']));
						$tag_categoria .= "".$data_option_value." ";
					}
					$tag_categoria = substr($tag_categoria, 0, -1);
				}
				else
				{
					$tag_categoria = "";
				}
				unset($o_categoria_produto);
				/*Fim tags*/

				$acao_click = "5";
				$link_img = "";
				$nome_imagem = "";
				$img = "";
				
				
				//$url_detalhe = $url_virtual."site/materia.php?acao_materia=detalhe&id=".$l['id']."";
				$url_detalhe = $url_virtual."interna/".$l['chamada_categoria']."/".$l['chamada_produto']."";
				$o_ilustra->set('limite',1);				
								
				if($l["id_album"] == 0 || $l["id_album"] == "")
				{
					$l["id_album"] = 1;
				}
				$o_ilustra->set('album_id',$l["id_album"]);
				$o_ilustra->set('largura',$largura);
				$o_ilustra->set('pasta','produtos');				
				$o_ilustra->set('separador','');				
				$o_ilustra->set('acao_click',$acao_click);
				$o_ilustra->set('url',$url_detalhe);
				$o_ilustra->set('div_ilustra','div_mostra_imagem');				
				$img = $o_ilustra->galeria();				
				
				//seleciona o nome da imagem
				$o_imagem = new Imagem;
				$o_imagem->set('id_album',$l['id_album']);
				$o_imagem->set('limite',1);
				if($res_imagem = $o_imagem->selecionar())
				{
					foreach($res_imagem as $l_imagem)
					{
						$nome_imagem = $l_imagem['nome'];
					}
				}
				unset($o_imagem);
				//unset($o_ilustra);
			

				//Pega Template
				$conteudo = $o_ajudante->template("".$url_fisico."templates/produto_destaque.html");
				if($l["preco"] != 0)
				{
					if($l["desconto"] != 0)
					{
						$preco = " 
						De <b class=\"cortado\">R$ ".number_format($l['preco'], 2, ',', ' ')."</b><br />
						Por R$ ".number_format($o_ajudante->desconto($l['preco'],$l["desconto"]), 2,',',' ');
					}
					else
					{
						$preco = "<b>R$ ".number_format($l['preco'], 2,',',' ')."</b>";
					}
				}
				
				
				$lista = array(
				"[url_virtual]" => $url_virtual,
				"[class_element]" => $class_element,
				"[class]" => "element ".$tag_assunto." ".$tag_categoria." box ".$tipo_col."  ",
				"[span]" => $span,
				"[imagem]" => $img,
				"[nome]" => $l["nome"],
				"[descricao]" => strip_tags($corpo_tratado),
				"[tipo]" => $l["tipo"],
				"[preco]" => $preco,
				"[categoria_id]" => $_REQUEST["_categoria_id"],
				"[id]" => $l["id"],
				"[complemento_id]" => $l["complemento_id"],
				"[nome]" => $l["nome"],
				"[url]" => $url_detalhe,
				"[imagem_url]" => $url_virtual."imagens/galeria/".$nome_imagem,
				);
				$resultado .= strtr($conteudo,$lista);
				unset($lista);
				unset($o_ilustra);
				$cont++;
			}//fecha foreach
		}
		else
		{
			//$resultado = $o_ajudante->mensagem(14);
			$resultado = false;
		}//fecha busca por produto
		// PAGINAÇÃO PARTE 2 FIM 

		return $resultado;
		unset($o_produto);
		unset($o_menu_produto);
		unset($o_ajudante);
		unset($o_configuracao);

	}
	
	function monta_imagem($id_complemento)
	{
		$o_ilustra = new Ilustra;
		$o_produto_complemento = new Produto_complemento;
		$o_produto_complemento->set("id",$id_complemento);
		//$o_produto_complemento->set("estado","a");
		if($rs = $o_produto_complemento->selecionar())
		{
			foreach($rs as $linha)
			{
				if($linha["id_album"] != 0)
				{
					$o_ilustra->set('album_id',$linha["id_album"]);
					$o_ilustra->set('largura','50');
					$o_ilustra->set('altura','50');
					$o_ilustra->set('separador',' ');
					$o_ilustra->set('url','asd.php');
					$o_ilustra->set('acao_click','3');
					$o_ilustra->set('div_ilustra','div_mostra_imagem');
					$o_ilustra->set('limite','1');
					$resultado .= $o_ilustra->galeria()."";
				}
			}
		}
		else
		{
			echo "asd<br>";
		}
		return $resultado;
		unset($o_produto_complemento);
		unset($o_ilustra);
	}
	
	function monta_produto_complemento()
	{
		if($this->id_produto)
		{
			$o_produto_complemento = new Produto_complemento;
			$o_produto_complemento->set('id_produto', $this->id_produto);
			$o_produto_complemento->set('ordenador', 'id asc');
			if($rs = $o_produto_complemento->selecionar())
			{
				$resultado = "";
				$cont = 0;
				$id_img = "";
				foreach($rs as $l)
				{
					if($l["id_imagem"] != "" || $l["id_imagem"] != 0)
					{
						$id_img .= $l['id_imagem'].",";
						$o_ilustra = new Ilustra;
						$o_ilustra->set('album_id',$l["id_album"]);
						$o_ilustra->set('id_imagem',$l["id_imagem"]);
						$o_ilustra->set('largura','80');
						$o_ilustra->set('altura','80');
						$o_ilustra->set('separador',' ');
						$o_ilustra->set('acao_click','8');
						$o_ilustra->set('limite','1');
						$img = $o_ilustra->galeria();
						unset($o_ilustra);
						
						$resultado .= "
								<div class=\"listagem_imagens_form\">
									<a title=\"Eliminar Imagem\" href=\"javascript:ajax_pagina('lista_produto_complemento','excluir', '".$l['id']."', '".$this->id_produto."', '".$l['id_imagem']."', '', '', '', '', '', 'div_ajax_resultado_03', 'ajax_gc_adm', 'false');\"><img src=\"../imagens/site/resp-errada.png\" /></a><br/>
									".$img."<br/>
									<label>Nome:</label>
									<input id=\"cmp_lookbook_".$cont."\" name=\"cmp_lookbook_[]\" type=\"text\" size=\"30\" maxlength=\"50\" value=\"".$l['tipo']."\" />
									<input id=\"cmp_lookbook_id_".$cont."\" name=\"cmp_lookbook_id_[]\" type=\"hidden\" size=\"30\" maxlength=\"50\" value=\"".$l['id']."\" />
								</div>					
						";
						
						$cont++;				
					}
				}
				$id_img = substr($id_img, 0, -1);
				$_SESSION['ids_img_lookbook'] = $id_img;
			}
			unset($o_produto_complemento);
			return $resultado;
		}
		else
		{
			$_SESSION['ids_img_lookbook'] = "";
			return false;
		}
	}
}
?>