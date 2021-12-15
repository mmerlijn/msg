<?php


namespace mmerlijn\msg\src\repo;


class OrderNote
{
    public $id = '';
    public $source_of_comment = '';
    public $comment = "";
    public $comment_type = [];

    public function toArray():array
    {
        return [
            "id"=>$this->id,
            "source_of_comment"=>$this->source_of_comment,
            "comment"=>$this->comment,
        ];
    }
}