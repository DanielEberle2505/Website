<?php

namespace App\User;

use App\Core\AbstractModel;

//Klasse, die einen "User" modelliert
class UserModel extends AbstractModel {

    public $id;
    public $name;
    public $password;
    public $userroleid;


}
