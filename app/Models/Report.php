<?php
namespace App\Models;
use App\traits\UsesUuid;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Category, Author, ReportImage,ShareIdea};
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory, UsesUuid;
    protected $fillable = ['title', 'content', 'image', 'category_id', 'is_trending', 'author_id'];
    protected $casts = [
        'is_trending' => 'boolean',
    ];
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($report) {
            foreach ($report->images as $image) {
                $imagePath = public_path("uploads/reports/" . basename($image->image));
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
            $report->images()->delete();
        });
    }
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
    public function ideas()
    {
        return $this->hasMany(ShareIdea::class);
    }
}
