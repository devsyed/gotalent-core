<?php 

defined('ABSPATH') || exit; 

class GTFormHelper
{
    public static function generate_form_fields($fields)
    {
        foreach ($fields as $field) {
            if (isset($field['type']) && isset($field['name'])) {
                $type = $field['type'];
                $name = $field['name'];
                $id = $name; 
                $label = isset($field['label']) ? $field['label'] : ucfirst($name); // Use the field name as the label if not specified
                $required = isset($field['required']) && $field['required'] ? 'required' : '';
    
                echo '<div class="gt-form-control mb-3 w-100">';
                echo '<label for="' . $id . '" class="form-label m-0">' . $label . '</label>';
    
                switch ($type) {
                    case 'text':
                    case 'password':
                    case 'email':
                    case 'number':
                        echo '<input type="' . $type . '" id="' . $id . '" name="' . $name . '" class="form-control" ' . $required . '>';
                        break;
    
                    case 'textarea':
                        echo '<textarea id="' . $id . '" name="' . $name . '" class="form-control" ' . $required . '></textarea>';
                        break;
    
                    case 'select':
                        if (isset($field['options']) && is_array($field['options'])) {
                            echo '<select id="' . $id . '" name="' . $name . '" class="form-control" ' . $required . '>';
                            foreach ($field['options'] as $option_value => $option_label) {
                                echo '<option value="' . $option_value . '">' . $option_label . '</option>';
                            }
                            echo '</select>';
                        }
                        break;
    
                    case 'radio':
                        if (isset($field['options']) && is_array($field['options'])) {
                            echo '<div class="gt-form-control mt-3 d-flex justify-content-start gap-4">';
                            foreach ($field['options'] as $option_value => $option_label) {
                                $checked = isset($field['checked']) && $field['checked'] === $option_value ? 'checked' : '';
                                echo '<div class="form-check">';
                                echo '<input class="form-check-input" type="radio" name="' . $name . '" id="' . $id . '_' . $option_value . '" value="' . $option_value . '" ' . $checked . '>';
                                echo '<label class="ms-2 form-check-label" for="' . $id . '_' . $option_value . '">' . $option_label . '</label>';
                                echo '</div>';
                            }
                            echo '</div>';
                        }
                        break;
    
                    // You can add more cases for other field types as needed
    
                    default:
                        // Handle unsupported field types
                        echo '<p>Unsupported field type: ' . $type . '</p>';
                        break;
                }
    
                echo '</div>';
            }
        }
    }

