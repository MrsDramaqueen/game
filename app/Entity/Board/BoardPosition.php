<?php

namespace App\Entity\Board;

class BoardPosition
{
    protected string $heightPosition;
    protected string $widthPosition;
    protected string $entityType;
    protected int $entityId;

    /**
     * @return string
     */
    public function getHeightPosition(): string
    {
        return $this->heightPosition;
    }

    /**
     * @param string $heightPosition
     * @return BoardPosition
     */
    public function setHeightPosition(string $heightPosition): BoardPosition
    {
        $this->heightPosition = $heightPosition;
        return $this;
    }

    /**
     * @return string
     */
    public function getWidthPosition(): string
    {
        return $this->widthPosition;
    }

    /**
     * @param string $widthPosition
     * @return BoardPosition
     */
    public function setWidthPosition(string $widthPosition): BoardPosition
    {
        $this->widthPosition = $widthPosition;
        return $this;
    }

    /**
     * @return string
     */
    public function getEntityType(): string
    {
        return $this->entityType;
    }

    /**
     * @param string $entityType
     * @return BoardPosition
     */
    public function setEntityType(string $entityType): BoardPosition
    {
        $this->entityType = $entityType;
        return $this;
    }

    /**
     * @return int
     */
    public function getEntityId(): int
    {
        return $this->entityId;
    }

    /**
     * @param int $entityId
     * @return BoardPosition
     */
    public function setEntityId(int $entityId): BoardPosition
    {
        $this->entityId = $entityId;
        return $this;
    }
}
