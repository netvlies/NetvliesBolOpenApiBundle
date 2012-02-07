<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Tests\Model;

use Netvlies\Bundle\BolOpenApiBundle\Model\Product;

class ProductTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Netvlies\Bundle\BolOpenApiBundle\Model\Product
     */
    private $product;

    public function setUp()
    {
        $simpleXmlElement = new \SimpleXMLElement(__DIR__.'/../fixtures/product.xml', 0 , true);
        $this->product = new Product($simpleXmlElement);
    }

    public function testIsProduct()
    {
        $this->assertTrue($this->product instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Product);
    }

    public function testIsValid()
    {
        $this->assertEquals($this->product->getId(), '1001004011586273');
        $this->assertEquals($this->product->getTitle(), 'De Hobbit');
        $this->assertEquals($this->product->getType(), 'book');
        $this->assertEquals($this->product->getPublisher(), 'Boekerij');
        $this->assertEquals(utf8_decode($this->product->getShortDescription()), html_entity_decode(utf8_decode('Op een dag komen er zomaar dertien dwergen op bezoek bij meneer Bilbo Balings, vergezeld door de beroemde tovenaar Gandalf. Ze komen een feestje vieren in z&#195;&#173;jn hobbithol; een afscheidsfeestje welteverstaan. De volgende dag gaat de groep op reis om in het oude Moria een schat te zoeken. Tot zijn grote schrik stelt Gandalf voor dat Bilbo meegaat als het veertiende lid van de expeditie. Voor hij het weet, is hij op avontuur en komt hij in aanraking met trollen, reusachtige wolven, spinnen, aardmannen en niet te vergeten de oude draak Smaug. Zo wordt Bilbo de meest wereldwijze hobbit ooit. &lt;br/&gt;&lt;br/&gt;')));
        $this->assertEquals(utf8_decode($this->product->getLongDescription()), html_entity_decode(utf8_decode('Op een dag komen er zomaar dertien dwergen op bezoek bij meneer Bilbo Balings, vergezeld door de beroemde tovenaar Gandalf. Ze komen een feestje vieren in z&#195;&#173;jn hobbithol; een afscheidsfeestje welteverstaan. De volgende dag gaat de groep op reis om in het oude Moria een schat te zoeken. Tot zijn grote schrik stelt Gandalf voor dat Bilbo meegaat als het veertiende lid van de expeditie. Voor hij het weet, is hij op avontuur en komt hij in aanraking met trollen, reusachtige wolven, spinnen, aardmannen en niet te vergeten de oude draak Smaug. Zo wordt Bilbo de meest wereldwijze hobbit ooit. &lt;br/&gt;&lt;br/&gt;')));
        $this->assertEquals($this->product->getReleaseDate(), '2011-07-27+02:00');
        $this->assertEquals($this->product->getEan(), '9789022561942');
        $this->assertTrue($this->product->getOffers() instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Offers);
        $this->assertTrue($this->product->getUrls() instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Urls);
        // @todo test promotions and other uncovered properties
    }

}