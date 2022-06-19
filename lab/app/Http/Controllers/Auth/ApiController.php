<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Mail\PatientCode;
use App\Http\Controllers\Api\Response;
use Illuminate\Validation\Rule;
use Mail;
use Validator;
use Str;

class ApiController extends Controller
{
    public $code = '';
    public $message = '';
    public $body = '';

    public function login(Request $request)
    {

        
        $validation = Response::validation($request, ['code' => 'required']); //validations

        if (!empty($validation)) {
            return $validation;
        }

        $patient = Patient::with('contract')->where('code', $request['code'])->first();

        if (isset($patient)) {
            $this->code = 200;
            $this->message = 'success';
            $this->body = [
                'patient' => $patient,
                'is_password' => $patient->password ? true : false,
            ];
            //create patient token
            $token = $patient->createToken('Laravel Password Grant Client')->accessToken;
            $patient['api_token'] = $token;

            return Response::response($this->code, $this->message, $this->body);
        } else {

            $this->code = 400;
            $this->message = 'patient not found';

            return Response::response($this->code, $this->message, $this->body);
        }
    }

    // create password
    public function create_password(Request $request)
    {
        $validation = Response::validation($request, [
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
            'code' => 'required',
        ]); //validations

        if (!empty($validation)) {
            return $validation;
        }

        $patient = Patient::where('code', $request['code'])->first();

        if (isset($patient)) {
            $patient->password = bcrypt($request['password']);
            $patient->save();

            $this->code = 200;
            $this->message = 'success';
            $this->body = [
                'patient' => $patient,
                'is_password' => $patient->password ? true : false,
            ];

            //create patient token
            $token = $patient->createToken('Laravel Password Grant Client')->accessToken;
            $patient['api_token'] = $token;

            return Response::response($this->code, $this->message, $this->body);
        } else {

            $this->code = 400;
            $this->message = 'patient not found';

            return Response::response($this->code, $this->message, $this->body);
        }
    }

    public function secondLogin(Request $request)
    {

        $validation = Response::validation($request, [
            'code' => 'required',
            'password' => 'required|min:6'
        ]); //validations

        if (!empty($validation)) {
            return $validation;
        }

        // credientials code and password
        $credentials = [
            'code' => $request['code'],
            'password' => $request['password']
        ];

        if (!auth()->guard('patient')->attempt($credentials)) {
            $this->code = 400;
            $this->message = 'wrong code or password';
            return Response::response($this->code, $this->message, $this->body);
        } else {
            $this->code = 200;
            $this->message = 'success';
            $this->body = auth()->guard('patient')->user();

            //create patient token
            $token = auth()->user()->createToken('Laravel Password Grant Client')->accessToken;

            $this->body['api_token'] = $token;

            return Response::response($this->code, $this->message, $this->body);
        }
    }

    public function forget_code(Request $request)
    {
        $validation = Response::validation($request, ['email' => 'required|email']);

        if (!empty($validation)) {
            return $validation;
        }

        $patient = Patient::where('email', $request['email'])->first();

        if (!empty($patient)) {
            //send mail patient code
            send_notification('patient_code', $patient);

            $this->code = 200;
            $this->message = 'mail sent successfully';

            return Response::response($this->code, $this->message, $this->body);
        } else {
            $this->code = 400;
            $this->message = 'patient email not found';

            return Response::response($this->code, $this->message, $this->body);
        }
    }

    public function register(Request $request)
    {
        $validation = Response::validation($request, [
            'name' => [
                'required',
                Rule::unique('patients')->whereNull('deleted_at')
            ],
            'gender' => [
                'required',
                Rule::in(['male', 'female']),
            ],
            'dob' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
            'phone' => [
                'nullable',
                Rule::unique('patients')->whereNull('deleted_at')
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('patients')->whereNull('deleted_at')
            ],
            'national_id' => [
                'nullable',
                Rule::unique('patients')->whereNull('deleted_at')
            ],
            'passport_no' => [
                'nullable',
                Rule::unique('patients')->whereNull('deleted_at')
            ],
            'address' => 'nullable'
        ]);

        if (!empty($validation)) {
            return $validation;
        }

        //register patient
        $patient = Patient::create([
            'name' => $request['name'],
            'national_id' => $request['national_id'],
            'passport_no' => $request['passport_no'],
            'country_id' => $request['country_id'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'gender' => $request['gender'],
            'dob' => $request['dob'],
            'address' => $request['address'],
        ]);

        patient_code($patient['id']);

        //Avatar
        if ($request->has('avatar') && !empty($request['avatar'])) {
            //save file
            $data = explode(',', $request['avatar']);
            $extension = explode('/', mime_content_type($request['avatar']))[1];
            $decoded = base64_decode($data[1]);
            //generte name
            $name = time() . $patient['id'] . '.' . $extension;
            file_put_contents("uploads/patient-avatar/" . $name, $decoded);
            //save file name to record
            $patient->update(['avatar' => $name]);
        }

        //create token
        $token = $patient->createToken('Laravel Password Grant Client')->accessToken;
        $patient['api_token'] = $token;

        //response
        $this->code = 200;
        $this->message = 'success';
        $this->body = ['patient' => $patient];

        send_notification('patient_code', $patient);

        return Response::response($this->code, $this->message, $this->body);
    }
}
