<?php

namespace Prokl\CustomRequestResponserBundle\Tests\Cases;

use Prokl\CustomRequestResponserBundle\Services\IndexRoutesManager\AdminRouteProcessor;

/**
 * Class AdminRouteProcessorTest
 * @package Prokl\CustomRequestResponserBundle\Tests\Cases
 *
 * @since 21.02.2021
 */
class AdminRouteProcessorTest extends BaseTestCase
{
    /**
     * @var AdminRouteProcessor $testObject Тестируемый объект.
     */
    protected $testObject;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->testObject = new AdminRouteProcessor();
    }

    /**
     * shouldIndex(). URL, не подлежащий индексации.
     *
     * @return void
     */
    public function testShouldIndexNotIndexing() : void
    {
        $request = $this->getRequest('/api/fake/');

        $this->assertFalse(
            $this->testObject->shouldIndex($request)
        );
    }

    /**
     * shouldIndex(). URL, подлежащий индексации.
     *
     * @return void
     */
    public function testShouldIndexIndexing() : void
    {
        $request = $this->getRequest('/simple_path/');

        $this->assertTrue(
            $this->testObject->shouldIndex($request)
        );
    }
}