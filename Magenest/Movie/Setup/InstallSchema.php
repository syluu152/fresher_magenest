<?php

namespace Magenest\Movie\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        if (!$installer->tableExists('magenest_director')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_director')
            )
                ->addColumn(
                    'director_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                        'unsigned' => true,
                    ],
                    'Director ID'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Director Name'
                )
                ->setComment('Magenest Director');
            $installer->getConnection()->createTable($table);
        }

        if (!$installer->tableExists('magenest_movie')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_movie')
            )
                ->addColumn(
                    'movie_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                        'unsigned' => true,
                    ],
                    'Movie ID'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Movie Name'
                )
                ->addColumn(
                    'description',
                    Table::TYPE_TEXT,
                    255,
                    [],
                    'Description'
                )
                ->addColumn(
                    'rating',
                    Table::TYPE_INTEGER,
                    1,
                    [],
                    'Rating'
                )
                ->addColumn(
                    'director_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable' => false,
                        'unsigned' => true,
                    ],
                    'Director ID'
                )
                ->addForeignKey(
                    $installer->getFkName('magenest_movie', 'director_id', 'magenest_director', 'director_id'),
                    'director_id',
                    $installer->getTable('magenest_director'),
                    'director_id',
                    Table::ACTION_CASCADE
                )
                ->setComment('Magenest Movie Table');
            $installer->getConnection()->createTable($table);
        }

        if (!$installer->tableExists('magenest_actor')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_actor')
            )
                ->addColumn(
                    'actor_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                        'unsigned' => true,
                    ],
                    'Actor ID'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Actor Name'
                )
                ->setComment('Magenest Actor');
            $installer->getConnection()->createTable($table);
        }

        if (!$installer->tableExists('magenest_movie_actor')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_movie_actor')
            )
                ->addColumn(
                    'movie_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable' => false,
                        'unsigned' => true,
                    ],
                    'Movie ID'
                )
                ->addColumn(
                    'actor_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable' => false,
                        'unsigned' => true,
                    ],
                    'Actor ID'
                )
                ->addForeignKey(
                    $installer->getFkName('magenest_movie_actor', 'movie_id', 'magenest_movie', 'movie_id'),
                    'movie_id',
                    $installer->getTable('magenest_movie'),
                    'movie_id',
                    Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $installer->getFkName('magenest_movie_actor', 'actor_id', 'magenest_actor', 'actor_id'),
                    'actor_id',
                    $installer->getTable('magenest_actor'),
                    'actor_id',
                    Table::ACTION_CASCADE
                )
                ->setComment('Magenest Movie Actor');
            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}
