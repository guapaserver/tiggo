<?php
header('Content-Type: text/javascript; charset=UTF-8');
require_once("../inc/includes.php");
$o_ajudante = new Ajudante;
$o_configuracao = new Configuracao;
$url_virtual = $o_configuracao->url_virtual(); 
$url_fisico = $o_configuracao->url_fisico(); 

global $data;

if($_REQUEST['tipo_produto'] > 0)
{
	$id_produto_tipo = $_REQUEST['tipo_produto'];

	//Monta os 5 ultimos trabalhos da agencia guapa
	$o_produto = new Produto;
	$o_produto->set('limite', 5);
	$o_produto->set('estado','a');
	$o_produto->set('id_produto_tipo',$id_produto_tipo);
	$o_produto->set('ordenador','ordem');
	if($rs_p = $o_produto->selecionar())
	{
		$sliderbgs = "";
		$empresas_descricao = "";
		$cont = 0;
		$data = array();
		$data_descricao = array();
		foreach($rs_p as $l_p)
		{
			if(file_exists(($url_fisico."imagens/produtos/".$l_p['logo_imagem'])))
			{
				$l_i = getimagesize($url_virtual."imagens/produtos/".$l_p['logo_imagem']);
			}
			
			//$imagem =  "<img width=\"165\" height=\"".$l_i[1]."\" src=\"".$url_virtual."imagens/produtos/".$l_p['logo_imagem']."\" title=\"\" alt=\"\">";
			$imagem =  "<img width=\"".$l_i[0]."px\" height=\"".$l_i[1]."px\" src=\"".$url_virtual."imagens/produtos/".$l_p['logo_imagem']."\" title=\"sdf\" alt=\"sdf\">";
			$img_nome = explode(".",$l_p['nome_imagem']);
			
			$data[] = array(
	            "image" => ''.$url_virtual.'imagens/produtos/'.$l_p['nome_imagem'].'',
	            "title" => '',
	            "thumb" => '',
	            "url" => ''
	        );
			
			/*$data_descricao[] = array(
	            "id" => ''.$l_p['id'].'',
	            "cont" => ''.$cont.'',
	            "imagem" => 'imagens/produtos/'.$l_p['logo_imagem'].'',
	             "height" => ''.$l_i[1].'',
	             "corpo" => ''.$l_p['corpo'].'',
	             "imagem_fundo" => ''.$img_nome[0].'',
	             "ext" => ''.$img_nome[1].'',
	        );*/
			
			/*$lista = array(
				"[id]" => $l_p['id']
				,"[cont]" => $cont
				,"[url_virtual]" => $url_virtual
				,"[imagem]" => $imagem
				,"[corpo]" => $l_p['corpo']
				,"[imagem_fundo]" => $img_nome[0]
				,"[ext]" => $img_nome[1]
			);*/
			
			//$sliderbgs .= "{image : '".$url_virtual."imagens/produtos/".$l_p['nome_imagem']."', title : '',  thumb : '', url : ''},";
			
			
			
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
		
			$template = $o_ajudante->template("../templates/descricao_empresa.html");
			$sliderbgs .= strtr($template,$lista);
			
			//$sliderbgs .= "{image : '".$url_virtual."imagens/produtos/".$l_p['nome_imagem']."', title : '',  thumb : '', url : ''},";
			$cont++;
		}
		
		$data_descricao = $sliderbgs;
		
	}
	else {
		$data_descricao = "";		
	}
}

//echo json_encode($data);
echo json_encode(array(
	'data' => $data,
	'data_descricao' => $data_descricao
));

?>
