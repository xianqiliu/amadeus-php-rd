<?php

declare(strict_types=1);

namespace Amadeus\Tests;

use Amadeus\Amadeus;
use Amadeus\AmadeusBuilder;
use Amadeus\Client\BasicHTTPClient;
use Amadeus\Configuration;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Amadeus\Amadeus
 * @covers \Amadeus\AmadeusBuilder
 * @covers \Amadeus\Airport
 * @covers \Amadeus\Airport\DirectDestinations
 * @covers \Amadeus\Booking
 * @covers \Amadeus\Booking\FlightOrders
 * @covers \Amadeus\Booking\HotelBookings
 * @covers \Amadeus\Client\AccessToken
 * @covers \Amadeus\Client\BasicHTTPClient
 * @covers \Amadeus\Configuration
 * @covers \Amadeus\ReferenceData
 * @covers \Amadeus\ReferenceData\Locations
 * @covers \Amadeus\ReferenceData\Locations\Hotel
 * @covers \Amadeus\ReferenceData\Locations\Hotels
 * @covers \Amadeus\ReferenceData\Locations\Hotels\ByCity
 * @covers \Amadeus\ReferenceData\Locations\Hotels\ByGeocode
 * @covers \Amadeus\ReferenceData\Locations\Hotels\ByHotels
 * @covers \Amadeus\Shopping
 * @covers \Amadeus\Shopping\Availability
 * @covers \Amadeus\Shopping\Availability\FlightAvailabilities
 * @covers \Amadeus\Shopping\FlightOffers
 * @covers \Amadeus\Shopping\FlightOffers\Pricing
 * @covers \Amadeus\Shopping\HotelOffer
 * @covers \Amadeus\Shopping\HotelOffers
 */
final class AmadeusBuilderTest extends TestCase
{
    private Amadeus $amadeus;
    private AmadeusBuilder $amadeusBuilder;
    private BasicHTTPClient $httpClient;

    /**
     * @Before
     */
    public function setUp(): void
    {
        $configuration = new Configuration('id', 'secret');
        $this->httpClient = new BasicHTTPClient($configuration);
        $this->amadeusBuilder = new AmadeusBuilder($configuration);

        $this->amadeus = $this->amadeusBuilder
            ->setSsl(true)
            ->setPort(8080)
            ->setHost('localhost')
            ->setHttpClient($this->httpClient)
            ->setTimeout(20)
            ->build();
    }

    public function testInitialize(): void
    {
        $configuration = $this->amadeus->getConfiguration();
        $this->assertTrue($configuration->isSsl());
        $this->assertEquals(8080, $configuration->getPort());
        $this->assertEquals('localhost', $configuration->getHost());
        $this->assertEquals($this->httpClient, $this->amadeus->getConfiguration()->getHttpClient());
        $this->assertEquals(20, $this->amadeus->getConfiguration()->getTimeout());
    }

    public function testBuildWithProductionEnvironment(): void
    {
        $this->amadeus = $this->amadeusBuilder->setProductionEnvironment()->build();
        $configuration = $this->amadeus->getConfiguration();
        $this->assertEquals('api.amadeus.com', $configuration->getHost());
    }
}
