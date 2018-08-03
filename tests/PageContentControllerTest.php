<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class PageContentControllerTest extends WebTestCase
{
    public function testPage()
    {
        $client = static::createClient();
        $client->request('GET', '/contact');
        self::assertEquals(200, $client->getResponse()->getStatusCode());
        self::assertContains(
            "м.Київ вул.Сармат тел. (044)-111-11-11 info@mail.com",
            $client->getResponse()->getContent()
        );
    }

}