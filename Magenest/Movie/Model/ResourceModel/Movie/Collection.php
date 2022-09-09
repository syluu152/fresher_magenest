<?php
namespace Magenest\Movie\Model\ResourceModel\Movie;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\InventoryReservationsApi\Model\ReservationInterface;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Magenest\Movie\Model\Movie',
            'Magenest\Movie\Model\ResourceModel\Movie'
        );
    }
    public function joinTable(){
        $actorTable = $this->getTable('magenest_actor');
        $actormovieTable = $this->getTable('magenest_movie_actor');
        $directorTable = $this->getTable('magenest_director');
        $result = $this
            ->addFieldToSelect('name','movie')
            ->addFieldToSelect('name','movie')
            ->addFieldToSelect('description')
            ->addFieldToSelect('rating')
            ->join($directorTable, 'main_table.director_id='.$directorTable.'.director_id',['director' => 'name'])
            ->join($actormovieTable,'main_table.movie_id='.$actormovieTable.'.movie_id',null)
            ->join($actorTable,$actorTable.'.actor_id='.$actormovieTable.'.actor_id',['actor' => new \Zend_Db_Expr("GROUP_CONCAT($actorTable.name)")])
            ->getSelect()
            ->group('main_table.movie_id');
            return $this->getConnection()->fetchAll($result);
    }

}
