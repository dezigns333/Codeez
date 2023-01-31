<?php

//Codeez Application 
//Version 1.0 
//DesignCntrl 
//Hosted at http://print.designwork.me 

//WordPress Theme Design 
//PHP 
//MySQL 
//OpenAI API 

//WordPress Security Standards 

//Enqueue Scripts 
function codeez_scripts() {
	//CSS
	wp_enqueue_style('codeez-style', get_template_directory_uri() . '/css/codeez.css');
	//JavaScript
	wp_register_script('codeez-script', get_template_directory_uri() . '/js/codeez.js', array('jquery'), '1.0', true);
	wp_enqueue_script('codeez-script');
}
add_action('wp_enqueue_scripts', 'codeez_scripts');

//Codeez Template System Page 
function codeez_template_page() {
	//HTML
	?>
	<div class="codeez-templates">
		<h1>Template System</h1>
		<p>Choose from a wide selection of templates to quickly generate code.</p>
		<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
			<input type="hidden" name="action" value="codeez_template" />
			<select name="template" class="codeez-template-select">
				<option value="app">Software App</option>
				<option value="web">Web App</option>
				<option value="mobile">Mobile App</option>
			</select>
			<input type="submit" name="submit" class="codeez-submit" value="Generate Template" />
		</form>
	</div>
	<?php
}

//Codeez Prompt Based Page 
function codeez_prompt_page() {
	//HTML
	?>
	<div class="codeez-prompt">
		<h1>Prompt Based Code Generation</h1>
		<p>Answer a few simple questions to generate code quickly and easily.</p>
		<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
			<input type="hidden" name="action" value="codeez_prompt" />
			<p>What language would you like to use?</p>
			<select name="language" class="codeez-language-select">
				<option value="php">PHP</option>
				<option value="javascript">JavaScript</option>
				<option value="python">Python</option>
			</select>
			<p>What type of app are you creating?</p>
			<select name="apptype" class="codeez-apptype-select">
				<option value="web">Web App</option>
				<option value="mobile">Mobile App</option>
				<option value="desktop">Desktop App</option>
			</select>
			<input type="submit" name="submit" class="codeez-submit" value="Generate Code" />
		</form>
	</div>
	<?php
}

//Codeez Admin Link Page 
function codeez_admin_page() {
	//HTML
	?>
	<div class="codeez-admin">
		<h1>Admin Link</h1>
		<p>Manage Codeez from the Admin page.</p>
		<a href="<?php echo admin_url(); ?>" class="codeez-admin-link">Go to Admin Page</a>
	</div>
	<?php
}

//Codeez Output Page 
function codeez_output_page() {
	//HTML
	?>
	<div class="codeez-output">
		<h1>Output</h1>
		<p>Your code will be generated here.</p>
		<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
			<input type="hidden" name="action" value="codeez_output" />
			<textarea name="output" class="codeez-output-textarea" rows="4" cols="50" placeholder="Your code will be generated here"></textarea>
		</form>
	</div>
	<?php
}

//Codeez Code Generation Function 
function codeez_code_gen() {
	//variables
	$input = sanitize_text_field($_POST['input']);
	//Code Generation
	$code = OpenAI($input);
	//Output
	echo $code;
}
add_action('admin_post_codeez_code_gen', 'codeez_code_gen');
add_action('admin_post_nopriv_codeez_code_gen', 'codeez_code_gen');

//Codeez Template System Function 
function codeez_template() {
	//variables
	$template = sanitize_text_field($_POST['template']);
	//Template Generation
	$code = OpenAI($template);
	//Output
	echo $code;
}
add_action('admin_post_codeez_template', 'codeez_template');
add_action('admin_post_nopriv_codeez_template', 'codeez_template');

//Codeez Prompt Based Function 
function codeez_prompt() {
	//variables
	$language = sanitize_text_field($_POST['language']);
	$apptype = sanitize_text_field($_POST['apptype']);
	//Prompt Based Code Generation
	$code = OpenAI($language, $apptype);
	//Output
	echo $code;
}
add_action('admin_post_codeez_prompt', 'codeez_prompt');
add_action('admin_post_nopriv_codeez_prompt', 'codeez_prompt');

