<?php
// !Paginacion
//Limito la busqueda 
$TAMANO_PAGINA = 10; 

//examino la pagina a mostrar y el inicio del registro a mostrar 
if (isset($_REQUEST["pagina"])) {
	$pagina = $_REQUEST["pagina"];
} else {
	$pagina = 1;
}
if (!$pagina) { 
   	 $inicio = 0; 
   	 $pagina=1; 
} 
else { 
   	$inicio = ($pagina - 1) * $TAMANO_PAGINA; 
}
?>
<div class="grid_12 title_small ui-state-highlight ui-corner-all"align=""center">
<br>
<?php
$sql="SELECT SUM(cantidad) FROM data_gastos WHERE fecha BETWEEN '$desde' AND '$hasta' $sql_aux";
$rs=mysql_query($sql,$db);
$row=mysql_fetch_array($rs);
$totalRango = $row["SUM(cantidad)"];
?>
<div class="prefix_2 grid_8 alpha" align="right"><?php 
$titulo = "Gastos desde $show_desde hasta $show_hasta";
if ($cuenta != "") {
	$titulo.=" de la cuenta <strong>$cuenta</strong>";
} 
echo "$titulo:"; 
?></div>
<div class="grid_2 title_small omega"><strong><?php echo " Q.".number_format($totalRango,2) ?></strong></div>
<div class="clear"></div>
<br>
<div class="prefix_1 grid_10 sufix_1">
<table width="800px" align="center">
	<tr class="title_small">
		<td colspan="5"><hr></td>
	</tr>
	<tr class="title_small">
		<td width="100px">Fecha</td>
		<td width="200px">Cuenta</td>
		<td width="100px">Cantidad</td>
		<td width="325px">Descripcion</td>
		<td width="75px">Factura</td>
	</tr>
	<tr class="title_small">
		<td colspan="5">&nbsp;</td>
	</tr>
<?php
//calculo el total de paginas
$sql="SELECT * FROM data_gastos WHERE fecha BETWEEN '$desde' AND '$hasta' $sql_aux";
$rs=mysql_query($sql,$db);
$num_total_registros = mysql_num_rows($rs);  
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 

$sql="SELECT * FROM data_gastos WHERE fecha BETWEEN '$desde' AND '$hasta' $sql_aux ORDER BY fecha DESC, id_gasto DESC LIMIT $inicio, $TAMANO_PAGINA";
$rs=mysql_query($sql,$db);
while ($row=mysql_fetch_object($rs)) {
	$factura="";
	if ($row->factura == 1) {
		$factura = '<img src="../images/asterisk.png" width=8 height=8>';
	} 	
		
 ?>
 	<tr onMouseOut="this.style.background='#FFF9E5';" onMouseOver="this.style.background='#FED961'">
 		<td width="100px"><?php echo show_fecha($row->fecha); ?></td>
		<td width="200px"><?php echo "$row->cuenta"; ?></td>
		<td width="100px"><?php echo "Q. ".number_format($row->cantidad,2); ?></td>
		<td width="325px"><?php echo "$row->descripcion"; ?></td>
		<td width="75px"><p align="center"><?php echo $factura ?></p></td>
 	</tr>
<?php
} // end while
?>
	<tr>
		<td colspan="5"><hr></td>
	</tr>
</table>	 
</div>
<div class="clear"></div>
<div class="prefix_1 grid_1 title"><?php echo $pagina ?></div>
<div class="grid_8">
Pagina: <?php
for ($i=1;$i<=$total_paginas;$i++) { 
?>
	<a href="index.php?pagina=<?php echo $i ?>" class="title_small"><?php echo $i; ?></a>
<?php
}
?>
</div>
<p>&nbsp;</p>
</div>
