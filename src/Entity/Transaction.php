<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?bool $is_in = null;

    #[ORM\Column(nullable: true)]
    private ?int $vat = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $unit_price = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $transaction_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function isIsIn(): ?bool
    {
        return $this->is_in;
    }

    public function setIsIn(bool $is_in): static
    {
        $this->is_in = $is_in;

        return $this;
    }

    public function getVat(): ?int
    {
        return $this->vat;
    }

    public function setVat(?int $vat): static
    {
        $this->vat = $vat;

        return $this;
    }

    public function getUnitPrice(): ?string
    {
        return $this->unit_price;
    }

    public function setUnitPrice(?string $unit_price): static
    {
        $this->unit_price = $unit_price;

        return $this;
    }

    public function getTransactionDate(): ?\DateTimeInterface
    {
        return $this->transaction_date;
    }

    public function setTransactionDate(?\DateTimeInterface $transaction_date): static
    {
        $this->transaction_date = $transaction_date;

        return $this;
    }
}
