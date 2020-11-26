<?php
# Create your BASE frame layout here with content.

function authenticate_view($content) {
    return frame('base_ui_login_register', $content);
}

function panel_view($content) {
    return frame('base_ui_panel', $content);
}