<?php
//a fazer
$o_produto = new Produto;
$o_produto_tipo = new Produto_tipo;
$o_auditoria = new Auditoria;

echo $o_ajudante->sub_menu_gc("NOVO","msg=5&acao_adm=empresas_adm&acao=nova&layout=form","Empresas");

echo $o_ajudante->mensagem($_REQUEST['msg']);
switch($_REQUEST['acao'])
{
	case 'nova':
		$o_ajudante->barrado(222);
		$acao = "inserido";

	break;

	case 'inserido':
		

		$o_ajudante->barrado(222);

		if(!isset($_REQUEST['_ordem']))
		{
			$_REQUEST['_ordem'] = 'z';
		}
		
		$palavra_chave = $o_ajudante->trata_texto_03($_REQUEST['_url_video']);
		
		if(isset($_REQUEST['_url_video']) && trim($_REQUEST['_url_video']) != "")
		{
			$_REQUEST['_url_video'] = trim($_REQUEST['_url_video']);

			if (preg_match("/.*v=/", $_REQUEST['_url_video'])) 
			{
				$url_video = preg_replace('/.*v=(.*)(&.*)?/','$1',$_REQUEST['_url_video']);
			}
			elseif(preg_match("/.*youtu.be/",$_REQUEST['_url_video']))
			{
				$url_video = preg_replace('/.*youtu.be\/(.*)?/','$1',$_REQUEST['_url_video']);

			}elseif(preg_match('/.*<iframe/',$_REQUEST['_url_video']))
			{
				//echo $url_video = preg_replace('/.*embed\/(.*)(=\".*)?/','$1',$_REQUEST['_url_video']);
				$url_video = preg_replace("/.*embed\/(.*)(\" fr.*)?/",'$1',$_REQUEST['_url_video']);
				//substr($id_area, 0, -1)
				$url_video = substr($url_video, 0, -43);
			}
			else
			{
				$url_video = "";
			}
		
		}
		else
		{
			$url_video = "";
		}
		
		$o_produto->set('nome',$_REQUEST['_nome']);
		$o_produto->set('url',$_REQUEST['_url']);
		$o_produto->set('nome_imagem',$_REQUEST['_nome_imagem']);
		$o_produto->set('nome_imagem_blur',$_REQUEST['_nome_imagem_blur']);
		$o_produto->set('logo_imagem',$_REQUEST['_logo_imagem']);
		$o_produto->set('logo_imagem_02',$_REQUEST['_logo_imagem_02']);
		$o_produto->set('corpo',trim($_REQUEST['_corpo']));
		$o_produto->set('data',date("Y-m-d H:i:s"));
		$o_produto->set('estilo',$_REQUEST['_estilo']);
		$o_produto->set('estilo_retrato',$_REQUEST['_estilo_retrato']);
		$o_produto->set('estado',$_REQUEST['_estado']);
		$o_produto->set('ordem', $_REQUEST['_ordem']);
		$o_produto->set('id_album',$_REQUEST['_id_album']);
		$o_produto->set('url_video',$url_video);
		$o_produto->set('id_produto_tipo', $_REQUEST['_id_produto_tipo']);
		$o_produto->set('palavra_chave', $palavra_chave);
		$o_produto->set('id_usuario', $_SESSION['usuario_numero']);
		$chamada_nome = $o_ajudante->trata_texto_01_url_amigavel($_REQUEST['_nome']);
		$chamada_nome = strtolower($chamada_nome);
		$o_produto->set('chamada_produto', str_replace(" ", "_", $chamada_nome));
		
		if($o_produto->inserir())
		{
			if($rs = $o_produto->selecionar())
			{
				foreach($rs as $l)
				{
					$id_produto = $l["id"];
				}
				
				$o_auditoria->set('acao_descricao',"Inserï¿½ï¿½o de uma nova materia: ".$_REQUEST["_nome"].".");
				if($o_auditoria->inserir())
				{}else
				{
					die("Erro ao tentar inserir um registro na categoria");
				}

				header("Location: ".$_SERVER['PHP_SELF']."?msg=5&acao_adm=empresas_adm&layout=lista");
			}
			else
			{
				die ("Error ao tentar selecionar a materia criada");
			}
		}
		else
		{
			die ("Error ao tentar inserir o produto");
		}
		ob_end_flush();
	break;

	case 'editar':
		$o_ajudante->barrado(222);
		$acao = "editado";

		$o_produto->set('id',$_REQUEST['_id']);
		$o_produto->set('tipo_produto','m');
		$o_produto->set('limite',1);
		if($rs = $o_produto->selecionar())
		{
			foreach($rs as $l)
			{
				?>
				<script language="javascript">
					$(window).load(function() {
						//ajaxHTML('div_ajax_resultado','../inc/busca_ajax.php?combo=1&quero=&tipo=lista_imagens&parametro=<?=$l['id_album']?>&div=div_ajax_resultado');
						$("#div_ajax_resultado").html("<img src=\"../imagens/galeria_thumbnail/<?=$l['nome_imagem']?>\" width=\"100\" />");
						$("#div_ajax_resultado_01").html("<img src=\"../imagens/galeria_thumbnail/<?=$l['logo_imagem']?>\" width=\"100\" />");
						$("#div_ajax_resultado_02").html("<img src=\"../imagens/galeria_thumbnail/<?=$l['logo_imagem_02']?>\" width=\"100\" />");
						$("#div_ajax_resultado4").html("<img src=\"../imagens/galeria_thumbnail/<?=$l['nome_imagem_blur']?>\" width=\"100\" />");
					});
				</script>
				<?php
			}
			
			if(trim($l['url_video']) != "")
			{
				$l['url_video'] = "http://www.youtube.com/watch?v=".$l['url_video'];
			}
			
			
		}
		else
		{
			die("Erro ao tentar selecionar produto selecionar_produto_complemento_02 ");
		}
	break;


	case 'editado':
		
		$o_ajudante->barrado(222);
		$id_produto = $_REQUEST['_id'];

		if(!isset($_REQUEST['_ordem']))
		{
			$_REQUEST['_ordem'] = 'z';
		}
		
		$palavra_chave = $o_ajudante->trata_texto_03($_REQUEST['_url_video']);
		
		if(isset($_REQUEST['_url_video']) && trim($_REQUEST['_url_video']) != "")
		{
			$_REQUEST['_url_video'] = trim($_REQUEST['_url_video']);

			if (preg_match("/.*v=/", $_REQUEST['_url_video'])) 
			{
				$url_video = preg_replace('/.*v=(.*)(&.*)?/','$1',$_REQUEST['_url_video']);
			}
			elseif(preg_match("/.*youtu.be/",$_REQUEST['_url_video']))
			{
				$url_video = preg_replace('/.*youtu.be\/(.*)?/','$1',$_REQUEST['_url_video']);

			}elseif(preg_match('/.*<iframe/',$_REQUEST['_url_video']))
			{
				//echo $url_video = preg_replace('/.*embed\/(.*)(=\".*)?/','$1',$_REQUEST['_url_video']);
				$url_video = preg_replace("/.*embed\/(.*)(\" fr.*)?/",'$1',$_REQUEST['_url_video']);
				//substr($id_area, 0, -1)
				$url_video = substr($url_video, 0, -43);
			}
			else
			{
				$url_video = "";
			}
		
		}
		else
		{
			$url_video = "";
		}
		
		$o_produto->set('nome',$_REQUEST['_nome']);
		$o_produto->set('url',$_REQUEST['_url']);
		$o_produto->set('nome_imagem',$_REQUEST['_nome_imagem']);
		$o_produto->set('nome_imagem_blur',$_REQUEST['_nome_imagem_blur']);
		$o_produto->set('logo_imagem',$_REQUEST['_logo_imagem']);
		$o_produto->set('logo_imagem_02',$_REQUEST['_logo_imagem_02']);
		$o_produto->set('corpo',trim($_REQUEST['_corpo']));
		$o_produto->set('data',date("Y-m-d H:i:s"));
		$o_produto->set('estado',$_REQUEST['_estado']);
		$o_produto->set('estilo',$_REQUEST['_estilo']);
		$o_produto->set('estilo_retrato',$_REQUEST['_estilo_retrato']);
		
		$o_produto->set('ordem', $_REQUEST['_ordem']);
		$o_produto->set('id_album',$_REQUEST['_id_album']);
		$o_produto->set('url_video',$url_video);
		$o_produto->set('id',$_REQUEST['_id']);
		$o_produto->set('id_produto_tipo', $_REQUEST['_id_produto_tipo']);
		$o_produto->set('id_usuario', $_SESSION['usuario_numero']);
		$o_produto->set('palavra_chave', $palavra_chave);
		$chamada_nome = $o_ajudante->trata_texto_01_url_amigavel($_REQUEST['_nome']);
		$chamada_nome = strtolower($chamada_nome);
		$o_produto->set('chamada_produto', str_replace(" ", "_", $chamada_nome));
		
		if($rs = $o_produto->editar())
		{

			$o_auditoria->set('acao_descricao',"Ediï¿½ï¿½o da matï¿½ria: ".$_REQUEST["_nome"].".");
			$o_auditoria->inserir();

			header("Location: index.php?acao_adm=empresas_adm&layout=lista&msg=1");
		}
		else
		{
			die("Erro ao tentar editar matï¿½ria");
		}
	break;

	case 'excluir':
		$o_ajudante->barrado(222);
		$o_produto->set('id',$_REQUEST['_id']);
		if($rs = $o_produto->selecionar())
		{
			foreach($rs as $l)
			{
				if($l['id_album'] > 0)
				{
					$o_imagem = new Imagem;
					$o_imagem->set('id_album', $l['id_album']);
					if($rs_img = $o_imagem->selecionar())
					{
						foreach($rs_img as $l_img)
						{
							if(file_exists("../imagens/produtos/".$l_img["nome"]))
							{
								unlink("../imagens/produtos/".$l_img['nome']);
							}
							
							$o_imagem->set('id', $l_img['id']);
							if($rs_i = $o_imagem->selecionar())
							{
								foreach($rs_i as $l_i)
								{
								}
							}
							$o_imagem->excluir();
						}
					}
					unset($o_imagem);
				}

				$rs = $o_produto->excluir();

				$o_auditoria->set('acao_descricao',"Exclusï¿½o da Matï¿½ria: ".$_REQUEST['_id'].".");
				$o_auditoria->inserir();
				header("Location: index.php?acao_adm=empresas_adm&msg=8&layout=lista");
			}
		}
		else
		{
			die("Erro ao tentar excluir Matï¿½ria.");
		}
	break;

	default:
	break;
}


