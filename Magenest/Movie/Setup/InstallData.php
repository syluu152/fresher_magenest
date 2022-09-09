<?php
namespace Magenest\Movie\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if($setup->getConnection()->isTableExists('magenest_director') == true){
            $data = [
                [
                    'name' => 'John'
                ],
                [
                    'name' => 'Steven'
                ],
            ];
            foreach ($data as $item){
                $setup->getConnection()->insert('magenest_director', $item);
            }
        }

        if($setup->getConnection()->isTableExists('magenest_movie') == true){
            $data = [
                [
                    'name' => 'Titanic',
                    'description' => 'Titanic Film',
                    'rating' => '5',
                    'director_id' => '1'
                ],
                [
                    'name' => 'End Game',
                    'description' => 'End Game Film',
                    'rating' => '4',
                    'director_id' => '2'
                ],
            ];
            foreach ($data as $item){
                $setup->getConnection()->insert('magenest_movie', $item);
            }
        }

        if($setup->getConnection()->isTableExists('magenest_actor') == true){
            $data = [
                [
                    'name' => 'David'
                ],
                [
                    'name' => 'Philip'
                ],
                [
                    'name' => 'Gavin'
                ],
            ];
            foreach ($data as $item){
                $setup->getConnection()->insert('magenest_actor', $item);
            }
        }

        if($setup->getConnection()->isTableExists('magenest_movie_actor') == true){
            $data = [
                [
                    'movie_id' => '1',
                    'actor_id' => '1'

                ],
                [
                    'movie_id' => '1',
                    'actor_id' => '2'

                ],
                [
                    'movie_id' => '1',
                    'actor_id' => '3'

                ],
                [
                    'movie_id' => '2',
                    'actor_id' => '1'
                ],
                [
                    'movie_id' => '2',
                    'actor_id' => '2'
                ],
            ];
            foreach ($data as $item){
                $setup->getConnection()->insert('magenest_movie_actor', $item);
            }
        }
        $setup->endSetup();
    }
}
