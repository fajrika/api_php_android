<?php

class prepare
{
    public $response;
    public $data;
    public $put;
    public function __construct()
    {
        require_once('achievement.php');
        require_once('input.php');

        $this->input = new input;
        $this->data = (object)[];
        $this->response = (object)[];
        $this->response->code = 500;
        $this->response->timestamp = date("Y-m-d H:i:s");
        $this->response->message = 'function not found';
    }

    public function login()
    {
        require_once('auth.php');
        $this->data->username = $this->input->get_attribute('username');
        $this->data->password = $this->input->get_attribute('password');

        if ($this->data->username && $this->data->password) {
            if ((new auth)->login($this->data->username, $this->data->password)) {
                $this->response->code = 200;
                $this->response->message = 'login successfully';
            } else {
                $this->response->code = 401;
                $this->response->message = 'failed username or password';
            }
        } else {
            $this->response->code = 500;
            $this->response->message = 'Parameter not complete';
        }
    }

    public function get_achievement()
    {
        require_once('achievement.php');
        $this->response->code = 200;
        $this->response->message = 'successfully';
        $this->response = (new achievement($this->response))->read();
    }

    public function store_achievement()
    {
        require_once('achievement.php');
        $this->data->nisn       = $this->input->get_attribute('nisn');
        $this->data->nama       = $this->input->get_attribute('nama');
        $this->data->nama_lomba = $this->input->get_attribute('nama_lomba');
        $this->data->tgl_lomba  = $this->input->get_attribute('tgl_lomba');
        $this->data->penyelenggara = $this->input->get_attribute('penyelenggara');
        $this->data->tingkatan  = $this->input->get_attribute('tingkatan');
        $this->data->peringkat  = $this->input->get_attribute('peringkat');
        $this->data->pembimbing = $this->input->get_attribute('pembimbing');
        $this->data->keterangan = $this->input->get_attribute('keterangan')??null;

        if ($this->data->nisn && $this->data->nama && $this->data->nama_lomba && $this->data->tgl_lomba && $this->data->penyelenggara && $this->data->tingkatan && $this->data->peringkat && $this->data->pembimbing) {
            $this->response = (new achievement($this->response))->create(
                $this->data->nisn,
                $this->data->nama,
                $this->data->nama_lomba,
                $this->data->tgl_lomba,
                $this->data->penyelenggara,
                $this->data->tingkatan,
                $this->data->peringkat,
                $this->data->pembimbing,
                $this->data->keterangan
            );
        } else {
            $this->response->code = 500;
            $this->response->message = 'Parameter not complete';
        }
    }

    public function edit_achievement()
    {
        require_once('achievement.php');
        $this->data->id         = $this->input->get_attribute('id');
        $this->data->nisn       = $this->input->get_attribute('nisn');
        $this->data->nama       = $this->input->get_attribute('nama');
        $this->data->nama_lomba = $this->input->get_attribute('nama_lomba');
        $this->data->tgl_lomba  = $this->input->get_attribute('tgl_lomba');
        $this->data->penyelenggara  = $this->input->get_attribute('penyelenggara');
        $this->data->tingkatan  = $this->input->get_attribute('tingkatan');
        $this->data->peringkat  = $this->input->get_attribute('peringkat');
        $this->data->pembimbing = $this->input->get_attribute('pembimbing');
        $this->data->keterangan = $this->input->get_attribute('keterangan')??null;

        if ($this->data->id && $this->data->nisn && $this->data->nama && $this->data->nama_lomba && $this->data->tgl_lomba && $this->data->penyelenggara && $this->data->tingkatan && $this->data->peringkat && $this->data->pembimbing) {
            $this->response = (new achievement($this->response))
                ->update(
                    $this->data->id,
                    $this->data->nisn,
                    $this->data->nama,
                    $this->data->nama_lomba,
                    $this->data->tgl_lomba,
                    $this->data->penyelenggara,
                    $this->data->tingkatan,
                    $this->data->peringkat,
                    $this->data->pembimbing,
                    $this->data->keterangan
                );
        } else {
            $this->response->code = 500;
            $this->response->message = 'Parameter not complete';
        }
    }

    public function destroy_achievement()
    {
        require_once('achievement.php');
        $this->data->id = $this->input->get_attribute('id');
        if ($this->data->id)
            $this->response = (new achievement($this->response))->delete($this->data->id);
        else {
            $this->response->code = 500;
            $this->response->message = 'Parameter not complete';
        }
    }
}


class route
{
    public function __invoke()
    {
        $this->prepare = new prepare;
        $this->prepare->path = strtolower(explode('/', $_SERVER['PATH_INFO'] ?? '')[1] ?? '');
        
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if ($this->prepare->path == 'achievement')
                    $this->prepare->get_achievement();
                break;
            case 'POST':
                if ($this->prepare->path == 'login')
                    $this->prepare->login();
                elseif ($this->prepare->path == 'achievement')
                    $this->prepare->store_achievement();
                break;
            case 'PUT':
                if ($this->prepare->path == 'achievement')
                    $this->prepare->edit_achievement();
                break;
            case 'DELETE':
                if ($this->prepare->path == 'achievement')
                    $this->prepare->destroy_achievement();
                break;
            default:
                $this->prepare->response->message = 'Method cant use';
                break;
        }
        return $this->prepare->response;
    }
}

header('Content-type: application/json');
$response = (new route)();
http_response_code($response->code);
echo json_encode($response);

