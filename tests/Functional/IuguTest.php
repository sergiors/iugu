<?php

namespace Sergiors\Iugu\Tests\Functional\Iugu;

use Sergiors\Iugu\Iugu;
use Sergiors\Iugu\BankSlip;
use Sergiors\Iugu\Charge;
use Sergiors\Iugu\Credentials;
use Sergiors\Iugu\Item;
use Sergiors\Iugu\ItemCollection;
use Sergiors\Iugu\Payer\Payer;
use Sergiors\Iugu\Payer\Phone;
use Sergiors\Iugu\Payer\Address;
use Sergiors\Iugu\PaymentFormatter;
use Sergiors\Iugu\Invoice\ResponseInterface;

class IuguTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldReturnSuccess()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $faker->addProvider(new \Faker\Provider\pt_BR\Address($faker));
        $postcode = 88034000;
        $cpf = preg_replace('/\D/', '', $faker->cpf);

        $items = new ItemCollection(...[
            new Item('Item 1', 10.00),
            new Item('Item 2', 20.50),
        ]);
        $address = new Address(
            $faker->streetName,
            $faker->buildingNumber,
            $faker->word,
            $faker->city,
            $faker->stateAbbr,
            $faker->country,
            $postcode
        );
        $phone = new Phone($faker->randomNumber(2), $faker->randomNumber());
        $payer = new Payer(
            $faker->name,
            $faker->email,
            $cpf,
            $phone,
            $address
        );
        $charge = new Charge($payer, $items);
        $credentials = new Credentials(getenv('IUGU_API_KEY'), getenv('IUGU_EMAIL'));
        $paymentFormatter = new PaymentFormatter($charge, new BankSlip());
        $iugu = new Iugu($credentials, $paymentFormatter);

        $this->assertInstanceOf(ResponseInterface::class, $iugu->doInvoice());
    }
}
