<?php
namespace Removeproduct\Commandline\Console\Command;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
 
class Removecartproduct extends Command
{
 
    const NAME_ARGUMENT = "cartremoveproduct";
     
    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $name = $input->getArgument(self::NAME_ARGUMENT);
        $output->writeln("Removing products from cart");
    }
 
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("cart:removeproduct");
        $this->setDescription("Removing products from cart");
        $this->setDefinition([
            new InputArgument(self::NAME_ARGUMENT, InputArgument::OPTIONAL)
        ]);
        parent::configure();    
    }
}