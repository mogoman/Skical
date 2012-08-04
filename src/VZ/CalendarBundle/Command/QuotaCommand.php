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

        if (count($events) > 0) {
            $rendered = $this->getContainer()->get('templating')->render(
                'VZCalendarBundle:Backend:quota-email.html.twig',
                array('events' => $events)
            );
            $mailFrom = $this->getContainer()->getParameter('cal_mail_from');
            $mailTo   = $this->getContainer()->getParameter('cal_mail_quota_to');
            $subject  = $this->getContainer()->getParameter('cal_mail_quota_subject');

            // log the emails going out
            $logger = $this->getContainer()->get('logger');

            if ($sendMail) {
                // email $rendered
                $message = \Swift_Message::newInstance()
                    ->setSubject($subject)
                    ->setFrom($mailFrom)
                    ->setTo($mailTo)
                    ->setBody($rendered)
                ;
                $this->getContainer()->get('mailer')->send($message);

                // and mark each event as quota sent
                foreach ($events as $event) {
                    $event->setQuotaNotified(1);
                    $em->persist($event);

                    $logger->info('SKICAL: Event ' . $event->getSummary() . ' quota notification was sent');
                }
                $em->flush();
            } else {
                $output->writeln("Not sending email, outputting only. Use --send to send email");
                $output->writeln("Email would be sent from " . $mailFrom);
                $output->writeln("Email would be sent to " . $mailTo);
                $output->writeln("Email subject " . $subject);
                $output->writeln($rendered);

                return 1;
            }
            return 0;
        } else {
            // nothing to do, no new events met the quota/date query
        }
    }
}