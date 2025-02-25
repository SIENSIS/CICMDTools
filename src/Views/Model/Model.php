@php namespace {namespace}\Models;

use CodeIgniter\Model;

/**
 * {! name !} Model
 */
class {! name !} extends Model
{
    protected $table      = '{! table !}';
    protected $primaryKey = '{! primaryKey !}';
    //    protected $useAutoIncrement = true;
    protected $returnType = '{! returnType !}';
    protected $useSoftDeletes = {! useSoftDeletes !};
    protected $protectFields    = true;
    protected $allowedFields = [{! allowedFields !}];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;

    // protected array $casts = [];
    // protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = {! useTimestamps !};
    protected $createdField  = '{! createdField !}';
    protected $updatedField  = '{! updatedField !}';
    protected $deletedField  = 'deleted_at';
    protected $dateFormat    = '{! dateFormat !}';

    // Validation
    protected $validationRules    = {! validationRules !};
    protected $validationMessages = [];
    protected $skipValidation     = false;
    protected $cleanValidationRules = true;

    // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];
}
