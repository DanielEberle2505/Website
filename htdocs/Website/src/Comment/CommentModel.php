<?php


namespace App\Comment;

use App\Core\AbstractModel;

//Klasse, die einen "Wikieintrag" modelliert
class CommentModel extends AbstractModel {

    public $id;
    public $gameid;
    public $comment;
    public $stars;
}
