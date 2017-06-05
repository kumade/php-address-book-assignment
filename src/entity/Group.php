<?php
namespace AddressBookAssignment;
use AddressBookAssignment\BaseEntity;
use AddressBookAssignment\Person;

class Group extends BaseEntity
{
    private static $ID_SEQUENCE = 0;
    
    private $name;
    private $persons = array();
    
    function __construct($name)
    {
        $this->name = $name;
        $this->id = Group::$ID_SEQUENCE++;
    }
    
    public function addPerson(Person $person) {
        if(!in_array($person->getId(), $this->persons)) {
            array_push($this->persons, $person->getId());
        }
    }
    
    
    public function getPersons() {
        return $this->persons;
    }
    
}

