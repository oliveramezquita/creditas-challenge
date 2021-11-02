<?php namespace App\Controllers;
use App\Models\HouseModel;

class House extends Client
{
  public function index()
  {
    $model = new HouseModel();

    $data['clients'] = $this->clients('house');
    foreach ($data['clients'] as $index => $client) {
      $house = $model->where('client_id', $client['id'])->first();
      $data['clients'][$index] = array_merge(
        $data['clients'][$index],
        array(
          'value'      => number_format($house['value'], 2, '.', ','),
          'ug_address' => $house['address'],
          'ug_zipcode' => $house['zipcode'],
          'ug_city'    => $house['city'],
          'ug_state'   => $house['state']
        )
      );
    }
    return $this->respond($data);
  }

  public function create()
  {
    $model = new HouseModel();
    helper('form');

    $rules = [
      'value'      => 'required|numeric',
      'ug_address' => 'required|max_length[255]',
      'ug_zipcode' => 'required|numeric|max_length[5]',
      'ug_city'    => 'required|max_length[50]',
      'ug_state'   => 'required|max_length[50]'
    ];
    if(!$this->validate(array_merge($this->client_rules(), $rules))) {
				return $this->fail($this->validator->getErrors());
		} else {
      $input = $this->request->getRawInput();
      $client_id = $this->create_client($input, 'house', $this->validate_state($input['ug_state']));
      $model->insert([
        'client_id' => $client_id,
        'value'     => $input['value'],
        'address'   => $input['ug_address'],
        'zipcode'   => $input['ug_zipcode'],
        'city'      => $input['ug_city'],
        'state'     => $input['ug_state']
      ]);
      $response = [
          'status'    => 201,
          'error'     => null,
          'client_id' => $client_id,
          'messages'  => [
              'success' => 'El cliente ha sido creado exitosamente'
          ]
      ];
      return $this->respondCreated($response);
    }
  }

  private function validate_state($state = '')
  {
    return $state == 'México' || $state == 'Ciudad de México' ? 0 : 1;
  }
}
