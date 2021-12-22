<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserTest extends Model
{
    use Notifiable, HasApiTokens;

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
