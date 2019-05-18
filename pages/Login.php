<?php
namespace Pages;

use Pages\Home;
use Facebook\WebDriver\WebDriverBy;

class Login
{
   private $navegador;
   private $home;

   public function __construct($navegador)
   {
      $this->navegador = $navegador;
   }

   public function preencheLogin($email, $senha)
   {
      $this->navegador
         ->findElement(WebDriverBy::id('signInEmail'))
         ->sendKeys($email);

      $this->navegador
         ->findElement(WebDriverBy::id('signInPassword'))
         ->sendKeys($senha);

      return $this;
   }

   public function submitLogin()
   {
      $this->navegador
         ->findElement(WebDriverBy::cssSelector('.ButtonBase, .SubmitButton'))
         ->click();

      $this->home = new Home($this->navegador);

      return $this->home;
   }

   public function getMensagemConfirmacaoLogin()
   {
      return $this->home->getMensagemConfirmacaoLogin();
   }
}