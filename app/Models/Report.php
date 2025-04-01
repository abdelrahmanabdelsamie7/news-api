<?php
namespace App\Models;
use App\Models\{Category,Author,ReportImage};
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory, UsesUuid;
    protected $fillable = ['title', 'content', 'image', 'category_id', 'is_trending', 'author_id'];
    protected $casts = [
        'is_trending' => 'boolean',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
    public function images()
    {
        return $this->hasMany(ReportImage::class);
    }
}
