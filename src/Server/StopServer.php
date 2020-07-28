<?php
declare(strict_types=1);


namespace Phper666\HyperfServiceCommand\Server;
use Swoole\Process;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Hyperf\Command\Annotation\Command as HyperfCommand;
/**
 * @HyperfCommand()
 */
class StopServer extends Command
{

    public function __construct()
    {
        parent::__construct('tmg:stop');
    }

    protected function configure()
    {
        $this->setDescription('Stop hyperf servers.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $pidFile = BASE_PATH . '/runtime/hyperf.pid';
        $pid = file_exists($pidFile) ? intval(file_get_contents($pidFile)) : false;
        if (!$pid) {
            $io->note('swoole server pid is invalid.');
            return -1;
        }

        if (!Process::kill($pid, SIG_DFL)) {
            $io->note('swoole server process does not exist.');
            return -1;
        }

        if (!Process::kill($pid, SIGTERM)) {
            $io->error('swoole server stop error.');
            return -1;
        }

        $io->success('swoole server stop success.');
        return 0;
    }

}
