<?php

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Pages\Login;

class ChangeNameTest extends TestCase
{
   private $navegador;

   protected function setUp() : void
   {
      $this->navegador = RemoteWebDriver::create('http://localhost:4444', DesiredCapabilities::chrome());
      $this->navegador->get('https://www.dazn.com/pt-BR/account/signin');
      $this->navegador->manage()->window()->maximize();
      $this->navegador->manage()->timeouts()->implicitlyWait(10);
   }

   public static function datasToChangeName()
   {
      $data = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'datas' . DIRECTORY_SEPARATOR . 'changeNames.json');

      return json_decode($data, true);
   }

   /**
    * @dataProvider datasToChangeName
    */
   public function testChangeNameOnDazn($email, $senha, $nome, $sobreNome)
   {
      $login = new Login($this->navegador);
      $nomeCompleto = $login
         ->preencheLogin($email, $senha)
         ->submitLogin()
         ->abreMenu()
         ->clicaEmMinhaConta()
         ->preencheConfirmacaoDetalhes($email, $senha)
         ->submitConfirmacaoDetalhes()
         ->clickEditarNome()
         ->preencheNovoNome($nome, $sobreNome)
         ->confirmNewName()
         ->getNomeCompleto();

      $this->assertEquals($nome . ' ' . $sobreNome, $nomeCompleto);
   }

   protected function tearDown() : void
   {
      $this->navegador->quit();
   }
}