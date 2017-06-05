<?php
namespace AddressBookAssignment;

use AddressBookAssignment\Person;
use AddressBookAssignment\Group;

/**
 * Address book
 */
class AddressBook {

    private $persons = array();
    private $groups = array();

    public function addPerson(Person $person) {
        $this->persons[$person->getId()] = $person;
    }
    
    public function addGroup(Group $group) {
        $this->groups[$group->getId()] = $group;
    }
    
    public function findGroupMembers(Group $group) {
        $result = [];
        foreach ($this->persons as $person) {
            if(in_array($person->getId(), $group->getPersons())) {
                array_push($result, $person);
            }
        }
        return $result;
    }
    
    public function findPersonGroups(Person $person) {
        $result = [];
        foreach ($this->groups as $group) {
            if(in_array($person->getId(), $group->getPersons())) {
                array_push($result, $group);
            }
        }
        return $result;
    }
    
    public function findPersonByName($firstName = null, $lastName = null) {
        if(empty($firstName) && empty($lastName)) {
            throw  new \InvalidArgumentException('Supply some name, please');
        }
        $result = [];
        foreach ($this->persons as $person) {
            if(empty($firstName)) {
                if($lastName == $person->getLastName()) {
                    array_push($result, $person);
                    continue;
                }
            }
            if(empty($lastName)) {
                if($firstName == $person->getFirstName()) {
                    array_push($result, $person);
                    continue;
                }
            }
            if($firstName == $person->getFirstName() && $lastName == $person->getLastName()) {
                array_push($result, $person);
            }
        }
        return $result;
    }
    
    public function findPersonByEmail($email) {
        if(empty($email)) {
            throw  new \InvalidArgumentException('Supply some email, please');
        }
        $result = [];
        foreach ($this->persons as $person) {
            $matches = array_filter($person->getEmails(), function($userEmail) use ($email) { return stripos($userEmail, $email) === 0; });
            if(!empty($matches)) {
                array_push($result, $person);
            }
        }
        return $result;
    }
    
    public function getPersons() {
        return $this->persons;
    }
    
    public function getGroups() {
        return $this->groups;
    }

}
