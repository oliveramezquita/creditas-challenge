<?php
namespace App\Models;
use CodeIgniter\Model;

class CarModel extends Model
{
    protected $table = 'car';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'model', 'price'];
}
