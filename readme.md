# Colorpicker Module

[![Build Status](https://travis-ci.org/silverstripe/silverstripe-theme-colorpicker.svg?branch=master)](https://travis-ci.org/silverstripe/silverstripe-theme-colorpicker)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/silverstripe/silverstripe-theme-colorpicker/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/silverstripe/silverstripe-theme-colorpicker/?branch=master)
[![codecov](https://codecov.io/gh/silverstripe/silverstripe-theme-colorpicker/branch/master/graph/badge.svg)](https://codecov.io/gh/silverstripe/silverstripe-theme-colorpicker)

This module provides a [Theme color picker](docs/en/01_Features/ThemeColors.md). It allows CMS users to adjust the colors of different areas of their site without requiring developer intervention.

## Installation

To install this module, you can do so with Composer:

```
composer require silverstripe/theme-colorpicker
```

## Usage

### Enabling

By default the theme color picker is disabled, to enable this you can adjust your YAML configuration. E.g. in
`app/_config/config.yml`:

```yml
SilverStripe\SiteConfig\SiteConfig:
  enable_theme_color_picker: true
```

### Adjusting/adding colors

Colorpicker is already supported by the [Watea](https://github.com/silverstripe/cwp-watea-theme) and [Bambusa](https://github.com/silverstripe/bambusa-theme) themes and will work out of the box.

The theme colors are all configurable, so via YAML configuration you can adjust existing colors or add new ones to
the theme color picker. see `ColorpickerSiteConfigExtension.theme_colors` for a list of the default colors.

```yml
SilverStripe\SiteConfig\SiteConfig:
  enable_theme_color_picker: true
  theme_colors:
    # Edit existing pink color
    pink:
      Color: '#C12099'
    # Add new brown color
    brown:
      Title: 'Brown'
      CSSClass: 'brown'
      Color: '#594116'
```

Now you can add the matching color to your SCSS. Assuming your project is using a custom theme which imports Wātea's
`main.scss` file, create a `$custom-theme-colors` as follows:

```scss
// themes/customtheme/scss/main.scss

// Ensure this variable is set before importing watea scss
$custom-theme-colors: (
  'pink': #C12099, // Adjusting existing pink color
  'brown': #594116 // Adding new brown color
);

@import '../../../watea/src/scss/main';
```

For more information on using customisable theme colors in the Wātea theme, please refer to the CWP
Developer documentation: [Using the Wātea theme](https://github.com/silverstripe/cwp/blob/master/docs/en/01_Working_with_projects/14_Using_the_Watea_theme.md).

## Using in your own theme

First, ensure that there is a HTML `class` present in your template which indicates the theme variation to the CSS.
Below is the default implementation which you'll also find in the Bambusa and Watea theme.

```html
<body class="$ClassName
        <% if $SiteConfig.HeaderBackground %>theme-header-{$SiteConfig.HeaderBackground}<% end_if %>
        <% if $SiteConfig.NavigationBarBackground %>theme-nav-{$SiteConfig.NavigationBarBackground}<% end_if %>
        <% if $SiteConfig.CarouselBackground %>theme-carousel-{$SiteConfig.CarouselBackground}<% end_if %>
        <% if $SiteConfig.FooterBackground %>theme-footer-{$SiteConfig.FooterBackground}<% end_if %>
        <% if $SiteConfig.AccentColor %>theme-accent-{$SiteConfig.AccentColor}<% end_if %>
        <% if $SiteConfig.TextLinkColor %>theme-link-{$SiteConfig.TextLinkColor}<% end_if %>
        <% if $SiteConfig.BannerBlockBackground %>theme-banner-block-{$SiteConfig.BannerBlockBackground}<% end_if %>">
```

You can now either manually generated the colour variations in your CSS (class name suffixes),
or you can trawl through the `src/scss` folder in either the Bambusa or Watea theme to find out how to use `@mixin` in SCSS to achieve that automatically.

## Versioning

This library follows [Semver](http://semver.org). According to Semver, you will be able to upgrade to any minor or patch version of this library without any breaking changes to the public API. Semver also requires that we clearly define the public API for this library.

All methods, with `public` visibility, are part of the public API. All other methods are not part of the public API. Where possible, we'll try to keep `protected` methods backwards-compatible in minor/patch versions, but if you're overriding methods then please test your work before upgrading.
