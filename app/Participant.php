<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'age_group', 'start_number', 'name', 'surname', 'total_points'
    ];

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function calculateAgeGroup(int $birthYear): string
    {
        switch ($birthYear) {
            case (in_array($birthYear, range(2010, 2012))):
                return '3';
            case (in_array($birthYear, range(2008, 2009))):
                return '5';
            case (in_array($birthYear, range(2006, 2007))):
                return '7';
            case (in_array($birthYear, range(2004, 2005))):
                return '9';
            case (2003):
                return '10';
            case (in_array($birthYear, range(2001, 2002))):
                return '12';
            case (in_array($birthYear, range(1999, 2000))):
                return '14';
            case (in_array($birthYear, range(1997, 1998))):
                return '16';
            case (in_array($birthYear, range(1995, 1996))):
                return '18';
            case (in_array($birthYear, range(1993, 1994))):
                return '20';
            case (in_array($birthYear, range(1979, 1992))):
                return '21';
            case (in_array($birthYear, range(1974, 1978))):
                return '35';
            case (in_array($birthYear, range(1969, 1973))):
                return '40';
            case (in_array($birthYear, range(1964, 1968))):
                return '45';
            case (in_array($birthYear, range(1959, 1963))):
                return '50';
            case (in_array($birthYear, range(1954, 1958))):
                return '55';
            case (in_array($birthYear, range(1949, 1953))):
                return '60';
            case (in_array($birthYear, range(1944, 1948))):
                return '65';
            case (in_array($birthYear, range(1939, 1943))):
                return '70';
            case (in_array($birthYear, range(1934, 1938))):
                return '75';
            case ($birthYear <= 1933):
                return '80';
            default:
                return false;
        }
    }
}
