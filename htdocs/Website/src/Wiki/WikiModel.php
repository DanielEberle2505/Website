<?php

namespace App\Wiki;

use App\Core\AbstractModel;

//Klasse, die einen "Wikieintrag" modelliert
class WikiModel extends AbstractModel {

    public $id;
    public $title;
    public $content;
}
