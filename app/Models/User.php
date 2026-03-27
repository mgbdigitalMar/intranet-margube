<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name','email','password','role','department','position','phone','birthday'];
    protected $hidden   = ['password'];
    protected $casts    = ['birthday' => 'date'];

    public function isAdmin(): bool { return $this->role === 'admin'; }

    public function initials(): string
    {
        $parts = explode(' ', trim($this->name));
        $i = strtoupper(substr($parts[0], 0, 1));
        if (isset($parts[1])) $i .= strtoupper(substr($parts[1], 0, 1));
        return $i;
    }

    public function daysUntilBirthday(): ?int
    {
        if (!$this->birthday) return null;
        $today = now()->startOfDay();
        $bday  = $this->birthday->copy()->setYear($today->year);
        if ($bday->lt($today)) $bday->addYear();
        return (int) $today->diffInDays($bday);
    }

    public function news()             { return $this->hasMany(News::class); }
    public function roomReservations() { return $this->hasMany(RoomReservation::class); }
    public function carReservations()  { return $this->hasMany(CarReservation::class); }
    public function purchases()        { return $this->hasMany(PurchaseRequest::class); }
    public function absences()         { return $this->hasMany(Absence::class); }
}
