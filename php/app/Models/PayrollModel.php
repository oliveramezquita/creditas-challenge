<?php
namespace App\Models;
use CodeIgniter\Model;

class PayrollModel extends Model
{
    protected $table = 'payroll';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'company', 'date_admission'];
}
