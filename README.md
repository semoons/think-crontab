# think-crontab 计划任务


### 使用范例
```
namespace app\task;

use cron\Task;

class DemoTask extends Task
{

    public function configure()
    {
        $this->daily(); //设置任务的周期，每天执行一次，更多的方法可以查看源代码，都有注释
    }

    /**
     * 执行任务
     * @return mixed
     */
    protected function execute()
    {
        //...具体的任务执行
    }
}
```

### 配置
``创建配置文件位于 config/cron.php``

```angular2html
return [
    'tasks' => [
        \app\task\DemoTask::class, //任务的完整类名
    ]
];
```
## 任务监听

两种方法：
``方法一 (推荐)``

起一个常驻进程，可以配合supervisor使用

```
php think cron:schedule
```
#### 创建 supervisor 
```angular2html
[program:php]
command= /usr/bin/php think cron:schedule ; 被监控进程
directory=/home/wwwroot/google.com
process_name=%(process_num)02d 
numprocs=1 ;启动几个进程 别改哟，多执行不算我的
autostart=true ;随着supervisord的启动而启动
autorestart=true ;自动启动
startsecs=1 ;程序重启时候停留在runing状态的秒数
startretries=10 ;启动失败时的最多重试次数
redirect_stderr=true ;重定向stderr到stdout
stdout_logfile=/root/supervisor.log ;stdout文件
```

``方法二``

在系统的计划任务里添加

```angular2html
* * * * * php /path/to/think cron:run >> /dev/null 2>&1
```


## TODO List

- [ ] 自动创建 cron 文件，注入 provider
- [ ] 创建任务命令 php think cron:create 
- [ ] 可追踪的定时任务日志 && 定时任务的心跳 && 异常追踪
- [ ] 并行任务 



## License
MIT

