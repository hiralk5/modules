<?php
namespace Removeproduct\Commandline\Model;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Quote\Model\ResourceModel\Quote\CollectionFactory;
use Magento\Quote\Model\QuoteRepository;
use Magento\Framework\App\Area;
use Magento\Framework\App\State;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Registry;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Catalog\Api\ProductRepositoryInterface;

class Removecartproduct extends Command
{
    protected CollectionFactory $quoteCollectionFactory;
    protected QuoteRepository $quoteRepository;
    protected $quoteItemCollection;

     public function __construct(
        CollectionFactory $quoteCollectionFactory,
        QuoteRepository $quoteRepository,
        \Magento\Quote\Model\ResourceModel\Quote\Item\CollectionFactory $quoteItemCollection,
        \Magento\Quote\Model\Quote\Item $getItem,
        \Magento\Checkout\Model\Cart $cart
    ) {
        parent::__construct();
        $this->quoteCollectionFactory = $quoteCollectionFactory;
        $this->quoteItemCollection = $quoteItemCollection;
        $this->quoteRepository = $quoteRepository;
        $this->getItem = $getItem;
        $this->cart = $cart;
    }
    
    protected function configure()
    {
        $this->setName('cart:removeproduct')
             ->setDescription('Remove products from cart!');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Removing products from cart!');
    
        $fromTime = new \DateTime('now', new \DateTimezone('UTC'));
        $toTime = clone $fromTime;
        $fromTime->sub(\DateInterval::createFromDateString('30 seconds')); // DateInterval::createFromDateString('2 day');
        $fromDate = $fromTime->format('Y-m-d H:i:s');
        $quoteCollection = $this->quoteCollectionFactory->create();
        $quoteCollection
            ->addFieldToFilter('updated_at', ['lteq' => $fromDate]);                
        if($quoteCollection->getSize() >0){
            foreach ($quoteCollection as  $key => $quote)
            {
                $getQuoteItemCollection = $this->quoteItemCollection->create();
                $quoteItem = $this->quoteItemCollection->addFieldToSelect('*')->addFieldToFilter('quote_id', $quote['entity_id'])->addFieldToFilter('updated_at', ['lteq' => $fromDate]);
               if($quoteItem->getSize() > 0) {
                    echo "quoteitem getsize >0 <br>";
                    foreach ($quoteItem->getData() as $key => $value) {
                        $itemModel = $this->getItem->load($value['item_id']);
                        $itemModel->delete();
                        $quoteUpdate = true;
                        $quoteFullObject = $this->quoteRepository->get($quote->getId());
                        $quoteFullObject->delete();
                    }
                    if ($quoteUpdate){
                        $cart = $this->cart->setQuote($quote)->getQuote()->setTotalsCollectedFlag(false);   
                        $cart->save();
                        echo "cart save";
                    }
                } else {
                    $quoteItemCheck = $quoteItemCollection->addFieldToSelect('*')->addFieldToFilter('quote_id', $quote['entity_id']);
                    if($quoteItemCheck->getSize() == 0) {
                        $quoteFullObject = $this->quoteRepository->get($quote['entity_id']);
                        $quoteFullObject->delete();
                        echo "quote deleted";
                    }
                }
                $quote->collectTotals()->save();

            }
        }
    }
}