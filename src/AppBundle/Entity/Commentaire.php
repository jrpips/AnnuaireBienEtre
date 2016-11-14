<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentaireRepository")
 */
class Commentaire {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Internaute", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $internaute;

    /**
     * @ORM\ManyToOne(targetEntity="Prestataire", cascade={"persist"},inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $prestataire;

    /**
     * @var float
     *
     * @ORM\Column(name="cote", type="float", nullable=true)
     */
    private $cote;

    /**
     * @Assert\NotBlank(message="Un titre est requis")
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Le titre du commentaire doit contenir 2 caractères minimun",
     *      maxMessage = "Le titre est trop long, 100 caractères maximun"
     * )
     * @ORM\Column(name="titre", type="string", length=100)
     */
    private $titre;

    /**
     * @Assert\NotBlank(message="Un commentaire est requis")
     * @Assert\Length(
     *      min = 15,
     *      max = 255,
     *      minMessage = "Le commentaire doit contenir 15 caractères minimun",
     *      maxMessage = "Le commentaire est trop long, doit contenir 255 caractères maximun"
     * )
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="encodage", type="date")
     */
    private $encodage;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set cote
     *
     * @param float $cote
     *
     * @return Commentaire
     */
    public function setCote($cote) {
        $this->cote = $cote;

        return $this;
    }

    /**
     * Get cote
     *
     * @return float
     */
    public function getCote() {
        return $this->cote;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Commentaire
     */
    public function setTitre($titre) {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre() {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Commentaire
     */
    public function setContenu($contenu) {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu() {
        return $this->contenu;
    }

    /**
     * Set encodage
     *
     * @param \DateTime $encodage
     *
     * @return Commentaire
     */
    public function setEncodage($encodage) {
        $this->encodage = $encodage;

        return $this;
    }

    /**
     * Get encodage
     *
     * @return \DateTime
     */
    public function getEncodage() {
        return $this->encodage;
    }

    /**
     * Set internaute
     *
     * @param \AppBundle\Entity\Internaute $internaute
     *
     * @return Commentaire
     */
    public function setInternaute(\AppBundle\Entity\Internaute $internaute) {
        $this->internaute = $internaute;

        return $this;
    }

    /**
     * Get internaute
     *
     * @return \AppBundle\Entity\Internaute
     */
    public function getInternaute() {
        return $this->internaute;
    }

    /**
     * Set prestataire
     *
     * @param \AppBundle\Entity\Prestataire $prestataire
     *
     * @return Commentaire
     */
    public function setPrestataire(\AppBundle\Entity\Prestataire $prestataire) {
        $this->prestataire = $prestataire;

        return $this;
    }

    /**
     * Get prestataire
     *
     * @return \AppBundle\Entity\Prestataire
     */
    public function getPrestataire() {
        return $this->prestataire;
    }

}
