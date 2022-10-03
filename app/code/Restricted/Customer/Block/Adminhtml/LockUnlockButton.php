<?php 
namespace Restricted\Customer\Block\Adminhtml;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Customer\Block\Adminhtml\Edit\GenericButton;

class LockUnlockButton extends GenericButton implements ButtonProviderInterface
{
   protected $_customerRepository;

    /**
     * @var AccountManagementInterface
     */
    protected $customerAccountManagement;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param AccountManagementInterface $customerAccountManagement
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context               $context,
        \Magento\Framework\Registry                         $registry,
        \Magento\Customer\Api\AccountManagementInterface    $customerAccountManagement,
        \Magento\Customer\Api\CustomerRepositoryInterface   $customerRepository
    ) {
        parent::__construct($context, $registry);
        $this->customerAccountManagement    = $customerAccountManagement;
        $this->_customerRepository          = $customerRepository;
    }

    public function getButtonData()
    {
        $customerId = $this->getCustomerId();

        // get customer
        $customer = $this->_customerRepository->getById($customerId);
        return [
            'label' => __('Lock / Unlock'),
            'on_click' => sprintf("location.href = '%s';", $this->getCustomUrl()),
            'sort_order' => 100
        ];
    }
    public function getCustomUrl()
    {
        return $this->getUrl('Restricted_Customer/index/lockunlock', ['customer_id' => $this->getCustomerId()]);
    }
}