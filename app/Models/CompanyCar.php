<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CompanyCar extends Model
{
    protected $fillable = ['name','plate','model'];

    public function fullName(): string
    {
        return "{$this->name} ({$this->plate})";
    }
}
