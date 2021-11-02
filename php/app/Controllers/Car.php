<?php namespace App\Controllers;
use App\Models\CarModel;

class Car extends Client
{
  public function index()
  {
    $model = new CarModel();

    $data['clients'] = $this->clients('car');
    foreach ($data['clients'] as $index => $client) {
      $car = $model->where('client_id', $client['id'])->first();
      $car['price'] = number_format($car['price'], 2, '.', ',');
      $data['clients'][$index] = array_merge($data['clients'][$index], $car);
    }
    return $this->respond($data);
  }

  public function create()
  {
    $model = new CarModel();
    helper('form');

    $rules = [
      'model' => 'required|max_length[50]',
      'price' => 'required|numeric'
    ];
    if(!$this->validate(array_merge($this->client_rules(), $rules))) {
				return $this->fail($this->validator->getErrors());
		} else {
      $input = $this->request->getRawInput();
      $client_id = $this->create_client($input, 'car', $this->validate_price($input['price']));
      $model->insert([
        'client_id' => $client_id,
        'model'     => $input['model'],
        'price'     => $input['price']
      ]);
      $response = [
          'status'    => 201,
          'client_id' => $client_id,
          'error'     => null,
          'messages'  => [
              'success' => 'El cliente ha sido creado exitosamente'
          ]
      ];
      return $this->respondCreated($response);
    }
  }

  private function validate_price($price = 0)
  {
    return $price >= 200000 && $price <= 500000 ? 0 : 1;
  }
}
