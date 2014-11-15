<?php
	class Flights extends Base {
		private $name;
		private $company_id;
        private $company_name;
		private $town_id_out;
        private $town_out_name;
		private $town_id_in;
        private $town_in_name;
		private $price;
		private $flight_time;
		private $plane_id;
        private $plane_name;

		function __construct() {
			$this->table_name = "flights";
		}

		function getName() {
			return $this->name;
		}

		function getCompany_id() {
			return $this->company_id;
		}

        function getCompany_name() {
            return $this->company_name;
        }

		function getTown_id_out() {
			return $this->town_id_out;
		}

        function getTown_out_name() {
            return $this->town_out_name;
        }

		function getTown_id_in() {
			return $this->town_id_in;
		}

        function getTown_in_name() {
            return $this->town_in_name;
        }

		function getPrice() {
			return $this->price;
		}

		function getFlight_time() {
			return $this->flight_time;
		}

		function getPlane_id() {
			return $this->plane_id;
		}

        function getPlane_name() {
            return $this->plane_name;
        }

		function setName($name) {
			$this->name = $name;
		}

		function setCompany_id($company_id) {
			$this->company_id = $company_id;
		}

		function setTown_id_out($town_id_out) {
			$this->town_id_out = $town_id_out;
		}

		function setTown_id_in($town_id_in) {
			$this->town_id_in = $town_id_in;
		}

		function setPrice($price) {
			$this->price = $price;
		}

		function setFlight_time($flight_time) {
			$this->flight_time = $flight_time;
		}

		function setPlane_id($plane_id) {
			$this->plane_id = $plane_id;
		}

        function addFlight($name,$company,$town_out,$town_in,$price,$time,$plane) {
            $data = array("name"=>$name,"company_id"=>$company,"town_id_out"=>$town_out,"town_id_in"=>$town_in,"price"=>$price,"flight_time"=>$time,"plane_id"=>$plane);
            $query = $this->insert($data,$this->getTable_name());
            $result = mysql_query("$query") or die(mysql_error());
            return $result;
        }

        function deleteFlight($id) {
            $query = $this->delete($id);
            $result = mysql_query("$query") or die(mysql_error());
            return $result;
        }

        function selectIdNameFromFlights() {
            $data = array("id","name");
            $query = $this->select($data,$this->getTable_name());
            $result = mysql_query("$query") or die(mysql_error());
            $arr_flights = array();
            while ($myrow = mysql_fetch_array($result)) {
                $flight = new Flights();
                $flight->id = $myrow["id"];
                $flight->name = $myrow["name"];
                $arr_flights[] = $flight;
            }
            return $arr_flights;
        }

        function allFlightWhere($town_out,$town_in,$company,$plane) {
            $data = array("flights.name", "companies.name", "t1.name", "t2.name", "flights.price", "flights.flight_time", "planes.name");
            $select = $this->select($data, $this->getTable_name());
            $innerjoin1 = $this->innerJoin("companies", "flights", "company_id", "id");
            $innerjoin2 = $this->innerJoin("towns as t1", "flights", "town_id_out", "id");
            $innerjoin3 = $this->innerJoin("towns as t2", "flights", "town_id_in", "id");
            $innerjoin4 = $this->innerJoin("planes", "flights", "plane_id", "id");
            $where = $this->where("flights.town_id_out", "=", "$town_out");
            $and1 = $this->and_where("flights.town_id_in", "=", "$town_in");
            $and2 = $this->and_where("flights.company_id", "=", "$company");
            $and3 = $this->and_where("flights.plane_id", "=", "$plane");
            $query = $select." ".$innerjoin1." ".$innerjoin2." ".$innerjoin3." ".$innerjoin4." ".$where." ".$and1." ".$and2." ".$and3;
            $result = mysql_query("$query") or die (mysql_error());

            $arr_flights = array();
            while ($myrow = mysql_fetch_array($result)) {
                $flight = new Flights();
                $flight->name = $myrow[0];
                $flight->company_name = $myrow[1];
                $flight->town_out_name = $myrow[2];
                $flight->town_in_name = $myrow[3];
                $flight->price = $myrow[4];
                $flight->flight_time = $myrow[5];
                $flight->plane_name = $myrow[6];

                $arr_flights[] = $flight;
            }
            return $arr_flights;
        }

        function search($part_of_name) {
            $data = array("flights.name","companies.name","t1.name","t2.name","flights.price","flights.flight_time","planes.name");
            $select = $this->select($data,$this->getTable_name());
            $innerjoin1 = $this->innerJoin("companies","flights","company_id","id");
            $innerjoin2 = $this->innerJoin("towns as t1","flights","town_id_out","id");
            $innerjoin3 = $this->innerJoin("towns as t2","flights","town_id_in","id");
            $innerjoin4 = $this->innerJoin("planes","flights","plane_id","id");
            $where = $this->where("locate(lower('$part_of_name'),lower(flights.name))",">","0");
            $query = $select." ".$innerjoin1." ".$innerjoin2." ".$innerjoin3." ".$innerjoin4." ".$where;
            $result = mysql_query("$query") or die(mysql_error());

            $arr_flights = array();
            while($myrow = mysql_fetch_array($result)) {
                $flight = new Flights();
                $flight->name = $myrow[0];
                $flight->company_name = $myrow[1];
                $flight->town_out_name = $myrow[2];
                $flight->town_in_name = $myrow[3];
                $flight->price = $myrow[4];
                $flight->flight_time = $myrow[5];
                $flight->plane_name = $myrow[6];
                $arr_flights[] = $flight;
            }
            return $arr_flights;
        }

        function display($sort_by) {
            $data = array("flights.name","companies.name","t1.name","t2.name","flights.price","flights.flight_time","planes.name");
            $select = $this->select($data,$this->getTable_name());
            $innerjoin1 = $this->innerjoin("companies","flights","company_id","id");
            $innerjoin2 = $this->innerjoin("towns as t1","flights","town_id_out","id");
            $innerjoin3 = $this->innerjoin("towns as t2","flights","town_id_in","id");
            $innerjoin4 = $this->innerjoin("planes","flights","plane_id","id");
            $order_by = $this->orderBy($sort_by);
            $query = $select." ".$innerjoin1." ".$innerjoin2." ".$innerjoin3." ".$innerjoin4." ".$order_by;
            $result = mysql_query("$query") or die(mysql_error());

            $arr_flights = array();
            while($myrow = mysql_fetch_array($result)) {
                $flight = new Flights();
                $flight->name = $myrow[0];
                $flight->company_name = $myrow[1];
                $flight->town_out_name = $myrow[2];
                $flight->town_in_name = $myrow[3];
                $flight->price = $myrow[4];
                $flight->flight_time = $myrow[5];
                $flight->plane_name = $myrow[6];

                $arr_flights[] = $flight;
            }
            return $arr_flights;
        }
	}