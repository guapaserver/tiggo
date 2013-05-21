<?php
switch($_REQUEST["acao_adm"])
{
	case 'album_adm':
		require("modulos/album_adm.php");
	break;

	case 'ambiente_adm':
		require("modulos/ambiente_adm.php");
	break;

	case 'auditoria':
		require("modulos/auditoria.php");
	break;

	case 'backup_adm':
		require("modulos/backup_adm.php");
	break;

	case 'email_adm':
		require("modulos/email_adm.php");
	break;

	case 'imagem_adm':
		require("modulos/imagem_adm.php");
	break;

	case 'mensagem_adm':
		require("modulos/mensagem_adm.php");
	break;

	case 'senha_adm':
		require("modulos/senha_adm.php");
	break;
	
	case 'apoiadores_adm':
		require("modulos/apoiadores_adm.php");
	break;

	case 'usuario_adm':
		require("modulos/usuario_adm.php");
	break;

	case 'usuario_ambiente_adm':
		require("modulos/usuario_ambiente_adm.php");
	break;

	case 'usuario_tipo_adm':
		require("modulos/usuario_tipo_adm.php");
	break;
	
	case 'menu_site_adm':
		require("modulos/menu_site_adm.php");
	break;
	
	case 'categoria_adm':
		require("modulos/categoria_adm.php");
	break;
	
	case 'noticias_adm':
		require("modulos/noticias_adm.php");
	break;
	
	case 'empresas_adm':
		require("modulos/empresas_adm.php");
	break;
	
	case 'oportunidade_adm':
		require("modulos/oportunidade_adm.php");
	break;
	
	case 'galeria_virtual_adm':
		require("modulos/galeria_virtual_adm.php");
	break;
	
	case 'enquete_adm':
		require("modulos/enquete_adm.php");
	break;
	
	case 'pagina_adm':
		require("modulos/pagina_adm.php");
	break;
	
	case 'empresa_adm':
		require("modulos/empresa_adm.php");
	break;
	
	case 'layout_adm':
		require("modulos/layout_adm.php");
	break;
	
	case 'home_adm':
		require("modulos/home_adm.php");
	break;
	
	case 'sair':
		header("Location: login.php?acao_logar=sair");
	break;

	default:
		require("home.php");
	break;
}
?>