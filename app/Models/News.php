<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table    = 'news';
    protected $fillable = ['user_id','type','title','body','event_date'];
    protected $casts    = ['event_date' => 'datetime'];

    public function author() { return $this->belongsTo(User::class, 'user_id'); }

    public function typeBadge(): string
    {
        return $this->type === 'evento' ? '🎉 Evento' : '📰 Noticia';
    }
    public function typeColor(): string
    {
        return $this->type === 'evento' ? 'tag-purple' : 'tag-blue';
    }
}
