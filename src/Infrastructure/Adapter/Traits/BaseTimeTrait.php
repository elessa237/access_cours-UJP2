<?php


namespace App\Infrastructure\Adapter\Traits;


use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Infrastructure\Adapter
 */
trait BaseTimeTrait
{

    /**
     * @ORM\Column(type="datetime_immutable", nullable=false)
     */
    private ?DateTimeImmutable $createdAt = null;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?DateTimeImmutable $updatedAt = null;

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeImmutable $createdAt
     * @return self
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeImmutable $updatedAt
     * @return self
     */
    public function setUpdatedAt(DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}