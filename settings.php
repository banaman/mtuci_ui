<?php
defined('MOODLE_INTERNAL') || die();

// This is used for performance, we don't need to know about these settings on every page in Moodle, only when
// we are looking at the admin settings pages.
if ($ADMIN->fulltree) {

    // Boost provides a nice setting page which splits settings onto separate tabs. We want to use it here.
    $settings = new theme_boost_admin_settingspage_tabs('themesettingmtuci_ui', get_string('configtitle', 'theme_mtuci_ui'));

    // Each page is a tab - the first is the "General" tab.
    $page = new admin_settingpage('theme_mtuci_ui_general', get_string('generalsettings', 'theme_mtuci_ui'));

    // Replicate the preset setting from boost.
    $name = 'theme_mtuci_ui/preset';
    $title = get_string('preset', 'theme_mtuci_ui');
    $description = get_string('preset_desc', 'theme_mtuci_ui');
    $default = 'default.scss';

    // We list files in our own file area to add to the drop down. We will provide our own function to
    // load all the presets from the correct paths.
    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_mtuci_ui', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    // These are the built in presets from Boost.
    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';

    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset files setting.
    $name = 'theme_mtuci_ui/presetfiles';
    $title = get_string('presetfiles', 'theme_mtuci_ui');
    $description = get_string('presetfiles_desc', 'theme_mtuci_ui');

    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
        array('maxfiles' => 20, 'accepted_types' => array('.scss')));
    $page->add($setting);


    // Must add the page after definiting all the settings!
    $settings->add($page);

    // END GENERAR SETTINGS.

    $page = new admin_settingpage('theme_mtuci_ui_footer', get_string('footer', 'theme_mtuci_ui'));

    // Helplink.
    $name = 'theme_mtuci_ui/footerhidehelplink';
    $title = get_string('footerhidehelplinksetting', 'theme_mtuci_ui', null, true);
    $description = get_string('footerlinks_desc', 'theme_mtuci_ui', null, true);
    $setting = new admin_setting_configcheckbox($name, $title, $description, 'no', 'yes', 'no' ); // Overriding default values
        // yes = 1 and no = 0 because of the use of empty() in theme_mtuci_ui_get_pre_scss() (lib.php). Default 0 value would
        // not write the variable to scss that could cause the scss to crash if used in that file. See MDL-58376.
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Logininfo.
    $name = 'theme_mtuci_ui/footerhidelogininfo';
    $title = get_string('footerhidelogininfosetting', 'theme_mtuci_ui', null, true);
    $description = get_string('footerlinks_desc', 'theme_mtuci_ui', null, true);
    $setting = new admin_setting_configcheckbox($name, $title, $description, 'no', 'yes', 'no' ); // Overriding default values
        // yes = 1 and no = 0 because of the use of empty() in theme_mtuci_ui_get_pre_scss() (lib.php). Default 0 value would
        // not write the variable to scss that could cause the scss to crash if used in that file. See MDL-58376.
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Homelink.
    $name = 'theme_mtuci_ui/footerhidehomelink';
    $title = get_string('footerhidehomelinksetting', 'theme_mtuci_ui', null, true);
    $description = get_string('footerlinks_desc', 'theme_mtuci_ui', null, true);
    $setting = new admin_setting_configcheckbox($name, $title, $description, 'no', 'yes', 'no' ); // Overriding default values
        // yes = 1 and no = 0 because of the use of empty() in theme_mtuci_ui_get_pre_scss() (lib.php). Default 0 value would
        // not write the variable to scss that could cause the scss to crash if used in that file. See MDL-58376.
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // User tours.
    $name = 'theme_mtuci_ui/footerhideusertourslink';
    $title = get_string('footerhideusertourslinksetting', 'theme_mtuci_ui', null, true);
    $description = get_string('footerlinks_desc', 'theme_mtuci_ui', null, true);
    $setting = new admin_setting_configcheckbox($name, $title, $description, 'no', 'yes', 'no' ); // Overriding default values
    // Yes = 1 and no = 0 because of the use of empty() in theme_mtuci_ui_get_pre_scss() (lib.php). Default 0 value would
    // Not write the variable to scss that could cause the scss to crash if used in that file. See MDL-58376.
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_mtuci_ui/footerhidetooldataprivacy';
    $title = get_string('footerhidetooldataprivacysetting', 'theme_mtuci_ui', null, true);
    $description = get_string('footerlinks_desc', 'theme_mtuci_ui', null, true);
    $setting = new admin_setting_configcheckbox($name, $title, $description, 'no', 'yes', 'no' ); // Overriding default values
    // Yes = 1 and no = 0 because of the use of empty() in theme_mtuci_ui_get_pre_scss() (lib.php). Default 0 value would
    // Not write the variable to scss that could cause the scss to crash if used in that file. See MDL-58376.
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    $name = 'theme_mtuci_ui/footerhidewhole';
    $title = get_string('footerhidewholesetting', 'theme_mtuci_ui', null, true);
    $description = get_string('wholefooter_desc', 'theme_mtuci_ui', null, true);
    $setting = new admin_setting_configcheckbox($name, $title, $description, 'yes', 'yes', 'no' ); // Overriding default values
    // Yes = 1 and no = 0 because of the use of empty() in theme_mtuci_ui_get_pre_scss() (lib.php). Default 0 value would
    // Not write the variable to scss that could cause the scss to crash if used in that file. See MDL-58376.
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    $settings->add($page);
}
