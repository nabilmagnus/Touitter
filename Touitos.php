<?php
/**
 * Created by PhpStorm.
 * User: nabil
 * Date: 28/04/16
 * Time: 12:06
 */
class Touitos
{
    protected $id;
    protected $pseudonyme;
    protected $email;
    protected $motPasse;
    protected $statut;
    protected $photo;

    /**
     * Touitos constructor.
     * @param $id
     * @param $pseudonyme
     * @param $email
     * @param $motPasse
     * @param $statut
     * @param $photo
     */
    public function __construct($id, $pseudonyme, $email, $motPasse, $statut, $photo)
    {
        $this->id = $id;
        $this->pseudonyme = $pseudonyme;
        $this->email = $email;
        $this->motPasse = $motPasse;
        $this->statut = $statut;
        $this->photo = $photo;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    
    public function getpseudonyme()
    {
        return $this->pseudonyme;
    }

    public function setPseudonyme($pseudonyme)
    {
        $this->pseudonyme = $pseudonyme;
    }

    public function getMotPasse()
    {
        return $this->motPasse;
    }

    public function setMotPasse($motPasse)
    {
        $this->motPasse = $motPasse;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     *
     */
    public function photo()
    {
          $this->actif=true;
    }


}

?>

