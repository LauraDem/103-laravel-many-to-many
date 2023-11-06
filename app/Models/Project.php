<?php

namespace App\Models;

use App\Models\Technology;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "content", 
        "type_id"
    ];

 

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function technologies() {
        return $this->belongsToMany(Technology::class, 'project_technology', 'project_id','technology_id');
    }

    public function getTypeBadge() {

        return $this->type ? " <span class='badge' style='background-color: {$this->type->color}'>{$this->type->label}</span>": 'Uncategorized';

}
public function getTecBadge() {

    return $this->technology ? " <span class='badge' style='background-color: {$this->technology->color}'>{$this->technology->label}</span>": 'Uncategorized';

}

    public function getAbstract($chars = 50) {
        return strlen($this->content) > $chars ? substr($this->content,0, $chars) . "..." : $this->content;
    }
}