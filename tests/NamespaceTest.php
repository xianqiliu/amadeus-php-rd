<?php

declare(strict_types=1);

namespace Amadeus\Tests;

use Amadeus\Amadeus;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Amadeus\Configuration
 * @covers \Amadeus\Amadeus
 * @covers \Amadeus\AmadeusBuilder
 * @covers \Amadeus\Client\BasicHTTPClient
 * @covers \Amadeus\Client\AccessToken
 * @covers \Amadeus\Resources\Resource
 * @covers \Amadeus\Airport
 * @covers \Amadeus\Airport\DirectDestinations
 * @covers \Amadeus\Booking
 * @covers \Amadeus\Booking\FlightOrders
 * @covers \Amadeus\Booking\HotelBookings
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
final class NamespaceTest extends TestCase
{
    public function testAllNamespacesExist(): void
    {
        $amadeus = Amadeus::builder("id", "secret")->build();

        // Airport
        $this->assertNotNull($amadeus->getAirport());
        $this->assertNotNull($amadeus->getAirport()->getDirectDestinations());

        // Booking
        $this->assertNotNull($amadeus->getBooking());
        $this->assertNotNull($amadeus->getBooking()->getFlightOrders());
        $this->assertNotNull($amadeus->getBooking()->getHotelBookings());

        // Shopping
        $this->assertNotNull($amadeus->getShopping());
        $this->assertNotNull($amadeus->getShopping()->getAvailability());
        $this->assertNotNull($amadeus->getShopping()->getAvailability()->getFlightAvailabilities());
        $this->assertNotNull($amadeus->getShopping()->getFlightOffers());
        $this->assertNotNull($amadeus->getShopping()->getFlightOffers()->getPricing());
        $this->assertNotNull($amadeus->getShopping()->getHotelOffer());
        $this->assertNotNull($amadeus->getShopping()->getHotelOffers());

        // ReferenceData
        $this->assertNotNull($amadeus->getReferenceData());
        $this->assertNotNull($amadeus->getReferenceData()->getLocations());
        $this->assertNotNull($amadeus->getReferenceData()->getLocations()->getHotel());
        $this->assertNotNull($amadeus->getReferenceData()->getLocations()->getHotels());
        $this->assertNotNull($amadeus->getReferenceData()->getLocations()->getHotels()->getByCity());
        $this->assertNotNull($amadeus->getReferenceData()->getLocations()->getHotels()->getByGeocode());
        $this->assertNotNull($amadeus->getReferenceData()->getLocations()->getHotels()->getByHotels());
    }
}
