<?php
	class Planes extends Base {
		private $name;

		function __construct() {
			$this->table_name = "planes";
		}

		function getName() {
			return $this->name;
		}

		function setName($name) {
			$this->name = $name;
		}

        function addPlane($name) {
            $data = array("name"=>$name);
            $query = $this->insert($data,$this->getTable_name());
            $result = mysql_query("$query") or die(mysql_error());
            return $result;
        }

        function selectIdNameFromPlanes() {
            $data = array("id","name");
            $query = $this->select($data,$this->getTable_name());
            $result = mysql_query("$query") or die(mysql_error());
            $arr_planes = array();
            while ($myrow = mysql_fetch_array($result)) {
                $plane = new Planes();
                $plane->id = $myrow["id"];
                $plane->name = $myrow["name"];
                $arr_planes[] = $plane;
            }
            return $arr_planes;
        }

        function selectUsedPlanes($company) {
            $data = array("planes.name");
            $select = $this->select($data,"planes,flights");
            $where = $this->where("flights.company_id","=",$company);
            $and = $this->and_where("flights.plane_id","=","planes.id");
            $query = $select." ".$where." ".$and;
            $result = mysql_query("$query") or die (mysql_error());

            $arr_planes = array();
            while($myrow = mysql_fetch_array($result)) {
                $plane = new Planes();
                $plane->name = $myrow[0];

                $arr_planes[] = $plane;
            }
            return $arr_planes;
        }

        function display() {
            $data = array("planes.name");
            $query = $this->select($data,$this->getTable_name());
            $result = mysql_query("$query");

            $arr_planes = array();
            while($myrow = mysql_fetch_array($result)) {
                $plane = new Planes();
                $plane->name = $myrow[0];

                $arr_planes[] = $plane;
            }
            return $arr_planes;
        }
	}