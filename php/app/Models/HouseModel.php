<?php
namespace App\Models;
use CodeIgniter\Model;

class HouseModel extends Model
{
    protected $table = 'house';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'value', 'address', 'zipcode', 'city', 'state'];
}
