<?php 

namespace Icreative\Moduletest\Plugin;
use Magento\Framework\Data\Tree\NodeFactory;
use Magento\Framework\UrlInterface;

class GetHtml{

	 /**
     * @var NodeFactory
     */
    protected $nodeFactory;
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;
    /**
     * @param NodeFactory  $nodeFactory
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        NodeFactory $nodeFactory,
        UrlInterface $urlBuilder
    ) {
        $this->nodeFactory = $nodeFactory;
        $this->urlBuilder = $urlBuilder;
    }
    public function beforeGetHtml(
        \Magento\Theme\Block\Html\Topmenu $subject,
        $outermostClass = '',
        $childrenWrapClass = '',
        $limit = 0
    ) {
        /**
         * Level1 Menu
         */
        $menuNode = $this->nodeFactory->create(
            [
                'data' => $this->getNodeAsArray("Men", "men.html"),
                'idField' => 'id',
                'tree' => $subject->getMenu()->getTree(),
            ]
        );
        /**
         * Level1-1 Child Menu
         */
        $menuNode->addChild(
            $this->nodeFactory->create(
                [
                    'data' => $this->getNodeAsArray("Child Menu", "child.html"),
                    'idField' => 'id',
                    'tree' => $subject->getMenu()->getTree(),
                ]
            )
        );
        $subject->getMenu()->addChild($menuNode);
    }
    protected function getNodeAsArray($name, $id) {
        $url = $this->urlBuilder->getUrl($id);
        return [
            'name' => __($name),
            'id' => $id,
            'url' => $url,
            'has_active' => false,
            'is_active' => false,
        ];
    }

}

?>