<?php
namespace Magenest\Movie\Block;

use Magento\Framework\View\Element\Template;
use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory;

class MovieList extends Template
{
    protected $movieCollectionFactory;

    public function __construct(Template\Context $context, CollectionFactory $movieCollectionFactory)
    {
        $this->movieCollectionFactory = $movieCollectionFactory;
        parent::__construct($context);
    }

    public function getMovie(){
        $movie = $this->movieCollectionFactory->create()->joinTable();
        return $movie;
    }
}
