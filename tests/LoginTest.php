<?php

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Pages\Login;

class LoginTest extends TestCase
{
   private $navegador;

   protected function setUp() : void
   {
      $this->navegador = RemoteWebDriver::create('http://localhost:4444', DesiredCapabilities::chrome());
      $this->navegador->get('https://www.dazn.com/pt-BR/account/signin');
      $this->navegador->manage()->window()->maximize();
      $this->navegador->manage()->timeouts()->implicitlyWait(5);
   }

   public static function datasToLogin()
   {
      $data = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'datas' . DIRECTORY_SEPARATOR . 'login.json');

      return json_decode($data, true);
   }

   /**
    * @dataProvider datasToLogin
    */
   public function testSignInOnDazn($email, $senha)
   {
      $login = new Login($this->navegador);
      $login
         ->preencheLogin($email, $senha)
         ->submitLogin()
         ->abreMenu()
         ->setMensagemConfirmacaoLogin();

      $this->assertEquals('Política de privacidade', $login->getMensagemConfirmacaoLogin());
   }

   protected function tearDown() : void
   {
      $this->navegador->quit();
   }
}