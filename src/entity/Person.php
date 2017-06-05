<?php
namespace AddressBookAssignment;
use AddressBookAssignment\BaseEntity;

class Person extends BaseEntity
{
    private static $ID_SEQUENCE = 0;
    
    private $firstName;
    private $lastName;
    private $addresses = array();
    private $emails = array();
    private $phones = array();
    
    function __construct($firstName, $lastName, $addresses = null, $emails = null, $phones = null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->addresses = $addresses;
        $this->emails = $emails;
        $this->phones = $phones;
        $this->id = Person::$ID_SEQUENCE++;
    }
    
    public function getFirstName() {
        return $this->firstName;
    }
    
    public function getLastName() {
        return $this->lastName;
    }
    
    public function getEmails() {
        return $this->emails;
    }
    
    public function getAddresses() {
        return $this->addresses;
    }
    
    public function getPhones() {
        return $this->phones;
    }
}