//Codeez Settings Function 
function codeez_settings() {
	//variables
	$input = sanitize_text_field($_POST['input']);
	$default = sanitize_text_field($_POST['default']);
	//Settings Generation
	$settings = OpenAI($input, $default);
	//Output
	echo $settings;
}
add_action('admin_post_codeez_settings', 'codeez_settings');
add_action('admin_post_nopriv_codeez_settings', 'codeez_settings');

//Codeez Output Function 
function codeez_output() {
	//variables
	$output = sanitize_text_field($_POST['output']);
	//Output
	echo $output;
}
add_action('admin_post_codeez_output', 'codeez_output');
add_action('admin_post_nopriv_codeez_output', 'codeez_output');



//Codeez Code Generation Page
function codeez_code_generation_page(){
	//variables
	$input = sanitize_text_field($_POST['input']);
	$output = '';
	//Code Generation
	if(isset($input) && !empty($input)){
		$output = '<h2>Code Generated</h2>';
		$output.= '<p><textarea rows="10" cols="50" name="output">'.$input.'</textarea></p>';
		$output.= '<p><input type="submit" name="submit" value="Submit"/></p>';
	} else {
		$output = '<h2>Code Generation</h2>';
		$output.= '<p><textarea rows="10" cols="50" name="input"></textarea></p>';
		$output.= '<p><input type="submit" name="submit" value="Generate"/></p>';
	}
	echo $output;
}
add_action('admin_post_codeez_code_generation_page', 'codeez_code_generation_page');
add_action('admin_post_nopriv_codeez_code_generation_page', 'codeez_code_generation_page');


//Codeez Templates Page
function codeez_templates_page(){
	//variables
	$template = sanitize_text_field($_POST['template']);
	$output = '';
	//Templates
	if(isset($template) && !empty($template)){
		$output = '<h2>Template Generated</h2>';
		$output.= '<p><textarea rows="10" cols="50" name="output">'.$template.'</textarea></p>';
		$output.= '<p><input type="submit" name="submit" value="Submit"/></p>';
	} else {
		$output = '<h2>Templates</h2>';
		$output.= '<p>Please select a template from the list below:</p>';
		$output.= '<p><select name="template">';
		$output.= '<option value="">--Select a template--</option>';
        $output .= '<option value="web_app">Web App</option>';
        $output .= '<option value="game_app">Game App</option>';
        $output .= '<option value="mobile_app">Mobile App</option>';
        $output .= '<option value="desktop_app">Desktop App</option>';
		$output.= '</select></p>';
		$output.= '<p><input type="submit" name="submit" value="Generate"/></p>';
	}
	echo $output;
}
add_action('admin_post_codeez_templates_page', 'codeez_templates_page');
add_action('admin_post_nopriv_codeez_templates_page', 'codeez_templates_page');


//Codeez Settings Page
function codeez_settings_page(){
	//variables
	$settings = sanitize_text_field($_POST['settings']);
	$output = '';
	//Settings
	if(isset($settings) && !empty($settings)){
		$output = '<h2>Settings Updated</h2>';
		$output.= '<p><textarea rows="10" cols="50" name="output">'.$settings.'</textarea></p>';
		$output.= '<p><input type="submit" name="submit" value="Submit"/></p>';
	} else {
		$output = '<h2>Settings</h2>';
		$output.= '<p>Please select the settings you would like to configure:</p>';
		$output.= '<p><input type="checkbox" name="settings[]" value="setting1">Setting 1</p>';
		$output.= '<p><input type="checkbox" name="settings[]" value="setting2">Setting 2</p>';
		$output.= '<p><input type="checkbox" name="settings[]" value="setting3">Setting 3</p>';
		$output.= '<p><input type="submit" name="submit" value="Configure"/></p>';
	}
	echo $output;
}
add_action('admin_post_codeez_settings_page', 'codeez_settings_page');
add_action('admin_post_nopriv_codeez_settings_page', 'codeez_settings_page');


