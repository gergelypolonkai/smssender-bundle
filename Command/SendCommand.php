<?php
namespace GergelyPolonkai\SMSSenderBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendCommand extends ContainerAwareCommand
{
    protected function configure() {
        $this
            ->setName('gergelypolonkai:smssender:send')
            ->addArgument('recipient', InputArgument::REQUIRED)
            ->addArgument('message', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $container = $this->getContainer();

        $sender = $container->get('gergelypolonkai_smssender.sender');
        $sender->login(
                $container->getParameter('username'),
                $container->getParameter('password')
        );
        $sender->sendMessage($input->getArgument('recipient'), $input->getArgument('message'), array());
        $sender->logout();
    }
}

