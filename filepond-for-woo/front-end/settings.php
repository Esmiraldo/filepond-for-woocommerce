<?php
function add_settings_page() {
    add_submenu_page(
        'options-general',  // Parent menu slug
        'File Upload Settings',  // Page title
        'File Upload Settings',  // Menu title
        'manage_options',  // Capability
        'file-upload-settings',  // Menu slug
        'render_settings_page'  // Callback function to render the page
    );
}
add_action('admin_menu', 'add_settings_page');

function render_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
                // Output security fields and settings sections
                settings_fields('file_upload_settings');
                do_settings_sections('file-upload-settings');
                submit_button();
            ?>
        </form>
    </div>
    <?php
}

function register_settings() {
    // Register a new section
    add_settings_section(
        'file_upload_section',  // ID
        'File Upload Settings',  // Title
        '',  // Callback function to render the section description
        'file-upload-settings'  // Page to add the section to
    );

    // Register a new field to set the maximum size
    add_settings_field(
        'max_size',  // ID
        'Max Size',  // Title
        'render_max_size_field',  // Callback function to render the field
        'file-upload-settings',  // Page to add the field to
        'file_upload_section'  // Section to add the field to
    );
    register_setting('file_upload_settings', 'max_size', ['type' => 'integer']);

    // Register a new field to set the file types
    add_settings_field(
        'file_types',  // ID
        'File Types',  // Title
        'render_file_types_field',  // Callback function to render the field
        'file-upload-settings',  // Page to add the field to
        'file_upload_section'  // Section to add the field to
    );
    register_setting('file_upload_settings', 'file_types', ['type' => 'string']);

    // Register a new field to enable/disable the preview
    add_settings_field(
        'preview_enable',  // ID
        'Preview Enable',  // Title
        'render_preview_enable_field',  // Callback function to render the field
        'file-upload-settings',  // Page to add the field to
        'file_upload_section'  // Section to add the field to
    );
    register_setting('file_upload_settings', 'preview_enable', ['type' => 'boolean']);
}
add_action('admin_init', 'register_settings');

// Callback function to render the max size field
function render_max_size_field() {
// Get saved max size value
$max_size = get_option( 'wc_filepond_max_size' );
?>
<input type="number" name="wc_filepond_max_size" value="<?php echo esc_attr( $max_size ); ?>">

  <?php
}

// Callback function to render the allowed file types field
function render_allowed_file_types_field() {
  // Get saved allowed file types value
  $allowed_file_types = get_option( 'wc_filepond_allowed_file_types' );
  ?>
  <input type="text" name="wc_filepond_allowed_file_types" value="<?php echo esc_attr( $allowed_file_types ); ?>">
  <p class="description">Enter allowed file types separated by commas (e.g. jpg, png, pdf)</p>
  <?php
}
// Callback function to render the preview enable field
function render_preview_enable_field() {
// Get saved preview enable value
$preview_enable = get_option( 'wc_filepond_preview_enable' );
?>
<input type="checkbox" name="wc_filepond_preview_enable" value="1" <?php checked( $preview_enable, 1 ); ?>>

  <?php
}

// Function to add a new page under dashboard of plugin
function wc_filepond_add_settings_page() {
  add_submenu_page(
    'woocommerce',
    'Filepond Settings',
    'Filepond Settings',
    'manage_options',
    'wc-filepond-settings',
    'wc_filepond_render_settings_page'
  );
}

// Callback function to render the settings page
function wc_filepond_render_settings_page() {
  ?>
  <div class="wrap">
    <h1>Filepond Settings</h1>
    <form method="post" action="options.php">
      <?php
      // Security field and save button
      settings_fields( 'wc_filepond_settings' );
      do_settings_sections( 'wc-filepond-settings' );
      submit_button();
      ?>
    </form>
  </div>
  <?php
}
// Function to register plugin settings
function wc_filepond_register_settings() {
// Register max size setting
register_setting(
'wc_filepond_settings',
'wc_filepond_max_size',
'intval'
);

// Register allowed file types setting
register_setting(
'wc_filepond_settings',
'wc_filepond_allowed_file_types'
);

// Register preview enable setting
register_setting(
'wc_filepond_settings',
'wc_filepond_preview_enable',
'intval'
);

// Add max size section
add_settings_section(
'wc_filepond_max_size_section',
'Max Size',
'wc_filepond_render_max_size_section',
'wc-filepond-settings'
);

// Add max size field
add_settings_field(
'wc_filepond_max_size_field',
'Max Size (in MB)',
'render_max_size_field',
'wc-filepond-settings',
'wc_filepond_max_size_section'
);

// Add allowed file types section
add_settings_section(
'wc_filepond_allowed_file_types_section',
'Allowed File Types',
'wc_filepond_render_allowed_file_types_section',
'wc-filepond-settings'
);

// Add allowed file types field
add_settings_field(
'wc_filepond_allowed_file_types_field',
'Allowed File Types',
'render_allowed_file_types_field',
'wc-filepond-settings',
'wc_filepond_allowed_file_types_section'
);

// Add preview enable section
add_settings_section(
'wc_filepond_preview_enable_section',
'Preview Enable',
'wc_filepond_render_preview_enable_section',
'wc-filepond-settings'
);

// Add preview enable field
add_settings_field(
'wc_filepond_preview_enable_field',
'Preview Enable',
'render_preview_enable_field',
'wc-filepond-settings',
'wc_filepond_preview_enable_section'
);
}

// Callback function to render the max size section
function wc_filepond_render_max_size_section() {
echo 'Set the maximum allowed size for uploaded files.';
}

// Callback function to render the allowed file types section
function wc_filepond_render_allowed_file_types_section() {
echo 'Set the allowed file types for uploaded files.';
}

// Callback function to render the preview enable section
function wc_filepond_render_preview_enable_section() {
echo 'Enable or disable preview for uploaded files.';
}
// Callback function to render the preview enable field
function wc_filepond_render_preview_enable_field() {
$options = get_option( 'wc_filepond_settings' );
$preview_enable = isset( $options['preview_enable'] ) ? $options['preview_enable'] : 'yes';
?>
<input type="radio" name="wc_filepond_settings[preview_enable]" value="yes" <?php checked( 'yes', $preview_enable ); ?>>Yes
<input type="radio" name="wc_filepond_settings[preview_enable]" value="no" <?php checked( 'no', $preview_enable ); ?>>No

  <?php
}

// Add preview enable section
add_settings_section(
  'wc_filepond_preview_enable_section',
  'Preview Enable',
  'wc_filepond_render_preview_enable_section',
  'wc_filepond_settings'
);

// Add preview enable field
add_settings_field(
  'preview_enable',
  'Preview Enable',
  'wc_filepond_render_preview_enable_field',
  'wc_filepond_settings',
  'wc_filepond_preview_enable_section'
);
