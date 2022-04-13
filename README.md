# Add Fake Text Button (Module for Magento 2)
[![Latest Stable Version](https://img.shields.io/packagist/v/ronangr1/module-add-fake-text-button.svg?style=flat-square)](https://packagist.org/packages/ronangr1/module-add-fake-text-button)
[![License: MIT](https://img.shields.io/github/license/ronangr1/M2-AddFakeTextButton.svg?style=flat-square)](./LICENSE) 
[![Packagist](https://img.shields.io/packagist/dt/ronangr1/module-add-fake-text-button.svg?style=flat-square)](https://packagist.org/packages/ronangr1/module-add-fake-text-button/stats)



- [Setup](#setup)
    - [Composer installation](#composer-installation)
    - [Setup the module](#setup-the-module)
- [Features](#features)
- [Settings](#settings)
- [Documentation](#documentation)
- [Support](#support)
- [Authors](#authors)
- [License](#license)

## Setup

Magento 2 Open Source or Commerce edition is required.

###  Composer installation

Run the following composer command:

```
composer require ronangr1/module-add-fake-text-button
```

### Setup the module

Run the following magento command:

```
bin/magento setup:upgrade
bin/magento s:s:d -f
bin/magento ca:cl
```

**If you are in production mode, do not forget to recompile and redeploy the static resources.**

## Features

### Generate fake text

Add a button that allows to generate fake text.

## Settings

The configuration for this module is available in `Stores > Configuration > Ronangr1 > Fake Text`.

## Documentation

### How to add the button

Example on `cms_block_form.xml`:

```xml
<field name="content" formElement="wysiwyg">
    <argument name="data" xsi:type="array">
        <item name="config" xsi:type="array">
            <item name="wysiwygConfigData" xsi:type="array">
                <item name="add_faketext" xsi:type="boolean">true</item>
            </item>
        </item>
    </argument>
</field>
```

## Support

Raise a new [request](https://github.com/ronangr1/M2-AddFakeTextButton/issues) to the issue tracker.

## Authors

- **ronangr1** - [![Twitter Follow](https://img.shields.io/twitter/follow/ronangr1.svg?style=social)](https://twitter.com/ronangr1)
- **Contributors**  [![GitHub contributors](https://img.shields.io/github/contributors/opengento/magento2-module.svg?style=flat-square)](https://github.com/ronangr1/module-add-fake-text-button/graphs/contributors)

## License

This project is licensed under the MIT License - see the [LICENSE](./LICENSE) details.

***That's all folks!***
