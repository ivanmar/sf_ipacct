<?php
//error_reporting(E_ALL);

require_once('framework.php');
require_once('include/graph/graph_chart.php');

$sec = new cIpacct();
if($sec->isLoggedIn('administrator')!=LOGIN_PASSED)
        header('Location: login.php');
ob_end_flush();

$base = new cBase('graphData');
$g = new graph();

$param=array( $g_timestep,$g_isporg,$g_startdate,$g_stopdate );
$exec=$base->execute($g_trafftype,$param);
$rows=$base->fetchAll();

$color=array('#3334AD','#47ad33','#D54C78','#864cd5','#ffd36a','#ff7777');
$barlabel=array();
$suborgs=array();
$i=0;
$max_value = 0;

foreach($rows as $id => $record)
{
    if($g_timestep=='year')
      $label=date("Y",strtotime($record['period']));
    elseif($g_timestep=='month')
      $label=date("m",strtotime($record['period']));
    elseif($g_timestep=='day')
      $label=date("d",strtotime($record['period']));
    elseif($g_timestep=='hour') 
      $label=date("H",strtotime($record['period']));

    $key = $record['suborgname'];
    if(!in_array($key,$suborgs))
    {
      array_push($suborgs,$key);
      if($g_type=='bar')
      {
        $bar[$key] = new bar( 70, $color[$i] );
        $bar[$key]->key( $key, 10 );
	$i++;
      }
    }
    if ( $record['cash'] > $max_value )
       $max_value = $record['cash'];

    if($g_type=='bar')
    {
      $bar[$key]->data[] = $record['cash'];
      $barlabel[]=$label;
    } elseif ($g_type == 'pie') 
      $pie_sum[$key]+=$record['cash'];

}

if($g_type=='bar') 
{
  foreach($bar as $key => $val)
      $g->data_sets[] = $bar[$key];

  $startdate=date("d/m/Y H\h",strtotime($g_startdate));
  $stopdate=date("d/m/Y H\h",strtotime($g_stopdate));
  $max_value = ceil(intval($max_value)/100)*100;
  $g->title( 'Accounting data from '.$startdate.' to '.$stopdate,
	   '{font-size:14px; color: #CCCCCC; margin: 3px; padding-left: 20px; padding-right: 20px;}' );
  $g->set_x_labels(  $barlabel );
  $g->set_x_label_style( 10, '#d5a8ff', 0, 1 );
  $g->set_x_axis_steps( 1 );
  $g->set_y_max( $max_value );
  //$g->y_label_steps( 100 );
  $g->set_y_label_style( 8, '#d5a8ff', 0, 2 );
  $g->set_y_legend( 'sale data', 11, '#CCCCCC' );
  $g->bg_colour = '#232323';
} 
elseif ($g_type == 'pie')
{
  $pieval = array();
  $links = array();
  foreach($pie_sum as $key => $val)
  {
    $pieval[] = $val;
    $links[] = "javascript:alert('$val')";
  }
  $g->bg_colour = '#232323';
  $g->pie(60,'#232323','{display:none;}',false,1);
  $g->pie_values( $pieval, $suborgs, $links );
  $g->pie_slice_colours( $color );
  $g->set_tool_tip( 'Label: #x_label#<br>Value: #val#' );
  $g->title( 'sub orgs', '{font-size:14px; color: #CCCCCC;}' );

} 

echo $g->render();

?>
