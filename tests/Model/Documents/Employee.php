<?php


namespace Tests\Model\Documents;


class Employee
{
    protected $id;

    protected $joinedAt;

    protected $lastClockedInAt;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Employee
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getJoinedAt()
    {
        return $this->joinedAt;
    }

    /**
     * @param mixed $joinedAt
     * @return Employee
     */
    public function setJoinedAt($joinedAt)
    {
        $this->joinedAt = $joinedAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastClockedInAt()
    {
        return $this->lastClockedInAt;
    }

    /**
     * @param mixed $lastClockedInAt
     * @return Employee
     */
    public function setLastClockedInAt($lastClockedInAt)
    {
        $this->lastClockedInAt = $lastClockedInAt;
        return $this;
    }
}