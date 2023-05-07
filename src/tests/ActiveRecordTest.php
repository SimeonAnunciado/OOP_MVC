<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once 'src/DatabaseConnection.php';
require_once 'src/Entity.php';
require_once './modules/page/models/Page.php';

final class ActiveRecordTest extends TestCase
{
    public function testFindAll(): void
    {
        $dbc = DatabaseConnection::getConnection();
        $page = new Page($dbc);
        $result = $page->findAll();
        $this->assertEquals(3,count($result));
    }
}
