<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\CircularDependencyException;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FlightCollection extends ResourceCollection
{

    private Direct $direct;
    private FlightScale $scale;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->direct = resolve(Direct::class);
        $this->scale = resolve(FlightScale::class);
    }

    /**
     * @throws CircularDependencyException
     * @throws BindingResolutionException
     */
    public function toArray($request): array
    {
        return [
            $this->direct->build($this->collection->get("direct"), $request),
            $this->scale->build($this->collection->get("scale"), $request)
        ];
    }
}
