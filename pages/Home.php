<?php
namespace Pages;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\WebDriverExpectedCondition;

class Home
{
	private $navegador;
	private $mensagemConfirmacaoLogin;

	public function __construct($navegador)
	{
		$this->navegador = $navegador;
	}

	public function abreMenu()
	{
		$wait = new WebDriverWait($this->navegador, 4, 500);
		$wait->until(
			WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//button[@data-test-id='NAVIGATION_SEARCH_ICON_OPEN']"))
		);

		$this->navegador
			->findElement(WebDriverBy::xpath("//ul[@class='header-nav___right-nav___3eW6Q']/li/button[@data-test-id='HEADER_NAVIGATION_ITEM_LINK']"))
			->click();

		return $this;
	}

	public function setMensagemConfirmacaoLogin()
	{
		$this->mensagemConfirmacaoLogin = $this->navegador
			->findElement(WebDriverBy::xpath("//a[@title='Política de privacidade']"))
			->getText();
	}

	public function getMensagemConfirmacaoLogin()
	{
		return $this->mensagemConfirmacaoLogin;
	}

	public function clicaEmMinhaConta()
	{
		return new \Pages\MyLogin($this->navegador);
	}
}