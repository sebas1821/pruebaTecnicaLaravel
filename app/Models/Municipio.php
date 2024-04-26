<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'municipios';

    protected $fillable = ['id_municipio','municipio','estado','id_departamento'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientes()
    {
        return $this->hasMany('App\Models\Cliente', 'ciudad', 'id_municipio');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function departamento()
    {
        return $this->hasOne('App\Models\Departamento', 'id_departamento', 'id_departamento');
    }
    
}
