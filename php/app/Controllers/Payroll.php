<?php namespace App\Controllers;
use App\Models\PayrollModel;

class Payroll extends Client
{
  public function index()
  {
    $model = new PayrollModel();

    $data['clients'] = $this->clients('payroll');
    foreach ($data['clients'] as $index => $client) {
      $payroll = $model->where('client_id', $client['id'])->first();
      $data['clients'][$index] = array_merge($data['clients'][$index], $payroll);
    }
    return $this->respond($data);
  }

  public function create()
  {
    $model = new PayrollModel();
    helper('form');

    $rules = [
      'company'         => 'required|max_length[100]',
      'date_admission'  => 'required'
    ];
    if(!$this->validate(array_merge($this->client_rules(), $rules))) {
				return $this->fail($this->validator->getErrors());
		} else {
      $input = $this->request->getRawInput();
      $client_id = $this->create_client($input, 'payroll', $this->validate_date_admission($input['date_admission']));
      $model->insert([
        'client_id'       => $client_id,
        'company'         => $input['company'],
        'date_admission'  => $input['date_admission']
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

  private function validate_date_admission($date_admission = '')
  {
    $date1 = $date_admission;
    $date2 = date('Y-m-d');

    $ts1 = strtotime($date1);
    $ts2 = strtotime($date2);

    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
    return $diff >= 14 ? 0 : 1;
  }
}
