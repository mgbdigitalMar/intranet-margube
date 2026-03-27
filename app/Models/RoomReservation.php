<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RoomReservation extends Model
{
    protected $fillable = ['user_id','room','date','hour','duration','reason','status'];
    protected $casts    = ['date' => 'date'];

    public function user() { return $this->belongsTo(User::class); }
}
