<?php

namespace App\Models;

use Carbon\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Intl\Currencies;
use Symfony\Component\Intl\Languages;
use Symfony\Component\Intl\Timezones;

class Setting extends Model
{
    use HasFactory;

    protected $primaryKey = 'name';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name' , 'value'
    ];



    public function localeOptions()
    {
        return Languages::getNames();
    }


    public function currencyOptions()
    {
        $currences =[];
        foreach(Currencies::getNames() as $code => $name)
        {
            $$currences[$code] = "$code - $name";
        }
        return $currences;
    }

    public function timezoneOptions()
    {
        return Timezones::getNames();
    }
}
