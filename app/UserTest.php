<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    protected $table = 'userTests';

    protected $fillable = [
        'ambulance', 'result', 'userID', 'covidTestID'
    ];

    public function covidTest()
    {
        return $this->belongsTo(CovidTest::class, 'covidTestID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}
