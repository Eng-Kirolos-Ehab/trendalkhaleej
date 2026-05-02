<?php
$fox56_customize->add_section( 'header_presets',[
    'title' => 'Header predefined presets',
    'panel' => 'header',
]);

$header_presets_data = fox56_header_presets_data();
$fox56_customize->add_field([
    "type" => "radio_image",
    "id" => "header_presets_layout",
    "title" => "Header presets",
    "hint" => "Header presets",
    "section" => 'header_presets',
    "options" => $header_presets_data['img'],
    "custom_data" => $header_presets_data['json'],
    "std" => "",
    'transport' => 'refresh'
]);

$fox56_customize->add_field([
    "type" => "html",
    "id" => "header_presets_ex_import",
    "title" => "Import/Export Header",
    "hint" => "Import/Export header",
    "desc" => "You can Import/Export Your Header here.",
    "section" => 'header_presets',
    "html" => '<div>
        <span class="customize-control-title">Import/Export Header</span>
        <a id="header56_import_btn" href="#">Import Header</a> | <a id="header56_export_btn" href="#">Export Header</a>
        <input type="file" accept="application/json" id="header56_importer" style="display:none" />
    </div>',
    "transport" => "refresh",
]);

function fox56_header_presets_data() {
    $preset_url = get_template_directory_uri().'/inc/customize/images/header-presets';
    $preset_dir = get_template_directory().'/inc/customize/images/header-presets';
    $data_dir = $preset_dir.'/data';
    // Check if the directory exists
    try {
        // Read the directory contents
        $files = scandir($data_dir);
        // Filter out the current (.) and parent (..) directories
        $files = array_diff($files, array('.', '..'));
        $data = [];
        // Iterate through the files and directories
        foreach ($files as $file) {
            // Construct the full path
            $filePath = $data_dir . '/' . $file;
            $pathInfo = pathinfo($filePath);
            // Check if it's a file or a directory
            if (is_file($filePath) && 'json' == $pathInfo['extension'] &&
                // Check intro img
                file_exists($preset_dir . '/' . $pathInfo['filename'].'.jpg')
            ) {   
                $jsonContent = file_get_contents($filePath);
                $data['json'][$pathInfo['filename']] = json_decode($jsonContent, true);
                $data['img'][$pathInfo['filename']] = $preset_url.'/'. $pathInfo['filename'].'.jpg';
            }
        }

        return $data;
    } catch (Exception $e) {
        return [
            'img' => [],
            'json' => []
        ];
        // Handle the exception by printing the error message
        // echo 'Error: ' . $e->getMessage();
    }
}