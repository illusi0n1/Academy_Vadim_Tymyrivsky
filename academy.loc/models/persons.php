<?php
	class Persons extends Base {
		private $name;

		function __construct() {
			$this->table_name = "persons";
		}

		function getName() {
			return $this->name;
		}

		function setName($name) {
			$this->name = $name;
		}

        function addPerson($name) {
            $data = array("name"=>$name);
            $query = $this->insert($data,$this->getTable_name());
            $result = mysql_query("$query") or die(mysql_error());
            return $result;
        }

        function selectIdNameFromPersons() {
            $data = array("id","name");
            $query = $this->select($data,$this->getTable_name());
            $result = mysql_query("$query") or die(mysql_error());
            $arr_persons = array();
            while ($myrow = mysql_fetch_array($result)) {
                $person = new Persons();
                $person->id = $myrow["id"];
                $person->name = $myrow["name"];
                $arr_persons[] = $person;
            }
            return $arr_persons;
        }

        function display() {
            $data = array("persons.name");
            $query = $this->select($data,$this->getTable_name());
            $result = mysql_query("$query");

            $arr_persons = array();
            while($myrow = mysql_fetch_array($result)) {
                $person = new Persons();
                $person->name = $myrow[0];

                $arr_persons[] = $person;
            }
            return $arr_persons;
        }
	}