//Codeez Admin Link
function codeez_admin_link(){
	$output = '<p><a href="'.admin_url().'">Admin Link</a></p>';
	echo $output;
}
add_action('admin_post_codeez_admin_link', 'codeez_admin_link');
add_action('admin_post_nopriv_codeez_admin_link', 'codeez_admin_link');

//Codeez Generate Code
function codeez_generate_code(){
	if(isset($_POST['input'])) {
		$input = $_POST['input'];
		$output = '<h1>Generated Code</h1>';
		$output .= '<p>The code generated is:</p>';
		$output .= '<textarea>'.$input.'</textarea>';
		echo $output;
	} elseif (isset($_POST['template'])) {
		$template = $_POST['template'];
		$output = '<h1>Generated Code</h1>';
		$output .= '<p>The code generated is:</p>';
		$output .= '<textarea>'.$template.'</textarea>';
		echo $output;
	}
}
add_action('admin_post_codeez_generate_code', 'codeez_generate_code');
add_action('admin_post_nopriv_codeez_generate_code', 'codeez_generate_code');

//Codeez Save Settings
function codeez_save_settings(){
	if(isset($_POST['language']) && isset($_POST['database'])) {
		$language = $_POST['language'];
		$database = $_POST['database'];
		$output = '<h1>Settings Saved</h1>';
		$output .= '<p>The settings have been saved:</p>';
		$output .= '<ul>';
		$output .= '<li>Language: '.$language.'</li>';
		$output .= '<li>Database: '.$database.'</li>';
		$output .= '</ul>';
		echo $output;
	}
}
add_action('admin_post_codeez_save_settings', 'codeez_save_settings');
add_action('admin_post_nopriv_codeez_save_settings', 'codeez_save_settings');

//Codeez Code Generation
function codeez_code_generation(){
	$output = '<h1>Code Generation</h1>';
	$output .= '<p>Generate code with the following settings:</p>';
	$output .= '<form action="'.admin_url('admin-post.php').'" method="post">';
	$output .= '<input type="hidden" name="action" value="codeez_generate_code">';
	$output .= '<label>Language:</label><input type="text" name="language"><br>';
	$output .= '<label>Database:</label><input type="text" name="database"><br>';
	$output .= '<input type="submit" name="submit" value="Generate">';
	$output .= '</form>';
	echo $output;
}
add_action('admin_post_codeez_generate_code', 'codeez_code_generation');
add_action('admin_post_nopriv_codeez_generate_code', 'codeez_code_generation');

//Codeez Save Code
function codeez_save_code(){
	if(isset($_POST['code'])) {
		$code = $_POST['code'];
		$output = '<h1>Code Saved</h1>';
		$output .= '<p>The code has been saved:</p>';
		$output .= '<ul>';
		$output .= '<li>Code: '.$code.'</li>';
		$output .= '</ul>';
		echo $output;
	}
}
add_action('admin_post_codeez_save_code', 'codeez_save_code');
add_action('admin_post_nopriv_codeez_save_code', 'codeez_save_code');

//Codeez Template System
function codeez_template_system(){
	$output = '<h1>Template System</h1>';
	$output .= '<p>Choose a template for your software application:</p>';
	$output .= '<form action="'.admin_url('admin-post.php').'" method="post">';
	$output .= '<input type="hidden" name="action" value="codeez_select_template">';
	$output .= '<select name="template">';
	$output .= '<option value="wordpress">WordPress</option>';
	$output .= '<option value="drupal">Drupal</option>';
	$output .= '<option value="joomla">Joomla</option>';
	$output .= '</select><br>';
	$output .= '<input type="submit" name="submit" value="Select">';
	$output .= '</form>';
	echo $output;
}
add_action('admin_post_codeez_select_template', 'codeez_template_system');
add_action('admin_post_nopriv_codeez_select_template', 'codeez_template_system');

//Codeez Select Template
function codeez_select_template(){
	if(isset($_POST['template'])) {
		$template = $_POST['template'];
		$output = '<h1>Template Selected</h1>';
		$output .= '<p>The following template has been selected:</p>';
		$output .= '<ul>';
		$output .= '<li>Template: '.$template.'</li>';
		$output .= '</ul>';
		echo $output;
	}
}
add_action('admin_post_codeez_select_template', 'codeez_select_template');
add_action('admin_post_nopriv_codeez_select_template', 'codeez_select_template');

