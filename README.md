Address book API description
===

### Add a person to the address book.
Call ```$addressBook->addPerson``` and pass a person as a parameter. Sample usage: see ```AddressBookTest::testAddPerson```.
***

### Add a group to the address book.
Call ```$addressBook->addGroup``` and pass a group as a parameter. Sample usage: see ```AddressBookTest::testAddGroup```.
***

### Given a group we want to easily find its members.
First add desired persons and groups to an address book with previous methods. Then add desired persons to a specific group with ```$someGroup->addPerson``` and pass a person as a parameter. 
Then call ```$addressBook->findGroupMembers``` and pass the group as a parameter. Sample usage: see ```AddressBookTest::testFindGroupMembers```.
Method returns an array of Person objects.
***
            
### Given a person we want to easily find the groups the person belongs to.
First add desired persons and groups to an address book with previous methods. Then add desired person to a few groups with ```$someGroup->addPerson``` and pass a person as a parameter. 
Then call ```$addressBook->findPersonGroups``` and pass the person as a parameter. Sample usage: see ```AddressBookTest::testFindPersonGroups```.
Method returns an array of Group objects.
***

### Find person by name (can supply either first name, last name, or both).
First add desired persons to an address book with previous methods.
Then call ```$addressBook->findPersonByName``` and pass either first name, last name, or both as parameter(s). Sample usage: see ```AddressBookTest::testFindPersonByName```.
Method returns an array of Person objects, which match the condition.
***

### Find person by email address (can supply either the exact string or a prefix string, ie. both "alexander@company.com" and "alex" should work).
First add desired persons to an address book with previous methods.
Then call ```$addressBook->findPersonByEmail``` and pass either the exact string or a prefix string as a parameter. Sample usage: see ```AddressBookTest::testFindPersonByEmail```.
Method returns an array of Person objects, which match the condition.
***

Design-only question
===

### Find person by email address (can supply any substring, ie. "comp" should work assuming "alexander@company.com" is an email address in the address book) - discuss how you would implement this without coding the solution.
To achieve this you need to change a method ```AddressBook::findPersonByEmail``` in a way that it should search for a string, provided as a parameter, not only in the beginning of an email address, but throughout the entire email string.
So, the filtering condition at line 74 have to be changed from ```stripos($userEmail, $email) === 0``` to ```stripos($userEmail, $email) !== false```


