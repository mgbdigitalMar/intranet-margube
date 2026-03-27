<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $fillable = ['user_id','item','quantity','reason','estimated_price','status','admin_notes'];

    public function user() { return $this->belongsTo(User::class); }
}
