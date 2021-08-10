<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentRepository;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=anounce::class, inversedBy="comments")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $anounce;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt=new DateTime();
    }
    /**
     *@ORM\PrePersist
     *@ORM\PreUpdate
     */

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = new \DateTime();

        return $this;
    }

    public function getAnounce(): ?anounce
    {
        return $this->anounce;
    }

    public function setAnounce(?anounce $anounce): self
    {
        $this->anounce = $anounce;

        return $this;
    }

    
}
