<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class generarAgendas extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'generarAgendas';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generador automático de agendas y turnos.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$this->info('Generar Agendas');
		$this->info('Iniciado: '.date('Y-m-d H:i:s'));
		$c = new CentroOdontologoEspecialidadController;
		$resultado = $c->generarAgendas();
		$this->info($resultado);	
		$this->info('Terminado: '.date('Y-m-d H:i:s'));
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
