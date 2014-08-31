<?php
namespace Stas\RecycleBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test for Stas\RecycleBundle\Controller\BatterypackController
 *
 * @group functional
 */
class BatterypackControllerTest extends WebTestCase
{
    /**
     * Check statistics feature
     */
    public function testStatistics()
    {
        $this->submitForm('AA', 4);
        $this->submitForm('AAA', 3);
        $this->submitForm('AA', 1);

        $client = static::createClient();
        $crawler = $client->request('GET', '/');
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
        $client = static::createClient();
        $crawler = $client->request('GET', '/batterypack/new');

        $form = $crawler->selectButton('form[save]')->form();
        $form->setValues(array(
            'form[type]' => $type,
            'form[amount]' => $amount,
        ));
        $client->submit($form);
    }
}
