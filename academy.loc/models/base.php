<?php
	class Base	{
		protected $id;
		protected $table_name;

        function getId() {
            return $this->id;
        }

		function getTable_name() {
			return $this->table_name;
		}

		function setTable_name($name) {
			$this->table_name = $name;
		}

		function insert($data,$table) {
			$fields = "";
			$values = "";

			foreach ($data as $key => $value) {
				$fields .= "`".$key."`,";
				$values .= "\"".$value."\",";
			}

			$fields = substr($fields,0,strlen($fields)-1);
			$values = substr($values,0,strlen($values)-1);

			$insert = "INSERT INTO ".$table." (".$fields.") VALUES (".$values.")";
			return $insert;
		}

		function select($data,$table) {
			$fields = "";

			foreach ($data as $key => $value) {
				$fields .= $value.",";
			}

			$fields = substr($fields,0,strlen($fields)-1);

			$select = "SELECT ".$fields." FROM ".$table;
			return $select;
		}

        function where($first_field,$sign_comparison,$second_field) {
            return " WHERE ".$first_field." ".$sign_comparison." ".$second_field;
        }

        function and_where($first_field,$sign_comparison,$second_field) {
            return " and ".$first_field." ".$sign_comparison." ".$second_field;
        }

		function delete($id) {
			return "DELETE FROM ".$this->table_name." WHERE id=".$id;
		}

		function innerJoin($table1,$table2,$table_id1,$table_id2) {
            if(strpos($table1,"as")===false) {
                return " INNER JOIN ".$table1." ON ".$table2.".".$table_id1."=".$table1."."."$table_id2";
            }
            else {
                $words = explode(" ",$table1);
                $count_words = count($words);
                return " INNER JOIN ".$table1." ON ".$table2.".".$table_id1."=".$words[$count_words-1]."."."$table_id2";
            }
		}

        function orderBy($order_by) {
            return " ORDER BY ".$order_by;
        }

	}
