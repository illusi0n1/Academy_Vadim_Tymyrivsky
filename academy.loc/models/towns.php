<?php
	class Towns extends Base {
		private $name;
		private $country_id;
        private $country_name;
		private $citizens_quantity;
		private $mayor_id;
        private $mayor_name;

		function __construct() {
			$this->table_name = "towns";
		}

		function getName() {
			return $this->name;
		}

		function getCountry_id() {
			return $this->country_id;
		}

        function getCountry_name() {
            return $this->country_name;
        }

		function getCitizens_quantity() {
			return $this->citizens_quantity;
		}

		function getMayor_id() {
			return $this->mayor_id;
		}

        function getMayor_name() {
            return $this->mayor_name;
        }

		function setName($name) {
			$this->name = $name;
		}

		function setCountry_id($country_id) {
			$this->country_id = $country_id;
		}

		function setQuantity_of_citizens($citizens_quantity) {
			$this->citizens_quantity = $citizens_quantity;
		}

        function addTown($name,$country,$citizens,$mayor) {
            $data = array("name"=>$name,"country_id"=>$country,"citizens_quantity"=>$citizens,"mayor_id"=>$mayor);
            $query = $this->insert($data,$this->getTable_name());
            $result = mysql_query("$query") or die(mysql_error());
            return $result;
        }

        function deleteTown($id) {
            $query = $this->delete($id);
            $result = mysql_query("$query") or die(mysql_error());
            return $result;
        }

        function selectIdNameFromTowns() {
            $data = array("id","name");
            $query = $this->select($data,$this->getTable_name());
            $result = mysql_query("$query") or die(mysql_error());
            $arr_towns = array();
            while ($myrow = mysql_fetch_array($result)) {
                $town = new Towns();
                $town->id = $myrow["id"];
                $town->name = $myrow["name"];
                $arr_towns[] = $town;
            }
            return $arr_towns;
        }

        function search($part_of_name) {
            $data = array("towns.name","countries.name","towns.citizens_quantity","persons.name");
            $select = $this->select($data,$this->getTable_name());
            $innerjoin1 = $this->innerJoin("countries","towns","country_id","id");
            $innerjoin2 = $this->innerJoin("persons","towns","mayor_id","id");
            $where = $this->where("locate(lower('$part_of_name'),lower(towns.name))",">","0");
            $query = $select." ".$innerjoin1." ".$innerjoin2." ".$where;
            $result = mysql_query("$query") or die(mysql_error());
            $arr_towns = array();
            while($myrow = mysql_fetch_array($result)) {
                $town = new Towns();
                $town->name = $myrow[0];
                $town->country_name = $myrow[1];
                $town->citizens_quantity = $myrow[2];
                $town->mayor_name = $myrow[3];

                $arr_towns[] = $town;
            }
            return $arr_towns;
        }

        function display($sort_by) {
            $data = array("towns.name","countries.name","towns.citizens_quantity","persons.name");
            $select = $this->select($data,$this->getTable_name());
            $innerjoin1 = $this->innerJoin("countries","towns","country_id","id");
            $innerjoin2 = $this->innerJoin("persons","towns","mayor_id","id");
            $order_by = $this->orderBy($sort_by);
            $query = $select." ".$innerjoin1." ".$innerjoin2." ".$order_by;
            $result = mysql_query("$query");

            $arr_towns = array();
            while($myrow = mysql_fetch_array($result)) {
                $town = new Towns();
                $town->name = $myrow[0];
                $town->country_name = $myrow[1];
                $town->citizens_quantity = $myrow[2];
                $town->mayor_name = $myrow[3];

                $arr_towns[] = $town;
            }
            return $arr_towns;
        }

        function cityInWhichCompanyFlies($company) {
            $data = array("towns.name");
            $select = $this->select($data,"towns,flights");
            $where = $this->where("flights.company_id","=",$company);
            $and = $this->and_where("flights.town_id_in","=","towns.id");
            $query = $select." ".$where." ".$and;
            $result = mysql_query("$query")or die(mysql_error());

            $arr_towns = array();
            while($myrow = mysql_fetch_array($result)) {
                $town = new Towns();
                $town->name = $myrow[0];
                $town->country_name = $myrow[1];
                $town->citizens_quantity = $myrow[2];
                $town->mayor_name = $myrow[3];

                $arr_towns[] = $town;
            }
            return $arr_towns;
        }
	}