<?php
//print_r($_SERVER);
class Configuracao
{
	public function __construct()
	{
		$configuracao = Array();
	}

	public function ftp_server()
	{
		$configuracao["ftp_server"] = "ftp.agenciaguapa.com.br";
		return $configuracao["ftp_server"];
	}

	public function ftp_senha()
	{
		$configuracao["ftp_senha"] = "g1u2a3p4a5199";
		return $configuracao["ftp_senha"];
	}

	public function ftp_usuario()
	{
		$configuracao["ftp_usuario"] = "agenciaguapa";
		return $configuracao["ftp_usuario"];
	}

	public function ftp_endereco()
	{
		$configuracao["ftp_endereco"] = "/httpdocs/clientes/guapa/imagens/";
		return $configuracao["ftp_endereco"];
	}
	
	public function url_fisico()
	{
		//$configuracao["url_fisico"] = $_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'];
		//$configuracao["url_fisico"] = $_SERVER['DOCUMENT_ROOT']."/clientes/guapa/";
		$configuracao["url_fisico"] = $_SERVER['DOCUMENT_ROOT']."/tiggo/";
		//$configuracao["host"] = "mysql.iwi.com.br";
		return $configuracao["url_fisico"];
	}

	public function url_virtual()
	{
		$configuracao["url_virtual"] = "http://".$_SERVER['HTTP_HOST']."/tiggo/";
		//$configuracao["url_virtual"] = "http://".$_SERVER['HTTP_HOST']."/clientes/guapa/";
		return $configuracao["url_virtual"];
	}

	public function host()
	{
		//$configuracao["host"] = "216.70.104.128";
		$configuracao["host"] = "10.0.1.252";
		//$configuracao["host"] = "localhost";
		return $configuracao["host"];
	}

	public function backup_path()
	{
		$configuracao["backup_path"] = $_SERVER['DOCUMENT_ROOT']."/tigo/imagens/backup/";
		return $configuracao["backup_path"];
	}

	public function banco_dados()
	{
		//$configuracao["banco_dados"] = "shopp_garden";
		//$configuracao["banco_dados"] = "hm2_26";
		$configuracao["banco_dados"] = "tigo";
		return $configuracao["banco_dados"];
	}

	public function usuario()
	{
		$configuracao["usuario"] = "root";
		//$configuracao["usuario"] = "guapa";
		return $configuracao["usuario"];
	}

	public function senha()
	{
		$configuracao["senha"] = "";
		//$configuracao["senha"] = "guapa123!";
		return $configuracao["senha"];
	}

	public function prefixo()
	{
		$configuracao["prefixo"] = "tigo";
		return $configuracao["prefixo"];
	}

	public function desenvolvedor()
	{
		$configuracao["desenvolvedor"] = "Kraken Digital";
		return $configuracao["desenvolvedor"];
	}

	public function desenvolvedor_email()
	{
		$configuracao["desenvolvedor_email"] = "alain.camacho@hm2.com.br";
		return $configuracao["desenvolvedor_email"];
	}

	public function desenvolvedor_site()
	{
		$configuracao["desenvolvedor_site"] = "krakendigital.com.br";
		return $configuracao["desenvolvedor_site"];
	}

	public function site_nome()
	{
		$configuracao["site_nome"] = "CHERY TIGO";
		return $configuracao["site_nome"];
	}

	public function email_contato()
	{
		$configuracao["email_contato"] = "leandro.akio@agenciaguapa.com.br";   // email de contato
		//$configuracao["email_contato"] = "ton@agenciaguapa.com.br";   // email de contato
		return $configuracao["email_contato"];
	}
	
	public function email_envio_copia()
	{
		//$configuracao["email_envio_copia"] = "ton@agenciaguapa.com.br,alain.mcf@gmail.com";  
		$configuracao["email_envio_copia"] = "";
		return $configuracao["email_envio_copia"];
	}

	public function site_descricao()
	{
		$configuracao["site_descricao"] = "";
		return $configuracao["site_descricao"];
	}

	public function site_slogan()
	{
		$configuracao["site_slogan"] = "";
		return $configuracao["site_slogan"];
	}

	public function site_palavra_chave()
	{
		$configuracao["site_palavra_chave"] = "ilustracoes ilustracoes desenhos desenhista websites web sites web design grafico grafico design grafico paginas paginas";
		return $configuracao["site_palavra_chave"];
	}

	public function site_titulo()
	{
		$configuracao["site_titulo"] = "Chery Tigo";
		return $configuracao["site_titulo"];
	}

	public function site_autor()
	{
		$configuracao["site_autor"] = "Desenvolvido por Kraken Digital : www.krakendigital.com.br - alain.camacho@hm2.com.br - designer programador : Alain Camacho";
		return $configuracao["site_autor"];
	}
}
?>