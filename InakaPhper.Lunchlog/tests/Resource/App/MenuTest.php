<?php
/**
 * Created by PhpStorm.
 * User: phper
 * Date: 16/03/04
 * Time: 21:51
 */

namespace InakaPhper\Lunchlog\Resource\App;


class MenuTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \InakaPhper\Lunchlog\Resource\App\Menu
     */
    private $resource;

    protected function setUp()
    {
        parent::setUp();
        $this->resource = clone $GLOBALS['RESOURCE'];
    }

    /**
     * @corvers InakaPhper\Lunchlog\Resource\App\Menu::onGet
     */
    public function testOnGet()
    {
        $expected = [
            'id' => 1,
            'shop_id' => 1,
            'name' => 'rice',
            'type' => 'washoku'
        ];

        // resource request
        $page = $this->resource->get->uri('app://self/shop')->withQuery(['id' => 1])->eager->request();
        $this->assertSame(200, $page->code);

        $this->assertArraySubset($expected, $page['shop']);
    }

    /**
     * @corvers InakaPhper\Lunchlog\Resource\App\Menu::onGet
     */
    public function testOnPost()
    {
        $page = $this->resource->post->uri('app://self/shop')->withQuery(['shop_id' => 1, 'name' => 'bento', 'type' => 'okan'])->eager->request();
        $this->assertSame(201, $page->code);
    }

    /**
     * @corvers InakaPhper\Lunchlog\Resource\App\Menu::onPut
     */
    public function testOnPut()
    {
        $page = $this->resource->put->uri('app://self/shop')->withQuery(['id' => 1, 'shop_id' => 1, 'name' => 'katsudon', 'type' => 'washoku'])->eager->request();
        $this->assertSame(200, $page->code);
    }

    /**
     * @corvers InakaPhper\Lunchlog\Resource\App\Menu::onDelete
     */
    public function testOnDelete()
    {
        $page = $this->resource->delete->uri('app://self/shop')->withQuery(['id' => 1])->eager->request();
        $this->assertSame(200, $page->code);
    }
}
