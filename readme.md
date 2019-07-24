# Colorpicker Module

[![Build Status](https://travis-ci.org/silverstripe/silverstripe-colorpicker.svg?branch=master)](https://travis-ci.org/silverstripe/silverstripe-colorpicker)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/silverstripe/silverstripe-colorpicker/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/silverstripe/silverstripe-colorpicker/?branch=master)
[![codecov](https://codecov.io/gh/silverstripe/silverstripe-colorpicker/branch/master/graph/badge.svg)](https://codecov.io/gh/silverstripe/silverstripe-colorpicker)

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

## Versioning

This library follows [Semver](http://semver.org). According to Semver, you will be able to upgrade to any minor or patch version of this library without any breaking changes to the public API. Semver also requires that we clearly define the public API for this library.

All methods, with `public` visibility, are part of the public API. All other methods are not part of the public API. Where possible, we'll try to keep `protected` methods backwards-compatible in minor/patch versions, but if you're overriding methods then please test your work before upgrading.
