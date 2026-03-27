<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CarReservation extends Model
{
    protected $fillable = ['user_id','car','date','hour','destination','reason','status'];
    protected $casts    = ['date' => 'date'];

    public function user() { return $this->belongsTo(User::class); }
}
