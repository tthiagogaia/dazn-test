<?php
namespace Pages;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\WebDriverExpectedCondition;

class MyLogin
{
   private $navegador;

   public function __construct($navegador)
   {
      $this->navegador = $navegador;

      $this->navegador
         ->findElement(WebDriverBy::xpath("//a[@title='Minha conta']"))
         ->click();
   }

   public function preencheConfirmacaoDetalhes($email, $senha)
   {
      $this->navegador
         ->findElement(WebDriverBy::id("j_id0:fMylogin:idemail121"))
         ->sendKeys($email);

      $this->navegador
         ->findElement(WebDriverBy::id("idEmailPwd"))
         ->sendKeys($senha);

      return $this;
   }

   public function submitConfirmacaoDetalhes()
   {
      $this->navegador
         ->findElement(WebDriverBy::id("j_id0:fMylogin:btnLogin"))
         ->click();

      return new \Pages\MyAccount($this->navegador);
   }
}