switch($_REQUEST['layout'])
{
	case 'form': 
		?>
		<form name="form" class="formularios" action="<?=$_SERVER['PHP_SELF']?>" method="post">

		<strong>Empresa</strong>
		<input name="_nome" id="_nome" type="text" value="<?=$l["nome"]?>" size="50" maxlength="150" tabindex="1" onblur="javascript:valida_nome(this.value, '<?=$l['nome']?>', 'produto');">
		<span class="requerido">*</span>
		<?php echo $o_ajudante->ajuda("Inserir nome desejado para a Materia. Ex.: campeonatos, festas, produtos, etc. Mï¿½ximo 100 caracteres.");?>
		<div id="div_valida"></div>
		<hr>

		<strong>Descrição</strong>
		<textarea name="_corpo" id="_corpo"  cols="80" rows="6" tabindex="2"><?=$l["corpo"]?></textarea>
		<br/><br/>
		<hr>
		
		<strong>URL do Site</strong>
		<input name="_url" id="_url" type="text" value="<?=$l["url"]?>" size="50" maxlength="150" tabindex="3">
		<?php echo $o_ajudante->ajuda("Inserir url do site da Empresa.");?>
		<hr>
		
		<strong>URL vídeo Youtube</strong>
		<textarea name="_url_video" id="_url_video" cols="80" rows="2" tabindex="4"><?=$l["url_video"]?></textarea>
		<?php echo $o_ajudante->ajuda("Inserir url do vÃ­deo desejado de YouTube para a MatÃ©ria. Ex.: http://www.youtube.com/watch?v=YBwuoIO2NNk.");?>
		<hr>
			
		<strong>Ordem:</strong>
		<?php 
		$array = array ("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l",);
		echo $o_ajudante->drop_varios($array, "_ordem", $l['ordem'], "", "", "");
		echo $o_ajudante->ajuda("Selecione a ordem da empresa.");
		?>
		<hr>
		
		<strong>Imagem Logo</strong>
		<input name="_logo_imagem" id="_logo_imagem" type="text" value="<?=$l["logo_imagem"]?>" readonly size="50" maxlength="150" tabindex="5" />
		
		<div id="div_carrega_imagem">
			
			<br /><strong></strong>
			<div id="file-uploader-demo2">
				<noscript>
					<input tabindex="6"  name="_arquivo" id="_arquivo" type="file">
					<input type="file" name="img[]" class="multi" accept="jpeg|jpg|png|gif" />
					<input type="submit" name="upload" value="Upload" />
				</noscript>
			</div>
			
			<hr class="hr_invisible">
		</div>

		<strong></strong>
		<div id="div_ajax_resultado_01"></div>
		<hr>
		
		<script language="javascript">
				$(window).load(function() {
					createUploader_onlyone('_logo_imagem','file-uploader-demo2','div_ajax_resultado_01');
				});
		</script> 
		
		<strong>Imagem Logo pro Video</strong>
		<input name="_logo_imagem_02" id="_logo_imagem_02" type="text" value="<?=$l["logo_imagem_02"]?>" readonly size="50" maxlength="150" tabindex="6" />
		
		<div id="div_carrega_imagem">
			
			<br /><strong></strong>
			<div id="file-uploader-demo3">
				<noscript>
					<input tabindex="6"  name="_arquivo" id="_arquivo" type="file">
					<input type="file" name="img[]" class="multi" accept="jpeg|jpg|png|gif" />
					<input type="submit" name="upload" value="Upload" />
				</noscript>
			</div>
			
			<hr class="hr_invisible">
		</div>

		<strong></strong>
		<div id="div_ajax_resultado_02"></div>
		<hr>
		
		<script language="javascript">
				$(window).load(function() {
					createUploader_onlyone('_logo_imagem_02','file-uploader-demo3','div_ajax_resultado_02');
				});
		</script> 
		
		<strong>Imagem BG</strong>
		<input name="_nome_imagem" id="_nome_imagem" type="text" value="<?=$l["nome_imagem"]?>" readonly size="50" maxlength="150" tabindex="7" />
		
		<div id="div_carrega_imagem">
			<br /><strong></strong>
			<div id="file-uploader-demo1">
				<noscript>
					<input tabindex="6"  name="_arquivo" id="_arquivo" type="file">
					<input type="file" name="img[]" class="multi" accept="jpeg|jpg|png|gif" />
					<input type="submit" name="upload" value="Upload" />
				</noscript>
			</div>
			<hr class="hr_invisible">
		</div>

		<strong></strong>
		<div id="div_ajax_resultado"></div>
		<hr>
		
		<script language="javascript">
				$(window).load(function() {
					createUploader_onlyone('_nome_imagem','file-uploader-demo1','div_ajax_resultado');
				});
		</script> 

		<strong>Imagem BG BLUR</strong>
		<input name="_nome_imagem_blur" id="_nome_imagem_blur" type="text" value="<?=$l["nome_imagem_blur"]?>" readonly size="50" maxlength="150" tabindex="7" />
		
		<div id="div_carrega_imagem">
			<br /><strong></strong>
			<div id="file-uploader-demo4">
				<noscript>
					<input tabindex="6"  name="_arquivo" id="_arquivo" type="file">
					<input type="file" name="img[]" class="multi" accept="jpeg|jpg|png|gif" />
					<input type="submit" name="upload" value="Upload" />
				</noscript>
			</div>
			<hr class="hr_invisible">
		</div>

		<strong></strong>
		<div id="div_ajax_resultado4"></div>
		<hr>
		
		<script language="javascript">
				$(window).load(function() {
					createUploader_onlyone('_nome_imagem_blur','file-uploader-demo4','div_ajax_resultado4');
				});
		</script> 



		<strong>Materia Tipo</strong>
		<input type="radio"  value="1" <?php if ($l["id_produto_tipo"] == "1") echo "checked";?> name="_id_produto_tipo" tabindex="13"> Cases 
		<input type="radio"  value="2" <?php if ($l["id_produto_tipo"] == "2") echo "checked";?> name="_id_produto_tipo" tabindex="14"> A Guapa 
		<span class="requerido">*</span>
		<hr>
		
		<strong>Estado</strong>
		<input type="radio"  value="a" <?php if ($l["estado"] == "a") echo "checked";?> name="_estado" tabindex="15"> on-line 
		<input type="radio"  value="i" <?php if ($l["estado"] == "i") echo "checked";?> name="_estado" tabindex="16"> off-line 
		<span class="requerido">*</span>
		<?php echo $o_ajudante->ajuda("Escolha se esta Materia estï¿½ disponï¿½vel.");?>
		<hr>

		<strong> </strong>
		<input name="image" type="image"  onClick="return checa_campos('produto_empresas');"  alt="Salvar alteraï¿½ï¿½es" src="../imagens/gc/btn_cadastrar.png">
		<?php
		if($acao != "inserido")
		{
			?>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:document.form.reset();"><img src="../imagens/gc/btn_cancelar.png" border="0"></a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:confirma('index.php?msg=6&_id=<?=$l["id"]?>&acao=excluir&acao_adm=empresas_adm','<?=$l["nome"]?>')"><img src="../imagens/gc/btn_excluir.png" border="0"></a>
			<?php
		}
		?>

		<input type="hidden" name="acao" value="<?=$acao?>">
		<input type="hidden" name="id_album_" value="<?=$_REQUEST['id_album']?>">
		<input type="hidden" name="acao_adm" value="empresas_adm">
		<input type="hidden" name="_id" value="<?=$l["id"]?>">
		</form>
		<?php
	break;

	case 'lista':
			?>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th><b>EMPRESA</b></th>
						<th><b>IMAGEM</b></th>
						<th><b>AMBIENTE</b></th>
						<th><b>ORDEM</b></th>
						<th><b>ESTADO</b></th>
						
						<th><b>EDITAR</b></th>
						<th><b>EXCLUIR</b></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><b>EMPRESA</b></th>
						<th><b>IMAGEM</b></th>
						<th><b>AMBIENTE</b></th>
						<th><b>ORDEM</b></th>
						<th><b>ESTADO</b></th>
						
						<th><b>EDITAR</b></th>
						<th><b>EXCLUIR</b></th>
					</tr>
				</tfoot>
				<tbody>
					<?php 
					$o_produto = new Produto;
					$o_produto->set('ordenador',"nome");
					if($rs = $o_produto->selecionar())
					{
						foreach($rs as $l)
						{
							$o_ilustra = new Ilustra;
							$o_ilustra->set('album_id',$l['id_album']);
							$o_ilustra->set('largura','40');
							$o_ilustra->set('altura','40');
							$o_ilustra->set('limite','1');
							$o_ilustra->set('pasta','produtos');
							$o_ilustra->set('acao_click', '1');
							$o_ilustra->set('separador',' ');
							$imagem = $o_ilustra->galeria();

							if($l["estado"] == "i"){$l["estado"] = "off-line";}else{$l["estado"] = "on-line";}
							if($l["na_home"] == "s"){$l["na_home"] = "sim";}else{$l["na_home"] = "nï¿½o";}
							
							echo "<tr>";
							echo "<td>".$l['nome']."</td>";
							
							echo "<td align=\"center\"><img src=\"".$url_virtual."imagens/galeria_thumbnail/".$l['nome_imagem']."\" width=\"80\"/></td>";
							echo "<td>".$l['nome_tipo_produto']."</td>";
							echo "<td align=\"center\">".$l['ordem']."</td>";
							echo "<td align=\"center\">".$l['estado']."</td>";
							
							echo "<td align=\"center\"><a href='index.php?msg=3&_id=".$l["id"]."&acao=editar&layout=form&acao_adm=".$_REQUEST["acao_adm"]."'><img src=\"../imagens/gc/edit.png\" title=\"editar\" /></a></td>";							
							echo "<td align=\"center\"><a href=javascript:confirma('index.php?_id=".$l["id"]."&acao=excluir&acao_adm=".$_REQUEST["acao_adm"]."','".str_replace(' ', '_', $l["nome"])."');><img src=\"../imagens/gc/cancel.png\" title=\"excluir\" /></a></td>";
							
							echo "</tr>";
							unset($o_ilustra);
						}
					}
					unset($o_produto);
					?>
				</tbody>
			</table>
			<br/><br/><br/>
			<?php
	break;

	default:
	break;
}
unset($o_produto);
unset($o_usuario_produto);
unset($o_categoria_produto);
?>