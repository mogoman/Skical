<?php

namespace VZ\CalendarBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class QuotaCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('vz:quota')
            ->setDescription('Check quotas and send email once the quota is reached')
            ->addOption('send', null, InputOption::VALUE_NONE, 'If set, email will be sent')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // flag to see if email must actually be sent
        $sendMail = false;
        if ($input->getOption('send')) {
            $sendMail = true;
        }

        // set all events where quota notification hasn't been set, the quota is over and the quota date
        // has already past
        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        $events  = $em->getRepository('VZCalendarBundle:Event')
            ->findAllOverQuota(time());

        if ($sendMail) {

        } else {
            $output->writeln("Not sending email, outputting only. Use --send to send email");
            return 1;
        }
        return 0;
    }
}