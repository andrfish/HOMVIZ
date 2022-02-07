<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Simulation extends Model
{

	static public function mergeResourcesPropreties($resources, $prop, $keyname){

        foreach ($resources as $rk => $resource) {

        	if (count($resource['subresources']) > 0) {

		        foreach ($resource['subresources'] as $sk => $subresource) {

	        		$resources[$rk]['subresources'][$sk][$keyname] = [];

		            if (isset($prop)) {

		                #Look for the same ID in subreserouces array, if so that means this resrouces has a subresource
		                if (isset($prop['resource'][$sk])) {

		                	$val_array = $prop['resource'][$sk];

		                	if ($keyname == 'allowedpopulation') {

		                		foreach ($val_array as $k => $v) {
		                			$val_array[$k] = Simulation::populationNametoID($v);
		                		}
		                		
		                	}

		                    $resources[$rk]['subresources'][$sk][$keyname] = $val_array;

		                }

		            }


		        }

        	} else {


	            $resources[$rk][$keyname] = [];

	            if (isset($prop)) {

	                #Look for the same ID in subreserouces array, if so that means this resrouces has a subresource
	                if (isset($prop['resource'][$rk])) {

	                	$val_array = $prop['resource'][$rk];

	                	if ($keyname == 'allowedpopulation') {

	                		foreach ($val_array as $k => $v) {
	                			$val_array[$k] = Simulation::populationNametoID($v);
	                		}
	                		
	                	}

	                    $resources[$rk][$keyname] = $val_array;

	                }

	            }


        	}

        }

        return $resources;

   }


	static public function mergeStatesPropreties($states, $prop, $keyname){

        foreach ($states as $rk => $state) {

            $states[$rk][$keyname] = [];

            if (isset($prop)) {

                #Look for the same ID in subreserouces array, if so that means this resrouces has a subresource
                if (isset($prop['state'][$rk])) {

                	$val_array = $prop['state'][$rk];

                	if ($keyname == 'allowedpopulation') {

                		foreach ($val_array as $k => $v) {
                			$val_array[$k] = Simulation::populationNametoID($v);
                		}
                		
                	}

                    $states[$rk][$keyname] = $val_array;

                }

            }

        }

        return $states;

   }

   static public function EditResourcesObject($resources, $subresources){
    if (isset($resources)) {

        foreach ($resources as $rk => $resource) {

            if ($resource['name']=='Addiction / Rehabilitation Center') {
                $resources[$rk]['name'] = 'Rehabilitation';
            }

            $resources[$rk]['subresources'] = [];

            if (isset($subresources)) {

                #Look for the same ID in subreserouces array, if so that means this resrouces has a subresource
                if (isset($subresources[$rk])) {

                    $resources[$rk]['subresources'] = $subresources[$rk];

                }

            }

        }

        return $resources;

    }

    return null;

   }

   static public function makeScenarioDetailsHTML($info, $scenarios, $resources){
    if (isset($info,$scenarios,$resources)) {

      $output = [];



      foreach ($info as $key => $value) {
        //just for scenarios not the main one
        if ($key!=0) {

          $scenario_id = $value['id'];

          if (isset($scenarios[$scenario_id])) {

            $this_sccenario = $scenarios[$scenario_id];

            $output[$scenario_id] = '';
          
            $html = '<ul>';

            $html .= '<li><strong>Scenario Name:</strong> <ul>'.$this_sccenario['name'].'</ul></li>';

            $html .= '<li><strong>Resources:</strong><ul>';
            $count1 = 1;
            foreach ($this_sccenario['scenario-for-resources'] as $key2 => $value2) {

              $html .= '<li>Resource #'.$count1.':<ul>';

              foreach ($resources as $res_key => $res_val) {
                
                if ($res_key==$key2) {
                  
                  $sub_resource_count = '';
                  if ($value2['kind']=='haschild') {
                    $sub_resource_count = '&nbsp;(with '.count($value2['subresources']).' sub-resources)';
                  }

                  $html .= '<li>Type: '.$res_val['name'].$sub_resource_count.'</li>';
                  $html .= '<li>Name: '.$res_val['name-for-show'].'</li>';

                  if ($value2['kind']=='haschild') {

                    $html .= '<li>Sub-resources:  <ul>';

                    $count = 1;

                    foreach ($res_val['subresources'] as $sub_key => $sub_value) {
                      
                      $html .= '<li>Sub-resources #'.$count.':<ul>';
                      $html .= '<li>Name: '.$sub_value['name'].'</li>';
                      $html .= '<li>Original maximum length of stay: '.$sub_value['maximumlengthofstay'].'</li>';

                      foreach ($value2['subresources'] as $key3 => $value3) {
                        if ($key3==$sub_key) {
                          $html .= '<li>Scecnario maximum length of stay: '.$value3['maximumlengthofstay-new'].'</li>';
                        }
                      }

                      $cap = $sub_value['capacity']=='-1'?'infinite':$sub_value['capacity'];
                      $html .= '<li>Original capacity: '.$cap.'</li>';

                      foreach ($value2['subresources'] as $key3 => $value3) {
                        if ($key3==$sub_key) {
                          $cap = $value3['capacity-new']=='-1'?'infinite':$value3['capacity-new'];
                          $html .= '<li>Scecnario capacity: '.$cap.'</li>';
                        }
                      }

                      $html .= '</ul></li>';
                      $count = $count+1;
                    }
                    
                    $html .= '</ul></li>';

                  } else if($value2['kind']=='main') {

                      $html .= '<li>Original maximum length of stay: '.$res_val['maximumlengthofstay'].'</li>';

                      if ($key2==$res_key) {
                        $html .= '<li>Scecnario maximum length of stay: '.$value2['maximumlengthofstay-new'].'</li>';
                      }

                      $cap = $res_val['capacity']=='-1'?'infinite':$res_val['capacity'];
                      $html .= '<li>Original capacity: '.$cap.'</li>';

                      if ($key2==$res_key) {
                        $cap = $value2['capacity-new']=='-1'?'infinite':$value2['capacity-new'];
                        $html .= '<li>Scecnario capacity: '.$cap.'</li>';
                      }

                  } else if($value2['kind']=='hfmain'){
                      $html .= '<li>Original capacity: '.$res_val['hf-capacity'].'</li>';

                      if ($key2==$res_key) {
                        $html .= '<li>Scenario capacity: '.$value2['capacity-new'].'</li>';
                        $html .= '<li>Rate of increase per month: '.$value2['monthly-increase'].'</li>';
                      }

                  }


                }

              }

              $count1++;

              $html .= '</ul></li>';

            }
            $html .= '</ul></li>';

            $html .= '</ul>';

            $output[$scenario_id] = $html;


          }

        }
      }

      return $output;
    }

    return null;

   }


   static public function AverageMultipleSimulations($data){

   		$output = [];

   		$number_of_simulatons = count($data);

		$current_simulation = 0;

		$output['simulation_0'] = [];

		foreach ($data['simulation_0'] as $weekname => $weekdata) {

			$output['simulation_0'][$weekname] = [];

			foreach ($weekdata as $resourcename => $resoruces) {

				$output['simulation_0'][$weekname][$resourcename] = [];

				foreach ($resoruces as $gendername => $genderdata) {

					$total = 0;

					for ($i=0; $i < $number_of_simulatons; $i++) { 
						$total = $total + $data['simulation_'.$i][$weekname][$resourcename][$gendername];
					}

					$avg = $total / $number_of_simulatons;

					$output['simulation_0'][$weekname][$resourcename][$gendername] = (int)$avg;

				}

			}

		}

   		return $output;

   }



   static public function AverageMultipleSimulatixxxns($data){

   		$output = [];

   		$number_of_simulatons = count($data);

		$current_simulation = 0;

		$output['simulation_0'] = [];

		foreach ($data['simulation_0'] as $res_key => $resrouce) {

			$output['simulation_0'][$res_key] = [];

			foreach ($resrouce as $gender_key => $gender) {
				
				$output['simulation_0'][$res_key][$gender_key] = [];

				foreach ($gender as $dp_key => $datapoint) {
					

					$total = $datapoint;

					for ($i=0; $i < $number_of_simulatons; $i++) { 
						$total = $total + $data['simulation_'.$i][$res_key][$gender_key][$dp_key];
					}

					$output['simulation_0'][$res_key][$gender_key][$dp_key] = $total / $number_of_simulatons;

				}		   			

			}

		}

   		return $output;

   }


   static public function populationIDtoName($id){

   	switch ($id) {
   		case 'u30hl1m':
   			return 'under 30, homeless less than 1 year, male';
      case 'u30hl1m_hf':
        return 'under 30, homeless less than 1 year, male (Housing First)';

      case 'u30hm1m':
        return 'under 30, homeless more than 1 year, male';
      case 'u30hm1m_hf':
        return 'under 30, homeless more than 1 year, male (Housing First)';


      case 'u30hl1f':
        return 'under 30, homeless less than 1 year, female';
      case 'u30hl1f_hf':
        return 'under 30, homeless less than 1 year, female (Housing First)';


      case 'u30hm1f':
        return 'under 30, homeless more than 1 year, female';
      case 'u30hm1f_hf':
        return 'under 30, homeless more than 1 year, female (Housing First)';


      case 'b30t50hl1m':
        return '30-50 years, homeless less than 1 year, male';
      case 'b30t50hl1m_hf':
        return '30-50 years, homeless less than 1 year, male (Housing First)';


      case 'b30t50hm1m':
        return '30-50 years, homeless more than 1 year, male';
      case 'b30t50hm1m_hf':
        return '30-50 years, homeless more than 1 year, male (Housing First)';


      case 'b30t50hl1f':
        return '30-50 years, homeless less than 1 year, female';
      case 'b30t50hl1f_hf':
        return '30-50 years, homeless less than 1 year, female (Housing First)';


      case 'b30t50hm1f':
        return '30-50 years, homeless more than 1 year, female';
      case 'b30t50hm1f_hf':
        return '30-50 years, homeless more than 1 year, female (Housing First)';


      case 'g50hl1m':
        return 'greater than 50 years, homeless less than 1 year, male';
      case 'g50hl1m_hf':
        return 'greater than 50 years, homeless less than 1 year, male (Housing First)';


      case 'g50hm1m':
        return 'greater than 50 years, homeless more than 1 year, male';
      case 'g50hm1m_hf':
        return 'greater than 50 years, homeless more than 1 year, male (Housing First)';


      case 'g50hl1f':
        return 'greater than 50 years, homeless less than 1 year, female';
      case 'g50hl1f_hf':
        return 'greater than 50 years, homeless less than 1 year, female (Housing First)';


      case 'g50hm1f':
        return 'greater than 50 years, homeless more than 1 year, female';
      case 'g50hm1f_hf':
        return 'greater than 50 years, homeless more than 1 year, female (Housing First)';


      case 'Combined_hf':
        return 'Combined Housing First';


   	}

   	return false;

   }

   static public function populationNametoID($id){

   	switch ($id) {
   		case 'under 30, homeless less than 1 year, male':
   			return 'u30hl1m';
      case 'under 30, homeless less than 1 year, male (Housing First)':
        return 'u30hl1m_hf';

   		case 'under 30, homeless more than 1 year, male':
   			return 'u30hm1m';
      case 'under 30, homeless more than 1 year, male (Housing First)':
        return 'u30hm1m_hf';

   		case 'under 30, homeless less than 1 year, female':
   			return 'u30hl1f';
      case 'under 30, homeless less than 1 year, female (Housing First)':
        return 'u30hl1f_hf';

   		case 'under 30, homeless more than 1 year, female':
   			return 'u30hm1f';
      case 'under 30, homeless more than 1 year, female (Housing First)':
        return 'u30hm1f_hf';

   		case '30-50 years, homeless less than 1 year, male':
   			return 'b30t50hl1m';
      case '30-50 years, homeless less than 1 year, male (Housing First)':
        return 'b30t50hl1m_hf';

   		case '30-50 years, homeless more than 1 year, male':
   			return 'b30t50hm1m';
      case '30-50 years, homeless more than 1 year, male (Housing First)':
        return 'b30t50hm1m_hf';

   		case '30-50 years, homeless less than 1 year, female':
   			return 'b30t50hl1f';
      case '30-50 years, homeless less than 1 year, female (Housing First)':
        return 'b30t50hl1f_hf';

   		case '30-50 years, homeless more than 1 year, female':
   			return 'b30t50hm1f';
      case '30-50 years, homeless more than 1 year, female (Housing First)':
        return 'b30t50hm1f_hf';

   		case 'greater than 50 years, homeless less than 1 year, male':
   			return 'g50hl1m';
      case 'greater than 50 years, homeless less than 1 year, male (Housing First)':
        return 'g50hl1m_hf';

   		case 'greater than 50 years, homeless more than 1 year, male':
   			return 'g50hm1m';
      case 'greater than 50 years, homeless more than 1 year, male (Housing First)':
        return 'g50hm1m_hf';

   		case 'greater than 50 years, homeless less than 1 year, female':
   			return 'g50hl1f';
      case 'greater than 50 years, homeless less than 1 year, female (Housing First)':
        return 'g50hl1f_hf';

   		case 'greater than 50 years, homeless more than 1 year, female':
   			return 'g50hm1f';
      case 'greater than 50 years, homeless more than 1 year, female (Housing First)':
        return 'g50hm1f_hf';

      case 'Combined Housing First':
        return 'Combined_hf';

   		default:
   			return 'error';
   	}

   	return false;

   }


}
