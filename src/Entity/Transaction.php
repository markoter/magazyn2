<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    private ?Item $item = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    private ?Warehouse $warehouse = null;

    #[ORM\OneToMany(targetEntity: InvoiceFile::class, mappedBy: 'transaction')]
    private Collection $invoiceFiles;

    public function __construct()
    {
        $this->invoiceFiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): static
    {
        $this->item = $item;

        return $this;
    }

    public function getWarehouse(): ?Warehouse
    {
        return $this->warehouse;
    }

    public function setWarehouse(?Warehouse $warehouse): static
    {
        $this->warehouse = $warehouse;

        return $this;
    }

    /**
     * @return Collection<int, InvoiceFile>
     */
    public function getInvoiceFiles(): Collection
    {
        return $this->invoiceFiles;
    }

    public function addInvoiceFile(InvoiceFile $invoiceFile): static
    {
        if (!$this->invoiceFiles->contains($invoiceFile)) {
            $this->invoiceFiles->add($invoiceFile);
            $invoiceFile->setTransaction($this);
        }

        return $this;
    }

    public function removeInvoiceFile(InvoiceFile $invoiceFile): static
    {
        if ($this->invoiceFiles->removeElement($invoiceFile)) {
            // set the owning side to null (unless already changed)
            if ($invoiceFile->getTransaction() === $this) {
                $invoiceFile->setTransaction(null);
            }
        }

        return $this;
    }
}
