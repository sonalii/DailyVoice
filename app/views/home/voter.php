<?php 

$link_class = 'voter';

if ($has_voted) {
	$link_class = $link_class . ' disabled';
}

$total    = $img_data->likes + $img_data->dislikes;
$up_per   = 0;
$down_per = 0;

if ($total > 0) {
	$up_per   = round( ($img_data->likes * 100) / $total );
	$down_per = round( ($img_data->dislikes * 100) / $total );
}

?>
					
					<table>
						<tr>
							<td><?php echo $up_per; ?>%</td>
							<td><a href="/vote/register/up/<?php echo $img_data->id; ?>" class="<?php echo $link_class; ?>"><img src="/public/img/up.png"></a></td>
							<td><a href="/vote/register/down/<?php echo $img_data->id; ?>" class="<?php echo $link_class; ?>"><img src="/public/img/down.png"></a></td>
							<td><?php echo $down_per; ?>%</td>
						</tr>
					</table>