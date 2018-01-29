<?php

namespace cron\command;

use cron\Task;
use Jenssegers\Date\Date;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\facade\Config;

class Run extends Command {

	protected function configure() {
		$this->setName('cron:run');
	}

	public function execute(Input $input, Output $output) {

		$tasks = Config::get('cron.tasks');

		foreach ($tasks as $taskClass) {

			if (is_subclass_of($taskClass, Task::class)) {

				/** @var Task $task */
				$task = new $taskClass();
				if ($task->isDue()) {

					if (!$task->filtersPass()) {
						continue;
					}

					$task->run();

					$output->writeln("Task {$taskClass} run at " . Date::now());
				}

			}
		}
	}
}