//Codeez Configurable Settings
function codeez_configurable_settings(){
	$output = '<h1>Configurable Settings</h1>';
	$output .= '<p>Configure the settings with the following form elements:</p>';
	$output .= '<form action="'.admin_url('admin-post.php').'" method="post">';
	$output .= '<input type="hidden" name="action" value="codeez_configure_settings">';
	$output .= '<label>Language:</label><input type="text" name="language" value="PHP"><br>';
	$output .= '<label>Database:</label><input type="text" name="database" value="MySQL"><br>';
	$output .= '<input type="submit" name="submit" value="Configure">';
	$output .= '</form>';
	echo $output;
}
add_action('admin_post_codeez_configure_settings', 'codeez_configurable_settings');
add_action('admin_post_nopriv_codeez_configure_settings', 'codeez_configurable_settings');

//Codeez Configure Settings
function codeez_configure_settings(){
	if(isset($_POST['language']) && isset($_POST['database'])) {
		$language = $_POST['language'];
		$database = $_POST['database'];
		$output = '<h1>Settings Configured</h1>';
		$output .= '<p>The settings have been configured with the following values:</p>';
		$output .= '<ul>';
		$output .= '<li>Language: '.$language.'</li>';
		$output .= '<li>Database: '.$database.'</li>';
		$output .= '</ul>';
		echo $output;
	}
}
add_action('admin_post_codeez_configure_settings', 'codeez_configure_settings');
add_action('admin_post_nopriv_codeez_configure_settings', 'codeez_configure_settings');

function codeez_openai_api(){
	$url = 'https://api.openai.com/v1/engines/davinci/completions';

	$data = array (
		"prompt" => "Enter your prompt here...",
		"max_tokens" => 50,
		"temperature" => 0.7,
		"top_p" => 0.9
	);
	$data = json_encode($data);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);

	$result = json_decode($result);
	return $result;
}
add_action('admin_post_codeez_openai_api', 'codeez_openai_api');
add_action('admin_post_nopriv_codeez_openai_api', 'codeez_openai_api');


//Codeez Home Page
function codeez_home_page(){
	$output = '<h1>Codeez Home Page</h1>';
	$output .= '<p>This is the home page for Codeez software application. It will include an input form to enter code and a textarea to output the generated code.</p>';
	$output .= '<form action="" method="POST">';
	$output .= '<input type="text" name="code" placeholder="Enter code here...">';
	$output .= '<textarea name="output" placeholder="Generated code here..."></textarea>';
	$output .= '<input type="submit" value="Generate Code">';
	$output .= '</form>';
	$result = codeez_openai_api();
	$output .= '<h2>Generated Code</h2>';
	$output .= '<p>'.$result.'</p>';
	echo $output;
}
add_action('admin_post_codeez_home_page', 'codeez_home_page');
add_action('admin_post_nopriv_codeez_home_page', 'codeez_home_page');

function codeez_get_template_details($app_type){
	$app_types = array(
		'page' => array(
			'name' => 'Page',
			'type' => 'page'
		),
		'post' => array(
			'name' => 'Post',
			'type' => 'post'
		),
		'comment' => array(
			'name' => 'Comment',
			'type' => 'comment'
		),
		'user' => array(
			'name' => 'User',
			'type' => 'user'
		)
	);

	$template_details = array();

	if(isset($app_types[$app_type])){
		$template_details = $app_types[$app_type];
	}

	return $template_details;
}

