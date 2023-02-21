<?php
namespace App\Interfaces;

interface MsgRepositoryInterface
{
    public function getAllMessages();
    public function SendMessage(array $msgDetails);
  

}