<?php namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ClientModel;
use App\Models\CarModel;
use App\Models\HouseModel;
use App\Models\PayrollModel;

class Client extends ResourceController
{
    use ResponseTrait;

    // all clients by type
    public function clients($type = ''){
      $model = new ClientModel();
      $data = $model->where('type', $type)->findAll();
      return $data;
    }

    // insert client
    public function create_client($data = array(), $type = '', $status = 0) {
        $db = \Config\Database::connect();
        $builder = $db->table('clients');
        $builder->insert([
          'name'    => $data['name'],
          'phone'   => $data['phone'],
          'email'   => $data['email'],
          'rfc'     => $data['rfc'],
          'address' => $data['address'],
          'zipcode' => $data['zipcode'],
          'city'    => $data['city'],
          'state'   => $data['state'],
          'type'    => $type,
          'status'  => $status
        ]);
        return $db->insertID();
    }

    // client rules
    public function client_rules()
    {
      return [
        'name'    => 'required|max_length[150]',
        'phone'   => 'required|numeric|max_length[10]',
        'email'   => 'required|valid_email',
        'rfc'     => 'required|alpha_numeric|max_length[13]',
        'address' => 'required|max_length[255]',
        'zipcode' => 'required|numeric|max_length[5]',
        'city'    => 'required|max_length[50]',
        'state'   => 'required|max_length[50]'
      ];
    }

    public function show($id = 0)
  	{
      $model = new ClientModel();
      $client = $model->find($id);
      if($id > 0 && isset($client)) {
        switch ($client['type']) {
          case 'car':
            $model_car = new CarModel();
            $additional = $model_car->where('client_id', $client['id'])->first();
            $additional['price'] = number_format($additional['price'], 2, '.', ',');
            break;
          case 'house':
            $model_house = new HouseModel();
            $house = $model_house->where('client_id', $client['id'])->first();
            $additional = array(
              'value'      => number_format($house['value'], 2, '.', ','),
              'ug_address' => $house['address'],
              'ug_zipcode' => $house['zipcode'],
              'ug_city'    => $house['city'],
              'ug_state'   => $house['state']
            );
            break;
          case 'payroll':
            $model_payroll = new PayrollModel();
            $additional = $model_payroll->where('client_id', $client['id'])->first();
            break;
        }
        $data = array_merge($client, $additional);
        return $this->respond([
          'status' => 200,
          'client' => $data,
        ], 200);
      }
      else
        return $this->failNotFound('El cliente no fue encontrado');
    }
}
