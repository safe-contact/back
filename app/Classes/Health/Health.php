<?php

namespace App\Classes\Health;

use App;

class Health{
    public bool $isSick;
    public bool $hasSymptom;
    public bool $meetIsSick;
    public bool $meetHasSymptom;

    public function __construct(bool $isSick, bool $hasSymptom, bool $hasRecovered)
    {
        $this->isSick = $isSick;
        $this->hasSymptom = $hasSymptom;
        $this->hasRecovered = $hasRecovered;
        $this->meetIsSick = false;
        $this->meetHasSymptom = false;
    }

    public function getMessage(string $locale): string
    {
        App::setLocale($locale);
        if($this->hasRecovered){
            return trans('safe.recovered');
        }
        if($this->isSick){
            return trans('safe.isSick');
        }
        if($this->hasSymptom){
            return trans('safe.hasSymptom');
        }
        if($this->meetIsSick){
            return trans('safe.meetIsSick');
        }
        if($this->meetHasSymptom){
            return trans('safe.meetHasSymptom');
        }
        return trans('safe.ok');
    }

    public function summary(string $locale)
    {
        return [
            'isDiagnostic' => $this->isSick,
            'hasSymptom' => $this->hasSymptom,
            'message' => $this->getMessage($locale)
        ];
    }
}
