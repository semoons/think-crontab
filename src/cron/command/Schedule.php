<?php

namespace cron\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Process;

class Schedule extends Command {

	protected function configure() {
		$this->setName('cron:schedule');
	}

	protected function execute(Input $input, Output $output) {

		if ('\\' == DIRECTORY_SEPARATOR) {
			$command = 'start /B "' . PHP_BINARY . '" think cron:run';
		} else {
			$command = 'nohup "' . PHP_BINARY . '" think cron:run >> /dev/null 2>&1 &';
		}

		$process = new Process($command);

		while (true) {
			$process->run();
			sleep(60);
		}
	}
}