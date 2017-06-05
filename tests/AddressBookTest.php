<?php
use AddressBookAssignment\Person;
use AddressBookAssignment\Group;
use AddressBookAssignment\AddressBook;

class AddressBookTest extends \PHPUnit_Framework_TestCase
{
    protected $personLinus;
    protected $personBill;
    protected $personSteve;
    protected $groupFriends;
    protected $groupFoes;
    protected $addressBook;

    protected function setUp()
    {
        $this->personLinus = new Person('Linus', 'Torvalds', ['Valhalla'], ['info@linuxfoundation.org'], ['+11800000001']);
        $this->personBill = new Person('Bill', 'Gates', null , ['bill@microsoft.com', 'spy@apple.com'], null);
        $this->personSteve = new Person('Steve', 'Jobs', ['Apple', 'Heaven'], ['boss@apple.com', 'steve@apple.com'], ['+22800000002']);
        $this->personSteveB = new Person('Steve', 'Balmer', ['Silicon valley, Developers Ave.'] , ['steve@microsoft.com'], ['+21800123456', '+21800654321']);
        $this->groupFriends = new Group('Friends');
        $this->groupFoes = new Group('Friends');
        $this->addressBook = new AddressBook();
    }
    
    public function testAddPerson()
    {
        $this->addressBook->addPerson($this->personLinus);
        $this->assertEquals(1, count($this->addressBook->getPersons()));
        $this->assertEquals($this->personLinus, array_pop($this->addressBook->getPersons()));
    }
    
    public function testAddGroup()
    {
        $this->addressBook->addGroup($this->groupFriends);
        $this->assertEquals(1, count($this->addressBook->getGroups()));
        $this->assertEquals($this->groupFriends, array_pop($this->addressBook->getGroups()));
    }
    
    public function testAddPersonToGroup()
    {
        $this->groupFriends->addPerson($this->personLinus);
        $this->assertEquals(1, count($this->groupFriends->getPersons()));
        $this->assertEquals($this->personLinus->getId(), $this->groupFriends->getPersons()[0]);
    }
    
    public function testFindGroupMembers()
    {
        $this->addressBook->addPerson($this->personLinus);
        $this->addressBook->addPerson($this->personSteve);
        
        $this->addressBook->addGroup($this->groupFriends);
        $this->addressBook->addGroup($this->groupFoes);
        
        $this->groupFriends->addPerson($this->personLinus);
        $this->groupFriends->addPerson($this->personSteve);
        
        $friends = $this->addressBook->findGroupMembers($this->groupFriends);
        $this->assertEquals(2, count($friends));
        $this->assertEquals($this->personLinus, $friends[0]);
        $this->assertEquals($this->personSteve, $friends[1]);
    }
    
    public function testFindPersonGroups()
    {
        $this->addressBook->addPerson($this->personLinus);
        $this->addressBook->addPerson($this->personSteve);
        
        $this->addressBook->addGroup($this->groupFriends);
        $this->addressBook->addGroup($this->groupFoes);
        
        $this->groupFriends->addPerson($this->personLinus);
        $this->groupFriends->addPerson($this->personSteve);
        $this->groupFoes->addPerson($this->personSteve);
        
        $linusGroups = $this->addressBook->findPersonGroups($this->personLinus);
        $steveGroups = $this->addressBook->findPersonGroups($this->personSteve);
        
        $this->assertEquals(1, count($linusGroups));
        $this->assertEquals($this->groupFriends, $linusGroups[0]);
        
        $this->assertEquals(2, count($steveGroups));
        $this->assertEquals($this->groupFriends, $steveGroups[0]);
        $this->assertEquals($this->groupFoes, $steveGroups[1]);
    }
    
    public function testFindPersonByName()
    {
        $this->addressBook->addPerson($this->personLinus);
        $this->addressBook->addPerson($this->personBill);
        $this->addressBook->addPerson($this->personSteve);
        $this->addressBook->addPerson($this->personSteveB);
        
        $steves = $this->addressBook->findPersonByName('Steve');
        
        $this->assertEquals(2, count($steves));
        $this->assertEquals($this->personSteve->getLastName(), $steves[0]->getLastName());
        $this->assertEquals($this->personSteveB->getLastName(), $steves[1]->getLastName());
        
        $linus = $this->addressBook->findPersonByName(null, 'Torvalds');
        $this->assertEquals(1, count($linus));
        $this->assertEquals($this->personLinus->getFirstName(), $linus[0]->getFirstName());
        
        $bg = $this->addressBook->findPersonByName('Bill', 'Gates');
        $this->assertEquals(1, count($bg));
        $this->assertEquals($this->personBill->getFirstName(), $bg[0]->getFirstName());
        $this->assertEquals($this->personBill->getLastName(), $bg[0]->getLastName());
    }
    
    public function testFindPersonByEmail()
    {
        $this->addressBook->addPerson($this->personLinus);
        $this->addressBook->addPerson($this->personBill);
        $this->addressBook->addPerson($this->personSteve);
        $this->addressBook->addPerson($this->personSteveB);
        
        $steves = $this->addressBook->findPersonByEmail('steve');
        
        $this->assertEquals(2, count($steves));
        $this->assertEquals($this->personSteve->getLastName(), $steves[0]->getLastName());
        $this->assertEquals($this->personSteveB->getLastName(), $steves[1]->getLastName());
        
        $bg = $this->addressBook->findPersonByEmail('spy@apple.com');
        $this->assertEquals(1, count($bg));
        $this->assertEquals($this->personBill->getFirstName(), $bg[0]->getFirstName());
        $this->assertEquals($this->personBill->getLastName(), $bg[0]->getLastName());
        
        $notLinus = $this->addressBook->findPersonByEmail('linuxfoundation.org');
        $this->assertEquals(0, count($notLinus));
    }
    
}