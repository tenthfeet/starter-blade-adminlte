<?php

if (! function_exists('generate_options')) {
    /**
     * Generate HTML <option> tags from iterable data.
     *
     * @param  iterable  $data  Key-value pairs where key is the option value and value is the display text.
     * @param  array  $selected  Array of selected values (strings or integers).
     * @param  string  $placeholder  Optional placeholder text.
     * @param  bool  $readonly  Whether to disable the select (affects only the placeholder).
     * @return string HTML option elements
     */
    function generate_options(iterable $data, array $selected = [], string $placeholder = '', bool $readonly = false): string
    {
        $options = '';

        if (! empty($placeholder)) {
            $safePlaceholder = htmlspecialchars($placeholder, ENT_QUOTES, 'UTF-8');
            $disabledAttribute = $readonly ? ' disabled' : '';
            $options .= "<option value=\"\"$disabledAttribute>$safePlaceholder</option>";
        }

        foreach ($data as $key => $val) {
            $key = htmlspecialchars((string) $key, ENT_QUOTES, 'UTF-8');
            $val = htmlspecialchars((string) $val, ENT_QUOTES, 'UTF-8');
            $isSelected = in_array($key, array_map('strval', $selected), true) ? ' selected' : '';

            $options .= "<option value=\"$key\"$isSelected>$val</option>";
        }

        return $options;
    }
}
