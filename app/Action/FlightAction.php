<?php
namespace App\Action;

use App\DataTransferObject\FlightDTO;
use App\Models\Flight;
use App\UseCase\Flight\IScale;
use Illuminate\Support\Collection;

class FlightAction
{
    public function __construct(private readonly IScale $scale)
    {
    }

    /**
     * @param FlightDTO $flightDTO
     * @return array[]
     */
    public function execute(FlightDTO $flightDTO): array
    {
        $direct = Flight::query()->getFlight($flightDTO, null,  2, true);

        return [
            "departures" => [
                "direct" => $direct,
                "scale" => $this->scale->filter($flightDTO),
            ],
            "return" => [
                "direct" => $this->getReturn($flightDTO),
                "scale" => $this->scale->filter($flightDTO),
            ]
        ];
    }

    /**
     * @param FlightDTO $flightDTO
     * @return Collection
     */
    private function getReturn(FlightDTO $flightDTO): Collection
    {
        $this->getReturnData($flightDTO);
        return Flight::query()->getFlight($flightDTO, null,  2, true);
    }

    /**
     * @param FlightDTO $flightDTO
     * @return void
     */
    private function  getReturnData(FlightDTO $flightDTO): void
    {
        $departure = $flightDTO->arrival_airport;
        $arrival =  $flightDTO->departure_airport;
        $flightDTO->departure_airport = $departure;
        $flightDTO->arrival_airport = $arrival;
    }
}
