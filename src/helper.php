<?php

use cron\command\Run;
use cron\command\Schedule;

\think\Console::addDefaultCommands([
	Run::class,
	Schedule::class,
]);