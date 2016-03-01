<?php
/**
 * Created by PhpStorm.
 * User: phper
 * Date: 16/02/14
 * Time: 2:58
 */

namespace InakaPhper\Lunchlog\Resource\App;


class ShopTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \InakaPhper\Lunchlog\Resource\App\Shop
     */
    private $resource;

    protected function setUp()
    {
        parent::setUp();
        $this->resource = clone $GLOBALS['RESOURCE'];
    }

    /**
     * @corvers InakaPhper\Lunchlog\Resource\App\Shop::onGet
     */
    public function testOnGet()
    {
        $expected = [
            'id' => 1,
            'name' => '魁龍',
            'address' => '北九州'
        ];

        // resource request
        $page = $this->resource->get->uri('app://self/shop')->withQuery(['id' => 1])->eager->request();
        $this->assertSame(200, $page->code);

        $this->assertArraySubset($expected, $page['shop']);
    }

    /**
     * @corvers InakaPhper\Lunchlog\Resource\App\Shop::onGet
     */
    public function testOnPost()
    {
        $page = $this->resource->post->uri('app://self/shop')->withQuery(['name' => '赤のれん', 'address' => '福岡市'])->eager->request();
        $this->assertSame(201, $page->code);
    }

    /**
     * @corvers InakaPhper\Lunchlog\Resource\App\Shop::onPut
     */
    public function testOnPut()
    {
        $page = $this->resource->put->uri('app://self/shop')->withQuery(['id' => 1, 'name' => '赤のれん', 'address' => '福岡市'])->eager->request();
        $this->assertSame(200, $page->code);
    }

    /**
     * @corvers InakaPhper\Lunchlog\Resource\App\Shop::onDelete
     */
    public function testOnDelete()
    {
        $page = $this->resource->delete->uri('app://self/shop')->withQuery(['id' => 1])->eager->request();
        $this->assertSame(200, $page->code);
    }
}
