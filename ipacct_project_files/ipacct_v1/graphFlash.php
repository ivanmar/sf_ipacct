<?php

require_once('include/graph/open_flash-chart.php');
      
      $g = new graph();

      $g->title( 'ipacct sales '. date("Y"), '{font-size: 26px;}' );
      $g->set_data( array(2,3,4,2,3,4) );
      $g->set_x_labels( array('jan','ert','fdf','hgh','sss','aaa') );

      $g->set_y_max( 60 );
      $g->y_label_steps( 1 );
      echo $g->render();

require_once('include/graph/open_flash_chart_object.php');
open_flash_chart_object( 700, 350, 'graphFlash.php' );

?>
