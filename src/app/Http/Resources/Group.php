<?php

namespace LaravelEnso\ControlPanelCommon\App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use LaravelEnso\Helpers\App\Classes\Obj;

class Group extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id(),
            'label' => $this->label(),
            'statistics' => Sensor::collection($this->sensors($request)),
            'order' => $this->order(),
        ];
    }

    private function sensors($request)
    {
        return (new Collection($this->statistics()))
            ->map(fn ($stat) => App::make($stat, [
                'params' => new Obj($request->all()),
            ]));
    }
}
