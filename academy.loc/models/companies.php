<?php
	class Companies extends Base {
		private $name;
		private $year;
		private $address;
		private $town_id;
        private $town_name;
		private $president_id;
        private $president_name;

		function __construct() {
			$this->table_name = "companies";
		}

		function getName() {
			return $this->name;
		}

		function getYear() {
			return $this->year;
		}

		function getAddress() {
			return $this->address;
		}

        function getTown_id() {
            return $this->town_id;
        }

        function getTown_name() {
            return $this->town_name;
        }

		function getPresident_id() {
			return $this->president_id;
		}

        function getPresident_name() {
            return $this->president_name;
        }

		function setName($name) {
			$this->name = $name;
		}

		function setYear($year) {
			$this->year = $year;
		}

		function setAddress($address) {
			$this->address = $address;
		}

		function setTown_id($town_id) {
			$this->town_id = $town_id;
		}

		function setPresident_id($president_id) {
			$this->president_id = $president_id;
		}

        function addCompany($name,$year,$address,$town,$president) {
            $data = array("name"=>$name,"year"=>$year,"address"=>$address,"town_id"=>$town,"president_id"=>$president);
            $query = $this->insert($data,$this->table_name);
            $result = mysql_query("$query") or die(mysql_error());
            return $result;
        }

        function deleteCompany($id) {
            $query = $this->delete($id);
            $result = mysql_query("$query") or die(mysql_error());
            return $result;
        }

        function selectIdNameFromCompanies() {
            $data = array("id","name");
            $query = $this->select($data,$this->getTable_name());
            $result = mysql_query("$query") or die(mysql_error());
            $arr_companies = array();
            while ($myrow = mysql_fetch_array($result)) {
                $company = new Companies();
                $company->id = $myrow["id"];
                $company->name = $myrow["name"];
                $arr_companies[] = $company;
            }
            return $arr_companies;
        }

        function search($part_of_name) {
            $data = array("companies.name","companies.year","companies.address","towns.name","persons.name");
            $select = $this->select($data,$this->getTable_name());
            $innerjoin1 = $this->innerJoin("towns","companies","town_id","id");
            $innerjoin2 = $this->innerJoin("persons","companies","president_id","id");
            $where = $this->where("locate(lower('$part_of_name'),lower(companies.name))",">","0");
            $query = $select." ".$innerjoin1." ".$innerjoin2." ".$where;
            $result = mysql_query("$query") or die(mysql_error());

            $arr_companies = array();
            while($myrow = mysql_fetch_array($result)) {
                $company = new Companies();
                $company->name = $myrow[0];
                $company->year = $myrow[1];
                $company->address = $myrow[2];
                $company->town_name = $myrow[3];
                $company->president_name = $myrow[4];
                $arr_companies[] = $company;
            }
            return $arr_companies;
        }

        function display($sort_by) {
            $data = array("companies.name","companies.year","companies.address","towns.name","persons.name");
            $select = $this->select($data,$this->getTable_name());
            $innerjoin1 = $this->innerJoin("towns","companies","town_id","id");
            $innerjoin2 = $this->innerJoin("persons","companies","president_id","id");
            $order_by = $this->orderBy($sort_by);
            $query = $select." ".$innerjoin1." ".$innerjoin2." ".$order_by;
            $result = mysql_query("$query");

            $arr_companies = array();
            while($myrow = mysql_fetch_array($result)) {
                $company = new Companies();
                $company->name = $myrow[0];
                $company->year = $myrow[1];
                $company->address = $myrow[2];
                $company->town_name = $myrow[3];
                $company->president_name = $myrow[4];

                $arr_companies[] = $company;
            }
            return $arr_companies;
        }
	}