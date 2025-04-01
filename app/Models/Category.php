<?php
namespace App\Models;
use App\Models\Report;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'categories';
    protected $fillable = ['title'];
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
