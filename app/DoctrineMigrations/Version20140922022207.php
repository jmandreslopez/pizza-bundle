<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140922022207 extends AbstractMigration
{
    /**
     * Creates the initial DB schema
     *
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE IF NOT EXISTS `customers` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `firstname` VARCHAR(255) NOT NULL,
            `lastname` VARCHAR(255) NOT NULL,
            `phone` varchar(50) NOT NULL,
            `address` text NOT NULL,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `phone` (`phone`)
          )");

        $this->addSql("CREATE TABLE IF NOT EXISTS `sizes` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `size` varchar(50) NOT NULL,
            `is_active` tinyint(1) NULL DEFAULT '1',
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `size` (`size`)
          )");

        $this->addSql("INSERT INTO `sizes` (`id`, `size`, `is_active`, `created_at`) VALUES
            (1, 'Small', 1, NOW()),
            (2, 'Medium', 1, NOW()),
            (3, 'Large', 1, NOW())");

        $this->addSql("CREATE TABLE IF NOT EXISTS `orders` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `customer_id` int(11) NOT NULL,
            `ingredient_1` tinyint(1) NOT NULL DEFAULT '0',
            `ingredient_2` tinyint(1) NOT NULL DEFAULT '0',
            `ingredient_3` tinyint(1) NOT NULL DEFAULT '0',
            `size_id` int(11) NOT NULL,
            `delivered` TINYINT(1) NULL DEFAULT '0',
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            KEY `customer` (`customer_id`),
            KEY `size` (`size_id`),
            CONSTRAINT `customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
            CONSTRAINT `size` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`)
          )");
    }

    /**
     * Drop all tables
     *
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("SET FOREIGN_KEY_CHECKS = 0");
        $this->addSql("DROP TABLE `customers`");
        $this->addSql("DROP TABLE `sizes`");
        $this->addSql("DROP TABLE `orders`");
        $this->addSql("SET FOREIGN_KEY_CHECKS = 1");
    }
}
