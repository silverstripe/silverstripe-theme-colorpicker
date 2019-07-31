<?php

namespace SilverStripe\Colorpicker\Extensions;

use SilverStripe\Colorpicker\Forms\ColorPickerField;
use SilverStripe\Colorpicker\Forms\FontPickerField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

/**
 * Class ColorpickerSiteConfigExtension
 * @package SilverStripe\Colorpicker\Extensions
 *
 * Adds color picker fields to the site config.
 */
class ColorpickerSiteConfigExtension extends DataExtension
{
    private static $db = array(
        'HeaderBackground' => 'Varchar(50)',
        'NavigationBarBackground' => 'Varchar(50)',
        'CarouselBackground' => 'Varchar(50)',
        'FooterBackground' => 'Varchar(50)',
        'AccentColor' => 'Varchar(50)',
        'BannerBlockBackground' => 'Varchar(50)',
        'TextLinkColor' => 'Varchar(50)',
    );

    /**
     * Defines if the theme color picker is enabled in the CMS
     *
     * @config
     * @var boolean
     */
    private static $enable_theme_color_picker = false;

    /**
     * Defines the theme colors that can be selected via the CMS
     *
     * @config
     * @var array
     */
    private static $theme_colors = [
        'default-accent' => [
            'Title' => 'Default',
            'CSSClass' => 'default-accent',
            'Color' => '#0F7EB2',
        ],
        'default-background' => [
            'Title' => 'Default',
            'CSSClass' => 'default-background',
            'Color' => '#001F2C',
        ],
        'red' => [
            'Title' => 'Red',
            'CSSClass' => 'red',
            'Color' => '#E51016',
        ],
        'dark-red' => [
            'Title' => 'Dark red',
            'CSSClass' => 'dark-red',
            'Color' => '#AD161E',
        ],
        'pink' => [
            'Title' => 'Pink',
            'CSSClass' => 'pink',
            'Color' => '#B32A95',
        ],
        'purple' => [
            'Title' => 'Purple',
            'CSSClass' => 'purple',
            'Color' => '#6239C8',
        ],
        'blue' => [
            'Title' => 'Blue',
            'CSSClass' => 'blue',
            'Color' => '#1F6BFE',
        ],
        'dark-blue' => [
            'Title' => 'Dark blue',
            'CSSClass' => 'dark-blue',
            'Color' => '#123581',
        ],
        'teal' => [
            'Title' => 'Teal',
            'CSSClass' => 'teal',
            'Color' => '#00837A',
        ],
        'green' => [
            'Title' => 'Green',
            'CSSClass' => 'green',
            'Color' => '#298436',
        ],
        'dark-orange' => [
            'Title' => 'Dark orange',
            'CSSClass' => 'dark-orange',
            'Color' => '#D34300',
        ],
        'dark-ochre' => [
            'Title' => 'Dark ochre',
            'CSSClass' => 'dark-ochre',
            'Color' => '#947200',
        ],
        'black' => [
            'Title' => 'Black',
            'CSSClass' => 'black',
            'Color' => '#111111',
        ],
        'dark-grey' => [
            'Title' => 'Dark grey',
            'CSSClass' => 'dark-grey',
            'Color' => '#555555',
        ],
        'light-grey' => [
            'Title' => 'Light grey',
            'CSSClass' => 'light-grey',
            'Color' => '#EAEAEA',
        ],
        'white' => [
            'Title' => 'White',
            'CSSClass' => 'white',
            'Color' => '#FFFFFF',
        ],
    ];

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        $this->addThemeColorPicker($fields);
    }

    /**
     * Add fields for selecting the theme colors for different areas of the site.
     *
     * @param  FieldList $fields
     * @return $this
     */
    protected function addThemeColorPicker(FieldList $fields)
    {
        // Only show theme color selector if enabled
        if (!$this->owner->config()->get('enable_theme_color_picker')) {
            return $this;
        }

        $fields->addFieldsToTab(
            'Root.ThemeOptions',
            [
                ColorPickerField::create(
                    'HeaderBackground',
                    _t(
                        __CLASS__ . '.HeaderBackground',
                        'Header background'
                    ),
                    $this->getThemeOptionsExcluding([
                        'default-accent',
                    ])
                ),
                ColorPickerField::create(
                    'NavigationBarBackground',
                    _t(
                        __CLASS__ . '.NavigationBarBackground',
                        'Navigation bar background'
                    ),
                    $this->getThemeOptionsExcluding([
                        'default-accent',
                    ])
                ),
                ColorPickerField::create(
                    'CarouselBackground',
                    _t(
                        __CLASS__ . '.CarouselBackground',
                        'Carousel background'
                    ),
                    $this->getThemeOptionsExcluding([
                        'default-accent',
                    ])
                )->setDescription(
                    _t(
                        __CLASS__ . '.CarouselBackgroundDescription',
                        'The background color of the carousel when there is no image set.'
                    )
                ),
                ColorPickerField::create(
                    'FooterBackground',
                    _t(
                        __CLASS__ . '.FooterBackground',
                        'Footer background'
                    ),
                    $this->getThemeOptionsExcluding([
                        'light-grey',
                        'white',
                        'default-accent',
                    ])
                ),
                ColorPickerField::create(
                    'AccentColor',
                    _t(
                        __CLASS__ . '.AccentColor',
                        'Accent color'
                    ),
                    $this->getThemeOptionsExcluding([
                        'light-grey',
                        'white',
                        'default-background',
                    ])
                )->setDescription(
                    _t(
                        __CLASS__ . '.AccentColorDescription',
                        'Affects color of buttons, current navigation items, etc. '.
                        'Please ensure sufficient contrast with background colors.'
                    )
                ),
                ColorPickerField::create(
                    'BannerBlockBackground',
                    _t(
                        __CLASS__ . '.BannerBlockBackground',
                        'Banner block background'
                    ),
                    $this->getOwner()->getThemeOptionsExcluding([
                        'light-grey',
                        'white',
                        'default-background',
                        'default-accent'
                    ])
                )->setDescription(
                    _t(
                        __CLASS__ . '.BannerBlockBackgroundDescription',
                        'Background color of banner blocks.'
                    )
                ),
                ColorPickerField::create(
                    'TextLinkColor',
                    _t(
                        __CLASS__ . '.TextLinkColor',
                        'Text link color'
                    ),
                    $this->getThemeOptionsExcluding([
                        'black',
                        'light-grey',
                        'dark-grey',
                        'white',
                        'default-background',
                    ])
                ),
            ]
        );

        return $this;
    }

    /**
     * Returns theme_colors used for ColorPickerField.
     *
     * @param  array  $excludedColors list of colors to exclude from the returned options
     *                                based on the theme color's 'CSSClass' value
     * @return array
     */
    public function getThemeOptionsExcluding($excludedColors = [])
    {
        $themeColors = $this->owner->config()->get('theme_colors');
        $options = [];

        foreach ($themeColors as $themeColor) {
            if (in_array($themeColor['CSSClass'], $excludedColors)) {
                continue;
            }

            $options[] = $themeColor;
        }

        return $options;
    }

    /**
     * If HeaderBackground is not set, assume no theme colors exist and populate some defaults if the color
     * picker is enabled. We don't use populateDefaults() because we don't want SiteConfig to re-populate its own
     * defaults.
     */
    public function onBeforeWrite()
    {
        $colorPickerEnabled = $this->owner->config()->get('enable_theme_color_picker');

        if ($colorPickerEnabled && !$this->owner->HeaderBackground) {
            $this->owner->update([
                'HeaderBackground' => 'default-background',
                'NavigationBarBackground' => 'default-background',
                'CarouselBackground' => 'default-background',
                'FooterBackground' => 'default-background',
                'AccentColor' => 'default-accent',
                'TextLinkColor' => 'default-accent',
                'BannerBlockBackground' => 'dark-orange'
            ]);
        }
    }
}
