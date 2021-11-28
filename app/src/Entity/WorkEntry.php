<?php

namespace App\Entity;

use App\Exception\WorkEntryDatesInvalidException;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="app_work_entry")
 * @ORM\Entity(repositoryClass="App\Repository\WorkEntryRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=true)
 * @ORM\HasLifecycleCallbacks
 */
class WorkEntry
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var DateTime|null $createdAt
     * @Assert\DateTime()
     * @ORM\Column(name="start_date", type="datetime", nullable=false)
     */
    protected ?DateTimeInterface $startDate;


    /**
     * @var DateTime|null $createdAt
     * @Assert\DateTime()
     * @ORM\Column(name="end_date", type="datetime", nullable=false)
     */
    protected ?DateTimeInterface $endDate;

    /**
     * @var DateTime|null $createdAt
     * @Assert\DateTime()
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected ?DateTimeInterface $createdAt = null;

    /**
     * @var DateTime|null $createdAt
     * @Assert\DateTime()
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected ?DateTimeInterface $updatedAt = null;

    /**
     * @var DateTime|null $createdAt
     * @Assert\DateTime()
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    protected ?DateTimeInterface $deletedAt = null;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="workEntries")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected User $user;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     */
    public function setStartDate(DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    /**
     * @param DateTime $endDate
     */
    public function setEndDate(DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return DateTime|null
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTime|null $deletedAt
     */
    public function setDeletedAt(?DateTime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }


    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps(): void
    {
        $this->setUpdatedAt(new DateTime('now'));
        if (null === $this->createdAt) {
            $this->setCreatedAt(new DateTime('now'));
        }
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * @throws Exception
     */
    public function isEndDateValid() : void
    {
        if($this->endDate < $this->startDate)
        {
            WorkEntryDatesInvalidException::throwException();
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'userId' => $this->getUser()->getId(),
            'startDate' => $this->getStartDate()->format('Y-m-d H:i:s'),
            'endDate' => $this->getEndDate()->format('Y-m-d H:i:s'),
        ];
    }
}