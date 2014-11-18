<?php
namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * Test for AppBundle\Controller\BatterypackController
 *
 * @group functional
 */
class BatterypackControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Check statistics feature
     */
    public function testStatistics()
    {
        $this->client = static::createClient();
        $this->submitForm('AA', 4);
        $this->submitForm('AAA', 3);
        $this->submitForm('AA', 1);

        $crawler = $this->client->request('GET', '/');
        $this->assertEquals(1, $crawler->filterXPath(
            "//tr[td[normalize-space(text())='AA'] and td[normalize-space(text())='5']]")->count());
        $this->assertEquals(1, $crawler->filterXPath(
                "//tr[td[normalize-space(text())='AAA'] and td[normalize-space(text())='3']]")->count());
    }

    /**
     * @param $type
     * @param $amount
     */
    protected function submitForm($type, $amount)
    {
        $crawler = $this->client->request('GET', '/batterypack/new');

        $form = $crawler->selectButton('batterypack[save]')->form();
        $form->setValues(array(
            'batterypack[type]' => $type,
            'batterypack[amount]' => $amount,
        ));
        $this->client->submit($form);
    }
}
