<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		$this->call('CodigErroresAuditoriaTableSeeder');
		$this->call('FeriadoTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('OdontologoTableSeeder');
		$this->call('ProvinciaTableSeeder');
	}

}
class UserTableSeeder extends Seeder {
 
     public function run()
     {
         DB::table('users')->delete();
         User::create(array(
                 'id' => 1,
                 'nombre' => 'admin',
         		 'email' => 'sistemas@consulmed.com.ar',
                 'password' => Hash::make('admin'),
                 'created_at' => new DateTime,
                 'updated_at' => new DateTime
         ));
         User::create(array(
                 'id' => 2,
                 'nombre' => 'fabio',
         		 'email' => 'fnovello@consulmed.com.ar',
                 'password' => Hash::make('fabio'),
                 'created_at' => new DateTime,
                 'updated_at' => new DateTime
         ));
      }
}
 
class OdontologoTableSeeder extends Seeder {
    public function run()
    {
        DB::table('odontologos')->delete();
        Odontologo::create(array(
                'id' => 1,
                'nombres' => 'Martin',
				'apellido' => 'Palermo',
                'matricula' => 'MN 123456',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
        ));
        Odontologo::create(array(
                'id' => 2,
                'nombres' => 'Guillermo',
				'apellido' => 'Barros Schelotto',
                'matricula' => 'MN 654321',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
        ));
		for ($i=3;$i<1000;$i++){
			$mn = 999000 + $i;
	        Odontologo::create(array(
	                'id' => $i,
	                'nombres' => 'Nombre-'.$i,
					'apellido' => 'Apellido-'.$i,
					'matricula' => 'MN '.$mn,
	                'created_at' => new DateTime,
	                'updated_at' => new DateTime
	        ));
		}
    }
}

class ProvinciaTableSeeder extends Seeder {
 
     public function run()
     {
         DB::table('provincias')->delete();
	$provincias = array(
		"CABA",
		"Buenos Aires",
		"Catamarca",
		"Chaco",
		"Chubut",
		"Córdoba",
		"Corrientes",
		"Entre Rios",
		"Formosa",
		"Jujuy",
		"La Pampa",
		"La Rioja",
		"Mendoza",
		"Misiones",
		"Neuquén",
		"Rio Negro",
		"Salta",
		"San Juan",
		"San Luis",
		"Santa Cruz",
		"Santa Fé",
		"Santiago del Estero",
		"Tierra del Fuego",
		"Tucumán",
	);
	foreach ($provincias as $p){
         Provincia::create(array(
                 'provincia' => $p,
         	 'pais_id' => 1,
                 'created_at' => new DateTime,
                 'updated_at' => new DateTime
         ));
	}
      }


}