//Codeez Template Selection
/*
function codeez_template_selection(){
	$app_type = $_POST['app_type'];
	if($app_type == 'web_app'){
		$output = '<h2>Web App Templates</h2>';
		$output .= '<p>This page will allow users to choose from different web app templates.</p>';
		$output .= '<form action="" method="POST">';
		$output .= '<select name="web_app_template">';
		$output .= '<option value="blog_template">Blog Template</option>';
		$output .= '<option value="ecommerce_template">Ecommerce Template</option>';
		$output .= '<option value="portfolio_template">Portfolio Template</option>';
		$output .= '<option value="forum_template">Forum Template</option>';
		$output .= '</select>';
		$output .= '<input type="submit" name="submit">';
		$output .= '</form>';

		echo $output;
	} else if($app_type == 'game_app'){
		$output = '<h2>Game App Templates</h2>';
		$output .= '<p>This page will allow users to choose from different game app templates.</p>';
		$output .= '<form action="" method="POST">';
		$output .= '<select name="game_app_template">';
		$output .= '<option value="puzzle_template">Puzzle Template</option>';
		$output .= '<option value="arcade_template">Arcade Template</option>';
		$output .= '<option value="adventure_template">Adventure Template</option>';
		$output .= '<option value="strategy_template">Strategy Template</option>';
		$output .= '</select>';
		$output .= '<input type="submit" name="submit">';
		$output .= '</form>';

		echo $output;
	} else if($app_type == 'mobile_app'){
		$output = '<h2>Mobile App Templates</h2>';
		$output .= '<p>This page will allow users to choose from different mobile app templates.</p>';
		$output .= '<form action="" method="POST">';
		$output .= '<select name="mobile_app_template">';
		$output .= '<option value="social_template">Social Template</option>';
		$output .= '<option value="location_template">Location Template</option>';
		$output .= '<option value="utility_template">Utility Template</option>';
		$output .= '<option value="entertainment_template">Entertainment Template</option>';
		$output .= '</select>';
		$output .= '<input type="submit" name="submit">';
		$output .= '</form>';

		echo $output;
	} else if($app_type == 'desktop_app'){
		$output = '<h2>Desktop App Templates</h2>';
		$output .= '<p>This page will allow users to choose from different desktop app templates.</p>';
		$output .= '<form action="" method="POST">';
		$output .= '<select name="desktop_app_template">';
		$output .= '<option value="office_template">Office Template</option>';
		$output .= '<option value="photo_template">Photo Template</option>';
		$output .= '<option value="video_template">Video Template</option>';
		$output .= '<option value="music_template">Music Template</option>';
		$output .= '</select>';
		$output .= '<input type="submit" name="submit">';
		$output .= '</form>';

		echo $output;
	}
}
*/

if(isset($_POST['submit'])){
	if(isset($_POST['app_type'])){
		codeez_template_selection();
	}
} else {
	codeez_templates_page();
}




function codeez_template_selection(){

	$app_type = $_POST['app_type'];
	$get_template_details = codeez_get_template_details($app_type);

?>
<div class="wrap">
	<h2>Create <?php echo ucwords($get_template_details['name']); ?></h2>
	<form method="post" action="">
		<input type="hidden" name="app_type" value="<?php echo $get_template_details['type']; ?>" />
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="app_name">Application Name</label></th>
					<td><input type="text" name="app_name" value="" class="regular-text" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="app_slug">Application Slug</label></th>
					<td><input type="text" name="app_slug" value="" class="regular-text" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="app_desc">Application Description</label></th>
					<td><input type="text" name="app_desc" value="" class="regular-text" /></td>
				</tr>
			</tbody>
		</table>
		<p class="submit"><input type="submit" name="create_app" value="Create" class="button button-primary" /></p>
	</form>
</div>
<?php

}

function codeez_create_app(){
	$app_type = $_POST['app_type'];
	$app_name = $_POST['app_name'];
	$app_slug = $_POST['app_slug'];
	$app_desc = $_POST['app_desc'];

	if(!empty($app_type) && !empty($app_name) && !empty($app_slug) && !empty($app_desc)){
		$create_app = codeez_create_application($app_type, $app_name, $app_slug, $app_desc);

		if($create_app){
			echo '<div class="updated"><p>Application successfully created.</p></div>';
		} else {
			echo '<div class="error"><p>Unable to create application.</p></div>';
		}
	}


 if(isset($_POST['create_app'])){ codeez_create_app(); } ?>

<div class="wrap">
	<h2>Create an Application</h2>
	<form method="post" action="<?php echo admin_url('admin.php?page=create_app'); ?>">
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="app_type">Application Type</label></th>
				<td>
					<select name="app_type" id="app_type" class="regular-text">
						<option value="">-- Select an Application Type --</option>
						<option value="page">Page</option>
						<option value="post">Post</option>
						<option value="comment">Comment</option>
						<option value="user">User</option>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="app_name">Application Name</label></th>
				<td><input type="text" name="app_name" id="app_name" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="app_slug">Application Slug</label></th>
				<td><input type="text" name="app_slug" id="app_slug" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="app_desc">Application Description</label></th>
				<td><textarea name="app_desc" id="app_desc" cols="30" rows="10" class="regular-text"></textarea></td>
			</tr>
		</table>

		<?php submit_button('Create Application'); ?>
		<input type="hidden" name="create_app" value="1" />
	</form>
</div>
<?php submit_button('Create Application'); ?>
		<input type="hidden" name="create_app" value="1" />
	</form>
</div>

<?php
}


