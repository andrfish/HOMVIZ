<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;
use Hash;
use Route;
use Response;
use Auth;
use URL;
use Session;
use DB;
use DateTime;
use App\Job;
use App\User;
use App\Simulation;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class SimulationsController extends Controller
{
	public function __construct() {
        $this->layout = "layouts.master";
        //CHECK IF THE HOMEPAGE IS SET
    }

    public function getAdd()
    {

        return view('simulations.add')
        ->with('layout',$this->layout);

    }

    public function postprogressUpdate()
    {   

        $ids = Input::get('ids');

        $status = 400;
        $serverkey = env("SERVER_KEY");

        $output = [];

        try {

            $status = 200;

            $sim = Simulation::whereIn('id', $ids)->get();

            foreach ($sim as $key => $simulation) {

                $output[$simulation->id] = [];

                //See these simulation statuses 
                //0:just created,1:processing,2:done

                if ($simulation->status==0) {

                    $url = 'http://216.36.166.133:2222/api/v1/simulation/create';
                    
                    $opts = [
                        "http" => [
                            "method" => "POST",
                            "header" => "key: ".$serverkey."\r\n" .
                                "Content-Type:'application/json'\r\n" .
                                "data: ".$simulation->data."\r\n"
                        ]
                    ];

                    $context = stream_context_create($opts);
                    $file = file_get_contents($url, false, $context);
                    $res = json_decode($file,1);

                    if ($res['status']=='succeeded') {
                        if (isset($res['simulation_id'])) {

                            $s = Simulation::find($simulation->id);
                            $s->serverID=$res['simulation_id'];
                            $s->status = 2;
                            $s->save();

                            $output[$simulation->id]['status']=2;
                            $output[$simulation->id]['progress']=0;

                        }
                    }

                } elseif ($simulation->status==2) {
                    
                    $url = 'http://216.36.166.133:2222/api/v1/simulation/status';

                    // Create a stream
                    $opts = [
                        "http" => [
                            "method" => "POST",
                            "header" => "key: ".$serverkey."\r\n" .
                            "simulation_id: ".$simulation->serverID."\r\n"
                        ]
                    ];

                    $context = stream_context_create($opts);

                    // Open the file using the HTTP headers set above
                    $file = file_get_contents($url, false, $context);

                    $res = json_decode($file,1);

                    if ($res['status']=='complete') {

                        $s = Simulation::find($simulation->id);
                        $s->status = 1;
                        $s->save();

                        $output[$simulation->id]['status']=1;

                        $url = 'http://216.36.166.133:2222/api/v1/simulation/result';
                        $opts = [
                            "http" => [
                                "method" => "POST",
                                "header" => "key: ".$serverkey."\r\n" .
                                 "simulation_id: ".$simulation->serverID."\r\n"
                            ]
                        ];

                        $context = stream_context_create($opts);
                        $file = file_get_contents($url, false, $context);
                        $res = json_decode($file,1);

                        if (isset($res['result'])) {
                            $s = Simulation::find($simulation->id);
                            $s->result = $res['result'];
                            $s->save();
                            $output[$simulation->id]['progress']=100;
                            $output[$simulation->id]['statushtml']='<span class="badge badge-success">Completed</span>';
                        }

                    } else {

                        if (isset($res['status'])) {
                        
                            $var = $res['status'];
                            $var = str_replace(' ', '', $var);
                            $var = explode(',', $var);

                            if (isset($var[0])) {
                                $simnum = str_replace('sim_', '', $var[0]);
                                $simname = 'Simulation '. ( ((int)$simnum)+1  );
                                $output[$simulation->id]['simulationname'] = $simname;
                            }

                            $first4='';
                            if (isset($var[1])) {
                               $first4 = substr($var[1], 0,4);
                            }

                            if ($first4=='week') {

                                $d = json_decode($simulation->data,1);
                                $numofweeks = $d['numberofweeks'];

                                $weekno = substr($var[1], 5);
                                $weekno = (int)$weekno+1;
                                $progress = $weekno / $numofweeks * 100;

                                $output[$simulation->id]['status']=2;
                                $output[$simulation->id]['progress']=$progress;
                                $output[$simulation->id]['statushtml']='<span class="badge badge-info">Processing</span>';

                            }

                        }

                    }

                } elseif ($simulation->status==1) {
                    $output[$simulation->id]['progress']=100;
                    $output[$simulation->id]['status']=1;
                    $output[$simulation->id]['statushtml']='<span class="badge badge-success">Completed</span>';
                }

            }

        } catch (Throwable $e) {

            return Response::json(array(
                'status' => '400',
                'error' => 'Error. View logs.'
            ));

        }

        return Response::json(array(
            'status' => $status,
            'output' => $output
        ));

    }

    public function postAdd()
    {

        $scenarios = Input::get('scenarios');
        $resources = Input::get('resources');
        $subresources = Input::get('subresources');
        $states = Input::get('states');

        //Merge resources and subresrouces
        $resources = Simulation::EditResourcesObject($resources,$subresources);

        $allowedPopulation = Input::get('allowedPopulation');
        $initialPopulation = Input::get('initialPopulation');
        $maximumlengthofstay = Input::get('maximumlengthofstay');

        $capacity = Input::get('capacity');

        $resources = Simulation::mergeResourcesPropreties($resources, $allowedPopulation, 'allowedpopulation');
        $resources = Simulation::mergeResourcesPropreties($resources, $initialPopulation, 'initialPopulation');
        $resources = Simulation::mergeResourcesPropreties($resources, $maximumlengthofstay, 'maximumlengthofstay');
        $resources = Simulation::mergeResourcesPropreties($resources, $capacity, 'capacity');

        $states = Simulation::mergeStatesPropreties($states, $allowedPopulation, 'allowedpopulation');
        $states = Simulation::mergeStatesPropreties($states, $initialPopulation, 'initialPopulation');

        $creatorname = 'none';
        $numberofweeks = Input::get('numberofweeks');
        $numberofsims = Input::get('numberofsims');
        $populationType = Input::get('populationType');
        $simulation_name = Input::get('simulation_name');
        $simulation_location = Input::get('simulation_location');

        $output = array();

        $output['simulation_name'] = $simulation_name;
        $output['simulation_location'] = $simulation_location;
        $output['creatorname'] = $creatorname; //todo: take it out
        $output['numberofweeks'] = $numberofweeks;
        $output['numberofsims'] = $numberofsims;
        $output['populationType'] = $populationType;
        $output['resources'] = $resources;
        $output['states'] = $states;
        $output['scenarios'] = $scenarios;

        $sim = new Simulation();
        $sim->user_id = Auth::user()->id;
        $sim->data = json_encode($output);
        $sim->population_content = json_encode(Input::get('populationTypeCount'));

        //for survey
        $sim->stopwatch = Input::get('stopwatch');
        $sim->videosliderwatches = Input::get('videosliderwatches');
        
        $sim->save();

        return Redirect::route('index');

    }

    public function postDelete()
    {

        $status = 400;
        $sim_id = Input::get('sim_id');
        $sim = Simulation::where('id',$sim_id)->where('user_id',Auth::user()->id)->first();

        if (isset($sim) && !empty($sim)) {
            if ($sim->delete()) {
                $status = 200;
            }
        }

        return Response::json(array(
        'status' => $status
        ));

    }

    public function getView($sim_id=null)
    {

        $sim_info = [];

        $sim = Simulation::find($sim_id);

        if (isset($sim->result) && !empty($sim->result)) {

            $metadata = json_decode($sim->data, true);
            $sim_info['name'] = $metadata['simulation_name'];
            $sim_info['city'] = $metadata['simulation_location'];
            $sim_info['numberofweeks'] = $metadata['numberofweeks'];
            $sim_info['populattioncontent'] = json_decode($sim->population_content,true);
            $sim_info['scenarios'] = $metadata['scenarios'];
            $phpdate = strtotime( $sim->created_at );
            $sim_info['creatorname'] = date( 'Y-m-d H:i:s', $phpdate );



            $data = json_decode($sim->result, true);

            $numberofweeks = 0;

            $weekLabel = [];
            $dataSeriesLabel = [];
            $dataSeriesLabelPie = [];
            $populationLabel = [];
            $resourceLabel = [];

            $scenario_ids = ['base'];
            $scenario_info = array(['name'=>'Main','id'=>'base']);

            //Get the names and ids of scenarios
            if (isset($metadata['scenarios'])) {
                foreach ($metadata['scenarios'] as $sce_key => $sce_val) {
                    $output = ['name'=>'','id'=>''];
                    $output['id'] = $sce_key;
                    $output['name'] = $metadata['scenarios'][$sce_key]['name'];
                    array_push($scenario_ids, $sce_key);
                    array_push($scenario_info, $output);
                }
            }

            //Merge and add scenarios info for viewing
            $scenario_details_html = Simulation::makeScenarioDetailsHTML($scenario_info,$sim_info['scenarios'],$metadata['resources']);

            //Get number of weeks
            foreach ($data as $key => $sim) {

                foreach ($sim as $w1key => $week) {

                    if ($key=='simulation_base') {
                        array_push($weekLabel, 'Week '.$numberofweeks);
                        $numberofweeks = $numberofweeks + 1;
                    }
                    
                    $weektotal = 0;

                    foreach ($week as $wk => $wv) {

                        array_push($resourceLabel, $wk);

                        $total = 0;
                        $total_hf = 0;

                        foreach ($wv as $pk => $pv) {

                            $last_three = substr($pk, -3);

                            if ($last_three=='_hf') {

                                $total_hf = $total_hf + $pv;

                            } else {

                                $total = $total + $pv;

                            }
                        }

                        $data[$key][$w1key][$wk]['Combined'] = $total;

                        $data[$key][$w1key][$wk]['Combined_hf'] = $total_hf;

                        $weektotal = $weektotal + $total;
                    }

                }

            }

            $resourceLabel = array_unique($resourceLabel);

            $mycounter = 0;

            //Generate data for charts
            foreach ($data as $key0 => $sim) {

                $dataSeriesLabel[$key0]=[];
                $dataSeriesLabelPie[$key0]=[];

                foreach ($sim as $key => $week) {

                    foreach ($week as $wk => $wv) {

                        if(!isset($dataSeriesLabel[$key0][$wk]))
                            $dataSeriesLabel[$key0][$wk]=[];

                        if(!isset($dataSeriesLabelPie[$key0][$wk]))
                            $dataSeriesLabelPie[$key0][$wk]=[];                    

                        foreach ($wv as $pk => $pv) {

                            if(!isset($dataSeriesLabel[$key0][$wk][$pk]))
                                $dataSeriesLabel[$key0][$wk][$pk]=[];

                            if(!isset($dataSeriesLabelPie[$key0][$wk][$pk]))
                                $dataSeriesLabelPie[$key0][$wk][$pk]=['init'=>null,'final'=>null];

                            if ($mycounter==0) {
                                $dataSeriesLabelPie[$key0][$wk][$pk]['init'] = $pv;
                            }

                            if ($mycounter==$numberofweeks-1) {
                                $dataSeriesLabelPie[$key0][$wk][$pk]['final'] = $pv;
                            }


                            if(!in_array($pk, $populationLabel))
                                array_push($populationLabel, $pk);

                            array_push($dataSeriesLabel[$key0][$wk][$pk], $pv);
                        }

                        
                    }

                    $mycounter += 1;

                }
                $mycounter = 0;
            }


            //Get more info to show in details section
            $sim_info['listofresources'] = [];
            if (isset($metadata['resources'])) {

                foreach ($metadata['resources'] as $resval) {
                    
                    if (isset($resval['name-for-show'])) {

                        array_push($sim_info['listofresources'], $resval['name-for-show']);

                    }

                }

            }

            $sim_info['listofstates'] = [];
            if (isset($metadata['states'])) {

                foreach ($metadata['states'] as $stateval) {
                
                    array_push($sim_info['listofstates'], $stateval['name-for-show']);

                }

            }

            foreach ($populationLabel as $pkey => $pvalue) {
                if ($pvalue!='Combined') {
                    $populationLabel[$pkey] = Simulation::populationIDtoName($pvalue);
                }
            }

            return view('simulations.view')
            ->with('dataSeriesLabel',json_encode($dataSeriesLabel))
            ->with('dataSeriesLabelPie',json_encode($dataSeriesLabelPie))
            ->with('resourceLabel',json_encode($resourceLabel))
            ->with('populationLabel',json_encode($populationLabel))
            ->with('weekLabel',json_encode($weekLabel))
            ->with('populationLabelview',$populationLabel)
            ->with('layout',$this->layout)
            ->with('numberofweeks',$numberofweeks)
            ->with('scenario_ids',json_encode($scenario_ids))
            ->with('scenario_info',$scenario_info)
            ->with('scenario_details_html',$scenario_details_html)
            ->with('sim_info',$sim_info);

        } else {
            return Redirect::route('index');
        }



    }

}
