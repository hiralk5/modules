<?php
namespace Removeproduct\Commandline\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
class Removecartproduct extends Command
{
   protected function configure()
   {
       $this->setName('cart:removeproduct');
       $this->setDescription('Remove Product from cart');
       
       parent::configure();
   }
   protected function execute(InputInterface $input, OutputInterface $output)
   {
       $output->writeln("Removing products from cart");
   }
}
