<?php
namespace App\Models;
use App\Models\Report;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'authors';
    protected $fillable = ['image','name'];
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
