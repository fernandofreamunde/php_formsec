<?php
/**
* 
*/
class Form 
{
	private $header_name;		//name of the form wich means that will apear on the name attribute
	private $header_action;		//action attribute of the form
	private $header_type;		//type of form if it is an upload form it will load the multidata thing

	private $form_items = [];  //stores the configuration of the object 
	private $select_opt = [];  //stores the select fields options. 

	/**
	* 	inicializes the form
	*	
	*	params:
	*	$name 		string		name of the form
	*	$action 	string		action of the form
	*	$type 		string		type of the form 0 normal 1 file upload
	*/
	function __construct( $name = 'form' , $action = 'index.php' , $type = '0'){

		$this->header_name = $name;
		$this->header_action = $action;
		$this->header_type = $type;

	}

	/**
	* 	inicializes an input field to be placed in the form
	*	
	*	params:
	*	$type 			string		type of the input acepts html input types
	*	$name 			string		name atribute of the input
	*	$placeholder 	string		placeholder atribute of the input
	*	$value 			string		value atribute of the input ...
	*/
	public function input( $type , $name , $placeholder = 1 , $value = 0 )
	{
		$input = [];
		
		$input['type'] = $type;
		$input['name'] = $name;

		if ($value !== 0){
			$input['value'] = $value;
		}

		if ($placeholder !== 0) {

			$input['placeholder'] = $name;
			
			if ( $placeholder !== 1 ) {
				$input['placeholder'] = $placeholder;
			}
	
		}

		array_push($this->form_items, $input);
	}

	/**
	* 	inicializes a select field to be placed in the form
	*	
	*	params:
	*	$name 			string		name atribute of the select field
	*	$multiple		string		defines if the select accepts multiple selection
	*/
	public function select($name , $multiple = 0 )
	{
		$input = [];

		$input['type'] = 'select';
		$input['name'] = $name;
		$input['multiple'] = $multiple;

		array_push($this->form_items, $input);
	}

	/**
	* 	inicializes options to an existing select field
	*	
	*	params:
	*	$select			string		select the select input that this option belongs
	*	$value 			string		value atribute that the option passes.
	*	$output 		string		output the visible part of the option
	*	$selected 		string		selected atribute of the options accepts values 1 and 0
	*/
	public function option( $select , $value , $output , $selected = 0 )
	{
		$input = [];

		$input['select'] = $select;
		$input['value'] = $value;
		$input['output'] = $output;
		$input['selected'] = $selected;

		array_push($this->select_opt, $input);
	}


	/**
	* 	debug function serves only to output the info of the actual form
	*	
	*	params:
	*	N/A
	*/
	public function print_form_info(){

		echo "<br><b>name:</b>" . $this->header_name;
		echo "<br><b>action:</b>" . $this->header_action;
		echo "<br><b>type:</b>" . $this->header_type;

		echo "<pre>" , print_r($this->form_items) , "</pre>";
		echo "<pre>" , print_r($this->select_opt) , "</pre>";
	}

	public function input_pw( $name = "pw", $placeholder = "password" )
	{
		$input = [];
		
		$input['type'] = "password";
		$input['name'] = $name;
		$input['placeholder'] = $placeholder;

		array_push($this->form_items, $input);
	}

	public function input_email( $name = "email", $placeholder = "someone@someplace.com" )
	{
		$input = [];
		
		$input['type'] = "text";
		$input['name'] = $name;
		$input['placeholder'] = $placeholder;

		array_push($this->form_items, $input);
	}

	public function input_text( $name = "text", $placeholder = "some text" )
	{
		$input = [];
		
		$input['type'] = "text";
		$input['name'] = $name;
		$input['placeholder'] = $placeholder;

		array_push($this->form_items, $input);
	}

	public function label( $output = "label" , $for = 0 )
	{
		$input = [];
		
		$input['type'] = "label";
		$input['output'] = $output;
		if ($for != 0) {
			$input['for'] = $for;
		}
		$input['form'] = $this->header_name;

		array_push($this->form_items, $input);
	}

	/**
	*	Falta acrescentar tag de abertura e fecho do form e submit button
	*
	*/
	public function form_draw()
	{
		foreach ($this->form_items as $key) {

			switch ($key['type']) {
				case 'text':

					?>
					<div>
						<input type = <?php echo '"'.$key['type'].'"'; ?> 
							   name = <?php echo '"'.$key['name'].'"'; ?> 
							   placeholder = <?php echo '"'.$key['placeholder'].'"'; ?> 
							   <?php 
							   if (isset($key['value'])) {
							   	?>
							   		value = <?php echo '"'.$key['value'].'"'; ?>  \>
							   <?php
								}
							   	?>
					</div>
					<?php
					#echo $key['type'];
					break;

				case 'label':
					# code...
					?>
					<div>
						<label
								form = <?php echo '"'.$key['form'].'"'; ?> 
							<?php 
								if (isset($key['for'])) {
							?>
								for = <?php echo '"'.$key['for'].'"'; ?> 
							<?php
								}
							?>	
						>
								<?php echo $key['output']; ?> 
						</label> 
					</div>
					<?php
					break;

				case 'password':

					?>
					<div>
						<input type = <?php echo '"'.$key['type'].'"'; ?> 
							   name = <?php echo '"'.$key['name'].'"'; ?> 
							   placeholder = <?php echo '"'.$key['placeholder'].'"'; ?> 
							/>
					</div>
					<?php
					break;

				case 'select':

					?>
					<div>
						<select
							name = <?php echo '"'.$key['name'].'"'; ?>
							
						<?php 
							if ($key['multiple'] == 1) {
						?>
								multiple = <?php echo '"'.$key['multiple'].'"'; ?>  \>
						<?php
							}
						?>
							>
						<?php 

							foreach ($this->select_opt as $opt) {
								if ($opt['select'] == $key['name']) {
									# code...
							?>
								<option value = <?php echo '"'.$opt['value'].'"'; ?> 
										
								<?php 
									if ($opt['selected'] == 1) {
								?>
									selected
								<?php
									}
								?>

								>
										<?php echo $opt['output']; ?> 
								</option>
							<?php
								}
							}
						?>


						</select>
						
					</div>
					<?php
					break;
				
				default:
					# code...
					break;
			}
		#	echo "<pre>" , print_r($key) , "</pre>";
		}
	}
}

$form = new Form;
$form->input('text' , 'uname' , 'username' , 'lol' );
$form->input('password' , 'pw' , 'passwd' , '123' );

$form->select( 'computadores' , 0 );
$form->option( 'computadores' , '1' , 'Windows' );
$form->option( 'computadores' , '2' , 'Linux' , 1 );
$form->option( 'computadores' , '3' , 'Mac' );

$form->select( 'smartphones' , 1 );
$form->option( 'smartphones' , '1' , 'Android' );
$form->option( 'smartphones' , '2' , 'iPhone' , 1 );
$form->option( 'smartphones' , '3' , 'Ubuntu Touch' );
$form->option( 'smartphones' , '4' , 'Jolla' );

$form->input_pw();
$form->input_email();
$form->input_text();
$form->label();

#$form->print_form_info();

$form->form_draw();

?>
