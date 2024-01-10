<?php 

namespace App\Models;


class Wiki {
    private $id;
    private $title;
    private $content;
    private $creation_date;
    private $statut;
    private $categorie_id;
    private $image;
    private $user_id;
    private $tags=[];

    public function __construct($image, $title, $content ,$creation_date, $statut, $categorie_id, $user_id) {
        $this->image = $image;
        $this->title = $title;
        $this->content = $content;
        $this->creation_date = $creation_date;
        $this->statut = $statut;
        $this->categorie_id = $categorie_id;
        $this->user_id = $user_id;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getCreationDate() {
        return $this->creation_date;
    }

    public function setCreationDate($creation_date) {
        $this->creation_date = $creation_date;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function setStatus($statut) {
        $this->statut = $statut;
    }

    public function getCategoryId() {
        return $this->categorie_id;
    }

    public function setCategoryId($categorie_id) {
        $this->categorie_id = $categorie_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }
}