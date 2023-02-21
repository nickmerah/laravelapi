<?php

namespace App\Repositories;

use App\Interfaces\MsgRepositoryInterface;

use App\Models\ContactForm;

class MsgRepository implements MsgRepositoryInterface
{
    public function getAllMessages()
    {
        return ContactForm::all();
    }

    
    public function SendMessage(array $msgDetails)
    {
        return ContactForm::create($msgDetails);
    }

 


}