<?php

namespace SilverStripe\ThemeColorpicker\Tests\Extensions;

use SilverStripe\Core\Config\Config;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\SiteConfig\SiteConfig;

class ColorpickerSiteConfigExtensionTest extends SapphireTest
{
    protected $usesDatabase = true;

    /**
     * Ensure theme options are returned in the expected format without any excluded values
     */
    public function testGetThemeOptionsExcluding()
    {
        Config::modify()->set(SiteConfig::class, 'theme_colors', [
            'color1' => [
                'Title' => 'Color 1',
                'CSSClass' => 'color-1',
                'Color' => '#111111',
            ],
            'color2' => [
                'Title' => 'Color 2',
                'CSSClass' => 'color-2',
                'Color' => '#222222',
            ],
        ]);
        $siteConfig = SiteConfig::create();

        // Returns all colors by default
        $themeColors = $siteConfig->getThemeOptionsExcluding();
        $this->assertEquals([
            [
                'Title' => 'Color 1',
                'CSSClass' => 'color-1',
                'Color' => '#111111',
            ],
            [
                'Title' => 'Color 2',
                'CSSClass' => 'color-2',
                'Color' => '#222222',
            ],
        ], $themeColors);

        // Returns colors without excludedColors
        $themeColors = $siteConfig->getThemeOptionsExcluding(['color-1']);
        $this->assertEquals([
            [
                'Title' => 'Color 2',
                'CSSClass' => 'color-2',
                'Color' => '#222222',
            ],
        ], $themeColors);
    }

    public function testDefaultValuesAreNotWrittenWhenDisabled()
    {
        SiteConfig::config()->set('enable_theme_color_picker', false);

        $siteConfig = SiteConfig::create();
        $siteConfig->write();

        $this->assertEmpty($siteConfig->HeaderBackground, 'Color fields should not be written when disabled');
    }

    public function testDefaultValuesAreWrittenWhenEnabled()
    {
        SiteConfig::config()->set('enable_theme_color_picker', true);

        $siteConfig = SiteConfig::create();
        $siteConfig->write();

        $this->assertNotEmpty($siteConfig->HeaderBackground, 'Color fields should be written when enabled');
    }
}
