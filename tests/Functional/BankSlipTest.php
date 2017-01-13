<?php

namespace Sergiors\Iugu\Tests\Functional\Iugu;

use Sergiors\Iugu\BankSlip;
use Sergiors\Iugu\Charge;
use Sergiors\Iugu\Credentials;
use Sergiors\Iugu\Item;
use Sergiors\Iugu\ItemCollection;
use Sergiors\Iugu\Payer\Payer;
use Sergiors\Iugu\Payer\Phone;
use Sergiors\Iugu\Payer\Address;

class BankSlipTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldReturnSuccess()
    {
        $faker = \Faker\Factory::create();
        $postcode = preg_replace('/\D/', '', $faker->postcode);

        $items = new ItemCollection(...[
            new Item('Item 1', 10.00),
            new Item('Item 2', 20.50),
        ]);
        $address = new Address(
            $faker->streetName,
            $faker->buildingNumber,
            $faker->city,
            $faker->stateAbbr,
            $faker->country,
            $postcode
        );
        $phone = new Phone($faker->randomNumber(2), $faker->randomNumber());
        $payer = new Payer(
            $faker->name,
            $faker->email,
            $faker->randomNumber(),
            $phone,
            $address
        );
        $charge = new Charge($payer, $items);
        $bankSlip = new BankSlip(new Credentials(getenv('IUGU_API_KEY'), getenv('IUGU_EMAIL')), $charge);

        $response = $bankSlip->getResponse();

        $this->assertArrayHasKey('success', $response);
    }
}
