<?php

include ("../inc/includes.php");

$o_configuracao = new Configuracao;
$url_virtual = $o_configuracao->url_virtual();
$url_fisico = $o_configuracao->url_fisico();

$o_produto = new Produto;

$id_produto = $_REQUEST['id_produto'];

if($id_produto > 0)
{
	$o_produto->set('id', $id_produto);
	if($rs = $o_produto->selecionar())
	{
		foreach($rs as $l_p)
		{
			$imagem = "";
			
			if(trim($l_p["logo_imagem_02"]) != "")
			{
				if(file_exists($url_fisico."imagens/produtos/".$l_p["logo_imagem_02"]))
				{

					$l_i = getimagesize($url_virtual."imagens/produtos/".$l_p['logo_imagem_02']);
				
					$imagem =  "<img width=\"".$l_i[0]."\" height=\"".$l_i[1]."\" src=\"".$url_virtual."imagens/produtos/".$l_p['logo_imagem_02']."\" title=\"\" alt=\"\">";
				}
			}
			elseif(trim($l_p["logo_imagem"]) != "")
			{
				if(file_exists($url_virtual."imagens/produtos/".$l_p["logo_imagem"]))
				{
					$l_i = getimagesize($url_virtual."imagens/produtos/".$l_p['logo_imagem']);
				
					$imagem =  "<img width=\"".$l_i[0]."\" height=\"".$l_i[1]."\" src=\"".$url_virtual."imagens/produtos/".$l_p['logo_imagem']."\" title=\"\" alt=\"\" />";
				}
			}
			else {
				$imagem =  "";
			}
		
			$corpo = $l_p['corpo'];
			
			if(trim($l_p['url']) != "")
			{
				$ver_site = "<a href=\"".$l_p['url']."\" target=\"_blank\"><img src='".$url_virtual."imagens/site/guapa_conheca_projeto.png'></a>";
			}
			else
			{
				$ver_site = "";			
			}
			
			if(trim($l_p['url_video']) != "")
			{
				$video = $l_p['url_video'];
			}
			else
			{
				$video = false;			
			}
		}
		
	}
	
	?>
	
	<link href="<?=$url_virtual?>inc/css/formatacao_popup.css" rel="stylesheet" type="text/css" />
	
	<div id="conteudo_popup">
		
		<?=$imagem?>
		
		<div class="conteudo_popup_interno">
			PROJETO:<br>
			<?=$corpo?>
		</div>
		
		<!--<hr class="hr_custom">-->
		
		<?=$ver_site?>
		
	</div>
	<?php
	 	if($video)
		{
	?>
	<iframe width="603" height="404" src="http://www.youtube.com/embed/<?=$video?>" frameborder="0" allowfullscreen style="margin-left: 2px; margin-top: 65px;float:left;"></iframe>
<?php
	 	}
}
?>
