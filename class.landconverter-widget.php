<?php

class Nepali_Landconverter_Widget extends WP_Widget {

	function Nepali_Landconverter_Widget() {
		$widget_ops = array( 'classname' => 'landconverter', 'description' => __('A widget that displays the nepali landconverter ', 'landconverter_widget_domain') );
		
		//$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'example-widget' );
		
		$this->WP_Widget( 'landconverter-widget', __('Nepali Land Converter', 'landconverter_widget_domain'), $widget_ops/*,$control_ops*/ );
	}
	
	public function widget( $args, $instance ) {
		global $wpdb, $post;
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ){
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
        	<form id="calculator" role="form">						
						<!--<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							Land Area conversion:						
						</div>-->
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="input-group">
                                <div class="input-group-addon">Sq.Feet</div>
                                <input type="text" placeholder="Enter area in sq feet" id="sq-feet" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="input-group">
                                <div class="input-group-addon">Ropani</div>
                                <input type="text" disabled="" placeholder="Ropani" id="ropani" class="form-control">
                            </div>
                        </div>
            			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="input-group">
                                <div class="input-group-addon">Anna</div>
                                <input type="text" disabled="" placeholder="Anna" id="anna" class="form-control">
                            </div>
                        </div>
            			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="input-group">
                                <div class="input-group-addon">Paisa</div>
                                <input type="text" disabled="" placeholder="Paisa" id="paisa" class="form-control">
                            </div>
                        </div>
            			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="input-group">
                                <div class="input-group-addon">Daam</div>
                                <input type="text" disabled="" placeholder="Daam" id="daam" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="input-group">
                                <div class="input-group-addon">Bigha</div>
                                <input type="text" disabled="" placeholder="Bigha" id="bigha" class="form-control">
                            </div>
                        </div>
           				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="input-group">
                                <div class="input-group-addon">Katha</div>
                                <input type="text" disabled="" placeholder="Katha" id="katha" class="form-control">
                            </div>
                        </div>
            			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="input-group">
                                <div class="input-group-addon">Dhoor</div>
                                <input type="text" disabled="" placeholder="Dhoor" id="dhoor" class="form-control">
                            </div>
                        </div>
			</form>
            <script>
				jQuery(document).ready(function($){
					jQuery.fn.ForceNumericOnly =
					function(){
						return this.each(function(){
							$(this).keydown(function(e){
								var key = e.charCode || e.keyCode || 0;
								return (
									key == 8 || 
									key == 9 ||
									key == 13 ||
									key == 46 ||
									key == 110 ||
									key == 190 ||
									(key >= 35 && key <= 40) ||
									(key >= 48 && key <= 57) ||
									(key >= 96 && key <= 105));
							});
						});
					};
					$("#sq-feet").ForceNumericOnly();
					
					$('#sq-feet').keyup(function(){
						var sq_feet = $('#sq-feet').val();
						if(sq_feet > 0){
							ropani = (1/5476)*sq_feet;
							ropani_to_anna = ropani - Math.floor(ropani);
							_ropani = ropani.toString().split('.');
							$('#ropani').val(_ropani[0]);
							if(typeof ropani_to_anna!==0){
								anna = 16 * ropani_to_anna;
								anna_to_paisa = anna - Math.floor(anna);
								_anna = anna.toString().split('.');
								$('#anna').val(_anna[0]);
								if(typeof anna_to_paisa!==0){
									paisa = 4 * anna_to_paisa;
									paisa_to_daam = paisa - Math.floor(paisa);
									_paisa = paisa.toString().split('.');
									$('#paisa').val(_paisa[0]);
									if(typeof paisa_to_daam!==0){
										daam = (4 * paisa_to_daam).toFixed(2);
										$('#daam').val(daam);
									}
								}
							}
							bigha = (1/72900)*sq_feet;
							bigha_to_katha = bigha - Math.floor(bigha);
							_bigha = bigha.toString().split('.');
							$('#bigha').val(_bigha[0]);
							if(typeof bigha_to_katha!==0){
								katha = 20 * bigha_to_katha;
								katha_to_dhoor = katha - Math.floor(katha);
								_katha = katha.toString().split('.');
								$('#katha').val(_katha[0]);
								if(typeof katha_to_dhoor!==0)
								{
									dhoor = (20 * katha_to_dhoor).toFixed(2);
									$('#dhoor').val(dhoor);
								}
							}
						} else {
							$('#calculator')[0].reset();
						}
						return false;
					});
				});
			</script>
        <?php
		echo $args['after_widget'];
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	
	function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = '';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
	<?php
	}
}

?>