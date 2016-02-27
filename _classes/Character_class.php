<?php #item-test.php

/**
 * TODO -- access protected ID of character.
 * TODO -- create three more characters.
 **/




#class Class name Curly brackets
class  Character {

	#constances -- position in the array?
	const CHARACTER_TYPE_HYBRID = 1;
	const CHARACTER_TYPE_MUTANT = 2;
	const CHARACTER_TYPE_ANDROID = 3;

	#Address types key - value pairings?
	static public $valid_character_types = array(
		Character::CHARACTER_TYPE_HYBRID => 'Hybrid',
		#1 => 'Hybrid',
		Character::CHARACTER_TYPE_MUTANT => 'Mutant',
		#2 => 'Mutant',
		Character::CHARACTER_TYPE_ANDROID => 'Android',
		#3 => 'Android',
	);


	#properties - public (all), protected(family), private (self)
	public     $characterID;				#Primary key of a character

	public     $firstName;  				#made
	public     $lastName;
	public     $codeName;
	public     $characterType;
	public     $characterAlignment;
	public     $characterPower;

	#added to test get and set
	#public    $characterAffiliation; #changes to protected
	#protected - only accessible by class/inheritance

	protected	 $_characterAffiliation;
	protected	 $_character_type_id;
	protected  $_time_created;
	protected  $_time_updated;


	/**
	 * constructor
	 * @parms array $data optional array of properties
	 */
	public function __construct($data = array()){
		#set default timezone
		date_default_timezone_set('America/Los_Angeles');
		#ceate timestamp
		$date = time();
		#make readable timestamp
		$this->_time_created = date('Y-m-d H:i:s', time());

		#confirm Character can be populated
		#$data is an array...
		if (!is_array($data)){
			trigger_error('Unable to construct address with a ' . get_class($name));
		}

		# If there is at least one value, populate the Address with it.
		if (count($data) > 0 ){
			foreach ($data as $name => $value){
				// Special case for protected properties.
				if (in_array($name, array(
					'time_created',
					'time_updated',
				))) {
					$name = '_' . $name;
				}
				$this->$name = $value;
			}
		}
	}



	#make a get for each element?

	/**
	 * Magic Method __get
	 * Get name of unset variable
	 * 	check database for match
	 *		return match if found
	 *	else
	 *		state no match found
	 *
	 * @param $string
	 * @return mix
	 */
	function __get($name){ #magic method
	#IS - its here always waiting/self actualizing

		#look up if unset
		if(!$this->_characterAffiliation){
			#if unset - set
			$this->_characterAffiliation = $this->_characterAffiliationGuess();
		}

		#attempt to return protectd porperty by name
		$protected_property_name = '_' . $name; #add underscore
		#call function property_exists()
		if(property_exists($this, $protected_property_name)) {
			return $this->$protected_property_name;
		}

		#unable to access property; trigger error
		trigger_error('Undefined property via __get(): ' . $name . ' - Max-Magic-Get-Note');
		return NULL;
	}


	/**
	 * Magic Method __set
	 * @param $string $name
	 * @return mix $value
	 */
	function __set($name, $value){
		# only set valid character type id
		if ('character_type_id' == $name) {
			$this->_setCharacerTypeId($value);
			return;
		}

		#once get has $name, set creates missing property

		#allow anything to set postal code
		if('characterAffiliation' == $name){
			$this->$name = $value; #what/where does value come from?
			#once $name is set to value,
			#$value goes poof!
			return;
			#
		}
		#unable to access property; trigger error
		trigger_error('Undefined or unallowed property via __set(): ' . $name . ' - MaxNote');
		return NULL;
	}

	/**
	 * Magic __toString - lets construct call display method?
	 * @return string
	 */
	function __toString(){
		return $this->displayCharacter();
	}


	/**
	 * guess team affiliation based on characterAffiliation
	 * @return string
	 */
	protected function _characterAffiliationGuess(){
		#get instance of ConnDB from ConnDB_classC4.php
		$db = ConnDB::getInstance();
		#get connection
		$mysqli = $db->getConnection();


		/*
			SELECT `characterAffiliation`
			FROM `character`
			WHERE  `characterID` = 2; #2 is $characterID
		*/
		#build query - tested sql in adminer, returns desired result 'avengers'

		$sql  = "";
		$sql .= "SELECT characterAffiliation ";
		$sql .= "FROM character ";

		#sanitize data - escape stuff..
		$characterID .= $mysqli->real_escape_string($this->characterID);
		$sql .= 'WHERE characterID = "' . $characterID . '" ;';

		#prepare query
		$result = $mysqli->query($sql);

		#if match (characterAffiliation) return match
		if ($row = $result->fetch_assoc()) {
			return $row['characterAffiliation'];
		}

	}

	/**
	 * Method - display character
	 * @param string
	 */
	function displayCharacter() {
		$output = '';

		$output .= $this->characterID . '<br />';

		#has characterID, show me character...

		#legal name
		if ( $this->lastName && $this->firstName ) {
			#last name first
			$output .= htmlspecialchars($this->lastName) . ', ' . htmlspecialchars($this->firstName) . '<br />';
		#only lastName
		}elseif( $this->lastName && $this->firstName == '' ){
			#print last name only
			$output .= htmlspecialchars($this->lastName) . '<br />';
		#only firstName exists
		}elseif( $this->lastName == '' && $this->firstName){
			#print first name only
			$output .= htmlspecialchars($this->firstName) . '<br />';
		}

		#code name
		if ( $this->codeName ) {
			$output .= htmlspecialchars($this->codeName) . '<br /> ';
		}

		#character type
		if ( $this->characterType ) {
			$output .= htmlspecialchars($this->characterType) . '<br />';
		}else{
			#no character type, default to base...
			$output = 'Unknown...<br/>';
		}

		#characterAlignment
		if ( $this->characterAlignment ) {
			$output .= htmlspecialchars($this->characterAlignment) . '<br />';
		}

		#added in to test __get() and __set()
		#characterAffiliation
		if ( $this->characterAffiliation ) {
			$output .= htmlspecialchars($this->characterAffiliation) . '<br /><br /><br />';
		}


		#give me the character as described
		return $output;
	}

	/**
	 * Determine if an character type is valid.
	 * @param int $character_type_id
	 * @return boolean
	 */
	static public function isValidCharacterTypeID($character_type_id){
		return array_key_exists($character_type_id, self::$valid_character_types);
	}


	/**
	 * If valid, set the character type id.
	 * @param int $character_type_id
	 */
	protected function _setCharacerTypeId($character_type_id){
		if (self::isValidCharacterTypeID($character_type_id)) {
			$this->_character_type_id = $character_type_id;
		}
	}


}
