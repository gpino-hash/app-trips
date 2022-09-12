<?php

namespace App\Http\Controllers;

use App\Action\FlightAction;
use App\DataTransferObject\FlightDTO;
use App\Http\Resources\FlightCollection;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{

    public function __construct(private readonly FlightAction $action)
    {
    }

    public function index(Request $request)
    {
        return FlightCollection::collection($this->action->execute(FlightDTO::from($request->all())));
    }
}
