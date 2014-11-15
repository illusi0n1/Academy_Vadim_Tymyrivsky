<?php
	class Countries extends Base {
		private $name;

		function __construct() {
			$this->table_name = "countries";
		}

		function getName() {
			return $this->name;
		}

		function setName($name) {
			$this->name = $name;
		}

        function addCountry($name) {
            $data = array("name"=>$name);
            $query = $this->insert($data,$this->getTable_name());
            $result = mysql_query("$query") or die(mysql_error());
            return $result;
        }

        function selectIdNameFromCountries() {
            $data = array("id","name");
            $query = $this->select($data,$this->getTable_name());
            $result = mysql_query("$query") or die(mysql_error());
            $arr_countries = array();
            while ($myrow = mysql_fetch_array($result)) {
                $country = new Countries();
                $country->id = $myrow["id"];
                $country->name = $myrow["name"];
                $arr_countries[] = $country;
            }
            return $arr_countries;
        }

        function display() {
            $data = array("countries.name");
            $query = $this->select($data,$this->getTable_name());
            $result = mysql_query("$query");

            $arr_countries = array();
            while($myrow = mysql_fetch_array($result)) {
                $country = new Countries();
                $country->name = $myrow[0];

                $arr_countries[] = $country;
            }
            return $arr_countries;
        }
	}
