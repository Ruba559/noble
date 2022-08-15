<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Property extends Model
{
    use HasFactory;
    use Translatable;

    protected $translatable = ['name' , 'type' , 'title' , 'description' , 'adress' , 'floor' , 'divider' , 'seo_title' , 'seo_description'];

    
   
    protected $table = 'properties';

    
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function cladding()
    {
        return $this->belongsTo(Cladding::class);
    }


    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }


    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }


}
