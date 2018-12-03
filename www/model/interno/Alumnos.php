<?php 
	class Alumno extends EntidadBase{
		private $idAlumno;
		private $sexo;
		private $CURP;
        private $generacion;
        private $turno;
        private $carrera;
        private $semestre;
        private $numMaterias;
        private $calificacion;

		public function __construct($adapter) {
            $table = "alumnos";
            parent::__construct($table, $adapter);
        }

        public function save ($estudiantes){
            $sql = "INSERT INTO alumnos VALUES ";
            foreach ($estudiantes as $alumno) {
                $sql .= "( NULL, '";
                $sql .= $alumno[1]."', '";
                $sql .= $alumno[0]."', '";
                $sql .= $alumno[2]."', '";
                $sql .= $alumno[3]."', '";
                $sql .= $alumno[4]."', '";
                $sql .= $alumno[5]."', '";
                $sql .= $alumno[6]."', '";
                $sql .= $alumno[7]."'), ";
            }
            $sql = substr($sql, 0, -1);
            $sql = substr($sql, 0, -1);
            $sql .= ";";
            //echo $sql;
            $save=$this->db()->query($sql);
            return $save;
        }

	}
?>