if(isset($_POST['create_app'])){ codeez_create_app(); } ?>

<div class="wrap">
	<h2>Create an Application</h2>
	<form method="post" action="<?php echo admin_url('admin.php?page=create_app'); ?>">
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="app_type">Application Type</label></th>
				<td>
					<select name="app_type" id="app_type" class="regular-text">
						<option value="">-- Select an Application Type --</option>
						<option value="page">Page</option>
						<option value="post">Post</option>
						<option value="comment">Comment</option>
						<option value="user">User</option>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="app_name">Application Name</label></th>
				<td><input type="text" name="app_name" id="app_name" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="app_slug">Application Slug</label></th>
				<td><input type="text" name="app_slug" id="app_slug" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="app_desc">Application Description</label></th>
				<td><textarea name="app_desc" id="app_desc" cols="30" rows="10" class="regular-text"></textarea></td>
			</tr>
		</table>

		<?php submit_button('Create Application'); ?>
		<input type="hidden" name="create_app" value="1" />
	</form>
</div>
<?php


function codeez_create_app(){
	global $wpdb;

	$app_type 	= $_POST['app_type'];
	$app_name 	= $_POST['app_name'];
	$app_slug 	= $_POST['app_slug'];
	$app_desc 	= $_POST['app_desc'];

	$table_name = $wpdb->prefix . "codeez_apps";

	$wpdb->insert(
		$table_name,
		array(
			'app_name' 	=> $app_name,
			'app_slug' 	=> $app_slug,
			'app_desc' 	=> $app_desc,
			'app_type' 	=> $app_type
		)
	);
	
	$app_id = $wpdb->insert_id;

	if(!empty($app_id)){
		// Create DB Tables
		codeez_create_db_tables($app_id, $app_slug);

		// Create App Pages
		codeez_create_app_pages($app_slug);

		// Create App Menus
		codeez_create_app_menus($app_slug);

		// Create App Settings
		codeez_create_app_settings($app_slug);
	}
}

function codeez_create_db_tables($app_id, $app_slug){
	global $wpdb;

	$table_name = $wpdb->prefix . "codeez_app_$app_slug";

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		`app_id` int(11) NOT NULL,
		`app_key` varchar(50) NOT NULL,
		`app_value` longtext NOT NULL
	) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
}

function codeez_create_app_pages($app_slug){
	global $wpdb;

	$table_name = $wpdb->prefix . "codeez_pages";

	$wpdb->insert(
		$table_name,
		array(
			'page_name' 	=> ucwords($app_slug),
			'page_slug' 	=> $app_slug
		)
	);
}

function codeez_create_app_menus($app_slug){
	global $wpdb;

	$table_name = $wpdb->prefix . "codeez_menus";

	$wpdb->insert(
		$table_name,
		array(
			'menu_name' 	=> ucwords($app_slug),
			'menu_slug' 	=> $app_slug,
			'menu_type' 	=> 'main',
			'menu_icon' 	=> 'fa-desktop',
			'menu_order' 	=> 0
		)
	);
}

function codeez_create_app_settings($app_slug){
	global $wpdb;

	$table_name = $wpdb->prefix . "codeez_settings";

	$wpdb->insert(
		$table_name,
		array(
			'setting_name' 	=> ucwords($app_slug),
			'setting_slug' 	=> $app_slug
		)
	);
}


/* End of File */

?>
