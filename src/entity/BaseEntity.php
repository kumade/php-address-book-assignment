<?php
namespace AddressBookAssignment;

class BaseEntity
{
    protected $id;
    
    public function getId() {
        return $this->id;
    }
}
