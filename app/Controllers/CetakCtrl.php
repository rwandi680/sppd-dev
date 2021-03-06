<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AturModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class CetakCtrl extends BaseController
{
    protected $aturModel;
    protected $pdf;

    public function __construct()
    {
        $db = \db_connect();
        $this->aturModel = new AturModel($db);
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', TRUE);
        $this->pdf = new \Dompdf\Dompdf($options);
    }

}
