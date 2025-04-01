<?php
namespace App\Models;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Subscriber extends Model
{
    use HasFactory, UsesUuid;
    protected $table = 'subscribers';
    protected $fillable = ['email'];
}
