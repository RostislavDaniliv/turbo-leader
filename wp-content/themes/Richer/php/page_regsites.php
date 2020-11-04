<?php
wp_enqueue_script( 'clipboard.js', '/wp-content/themes/Richer/js/libs/clipboard.min.js'); 


global $wpdb;

$sponsor_role = $ultimatemember->user->get_role(); 
$login_name = strtolower( um_user('user_login') );

$game_roles = array( 'speaker-game', 'partner-game', 'speaker-gy', 'partner-gy', 'admin' );
$yoke_roles = array( 'speaker-yoke', 'partner-yoke', 'speaker-gy', 'partner-gy', 'admin' );

$is_game_role = in_array($sponsor_role, $game_roles);
$is_yoke_role = in_array($sponsor_role, $yoke_roles);
$is_gy_role = in_array($sponsor_role, array( 'speaker-gy', 'partner-gy', 'admin' ) );


$query = "SELECT site_id, name, url, type FROM wp_regsites";
$res_sites = $wpdb->get_results($query);


?>

<script type="text/javascript">
	
	$(document).ready(function(){
			var clipboard = new Clipboard('.clipboard-btn-copy');
	})

</script>


<div class="container">
	<div class="wpb_column vc_column_container vc_col-sm-12">
		<div class="vc_column-inner ">

			<div class="row">
				<div class="span12" style="padding-top:40px">
					
					<?php if($is_game_role):?>

						<div class="toggle style4">
							<div class="toggle-title active">
								<div class="status-icon fleft"><i class="fa fa-television"></i></div><span>Бизнес Novavi (Forking)</span>
							</div>
							<div class="toggle-inner" style="display: none;">
								
								<div class="custom-table custom-table-2" style="width:100%">
									<table width="100%">
									<thead>
										<tr>
											<th>Сайт</th>
											<th>Ссылка</th>
											<th style="width: 100px"></th>
										</tr>
									</thead>
									<tbody>
										
										<?php foreach ($res_sites as $site):?>
											<?php if($site->type == 1): ?>

											<tr>
												<td> <?php echo $site->name ?> </td>
												<td><a id="site-uds-<?php echo $site->site_id ?>" target="_blank" href="<?php echo $site->url ?>?id=<?php echo $login_name ?>">
													<?php echo $site->url ?>?id=<?php echo $login_name ?>	
													</a>
												</td>
												<td style="text-align: center">
													<button class="button  yellow mini simple align clipboard-btn-copy" data-clipboard-target="#site-uds-<?php echo $site->site_id ?>" title="Скопировать ссылку в буфер обмена">
														<i class="fa fa-clipboard" aria-hidden="true"></i>
													</button>
													<a target="_blank" class="button  yellow mini simple align clipboard-btn-copy" href="<?php echo $site->url ?>?id=<?php echo $login_name ?>" title="Открыть в новой вкладке">
														<i class="fa fa-eye" aria-hidden="true"></i>
													</a>
												</td>
											</tr>
											
											<?php endif;?>
										<?php endforeach;?>

									</tbody>
									</table>
								</div>

							</div>
						</div>
						
					<?php endif;?>
					
					<?php if($is_yoke_role):?>

						<div class="toggle style4">
							<div class="toggle-title active">
								<div class="status-icon fleft"><i class="fa fa-television"></i></div><span>Sushi Master (All Unic)</span>
							</div>
							<div class="toggle-inner" style="display: none;">
								
								<div class="custom-table custom-table-2" style="width:100%">
									<table width="100%">
									<thead>
										<tr>
											<th>Сайт</th>
											<th>Ссылка</th>
											<th style="width: 100px"></th>
										</tr>
									</thead>
									<tbody>
										
										<?php foreach ($res_sites as $site):?>
											<?php if($site->type == 2): ?>
												<tr>
													<td> <?php echo $site->name ?> </td>
													<td><a id="site-yoke-<?php echo $site->site_id ?>" target="_blank" href="<?php echo $site->url ?>?id=<?php echo $login_name ?>">
														<?php echo $site->url ?>?id=<?php echo $login_name ?>	
														</a>
													</td>
													<td style="text-align: center">
														<button class="button  yellow mini simple align clipboard-btn-copy" data-clipboard-target="#site-yoke-<?php echo $site->site_id ?>" title="Скопировать ссылку в буфер обмена">
															<i class="fa fa-clipboard" aria-hidden="true"></i>
														</button>
														<a target="_blank" class="button  yellow mini simple align clipboard-btn-copy" href="<?php echo $site->url ?>?id=<?php echo $login_name ?>" title="Открыть в новой вкладке">
															<i class="fa fa-eye" aria-hidden="true"></i>
														</a>
													</td>
												</tr>
										
											<?php endif; ?>
										<?php endforeach;?>

									</tbody>
									</table>
								</div>

							</div>
						</div>

					<?php endif;?>





				</div>
			</div>
		</div>
	</div>
</div>