class AnamnesisPreguntasTableSeeder extends Seeder {
	public function run(){
		DB::table('anamnesis_respuestas')->delete();
		DB::table('anamnesis_preguntas')->delete();
		$preguntas = array(
			"01" => "Alergia a analgésicos",
			"02" => "Alergia a drogas o medicamentos",
			"02b" => "Indicar cuales",
			"03" => "Anemia",
			"04" => "Asma Bronquial",
			"05" => "Ataques convulsivos",
			"06" => "Diabetes",
			"07" => "Dolencia crónica",
			"08" => "Embarazo",
			"09" => "Enfermedades venéreas (sífilis)", 
			"10" => "Fierbe reumática",
			"11" => "Hepatitis A o B",
			"12" => "Hipertensión",
			"13" => "Presión ocular",
			"14" => "Problemas hepáticos",
			"15" => "Problemas neurológicos",
			"16" => "Problemas renales",
			"17" => "Sangrado excesivo por heridas",
			"18" => "HIV",
			"19" => "Trastornos psiquiátricos",
			"20" => "Tratamientos por radiación",
			"21" => "Tumores",
			"22" => "Ulcera gastroduodenal",
			"23" => "Recibió tratamiento odontológico",
			"24" => "De periodoncia",
			"25" => "De endodoncia",
			"26" => "De extracionas dentarias",
			"27" => "De prótesis dentarias",
			"28" => "¿Toma anticoagulantes?",
			"101" => "Si está tomando algún medicamento indique cual (es)",
			"102" => "Si está actualmete en tratamiento indique el problema",
		);
		$i = 0;
		foreach ($preguntas as $nro=>$preg){
			$i++;
			AnamnesisPregunta::create(array(
				'id' => $i,
				'numero' => $nro,
				'pregunta' => $preg,
				'created_at' => new DateTime,
				'updated_at' => new DateTime
			));
		}

	}
}

 
class FeriadoTableSeeder extends Seeder {
    public function run()
    {
        DB::table('feriados')->delete();
$feriados = array(
"01/01/2014"=>"Año Nuevo"
,"03/03/2014"=>"Carnaval"
,"04/03/2014"=>"Carnaval"
,"24/03/2014"=>"Memoria por la verdad y la justicia."
,"02/04/2014"=>"Caidos en la Guerra de Malvinas"
,"18/04/2014"=>"Viernes Santo"
,"01/05/2014"=>"Día del trabajador"
,"02/05/2014"=>"Feriado Puente"
,"25/05/2014"=>"Revolución de Mayo"
,"20/06/2014"=>"Inmortalidad de Manuel Belgrano"
,"09/07/2014"=>"Día de la Independencia"
,"18/08/2014"=>"Inmortalidad de Gral. San Martín"
,"13/10/2014"=>"Respeto por la Diversidad Cultural"
,"24/11/2014"=>"Soberanía Nacional"
,"08/12/2014"=>"Inmaculada Concepción de María"
,"25/12/2014"=>"Navidad"
,"26/12/2014"=>"Feriado Puente"
,"31/12/2014"=>"No Trabajamos."
,"01/01/2015"=>"Año Nuevo"
,"03/03/2015"=>"Carnaval"
,"04/03/2015"=>"Carnaval"
,"23/03/2015"=>"Feriado Puente"
,"24/03/2015"=>"Memoria por la verdad y la justicia."
,"02/04/2015"=>"Caidos en la Guerra de Malvinas"
,"18/04/2015"=>"Viernes Santo"
,"01/05/2015"=>"Día del trabajador"
,"25/05/2015"=>"Revolución de Mayo"
,"20/06/2015"=>"Inmortalidad de Manuel Belgrano"
,"09/07/2015"=>"Día de la Independencia"
,"18/08/2015"=>"Inmortalidad de Gral. San Martín"
,"13/10/2015"=>"Respeto por la Diversidad Cultural"
,"24/11/2015"=>"Soberanía Nacional"
,"07/12/2015"=>"Feriado Puente"
,"08/12/2015"=>"Inmaculada Concepción de María"
,"25/12/2015"=>"Navidad"
,"31/12/2015"=>"No Trabajamos."
,"01/01/2016"=>"Año Nuevo"
,"03/03/2016"=>"Carnaval"
,"04/03/2016"=>"Carnaval"
,"24/03/2016"=>"Memoria por la verdad y la justicia."
,"02/04/2016"=>"Caidos en la Guerra de Malvinas"
,"18/04/2016"=>"Viernes Santo"
,"01/05/2016"=>"Día del trabajador"
,"25/05/2016"=>"Revolución de Mayo"
,"20/06/2016"=>"Inmortalidad de Manuel Belgrano"
,"08/07/2016"=>"Feriado Puente"
,"09/07/2016"=>"Día de la Independencia"
,"18/08/2016"=>"Inmortalidad de Gral. San Martín"
,"13/10/2016"=>"Respeto por la Diversidad Cultural"
,"24/11/2016"=>"Soberanía Nacional"
,"08/12/2016"=>"Inmaculada Concepción de María"
,"09/12/2016"=>"Feriado Puente"
,"25/12/2016"=>"Navidad"
,"31/12/2016"=>"No Trabajamos."
);

foreach ($feriados as $fecha=>$feriado){
	 Feriado::create(array(
                'fecha' => substr($fecha,6,4)."-".substr($fecha,3,2)."-".substr($fecha,0,2),
		'feriado' => $feriado,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
        ));
}
     }
}
class CodigoErroresAuditoriaTableSeeder extends Seeder {
    public function run()
    {
        DB::table('codigo_errores_auditoria')->delete();
			$errores = array(
			//"01" =>	"Trabajo realizado c/posteri. a la Baja del Afiliad",
			"02" => "Edad fuera de rango permitido",
			"03"=>"No Cumple con Period de garantía c/tram.anterior",
			"04"=>"Mayor Cantidad de las permitidas por sesion",
			//"05"=>"Tratamiento realizado NO se paga",
			//"06"=>"No Cumple c/period. de garantia dentro presentac.",
			"07"=>"Tratamiento NO cumple con obligaciones",
			"08"=>"Tratamiento NO cumple con restricciones",
			"09"=>"Ficha Odo. c/errores de confeccion Inexistente",
			//"10"=>"Fichado NO coincide c/tratam. anterior o a realiz.",
			"11"=>"Falta identificar la pieza dental",
			//"12"=>"Falta identificar el codigo de nomenclador",
			"13"=>"Falta identificar la cara de la pieza",
			//"14"=>"Empresa inexistente o faltante",
			//"15"=>"Falta identificar credencial",
			//"16"=>"Falta fecha de tratamiento",
			//"17"=>"Empresa dada de Baja",
			//"18"=>"Afiliado Inexistente",
			"19"=>"Tratamiento fuera de piezas permitidas",
			//"20"=>"Codigo nomenclador desconocido",
			//"21"=>"Afiliado pertenece a otra empresa",
			//"24"=>"Afiliado empresa sin Servicio de Odontologia ",
			"35"=>"Trat. anter. al Fichado, NO registrado en el mismo",
			//"47"=>"No se reconoce paso intermedio",
			"70"=>"Prestacion NO Registrada en el Fichado",
			"91"=>"Afiliado no pago el Coseguro Correspondiente",
			"92"=>"Tratamiento no cumple con Prohibiciones",
			"A7"=>"Comparacion fichados Ayacucho-Zonales-Interior",
			"C4"=>"No Corresponde % Derivacion",
			);
			foreach ($errores as $codigo=>$desc){
				 CodigoErroresAuditoria::create(array(
					'codigo'=> $codigo,
					'descripcion'=>$desc,
					'created_at' => new DateTime,
					'updated_at' => new DateTime
				));
			}
    }
} 
