<?php
namespace Pages;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\WebDriverExpectedCondition;

class MyAccount
{
   private $navegador;

   public function __construct($navegador)
   {
      $this->navegador = $navegador;
   }

   public function clickEditarNome()
   {
      $this->navegador
         ->findElement(WebDriverBy::id("j_id0:frmMyAccount:editName"))
         ->click();

      return $this;
   }

   public function preencheNovoNome($nome, $sobreNome)
   {
      $this->navegador
         ->findElement(WebDriverBy::id("j_id0:frmMyAccount:idFirstname"))
         ->clear()
         ->sendKeys($nome);

      $this->navegador
         ->findElement(WebDriverBy::id("j_id0:frmMyAccount:idSurname"))
         ->clear()
         ->sendKeys($sobreNome);

      $this->navegador
         ->findElement(WebDriverBy::id("j_id0:frmMyAccount:idFirstname"))
         ->click();

      return $this;
   }

   public function confirmNewName()
   {
      $wait = new WebDriverWait($this->navegador, 4, 500);
      $wait->until(
         WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id("j_id0:frmMyAccount:SaveName"))
      );

      $this->navegador
         ->findElement(WebDriverBy::id("j_id0:frmMyAccount:SaveName"))
         ->click();

      return $this;
   }

   public function getNomeCompleto()
   {
      return $this->navegador
         ->findElement(WebDriverBy::xpath("//span[@id='j_id0:frmMyAccount:j_id94']/div[2]/div"))->getText();
   }
}