    public static function generate_dashboard_form_fields($fields)
    {
        foreach ($fields as $field) {
            if (isset($field['type']) && isset($field['name'])) {
                $type = $field['type'];
                $name = $field['name'];
                $id = $name; 
                $label = isset($field['label']) ? $field['label'] : ucfirst($name);
                $required = isset($field['required']) && $field['required'] ? 'required' : '';
                $value = isset($field['value']) ? $field['value'] : '';
                $fieldset_class = (isset($field['fieldset_class'])) ? $field['fieldset_class'] : '';
                $field_description = (isset($field['description'])) ? $field['description'] : '';
                $default_checked = (isset($field['default']) && $field['default'] == true) ? 'checked' : '';
                $info = (isset($field['info'])) ? $field['info'] : '';


    
                echo '<fieldset class="'.$fieldset_class.'">';
    
                if($type !== 'file'){
                    echo '<label for="' . $id . '" class="form-label m-0">' . $label . '</label>';
                }
    
                switch ($type) {
                    case 'hidden':
                        echo '<input type="' . $type . '" id="' . $id . '" name="' . $name . '" class="form-control" ' . $required . ' value="'.$value.'">
                        ';
                        break;
                    case 'text':
                    case 'password':
                    case 'email':
                    
                    case 'number':
                        echo '<input type="' . $type . '" id="' . $id . '" name="' . $name . '" class="form-control" ' . $required . ' value="'.$value.'">
                        <p class="info-field">'.$info.'</p>
                        ';
                        
                        break;
    
                    case 'textarea':
                        echo '<textarea id="' . $id . '" name="' . $name . '" class="form-control" ' . $required . '>'.$value.'</textarea>';
                        break;
    
                    case 'select':
                        if (isset($field['options']) && is_array($field['options'])) {
                            echo '<select id="' . $id . '" name="' . $name . '" class="form-control" ' . $required . '>';
                            foreach ($field['options'] as $option_value => $option_label) {
                                $selected = ($option_value == $field['default']) ? 'selected' : false;
                                echo '<option value="' . $option_value . '" '.$selected.'>' . $option_label . '</option>';
                            }
                            echo '</select>';
                        }
                        break;
    
                    case 'radio':
                        if (isset($field['options']) && is_array($field['options'])) {
                            echo '<div class="gt-form-control mt-3 d-flex justify-content-start gap-4">';
                            foreach ($field['options'] as $option_value => $option_label) {
                                $checked = isset($field['checked']) && $field['checked'] === $option_value ? 'checked' : '';
                                echo '<div class="form-check">';
                                echo '<input class="form-check-input" type="radio" name="' . $name . '" id="' . $id . '_' . $option_value . '" value="' . $option_value . '" ' . $checked . '>';
                                echo '<label class="ms-2 form-check-label" for="' . $id . '_' . $option_value . '">' . $option_label . '</label>';
                                echo '</div>';
                            }
                            echo '</div>';
                        }
                        break;
                    case 'checkbox':
                        echo '<div class="gt-form-control">
                        <p>'.$field_description.'</p>
                        <div class="form-check form-switch">
                        <input class="gt-switch form-check-input" name="'.$field['name'].'" type="checkbox" role="switch" id="'.$field['name'].'"value="'.strtolower($field['value']).'" '.$default_checked.'>
                        </div>';
                        break;
                    case 'range': 
                        echo '<div class="gt-form-control gt-range-field">
                        <p class="gt-range-input">AED </p>
                        <input type="range" min="100" max="'.$field['max'].'" step="'.$field['step'].'" value="'.$field['value'].'" class="gt-range form-control-range range-slider" id="'.$field['name'].'" name="'.$field['name'].'">
                        </div>';
                        break;
                    case 'wysiwyg':
                        echo '<textarea class="wysiwyg"></textarea>';
                      break;

                    case 'file':
                        echo '<div 
                        id="'.$field['name'].'" 
                        data-max-upload="'.$field['max_upload'].'" 
                        class="dropzone gt-dropzone" 
                        action="'.$field['action'].'"
                        data-input-id="'.$field['input_id'].'"
                    >
                    
                        <div class="dz-message" data-dz-message><span><p>'.__($field['message'],'gotalent-core').'</p></span></div>
                    </div>';

                        break;
                    case 'multiselect':
                        if (isset($field['options']) && is_array($field['options'])) {
                        echo '<select class="js-example-basic-multiple" name="'.$field['name'].'[]"
                            multiple="multiple">';
                            foreach ($field['options'] as $option_value => $option_label) {
                            $selected = ($option_value == 0) ? true : false;
                            echo '<option value="' . strtolower($option_label) . '" '.$selected.' selected="selected">' . ucfirst($option_label) . '</option>';
                            }
                            echo '</select>';
                        }
                        break;

                    default:
                        // Handle unsupported field types
                        echo '<p>Unsupported field type: ' . $type . '</p>';
                        break;
                }
    
                echo '</fieldset>';
            }
        }
    }

    public static function save_files($files, $directory = '')
    {

        $upload_dir = wp_get_upload_dir();
        $base_dir = ($directory !== '') ? $upload_dir['basedir'] . '/' . $directory : $upload_dir['basedir'];
        $base_url = ($directory !== '') ? $upload_dir['baseurl'] . '/' . $directory : $upload_dir['baseurl'];
        
        $files = $_FILES;
        $attachment_links = [];
        
        foreach ($files as $file) {
            $file_name = $file['name'];
            $unique_string = md5(time() . $file_name);
            $file_type = wp_check_filetype($file_name);
            $tmp_name = $file['tmp_name'];
            $file_mime_type = $file['type'];
        
            $destination = $base_dir . '/' . $unique_string . '.' . $file_type['ext'];
            move_uploaded_file($tmp_name, $destination);
        
            $image_link = $base_url . '/' . $unique_string . '.' . $file_type['ext'];
            $attachment_links[] = $image_link;
        }
        
        return $attachment_links;
        
    }
    
    
}
