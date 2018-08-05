<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Duration\durationInterface as durationInterface;
use App\Http\Requests\manageDurationRequest;
use Illuminate\Support\Facades\Input;

class manageDurationController extends Controller
{
    
    public function __construct(durationInterface $duration){
        $this->duration = $duration;
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $search = [];
        $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        $search['all'] = true;

 
        $data = $this->duration->getAll($offset, $limit, $search);
        $data['offset'] = isset($_GET['all']) ? 'all' :$offset;
        $data['limit'] = isset($_GET['all']) ? 'all' : $limit;
        $data['total'] = 0;
        
        $data['total'] = $this->duration->count();

        return response()->json(['success'=> $data ], 200);
    }

}
