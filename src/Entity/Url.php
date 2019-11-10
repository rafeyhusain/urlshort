<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as AcmeAssert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UrlRepository")
 * @ORM\Entity
 * @ORM\Table(name="url")
 */
class Url
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     * @Assert\NotBlank()
     * @AcmeAssert\ContainsUrl
     */
    private $originalUrl;

    /**
     * @ORM\Column(type="string", length=300)
     *
     */
    private $shortenedUrl;

    public function __construct()
    {
        $this->localizationStatistics = new ArrayCollection();
    }


    public function addUrl($link, $shortenedUrl)
    {
        $this
            ->setOriginalUrl($link)
            ->setShortenedUrl($shortenedUrl);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getOriginalUrl(): ?string
    {
        return $this->originalUrl;
    }

    public function setOriginalUrl(string $originalUrl): self
    {
        $this->originalUrl = $originalUrl;

        return $this;
    }

    public function getShortenedUrl(): ?string
    {
        return $this->shortenedUrl;
    }

    public function setShortenedUrl(string $shortenedUrl): self
    {
        $this->shortenedUrl = $shortenedUrl;

        return $this;
    }
}
