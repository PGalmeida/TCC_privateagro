<?php
# $Id$
# PHPlot test: Bug 1437912 - Bar Chart Labels not centered
# This is a parameterized test. Other scripts can set $tp and then include
# this script. The parameters are shown in the defaults array below:
if (!isset($tp)) $tp = array();
$tp = array_merge(array(
  'title' => utf8_decode('Gastos com a Plantação'),
  'suffix' => "",           # Title part 2
  'ND' => 4,                # Number of data rows
  'NB' => 1,                # Number of bars per group
  'FSize' => 4,             # Font size
  'Shade' => 0,             # Shading
        ), $tp);

require_once 'phplot.php';

session_start();
$irrigacao = $_SESSION['p_irrigacao'];
$p_tipo = $_SESSION['p_tipo'];
$fertilizante = $_SESSION['p_fertilizante'];
$tipo = $_SESSION['tipo'];


# All the labels are A so we can look for centering.
$data = array(
  array(utf8_decode("Irrigações"), $irrigacao),
  array($tipo, $p_tipo),
  array("Fertilizantes", $fertilizante)
);

/* for ($i = 1; $i <= $tp['ND']; $i++) {
  $row = array('A');
  for ($j = 1; $j <= $tp['NB']; $j++) $row[] = $i + $j;
  $data[] = $row;
} */



$plot = new PHPlot(800, 600);

$plot->SetPlotType('bars');
$plot->SetDataType('text-data');
$plot->SetDataValues($data);

# Main plot title:
$plot->SetTitle($tp['title'] . $tp['suffix']);

# Turn off X tick labels and ticks because they don't apply here:
$plot->SetXTickLabelPos('none');
$plot->SetXTickPos('none');

# Make the text font bigger for the labels:
$plot->SetFont('x_label', $tp['FSize']);

# Results may differ with or without shading:
if (isset($tp['Shade'])) $plot->SetShading($tp['Shade']);

# Legend
//$plot->SetLegend($colors, 0, count($data));

# TESTING:
#$plot->group_frac_width=1.0;
#$plot->bar_width_adjust=0.5;

$plot->DrawGraph();
#fwrite(STDERR, print_r($plot, True));
