<?php #character-test.php

echo basename(__file__) . ' <br /> <br /><br />';

include './_inc/mbx-inc.php'; #maxFunctions

include './_classes/Character_class.php';
include './_classes/ConnDB_class.php';
$character = new Character; #instantiated class
#end config

#returnBreak(4, TRUE);

#Set Properites explicity as not using __construct
#object . property = added value
$character->characterID       = 2; #property - must be int
$character->firstName         	 = 'Theodore';#property
$character->lastName          	 = 'Altman';
$character->codeName          	 = 'Chimaera';
$character->characterType     	 = 'Hybrid';
$character->character_type_id    = 2; ###
$character->characterAlignment	 = 'Neutral';
$character->characterPower    	 = 'Metamorph';
#$character->characterAffiliation = 'Avengers'; #unset to test lookup/db connection

echo '<h2>Explicity set character properties </h2>';
echo $character;


echo '<h2>Test Character __construct</h2>';
$character2 = new Character (array(
'characterID'					 => (int)3,
'firstName'         	 => 'William',#property
'lastName'          	 => 'Kaplan',
'codeName'          	 => 'Chant',
'characterType'     	 => 'Mutant',
'characterAlignment'	 => 'Good',
'characterPower'    	 => 'Magic',
#'characterAffiliation' => 'Avengers', #unset to test lookup/db connection
));

echo $character2->displayCharacter();


echo '<h2>Explicit Set Prorperites - Use __toString MM </h2>';
echo $character2;








